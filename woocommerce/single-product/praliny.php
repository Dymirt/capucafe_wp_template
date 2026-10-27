<div data-layer="769-1024 Stworz zestaw s3" id="ccafe-pralines" class="1024StworzZestawS3 w-full bg-white inline-flex flex-col justify-start items-start">
	<div data-layer="Frame 110" class="Frame110 self-stretch grid grid-cols-1 lg:grid-cols-2 gap-10">
		<div data-layer="Frame 109" class="Frame109 flex-1 self-stretch inline-flex flex-col justify-start items-start">
			<div data-layer="Foto" class="Foto self-stretch min-w-0 w-full bg-neutral-200 inline-flex justify-start items-start gap-2.5 overflow-hidden">
				<div data-layer="Opakowanie 16" class="Opakowanie16 flex-1 aspect-square relative bg-neutral-200 flex justify-start items-start gap-2.5 overflow-hidden">
					<img
						id="main-variation-image"
						data-layer="image 1"
						class="Image1 flex-1 w-full aspect-square object-cover"
						src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_single'); ?>"
						alt="<?php the_title_attribute(); ?>" />
					<div id="candy-image-summary"
						aria-hidden="true">
					</div>
				</div>
			</div>
			<?php
			// your custom placement point
			do_action('ccafe_product_tabs_after_gallery');
			?>
		</div>
		<div data-layer="txt" class="Txt flex-1 self-stretch inline-flex flex-col justify-start items-start gap-6">
			<div data-layer="Frame 107" class="Frame107 self-stretch py-12 flex flex-col justify-start items-start gap-6">
				<div data-layer="Stwórz własny zestaw pralin" class="StwRzWAsnyZestawPralin self-stretch justify-start text-stone-700 text-2xl font-normal font-['Didot_LT_Pro']">Stwórz własny zestaw pralin</div>
				<div data-layer="Ilosc" class="Ilosc self-stretch flex flex-col justify-start items-start gap-2">
					<div data-layer="Wybierz ilość sztuk w opakowaniu:" class="WybierzIloSztukWOpakowaniu self-stretch justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Wybierz ilość sztuk w opakowaniu:</div>
					<?php
					global $product;
					$product_id = $product->get_id();
					$product = wc_get_product($product_id);
					if (!$product || !$product->is_type('variable')) {
						echo "Not a variable product";
						return;
					}
					$product_variable = new WC_Product_Variable($product->get_id());
					$attributes = $product_variable->get_variation_attributes();
					$available_variations = $product_variable->get_available_variations();


					$variation_map = [];
					foreach ($available_variations as $variation) {
						$variation_id = $variation['variation_id'];
						foreach ($variation['attributes'] as $attr_name => $attr_value) {
							// Remove 'attribute_' prefix for easier matching
							$variation_map[$attr_value] = $variation_id;
						}
					}
					// Example: mapping variation option slugs to image URLs and labels manually:
					$image_map = [];
					foreach ($available_variations as $variation) {
						foreach ($variation['attributes'] as $attr_value) {
							if (!empty($attr_value) && !isset($image_map[$attr_value])) {
								$image_map[$attr_value] = $variation['image']['full_src'] ?: 'https://placehold.co/76x76';
							}
						}
					}

					$label_map = [
						'16_szt' => '16 szt.',
						'12_szt' => '12 szt.',
						'6_szt'  => '6 szt.',
					];
					?>

					<form id="ccafe-praline-form" class="variations_form cart"
						method="post"
						enctype="multipart/form-data"
						data-product_id="<?php echo esc_attr($product_id); ?>"
						data-product_variations='<?php echo wc_esc_json(wp_json_encode($available_variations)); ?>'>

						<?php wp_nonce_field(ccafe_session_nonce_action('ccafe_pralines_' . $product_id), 'ccafe_praline_nonce'); ?>
                        <?php foreach ($attributes as $attribute_name => $options) :						?>
							<div class="attribute-group" data-attribute="<?php echo esc_attr($attribute_name); ?>">


								<div data-layer="wybierz" class="ccafe-box-options grid grid-cols-3 gap-2 w-full">
									<?php foreach ($options as $option) :
										$option_slug = $option;
										$img_url = isset($image_map[$option_slug]) ? $image_map[$option_slug] : 'https://placehold.co/76x76';
										$label = isset($label_map[$option_slug]) ? $label_map[$option_slug] : ucfirst($option);
										$variation_id = isset($variation_map[$option_slug]) ? $variation_map[$option_slug] : 0;

									?>
										<button
											data-layer="Frame"
											type="button" aria-pressed="false" class="Frame p-2 !bg-white !text-stone-800 bg-white rounded-sm inline-flex flex-col justify-center items-center gap-2 option-card"
											data-value="<?php echo esc_attr($option_slug); ?>"
											data-capacity="<?php echo (int) strtok($option_slug, ' '); ?>"
											data-variation-id="<?php echo esc_attr($variation_id); ?>"
											data-variation-price="<?php echo esc_attr($variation_id ? wc_get_price_to_display(wc_get_product($variation_id)) : ''); ?>">

											<div data-layer="Foto" class="Foto w-full aspect-square bg-neutral-200 inline-flex justify-start items-center gap-2.5 overflow-hidden">
												<img data-layer="image" alt="" class="Image flex-1 self-stretch" src="<?php echo esc_url($img_url); ?>" />
											</div>
											<div class="Szt justify-start text-stone-700 text-xs font-bold font-['Mulish']"><?php echo esc_html($label); ?></div>
										</button>
									<?php endforeach; ?>
								</div>

								<!-- Hidden input updated by JS when option-card is clicked -->

								<?php
								$sanitized_attr = sanitize_title($attribute_name);
								?>
								<input type="hidden"
									id="<?php echo esc_attr($sanitized_attr); ?>"
									name="attribute_<?php echo esc_attr($sanitized_attr); ?>"
									required />

								<input type="hidden" name="variation_id" class="variation_id" value="0" />
							</div>
						<?php endforeach; ?>
						<br />
						<input
							type="hidden"
							id="quantity"
							name="quantity"
							value="1"
							min="1"
							class="input-text qty text"
							required />

						<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>" />
						<input type="hidden" name="product_id" value="<?php echo esc_attr($product_id); ?>" />

						<input type="hidden" name="custom_candies" id="custom_candies_input" />
						<input type="hidden" name="box_size" id="box_size_input" />

						<div data-layer="cena i btn" class="CenaIBtn self-stretch flex flex-col justify-start items-start gap-8 pt-2">
							<div data-layer="cena" class="Cena self-stretch h-12 flex flex-col justify-center items-start ">
								<div id="variation-price" data-layer="80,00 zł" class="00Z self-stretch justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']"><?php echo wp_kses_post($product->get_price_html()); ?></div>
								<div data-layer="Cena brutto za pudełko" class="CenaBrutto1kg0000Z self-stretch justify-start text-zinc-500 text-xs font-normal font-['Mulish']">Cena brutto za pudełko</div>
							</div>
							<button type="submit" disabled data-layer="BTN" class="single_add_to_cart_button Btn !p-0 inline-flex flex-col justify-start items-start gap-4">
								<div data-layer="BTN midle dark" data-property-1="koszyk defoult" class="BtnMidleDark w-full self-stretch h-12 px-7 bg-[#74604B] rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-4">
									<div data-layer="Poznaj nas" class="PoznajNas justify-center text-white text-sm font-bold font-['Mulish'] uppercase leading-tight">Dodaj do koszyka</div>
									<div data-layer="shopping_bag" class="ShoppingBag"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<mask id="mask0_6021_17907" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
												<rect width="24" height="24" fill="#D9D9D9" />
											</mask>
											<g mask="url(#mask0_6021_17907)">
												<path d="M6.30775 21.5C5.80258 21.5 5.375 21.325 5.025 20.975C4.675 20.625 4.5 20.1974 4.5 19.6923V8.30775C4.5 7.80258 4.675 7.375 5.025 7.025C5.375 6.675 5.80258 6.5 6.30775 6.5H8.25V6.25C8.25 5.21417 8.616 4.33017 9.348 3.598C10.0802 2.866 10.9642 2.5 12 2.5C13.0358 2.5 13.9198 2.866 14.652 3.598C15.384 4.33017 15.75 5.21417 15.75 6.25V6.5H17.6923C18.1974 6.5 18.625 6.675 18.975 7.025C19.325 7.375 19.5 7.80258 19.5 8.30775V19.6923C19.5 20.1974 19.325 20.625 18.975 20.975C18.625 21.325 18.1974 21.5 17.6923 21.5H6.30775ZM6.30775 20H17.6923C17.7692 20 17.8398 19.9679 17.9038 19.9038C17.9679 19.8398 18 19.7693 18 19.6923V8.30775C18 8.23075 17.9679 8.16025 17.9038 8.09625C17.8398 8.03208 17.7692 8 17.6923 8H15.75V10.25C15.75 10.4628 15.6782 10.641 15.5345 10.7845C15.391 10.9282 15.2128 11 15 11C14.7872 11 14.609 10.9282 14.4655 10.7845C14.3218 10.641 14.25 10.4628 14.25 10.25V8H9.75V10.25C9.75 10.4628 9.67817 10.641 9.5345 10.7845C9.391 10.9282 9.21283 11 9 11C8.78717 11 8.609 10.9282 8.4655 10.7845C8.32183 10.641 8.25 10.4628 8.25 10.25V8H6.30775C6.23075 8 6.16025 8.03208 6.09625 8.09625C6.03208 8.16025 6 8.23075 6 8.30775V19.6923C6 19.7693 6.03208 19.8398 6.09625 19.9038C6.16025 19.9679 6.23075 20 6.30775 20ZM9.75 6.5H14.25V6.25C14.25 5.62317 14.0317 5.09142 13.5953 4.65475C13.1588 4.21825 12.627 4 12 4C11.373 4 10.8413 4.21825 10.4048 4.65475C9.96825 5.09142 9.75 5.62317 9.75 6.25V6.5Z" fill="white" />
											</g>
										</svg></div>
								</div>
							</button>
						</div>

					<p id="praline-status" class="text-sm mt-4" role="status" aria-live="polite">Wybierz rozmiar pudełka, a następnie smaki pralin.</p><noscript>Konfigurator wymaga JavaScript do wizualnego wyboru pralin.</noscript></form>
				</div>

				<?php
				// Get all candies (posts of type 'candy')
				$candies = get_posts([
					'post_type'      => 'praliny_candy',
					'posts_per_page' => -1,
					'orderby'        => 'title',
					'order'          => 'ASC',
				]);
				?>
				<div data-layer="Ilosc" class="Ilosc self-stretch flex flex-col justify-start items-start gap-2">
					<div data-layer="Frame 43" class="Frame43 self-stretch pr-2 inline-flex justify-between items-center">
						<div data-layer="Wybierz praliny spośród 52 smaków:" class="WybierzPralinySpoRD52SmakW flex-1 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Wybierz praliny spośród <?php echo count($candies); ?> smaków:</div>
					</div>
					<div class="text-lg font-bold mt-4">
						Łącznie wybrane cukierki: <span class="global-counter">0</span>
					</div>

					<div data-layer="wybierz" class="Wybierz grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 w-full">

						<?php


						foreach ($candies as $candy) :
							$thumb = get_the_post_thumbnail_url($candy->ID, 'thumbnail') ?: 'https://placehold.co/88x88';
							$title = esc_html($candy->post_title);
							$extra_image_id = get_post_meta($candy->ID, '_extra_image_id', true);
							$extra_image_url = $extra_image_id ? wp_get_attachment_image_url($extra_image_id, 'thumbnail') : $thumb;

						?>
							<div data-layer="karta" data-property-1="Default" data-candy-id="<?php echo (int) $candy->ID; ?>" class="Karta flex w-full h-full pb-4 bg-white rounded-sm inline-flex flex-col justify-start items-center gap-2">
								<div data-layer="photo" class="Photo aspect-square w-full self-stretch bg-stone-200 inline-flex justify-start items-center gap-2.5">
									<img
										alt="<?php echo esc_attr($candy->post_title); ?>" class="1 !h-full !w-full object-cover rounded-sm"
										src="<?= esc_url($thumb); ?>"
										data-extra-image="<?= esc_url($extra_image_url); ?>" />
								</div>
								<div class="AgrestWCzekoladzie self-stretch flex-1 text-center justify-start text-zinc-800 text-xs font-normal font-['Mulish'] break-words"><?= $title; ?></div>
								<div class="Ilosc p-0 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2">
									<button type="button" aria-label="<?php echo esc_attr('Mniej: ' . $candy->post_title); ?>" class="decrement text-2xl font-bold !bg-transparent !text-stone-800">-</button>
									<div class="candy-count text-zinc-800 text-xs font-normal font-['Mulish'] leading-tight" data-count>0</div>
									<button type="button" aria-label="<?php echo esc_attr('Więcej: ' . $candy->post_title); ?>" class="increment text-xl font-bold !bg-transparent !text-stone-800">+</button>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div data-layer="Wybrane filtry" class="WybraneFiltry self-stretch flex flex-col justify-start items-center gap-2">
					<div data-layer="title" class="Title self-stretch py-2.5 inline-flex justify-start items-end gap-2">
						<div data-layer="Wybrane praliny" class="WybranePraliny15Z16 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Wybrane praliny (<span class="global-counter">0</span> z <span class="box-capacity">0</span>)</div>
					</div>
					<div id="candy-summary-list" data-layer="aktywne filtry" class="AktywneFiltry self-stretch inline-flex justify-start items-start gap-2 flex-wrap content-start overflow-hidden">
						<div></div>


					</div>
					<button type="button" data-layer="btn" id="clear_all" class="Btn h-9 px-2 flex justify-center items-center">
						<div data-layer="BTN XS" data-property-1="Default" class="BtnXs size- border-b border-zinc-800 flex justify-center items-center gap-2.5">
							<div data-layer="Poznaj nas" class="PoznajNas justify-center text-zinc-800 text-xs font-normal font-['Mulish']">Wyczyść wszystkie</div>
						</div>
					</button>
                    <button type="submit" form="ccafe-praline-form" disabled class="ccafe-praline-submit">Dodaj zestaw do koszyka</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
do_action('woocommerce_after_single_product_summary');
?>
