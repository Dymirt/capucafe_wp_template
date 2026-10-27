<?php
/** Run with: npm run local:wp -- eval-file "$PWD/tests/p1-local-test.php"
 * Uses disposable local products, removes them in finally; never touches orders.
 */
if (wp_get_environment_type() !== 'local' || wp_parse_url(home_url(), PHP_URL_HOST) !== 'capuccino-dev.local') throw new RuntimeException('Local only.');
$GLOBALS['ccafe_test_checks'] = 0;
function ccafe_test($condition, $message) {
	if (!$condition) throw new RuntimeException('FAIL: ' . $message);
	$GLOBALS['ccafe_test_checks']++;
}
$parent = get_page_by_path('praliny', OBJECT, 'product');
$product = wc_get_product($parent->ID);
$flavours = get_posts(['post_type'=>'praliny_candy','post_status'=>'publish','numberposts'=>2]);
$id = $flavours[0]->ID;
foreach ($product->get_children() as $variation_id) {
	$v = wc_get_product($variation_id);
	$capacity = (int) $v->get_attribute('ilosc-sztuk-w-opakowaniu');
	if (!$capacity) continue;
	$raw = wp_json_encode([['id'=>$id,'name'=>'Sfałszowana nazwa','quantity'=>$capacity]]);
	$result = ccafe_praline_configuration($parent->ID, $variation_id, $raw);
	ccafe_test(!is_wp_error($result), "valid $capacity");
	ccafe_test($result['custom_candies'][0]['name'] === $flavours[0]->post_title, 'name derived from CMS');
	ccafe_test($result['box_size'] === "$capacity sztuk", 'real variation capacity');
	foreach ([-1,0,1.5,'6.0',true,null,$capacity-1,$capacity+1,999999999] as $qty) ccafe_test(is_wp_error(ccafe_praline_configuration($parent->ID,$variation_id,wp_json_encode([['id'=>$id,'quantity'=>$qty]]))), 'invalid flavour quantity');
	foreach (['[]','null','{bad',str_repeat('a',8193),wp_json_encode([['id'=>99999999,'quantity'=>$capacity]]),wp_json_encode([['id'=>$id,'quantity'=>1],['id'=>$id,'quantity'=>$capacity-1]]),wp_json_encode([['name'=>'Advocat','quantity'=>$capacity]])] as $bad) ccafe_test(is_wp_error(ccafe_praline_configuration($parent->ID,$variation_id,$bad)), 'invalid payload');
	$_POST = ['custom_candies'=>wp_slash($raw),'ccafe_praline_nonce'=>wp_create_nonce(ccafe_session_nonce_action('ccafe_pralines_'.$parent->ID)),'box_size'=>'999 sztuk'];
	ccafe_test(!is_wp_error(ccafe_praline_request($parent->ID,$variation_id)), 'valid signed request');
	$data=apply_filters('woocommerce_add_cart_item_data',[], $parent->ID,$variation_id);
	ccafe_test($data['box_size'] === "$capacity sztuk", 'forged box ignored');
	$_POST['ccafe_praline_nonce']='bad';
	ccafe_test(is_wp_error(ccafe_praline_request($parent->ID,$variation_id)), 'nonce rejected');
	ccafe_test(!apply_filters('woocommerce_add_to_cart_validation',true,$parent->ID,1,$variation_id), 'validation hook denies request');
	try { apply_filters('woocommerce_add_cart_item_data',[], $parent->ID,$variation_id); $blocked=false; } catch (Exception $e) { $blocked=true; }
	ccafe_test($blocked, 'direct cart API protected');
	$legacy=apply_filters('woocommerce_get_cart_item_from_session',['product_id'=>$parent->ID,'variation_id'=>$variation_id,'custom_candies'=>'malformed']);
	ccafe_test(!empty($legacy['ccafe_praline_invalid']) && !isset($legacy['custom_candies']), 'malformed old session safe to render');
	$restored=apply_filters('woocommerce_get_cart_item_from_session',array_merge($data,['product_id'=>$parent->ID,'variation_id'=>$variation_id]));
	ccafe_test(empty($restored['ccafe_praline_invalid']) && $restored['custom_candies']===$data['custom_candies'],'valid session restored');
}
ccafe_test(is_wp_error(ccafe_praline_configuration($parent->ID,0,'[]')), 'no variation');
ccafe_test(is_wp_error(ccafe_praline_configuration($parent->ID,1383,'[]')), 'unrelated product');
$_POST=['custom_candies'=>'malformed','box_size'=>['bad']];
ccafe_test(apply_filters('woocommerce_add_cart_item_data',[],1383,0) === [], 'unrelated product unaffected');
foreach ([null,[],false,true,-1,'-1','1.5',1.5,'1e3','01',' 1','1000000000'] as $invalid) ccafe_test(ccafe_integer($invalid,true) === false,'strict cart integer');
$created=[];
try {
	$stock=new WC_Product_Simple(); $stock->set_name('LOCAL P1 TEST'); $stock->set_status('publish'); $stock->set_regular_price('10'); $stock->set_manage_stock(true); $stock->set_stock_quantity(5); $created[]=$stock->save();
	$cart=new WC_Cart();
	// Populate only an isolated in-memory cart; no customer's session is changed.
	$cart->cart_contents=['test'=>['data'=>$stock,'quantity'=>2,'product_id'=>$stock->get_id(),'variation_id'=>0]];
	ccafe_test(ccafe_cart_quantity_error($cart,'test',3) === null,'valid stock');
	ccafe_test(ccafe_cart_quantity_error($cart,'test',0) === null,'explicit removal');
	foreach ([null,[],-1,'2.5','bad',6] as $bad) ccafe_test(is_wp_error(ccafe_cart_quantity_error($cart,'test',$bad)),'bad cart request');
	ccafe_test(is_wp_error(ccafe_cart_quantity_error($cart,'foreign',1)),'foreign key');
	$cart->cart_contents['other']=['data'=>$stock,'quantity'=>3,'product_id'=>$stock->get_id(),'variation_id'=>0];
	ccafe_test(is_wp_error(ccafe_cart_quantity_error($cart,'test',3)),'aggregate stock across lines');
	unset($cart->cart_contents['other']);
	$stock->set_sold_individually(true);
	ccafe_test(is_wp_error(ccafe_cart_quantity_error($cart,'test',2)),'sold individually');
	$stock->set_sold_individually(false); $stock->set_stock_status('outofstock');
	ccafe_test(is_wp_error(ccafe_cart_quantity_error($cart,'test',1)),'out of stock');
	ccafe_test(ccafe_cart_quantity_error($cart,'test',0) === null,'unavailable product can be removed');
	$stock->set_stock_status('instock'); $stock->set_backorders('yes'); $stock->save();
	ccafe_test(ccafe_cart_quantity_error($cart,'test',20) === null,'allowed backorders');

	$variable=new WC_Product_Variable(); $variable->set_name('LOCAL P1 SHARED STOCK'); $variable->set_status('publish'); $variable->set_manage_stock(true); $variable->set_stock_quantity(5); $created[]=$variable->save();
	$variations=[];
	foreach ([1,2] as $number) {
		$variant=new WC_Product_Variation(); $variant->set_parent_id($variable->get_id()); $variant->set_regular_price('10'); $variant->set_status('publish'); $created[]=$variant->save(); $variations[]=$variant;
	}
	WC_Product_Variable::sync($variable->get_id());
	$variations = array_map(function($v) { return wc_get_product($v->get_id()); }, $variations);
	$cart->cart_contents=['first'=>['data'=>$variations[0],'quantity'=>2], 'second'=>['data'=>$variations[1],'quantity'=>2]];
	ccafe_test(ccafe_cart_quantity_error($cart,'first',3) === null,'shared parent stock accepts total five');
	ccafe_test(is_wp_error(ccafe_cart_quantity_error($cart,'first',4)),'shared parent stock denies total six');
} finally { foreach(array_reverse($created) as $product_id) wc_get_product($product_id)->delete(true); wc_clear_notices(); }
echo 'PASS: ' . $GLOBALS['ccafe_test_checks'] . " local business-rule checks\n";
