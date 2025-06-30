<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
//do_action('woocommerce_shop_loop_header');

?>

<style>
	#primary {
		width: 100%
	}

	.Image {
		background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/resources/img/stworz_praliny.jpg");
		background-size: cover;
		background-position: center;
	}
</style>

<div class="md:flex">
	<div class="w-full md:w-72 mb-4">
		<?php
		$praliny_product = get_page_by_path('praliny', OBJECT, 'product');
		if ($praliny_product) :
			$praliny_link = get_permalink($praliny_product->ID);
		?>
		<?php endif; ?>



		<div data-layer="kategorie i filtry" class="KategorieIFiltry w-full inline-flex flex-col justify-start items-start">
			<a href="<?= esc_url($praliny_link); ?>" data-layer="Wybrane filtry" class="WybraneFiltry self-stretch py-4 border-b border-neutral-200 flex flex-col justify-start items-center gap-2.5">
				<div data-layer="image" class="Image self-stretch h-40 pl-4 pr-[20%] py-4 bg-linear-318 from-stone-700/60 to-stone-700/0 to 54% rounded-sm backdrop-blur-sm flex flex-col justify-between items-start">
					<div data-layer="Frame" class="Frame size-8 relative overflow-hidden">
						<div data-layer="Vector" class="Vector size-5 left-[6px] top-[6.40px] absolute"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
								<path d="M16.1693 11H1C0.716222 11 0.478666 10.9042 0.287333 10.7127C0.0957776 10.5213 0 10.2838 0 10C0 9.71622 0.0957776 9.47867 0.287333 9.28734C0.478666 9.09578 0.716222 9 1 9H16.1693L9.277 2.10767C9.07878 1.90945 8.98089 1.67745 8.98333 1.41167C8.986 1.14589 9.09067 0.909558 9.29733 0.702669C9.50422 0.509558 9.73844 0.409558 10 0.402669C10.2616 0.39578 10.4958 0.49578 10.7027 0.702669L19.1563 9.15634C19.2812 9.28122 19.3692 9.41289 19.4203 9.55134C19.4717 9.68978 19.4973 9.83934 19.4973 10C19.4973 10.1607 19.4717 10.3102 19.4203 10.4487C19.3692 10.5871 19.2812 10.7188 19.1563 10.8437L10.7027 19.2973C10.518 19.482 10.2893 19.5764 10.0167 19.5807C9.744 19.5849 9.50422 19.4904 9.29733 19.2973C9.09067 19.0904 8.98733 18.8529 8.98733 18.5847C8.98733 18.3162 9.09067 18.0786 9.29733 17.8717L16.1693 11Z" fill="#A9957B" />
							</svg></div>
					</div>
					<div data-layer="Stwórz własny zestaw pralin" class="StwRzWAsnyZestawPralin self-stretch justify-center"><span class="text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Stwórz </span><span class="text-white text-sm font-bold font-['Mulish'] uppercase leading-tight">własny zestaw pralin</span></div>
				</div>
			</a>
			<div data-layer="lista" class="Lista self-stretch py-4 border-b border-neutral-200 flex flex-col justify-start items-center gap-3.5">
				<div data-layer="title" class="Title self-stretch pr-2 py-2.5 inline-flex justify-between items-center">
					<div data-layer="Kategorie główne" class="KategorieGWne justify-start text-stone-700 text-xl font-bold font-['Mulish']">Kategorie główne
					</div>
					<div data-layer="chevron_left" class="ChevronLeft w-1.5 h-3 bg-stone-400"></div>
				</div>
				<?php
				$terms = get_terms([
					'taxonomy' => 'product_cat',
					'hide_empty' => true,
				]);

				$current_term = get_queried_object();
				$current_term_id = isset($current_term->term_id) ? $current_term->term_id : null;


				if (!empty($terms)) :
				?>
					<div data-layer="Frame 3" class=" Frame3 self-stretch px-2 inline-flex justify-start items-start gap-3">
						<div data-layer="Kategorie" class="Kategorie flex-1 inline-flex flex-col justify-start items-start gap-4">
							<a href="<?= esc_url(get_permalink(wc_get_page_id('shop'))); ?>"
								data-layer="Wszystkie produkty"
								class="WszystkieProdukty justify-start text-base leading-snug font-['Mulish'] hover:underline <?= !is_tax('product_cat') ? '!text-stone-400 font-bold' : '!text-zinc-800 font-light' ?>">
								Wszystkie produkty
							</a>
							<?php foreach ($terms as $term): ?>
								<?php
								$is_active = $current_term_id === $term->term_id;
								$category_class = $is_active
									? '!text-stone-400 font-bold'
									: '!text-zinc-800 font-light';
								?>
								<a href="<?= esc_url(get_term_link($term)) ?>"
									data-layer="<?= esc_attr($term->name); ?>"
									class="<?= esc_attr($term->slug); ?> justify-start text-base leading-snug font-['Mulish'] hover:underline transition <?= $category_class ?>">
									<?= esc_html(mb_convert_case($term->name, MB_CASE_TITLE, "UTF-8")); ?> </a>
							<?php endforeach; ?>
						</div>

						<div data-layer="Kategorie" class="Kategorie size- inline-flex flex-col justify-start items-end gap-4">

							<?php $total_products = wc_get_products([
								'status' => 'publish',
								'limit'  => -1,
								'return' => 'ids',
							]);
							$total_count = count($total_products); ?>
							<?php
							$is_all_active = !is_tax('product_cat');
							$total_class = $is_all_active
								? 'text-stone-400 font-bold'
								: 'text-zinc-500 font-light';
							?>
							<div data-layer="(<?= $total_count ?>)" class="justify-start text-base leading-snug font-['Mulish'] <?= $total_class ?>">
								(<?= $total_count ?>)
							</div>
							<?php foreach ($terms as $term): ?>
								<?php
								$is_active = $current_term_id === $term->term_id;
								$category_class = $is_active
									? 'text-stone-400 font-bold'
									: 'text-zinc-500 font-light';
								?>
								<div data-layer="<?= esc_attr($term->count); ?>" class="justify-start text-base leading-snug font-['Mulish'] <?= $category_class ?>">
									(<?= esc_html($term->count); ?>)
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div data-layer="lista" class="hidden Lista self-stretch py-4 border-b border-neutral-200 flex flex-col justify-start items-center gap-3.5">
				<div data-layer="title" class="Title self-stretch pr-2 py-2.5 inline-flex justify-between items-center">
					<div data-layer="Na specjalną okazję" class="NaSpecjalnOkazj justify-start text-stone-700 text-xl font-bold font-['Mulish']">Na specjalną okazję</div>
					<div data-layer="chevron_left" class="ChevronLeft w-1.5 h-3 bg-stone-400"></div>
				</div>
				<div data-layer="Frame 3" class="Frame3 self-stretch px-2 inline-flex justify-start items-start gap-3">
					<div data-layer="Kategorie" class="Kategorie flex-1 inline-flex flex-col justify-start items-start gap-4">
						<div data-layer="Urodziny" class="Urodziny justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Urodziny</div>
						<div data-layer="Weselne torty" class="WeselneTorty justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Weselne torty</div>
						<div data-layer="Boże Narodzenie" class="BoENarodzenie justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Boże Narodzenie</div>
						<div data-layer="Pączki - Tłusty Czwartek" class="PCzkiTUstyCzwartek justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Pączki - Tłusty Czwartek </div>
						<div data-layer="Wielkanoc" class="Wielkanoc justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Wielkanoc</div>
						<div data-layer="Mikołajki" class="MikoAjki justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Mikołajki </div>
						<div data-layer="Walentynki" class="Walentynki justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Walentynki</div>
						<div data-layer="Prezenty dla pracowników" class="PrezentyDlaPracownikW justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Prezenty dla pracowników</div>
						<div data-layer="Spotkania biznesowe" class="SpotkaniaBiznesowe justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Spotkania biznesowe</div>
						<div data-layer="Halloween" class="Halloween justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Halloween</div>
						<div data-layer="Inne okazje" class="InneOkazje justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">Inne okazje</div>
					</div>
					<div data-layer="Kategorie" class="Kategorie size- inline-flex flex-col justify-start items-end gap-4">
						<div data-layer="(172)" class="172 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(172)</div>
						<div data-layer="(8)" class="8 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(8)</div>
						<div data-layer="(8)" class="8 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(8)</div>
						<div data-layer="(16)" class="16 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(16)</div>
						<div data-layer="(8)" class="8 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(8)</div>
						<div data-layer="(16)" class="16 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(16)</div>
						<div data-layer="(16)" class="16 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(16)</div>
						<div data-layer="(16)" class="16 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(16)</div>
						<div data-layer="(16)" class="16 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(16)</div>
						<div data-layer="(16)" class="16 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(16)</div>
						<div data-layer="(16)" class="16 justify-start text-zinc-500 text-base font-light font-['Mulish'] leading-snug">(16)</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		//do_action( 'woocommerce_after_main_content' );

		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
		?>
	</div>
	<div class="px-4 w-full lg:w-3/4">
		<?php

		if (woocommerce_product_loop()) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action('woocommerce_before_shop_loop');

			woocommerce_product_loop_start();

			if (wc_get_loop_prop('total')) {
				while (have_posts()) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action('woocommerce_shop_loop');

					wc_get_template_part('content', 'product');
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action('woocommerce_after_shop_loop');
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action('woocommerce_no_products_found');
		}



		?>
	</div>
</div>
<?php
get_footer('shop');
