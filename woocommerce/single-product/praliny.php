<div data-layer="769-1024 Stworz zestaw s3" class="1024StworzZestawS3 w-full bg-white inline-flex flex-col justify-start items-start overflow-hidden">
	<div data-layer="Frame 110" class="Frame110 self-stretch grid grid-cols-1 md:grid-cols-2 gap-10">
		<div data-layer="Frame 109" class="Frame109 flex-1 self-stretch inline-flex flex-col justify-start items-start">
			<div data-layer="Foto" class="Foto self-stretch min-w-72 min-h-72 bg-neutral-200 inline-flex justify-start items-start gap-2.5 overflow-hidden">
				<div data-layer="Opakowanie 16" class="Opakowanie16 flex-1 h-full relative bg-neutral-200 flex justify-start items-start gap-2.5 overflow-hidden">
					<img
						id="main-variation-image"
						data-layer="image 1"
						class="Image1 flex-1 h-96 object-cover"
						src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_single'); ?>"
						alt="<?php the_title_attribute(); ?>" />
					<div id="candy-image-summary"
						class="absolute top-[140px] left-[53px] grid grid-cols-3 gap-2 w-fit">
					</div>
				</div>
			</div>
		</div>
		<div data-layer="txt" class="Txt flex-1 self-stretch pr-10 inline-flex flex-col justify-start items-start gap-6">
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

					<form class="variations_form cart"
						method="post"
						enctype="multipart/form-data"
						data-product_id="<?php echo esc_attr($product_id); ?>"
						data-product_variations='<?php echo wp_json_encode($available_variations); ?>'>

						<?php foreach ($attributes as $attribute_name => $options) :						?>
							<div class="attribute-group" data-attribute="<?php echo esc_attr($attribute_name); ?>">


								<div data-layer="wybierz" class="Wybierz self-stretch inline-flex justify-start items-start gap-0.5">
									<?php foreach ($options as $option) :
										$option_slug = $option;
										$img_url = isset($image_map[$option_slug]) ? $image_map[$option_slug] : 'https://placehold.co/76x76';
										$label = isset($label_map[$option_slug]) ? $label_map[$option_slug] : ucfirst($option);
										$variation_id = isset($variation_map[$option_slug]) ? $variation_map[$option_slug] : 0;

									?>
										<div
											data-layer="Frame"
											class="Frame size- p-2 bg-white rounded-sm inline-flex flex-col justify-center items-center gap-2 option-card"
											data-value="<?php echo esc_attr($option_slug); ?>"
											tabindex="0"
											data-variation-id="<?php echo esc_attr($variation_id); ?>"
											data-variation-price="<?php echo esc_attr($variation_id ? wc_get_price_to_display(wc_get_product($variation_id)) : ''); ?>">

											<div data-layer="Foto" class="Foto size-20 bg-neutral-200 inline-flex justify-start items-center gap-2.5 overflow-hidden">
												<img data-layer="image" class="Image flex-1 self-stretch" src="<?php echo esc_url($img_url); ?>" />
											</div>
											<div class="Szt justify-start text-stone-400 text-xs font-bold font-['Mulish']"><?php echo esc_html($label); ?></div>
										</div>
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
								<div id="variation-price" data-layer="80,00 zł" class="00Z self-stretch justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">30-80,00 zł</div>
								<div data-layer="Cena brutto/1kg 00,00 zł" class="CenaBrutto1kg0000Z self-stretch justify-start text-zinc-500 text-xs font-normal font-['Mulish']">Cena brutto/1kg 00,00 zł</div>
							</div>
							<button type="submit" data-layer="BTN" class="single_add_to_cart_button Btn !p-0 w-full max-w-72 inline-flex flex-col justify-start items-start gap-4">
								<div data-layer="BTN midle dark" data-property-1="koszyk defoult" class="BtnMidleDark w-full self-stretch h-12 px-7 bg-stone-400 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-4">
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

					</form>
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

					<div data-layer="wybierz" class="Wybierz grid grid-cols-3 lg:grid-cols-5 gap-4 w-full">

						<?php


						foreach ($candies as $candy) :
							$thumb = get_the_post_thumbnail_url($candy->ID, 'thumbnail') ?: 'https://placehold.co/88x88';
							$title = esc_html($candy->post_title);
							$extra_image_id = get_post_meta($candy->ID, '_extra_image_id', true);
							$extra_image_url = $extra_image_id ? wp_get_attachment_image_url($extra_image_id, 'thumbnail') : $thumb;

						?>
							<div data-layer="karta" data-property-1="Default" class="Karta flex-1 min-w-20 pb-4 bg-white rounded-sm inline-flex flex-col justify-start items-center gap-2">
								<div data-layer="photo" class="Photo self-stretch h-full bg-stone-200 inline-flex justify-start items-center gap-2.5">
									<img
										class="1 flex-1 h-24"
										src="<?= esc_url($thumb); ?>"
										data-extra-image="<?= esc_url($extra_image_url); ?>" />
								</div>
								<div class="AgrestWCzekoladzie self-stretch h-7 text-center justify-start text-zinc-800 text-[10px] font-normal font-['Mulish']"><?= $title; ?></div>
								<div class="Ilosc h-7 p-2 bg-white rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2">
									<button type="button" class="decrement text-xl font-bold px-1">-</button>
									<div class="candy-count text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight" data-count>0</div>
									<button type="button" class="increment text-xl font-bold px-">+</button>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div data-layer="Wybrane filtry" class="WybraneFiltry self-stretch flex flex-col justify-start items-center gap-2">
					<div data-layer="title" class="Title self-stretch py-2.5 inline-flex justify-start items-end gap-2">
						<div data-layer="Wybrane praliny (15 z 16)" class="WybranePraliny15Z16 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Wybrane praliny (<span class="global-counter">0</span> z 16)</div>
					</div>
					<div id="candy-summary-list" data-layer="aktywne filtry" class="AktywneFiltry self-stretch inline-flex justify-start items-start gap-2 flex-wrap content-start overflow-hidden">
						<div></div>

						<div data-layer="btn" class="Btn h-9 px-2 flex justify-center items-center">
							<div data-layer="BTN XS" data-property-1="Default" class="BtnXs size- border-b border-zinc-800 flex justify-center items-center gap-2.5">
								<div data-layer="Poznaj nas" class="PoznajNas justify-center text-zinc-800 text-xs font-normal font-['Mulish']">Wyczyść wszystkie</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		let globalCount = 0;
		let maxCandies = 0;
		const globalCounterEl = document.getElementById('global-counter');
		const summaryList = document.getElementById("candy-summary-list");
		const submitButton = document.querySelector('.single_add_to_cart_button');

		function updateAll() {
			updateGlobalCounterDisplay();
			saveCandySelectionToStorage();
			updateSummary(); // Text version
			updateImageSummary(); // Image box version
			updateSubmitButtonState(); // ← Add this line
		}

		function updateSubmitButtonState() {
			if (globalCount === maxCandies && maxCandies !== 0) {
				submitButton.disabled = false;
				submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
			} else {
				submitButton.disabled = true;
				submitButton.classList.add('opacity-50', 'cursor-not-allowed');
			}
		}

		function updateGlobalCounterDisplay() {
			document.querySelectorAll('.global-counter').forEach(el => {
				el.textContent = globalCount;
			});
		}

		function updateSummary() {
			const summaryList = document.getElementById("candy-summary-list");
			summaryList.innerHTML = ""; // Clear previous

			document.querySelectorAll(".Karta").forEach(card => {
				const count = parseInt(card.querySelector("[data-count]").textContent, 10);
				if (count > 0) {
					const name = card.querySelector(".AgrestWCzekoladzie").textContent.trim();
					const imgSrc = card.querySelector("img").getAttribute("src");

					for (let i = 0; i < count; i++) {
						const item = document.createElement("div");
						item.className = "Span size- px-1.5 py-[5px] bg-stone-200 rounded-sm flex justify-center items-center gap-0.5";

						item.innerHTML = `
					<div class="Frame46 size-6 p-1 bg-stone-200 flex justify-start items-center gap-2.5 flex-wrap content-center">
						<img class="Dsc09203 w-4 self-stretch" src="${imgSrc}" />
					</div>
					<div class="Lemoniada justify-center text-zinc-800 text-xs font-normal font-['Mulish']">${name}</div>
					<div class="Small size-4 relative overflow-hidden remove-candy" data-candy-name="${name}">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
					<path d="M10.0575 8.9999L13.2825 5.7824C13.4237 5.64117 13.503 5.44962 13.503 5.2499C13.503 5.05017 13.4237 4.85862 13.2825 4.71739C13.1412 4.57617 12.9497 4.49683 12.75 4.49683C12.5502 4.49683 12.3587 4.57617 12.2175 4.71739L8.99995 7.9424L5.78245 4.71739C5.64123 4.57617 5.44968 4.49683 5.24995 4.49683C5.05023 4.49683 4.85868 4.57617 4.71745 4.71739C4.57623 4.85862 4.49689 5.05017 4.49689 5.2499C4.49689 5.44962 4.57623 5.64117 4.71745 5.7824L7.94245 8.9999L4.71745 12.2174C4.64716 12.2871 4.59136 12.3701 4.55329 12.4615C4.51521 12.5529 4.49561 12.6509 4.49561 12.7499C4.49561 12.8489 4.51521 12.9469 4.55329 13.0383C4.59136 13.1297 4.64716 13.2127 4.71745 13.2824C4.78718 13.3527 4.87013 13.4085 4.96152 13.4466C5.05292 13.4846 5.15095 13.5042 5.24995 13.5042C5.34896 13.5042 5.44699 13.4846 5.53839 13.4466C5.62978 13.4085 5.71273 13.3527 5.78245 13.2824L8.99995 10.0574L12.2175 13.2824C12.2872 13.3527 12.3701 13.4085 12.4615 13.4466C12.5529 13.4846 12.6509 13.5042 12.75 13.5042C12.849 13.5042 12.947 13.4846 13.0384 13.4466C13.1298 13.4085 13.2127 13.3527 13.2825 13.2824C13.3527 13.2127 13.4085 13.1297 13.4466 13.0383C13.4847 12.9469 13.5043 12.8489 13.5043 12.7499C13.5043 12.6509 13.4847 12.5529 13.4466 12.4615C13.4085 12.3701 13.3527 12.2871 13.2825 12.2174L10.0575 8.9999Z" fill="#42352F"/>
					</svg>
					</div>
				`;
						summaryList.appendChild(item);
					}
				}
			});
		};

		document.getElementById("candy-summary-list").addEventListener("click", (e) => {
			if (e.target.closest(".remove-candy")) {
				const button = e.target.closest(".remove-candy");
				const candyName = button.getAttribute("data-candy-name");

				document.querySelectorAll(".Karta").forEach(card => {
					const name = card.querySelector(".AgrestWCzekoladzie").textContent.trim();
					if (name === candyName) {
						const countEl = card.querySelector("[data-count]");
						let count = parseInt(countEl.textContent, 10);
						if (count > 0) {
							count--;
							countEl.textContent = count;
							updateAll(); // re-render after change
						}
					}
				});
			}
		});


		// add candies to main image summary
		function updateImageSummary() {
			const imageSummaryEl = document.getElementById("candy-image-summary");
			imageSummaryEl.innerHTML = ""; // Clear previous

			// Get selected box size
			const selectedBoxCard = document.querySelector(".option-card.selected");
			let boxSize = selectedBoxCard?.dataset.value || "16_szt";

			//console.log('Selected box size:', boxSize);

			const layoutMap = {
				"6 sztuk": {
					cols: "grid-cols-3",
					left: "left-[27%]",
					top: "top-[47%]",
					width: "w-[38%]",
					max: 6
				},
				"12 sztuk": {
					cols: "grid-cols-4",
					left: "left-[15%]",
					top: "top-[41%]",
					width: "w-[51%]",
					max: 12
				},
				"16 sztuk": {
					cols: "grid-cols-4",
					left: "left-[14%]",
					top: "top-[35%]",
					width: "w-[50%]",
					max: 16
				},
			};

			const layout = layoutMap[boxSize] || layoutMap["16 sztuk"];

			imageSummaryEl.className = `absolute grid gap-2 gap-y-[11px] ${layout.cols} ${layout.left} ${layout.top} ${layout.width}`;
			maxCandies = layout.max;

			// Tailwind class swap
			imageSummaryEl.classList.remove("grid-cols-3", "grid-cols-4");
			imageSummaryEl.classList.add(boxSize === "6 sztuk" ? "grid-cols-3" : "grid-cols-4");


			document.querySelectorAll(".Karta").forEach(card => {
				const count = parseInt(card.querySelector("[data-count]").textContent, 10);
				//const image = card.querySelector("img").getAttribute("src");
				const image = card.querySelector("img").dataset.extraImage || card.querySelector("img").src;

				for (let i = 0; i < count; i++) {
					const img = document.createElement("img");
					img.src = image;
					img.className = "w-[94%] h-auto"; // Apply same classes

					imageSummaryEl.appendChild(img);

				}
			});
		};

		// Add candies to the cart on form submit
		document.querySelector('form.variations_form.cart').addEventListener('submit', () => {
			const candies = [];

			document.querySelectorAll(".Karta").forEach(card => {
				const count = parseInt(card.querySelector("[data-count]").textContent, 10);
				if (count > 0) {
					const candyName = card.querySelector(".AgrestWCzekoladzie").textContent.trim();
					candies.push({
						name: candyName,
						quantity: count
					});
				}
			});

			const boxSize = document.querySelector(".option-card.selected")?.dataset.value || "16_szt";

			document.getElementById("custom_candies_input").value = JSON.stringify(candies);
			document.getElementById("box_size_input").value = boxSize;

			localStorage.removeItem('candySelection');

		});

		// Candies selection logic
		document.querySelectorAll('.Karta').forEach(card => {
			const countEl = card.querySelector('[data-count]');
			const incrementBtn = card.querySelector('.increment');
			const decrementBtn = card.querySelector('.decrement');

			if (!countEl || !incrementBtn || !decrementBtn) return;

			incrementBtn.addEventListener('click', () => {
				let count = parseInt(countEl.textContent, 10);
				if (globalCount < maxCandies) {
					count++;
					countEl.textContent = count;
					globalCount++;
					updateAll();
				} else {
					alert(`Nie możesz wybrać więcej niż ${maxCandies} pralin.`);
				}
			});

			decrementBtn.addEventListener('click', () => {
				let count = parseInt(countEl.textContent, 10);
				if (count > 0) {
					count--;
					countEl.textContent = count;
					globalCount--;
					updateAll();
				}
			});
		});

		// Variation selection logic
		document.querySelectorAll('.attribute-group').forEach(group => {
			const cards = group.querySelectorAll('.option-card');
			cards.forEach(card => {
				card.addEventListener('click', () => {

					const mainImage = document.getElementById('main-variation-image');
					const variationImgEl = card.querySelector('img');
					if (mainImage && variationImgEl) {
						const newSrc = variationImgEl.getAttribute('src');
						if (newSrc) mainImage.setAttribute('src', newSrc);
					}
					// Remove outline classes from siblings
					cards.forEach(c => {
						c.classList.remove('outline', 'outline-1', 'outline-offset-[-1px]', 'outline-stone-400', 'selected');
					});

					// Add outline classes on clicked card
					card.classList.add('outline', 'outline-1', 'outline-offset-[-1px]', 'outline-stone-400', 'selected');

					// Save selected value on the attribute group div dataset or a hidden input
					group.dataset.selectedValue = card.dataset.value;

					maxCandies = parseInt(card.dataset.value, 10) || 16; // Default to 16 if not set

					//console.log('size:', maxCandies);

					requestAnimationFrame(() => {
						removeNotFitCandies();
						updateAll();
					});



					let huddenVariationInput = group.querySelector('input[name="variation_id"]');
					if (!huddenVariationInput) {
						huddenVariationInput = document.createElement('input');
						huddenVariationInput.type = 'hidden';
						huddenVariationInput.name = 'variation_id';
						group.appendChild(huddenVariationInput);
					}
					huddenVariationInput.value = card.dataset.variationId || 0;

					// Update the variation price
					const price = document.getElementById("variation-price");
					if (price) {
						price.textContent = card.dataset.variationPrice ? `${card.dataset.variationPrice} zł` : '80,00 zł';
					}

				});
			});
		});

		function removeNotFitCandies() {
			let tmpCount = 0;
			document.querySelectorAll('.Karta').forEach(card => {
				let candycounter = 0;
				const countEl = card.querySelector('[data-count]');
				let count = parseInt(countEl.textContent, 10); // ✅ use let instead of const
				if (tmpCount >= maxCandies) {
					countEl.textContent = 0;
					return;
				}
				while (tmpCount < maxCandies && candycounter < count) {
					tmpCount++;
					candycounter++;
					countEl.textContent = candycounter;
				}

			});
			globalCount = tmpCount;
		}

		// Save selection to localStorage
		function saveCandySelectionToStorage() {
			const candies = [];
			document.querySelectorAll(".Karta").forEach(card => {
				const count = parseInt(card.querySelector("[data-count]").textContent, 10);
				if (count > 0) {
					const candyName = card.querySelector(".AgrestWCzekoladzie").textContent.trim();
					candies.push({
						name: candyName,
						quantity: count
					});
				}
			});
			const boxSize = document.querySelector(".option-card.selected")?.dataset.value || "16_szt";
			localStorage.setItem('candySelection', JSON.stringify({
				boxSize,
				candies
			}));
		}

		// Load selection from localStorage
		function loadCandySelectionFromStorage() {
			const saved = localStorage.getItem('candySelection');
			if (!saved) return;

			try {
				const {
					boxSize,
					candies
				} = JSON.parse(saved);

				// Restore box size
				const boxCard = document.querySelector(`.option-card[data-value='${boxSize}']`);
				if (boxCard) {
					boxCard.click();
				}

				setTimeout(() => {
					candies.forEach(({
						name,
						quantity
					}) => {
						document.querySelectorAll('.Karta').forEach(card => {
							const title = card.querySelector(".AgrestWCzekoladzie").textContent.trim();
							if (title === name) {
								const countEl = card.querySelector('[data-count]');
								const incrementBtn = card.querySelector('.increment');
								let current = parseInt(countEl.textContent, 10);
								while (current < quantity && globalCount < maxCandies) {
									incrementBtn.click();
									current++;
								}
							}
						});
					});
				}, 100);

			} catch (e) {
				console.error("Failed to restore candy selection", e);
			}
		}
		// Log form submission
		/*
		document.querySelector('form.variations_form.cart').addEventListener('submit', function(e) {
			// Log the form element
			console.log('Form element:', this);

			// Optional: prevent actual submission for testing
			// e.preventDefault();

			// Use FormData to see all the form fields and values
			const formData = new FormData(this);

			console.log('Form data:');
			for (const [key, value] of formData.entries()) {
				console.log(`${key}: ${value}`);
			}
		});
		*/

		// Hook saving to changes
		function bindStorageEvents() {
			document.querySelectorAll('.increment, .decrement').forEach(btn => {
				btn.addEventListener('click', () => setTimeout(saveCandySelectionToStorage, 100));
			});
			document.querySelectorAll('.option-card').forEach(card => {
				card.addEventListener('click', () => setTimeout(saveCandySelectionToStorage, 100));
			});
		}

		// Initialize restoration
		loadCandySelectionFromStorage();
		bindStorageEvents();

	});
</script>

<div class="top-[46%] left-[26%] left-[14%] top-[34%] w-[20%] h-[20%] size-[10%] w-[10%] h-auto w-[60%] w-[20%] w-[38%] w-[94%] left-[27%] top-[47%] w-[51%] top-[41%] gap-y-[7.5%]"></div>
