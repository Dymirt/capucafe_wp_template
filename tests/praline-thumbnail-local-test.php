<?php
if (PHP_SAPI !== 'cli' || !defined('ABSPATH')) { http_response_code(404); exit; }
/** npm run local:wp -- eval-file "$PWD/tests/praline-thumbnail-local-test.php" */
if (wp_get_environment_type() !== 'local') throw new RuntimeException('Local only.');
$GLOBALS['ccafe_thumbnail_checks'] = 0;
function ccafe_thumbnail_assert($condition, $message) {
    if (!$condition) throw new RuntimeException('FAIL: ' . $message);
    $GLOBALS['ccafe_thumbnail_checks']++;
}
$parent=get_page_by_path('praliny',OBJECT,'product');
$product=wc_get_product($parent->ID);
$flavours=get_posts(['post_type'=>'praliny_candy','post_status'=>'publish','numberposts'=>2]);
foreach ($product->get_children() as $id) {
    $v=wc_get_product($id);
    $capacity=(int)$v->get_attribute('ilosc-sztuk-w-opakowaniu');
    if (!in_array($capacity,[6,12,16],true)) continue;
    $configuration=ccafe_praline_configuration($parent->ID,$id,wp_json_encode([
        ['id'=>$flavours[0]->ID,'quantity'=>$capacity-1],['id'=>$flavours[1]->ID,'quantity'=>1],
    ]));
    $item=array_merge($configuration,['product_id'=>$parent->ID,'variation_id'=>$id,'quantity'=>2]);
    $base=$v->get_image('woocommerce_thumbnail');
    $html=apply_filters('woocommerce_cart_item_thumbnail',$base,$item,'local-test');
    ccafe_thumbnail_assert(strpos($html,'ccafe-praline-thumbnail')!==false,'composition wrapper');
    ccafe_thumbnail_assert(strpos($html,'data-capacity="'.$capacity.'"')!==false,'matching grid');
    ccafe_thumbnail_assert(substr_count($html,'ccafe-praline-piece')===$capacity,'one piece per slot, independent of box quantity');
    ccafe_thumbnail_assert(strpos($html,$base)!==false,'original box photo retained');
    ccafe_thumbnail_assert(strpos($html,'role="img"')!==false,'accessible composed preview');
    $bad=$item; $bad['custom_candies']=[['id'=>99999999,'quantity'=>$capacity]];
    ccafe_thumbnail_assert(ccafe_praline_cart_thumbnail($base,$bad,'test')===$base,'invalid data not rendered');
    $missing=$item; unset($missing['custom_candies']);
    ccafe_thumbnail_assert(ccafe_praline_cart_thumbnail($base,$missing,'test')===$base,'old incomplete configuration safe');
}
ccafe_thumbnail_assert(ccafe_praline_cart_thumbnail('<img>', ['product_id'=>1383], 'test')==='<img>','ordinary product unchanged');
echo 'PASS: ' . $GLOBALS['ccafe_thumbnail_checks'] . " praline thumbnail checks\n";
