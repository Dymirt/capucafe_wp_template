<div data-layer="769-1024 Stworz zestaw s3" class="1024StworzZestawS3 w-full bg-white inline-flex flex-col justify-start items-start overflow-hidden">
	<div data-layer="Frame 110" class="Frame110 self-stretch grid grid-cols-1 md:grid-cols-2 gap-10">
		<div data-layer="Frame 109" class="Frame109 flex-1 self-stretch inline-flex flex-col justify-start items-start">
			<div data-layer="ol mobile" data-property-1="Default" class="OlMobile size- p-3 inline-flex justify-start items-center">
				<div data-layer="Bounding box" class="BoundingBox size-6 bg-zinc-300"></div>
				<div data-layer="chevron_left" class="ChevronLeft w-1.5 h-3 bg-stone-400"></div>
				<div data-layer="Praliny czekoladowe 12 szt" class="PralinyCzekoladowe12Szt justify-center text-zinc-800 text-[10px] font-normal font-['Mulish'] uppercase">Stwórz własny zestaw pralin</div>
			</div>
			<div data-layer="Foto" class="Foto self-stretch min-w-72 min-h-72 bg-neutral-200 inline-flex justify-start items-start gap-2.5 overflow-hidden">
				<div data-layer="Opakowanie 16" class="Opakowanie16 flex-1 h-full relative bg-neutral-200 flex justify-start items-start gap-2.5 overflow-hidden">
					<img id="main-variation-image" data-layer="image 1" class="Image1 flex-1 h-96" src="https://placehold.co/408x408" />
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
											data-variation-price= "<?php echo esc_attr($variation_id ? wc_get_price_to_display(wc_get_product($variation_id)) : ''); ?>">

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
						<label for="quantity">Ilość zestawów</label>
						<input
							type="number"
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
							<button type="submit" class="single_add_to_cart_button button alt">
								<div data-layer="BTN" class="Btn w-full max-w-72 flex flex-col justify-start items-start gap-4">
									<div data-layer="BTN midle dark" data-property-1="koszyk defoult" class="BtnMidleDark self-stretch h-12 px-7 bg-stone-400 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-4">
										<div data-layer="Poznaj nas" class="PoznajNas justify-center text-white text-sm font-bold font-['Mulish'] uppercase leading-tight">Dodaj do koszyka</div>
										<div data-layer="Bounding box" class="BoundingBox size-6 bg-zinc-300"></div>
										<div data-layer="shopping_bag" class="ShoppingBag w-3.5 h-5 bg-white"></div>
									</div>
								</div>
							</button>
						</div>

					</form>
				</div>
				<div data-layer="Ilosc" class="Ilosc self-stretch flex flex-col justify-start items-start gap-2">
					<div data-layer="Frame 43" class="Frame43 self-stretch pr-2 inline-flex justify-between items-center">
						<div data-layer="Wybierz praliny spośród 52 smaków:" class="WybierzPralinySpoRD52SmakW flex-1 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Wybierz praliny <br />spośród 52 smaków:</div>
					</div>
					<div class="text-lg font-bold mt-4">
						Łącznie wybrane cukierki: <span class="global-counter">0</span>
					</div>

					<div data-layer="wybierz" class="Wybierz grid grid-cols-3 lg:grid-cols-5 gap-4 w-full">

						<?php
						$candies = get_posts([
							'post_type'      => 'praliny_candy',
							'posts_per_page' => -1,
							'orderby'        => 'title',
							'order'          => 'ASC',
						]);

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
					<div data-layer="Rozwijany opis" class="RozwijanyOpis self-stretch inline-flex justify-center items-center gap-4">
						<div data-layer="Line 2" class="Line2 flex-1 h-0 min-w-20 origin-top-left rotate-180 outline outline-1 outline-offset-[-0.50px] outline-neutral-200"></div>
						<div data-layer="Frame 96" class="Frame96 size- flex justify-start items-center">
							<div data-layer="zwiń" class="Zwi justify-start text-zinc-800 text-xs font-bold font-['Mulish'] uppercase leading-tight">zwiń</div>
							<div data-layer="Bounding box" class="BoundingBox size-6 bg-zinc-300"></div>
							<div data-layer="chevron_left" class="ChevronLeft w-1.5 h-3 origin-top-left rotate-180 bg-stone-400"></div>
						</div>
						<div data-layer="Line 1" class="Line1 flex-1 h-0 min-w-20 origin-top-left rotate-180 outline outline-1 outline-offset-[-0.50px] outline-neutral-200"></div>
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
				<div data-layer="cena i btn" class="CenaIBtn self-stretch flex flex-col justify-start items-start gap-8">
					<div data-layer="cena" class="Cena self-stretch h-12 flex flex-col justify-center items-start">
						<div data-layer="80,00 zł" class="00Z self-stretch justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">80,00 zł</div>
						<div data-layer="Cena brutto/1kg 00,00 zł" class="CenaBrutto1kg0000Z self-stretch justify-start text-zinc-500 text-xs font-normal font-['Mulish']">Cena brutto/1kg 00,00 zł</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		let globalCount = 0;
		let maxCandies = 16;
		const globalCounterEl = document.getElementById('global-counter');
		const summaryList = document.getElementById("candy-summary-list");

		function updateAll() {
			updateGlobalCounterDisplay();
			updateSummary(); // Text version
			updateImageSummary(); // Image box version
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
					<div class="Small size-4 relative overflow-hidden">
						<div class="Vector size-2.5 left-[4.50px] top-[4.50px] absolute bg-stone-700"></div>
					</div>
				`;
						summaryList.appendChild(item);
					}
				}
			});
		}



		function updateImageSummary() {
			const imageSummaryEl = document.getElementById("candy-image-summary");
			imageSummaryEl.innerHTML = ""; // Clear previous

			// Get selected box size
			const selectedBoxCard = document.querySelector(".option-card.selected");
			let boxSize = selectedBoxCard?.dataset.value || "16_szt";

			console.log('Selected box size:', boxSize);

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
		}

		document.querySelector('.single_add_to_cart_button').addEventListener('click', () => {
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
		});


		document.querySelectorAll('.Karta').forEach(card => {
			const countEl = card.querySelector('[data-count]');
			const incrementBtn = card.querySelector('.increment');
			const decrementBtn = card.querySelector('.decrement');

			if (!countEl || !incrementBtn || !decrementBtn) return;

			let count = 0;

			incrementBtn.addEventListener('click', () => {
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
				if (count > 0) {
					count--;
					countEl.textContent = count;
					globalCount--;
					updateAll();
				}
			});
		});
		document.querySelectorAll('.attribute-group').forEach(group => {
			const cards = group.querySelectorAll('.option-card');
			cards.forEach(card => {
				card.addEventListener('click', () => {

					const mainImage = document.getElementById('main-variation-image');
					const variationImgEl = card.querySelector('img');
					if (mainImage && variationImgEl) {
						mainImage.src = variationImgEl.src;
					}
					// Remove outline classes from siblings
					cards.forEach(c => {
						c.classList.remove('outline', 'outline-1', 'outline-offset-[-1px]', 'outline-stone-400', 'selected');
					});

					// Add outline classes on clicked card
					card.classList.add('outline', 'outline-1', 'outline-offset-[-1px]', 'outline-stone-400', 'selected');

					// Save selected value on the attribute group div dataset or a hidden input
					group.dataset.selectedValue = card.dataset.value;

					updateImageSummary();

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
