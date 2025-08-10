<div class="product-semple p-2 w-full md:w-[40%] lg:w-[30%] inline-flex flex-col justify-start items-start snap-start">
	<a href="<?php the_permalink(); ?>" style="display: block; width: 100%; height: 100%;">
		<?php woocommerce_show_product_sale_flash(); ?>
		<?php the_post_thumbnail('woocommerce_thumbnail', ['class' => 'w-64 h-64 object-cover w-full']); ?>
	</a>
	<div class="self-stretch flex flex-col justify-start items-start">
		<div class="self-stretch h-20 py-4 border-t border-stone-400 flex flex-col justify-start items-center gap-2.5">
			<div class="self-stretch justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">
				<?php the_title(); ?>
			</div>
		</div>
		<div class="self-stretch inline-flex justify-start items-start gap-3 flex-wrap content-start">
			<div class="flex-1 h-12 inline-flex flex-col justify-center items-start">
				<div class="self-stretch min-w-32 justify-start text-stone-700 text-2xl font-normal font-['Didot_LT_Pro'] ">
					<?php woocommerce_template_loop_price(); ?>
				</div>
			</div>

			<a href="?add-to-cart=<?php the_ID(); ?>" data-layer="btn" class="Btn h-12 min-w-12 p-1 !bg-[#B1A08E] rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex flex-col justify-center items-center gap-2.5">
				<div data-layer="shopping_bag" class="ShoppingBag relative "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
						<mask id="mask0_6013_12241" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="25">
							<rect y="0.278809" width="24" height="24" fill="#D9D9D9" />
						</mask>
						<g mask="url(#mask0_6013_12241)">
							<path d="M6.30775 21.7788C5.80258 21.7788 5.375 21.6038 5.025 21.2538C4.675 20.9038 4.5 20.4762 4.5 19.9711V8.58656C4.5 8.08139 4.675 7.65381 5.025 7.30381C5.375 6.95381 5.80258 6.77881 6.30775 6.77881H8.25V6.52881C8.25 5.49298 8.616 4.60897 9.348 3.87681C10.0802 3.14481 10.9642 2.77881 12 2.77881C13.0358 2.77881 13.9198 3.14481 14.652 3.87681C15.384 4.60897 15.75 5.49298 15.75 6.52881V6.77881H17.6923C18.1974 6.77881 18.625 6.95381 18.975 7.30381C19.325 7.65381 19.5 8.08139 19.5 8.58656V19.9711C19.5 20.4762 19.325 20.9038 18.975 21.2538C18.625 21.6038 18.1974 21.7788 17.6923 21.7788H6.30775ZM6.30775 20.2788H17.6923C17.7692 20.2788 17.8398 20.2467 17.9038 20.1826C17.9679 20.1186 18 20.0481 18 19.9711V8.58656C18 8.50956 17.9679 8.43906 17.9038 8.37506C17.8398 8.31089 17.7692 8.27881 17.6923 8.27881H15.75V10.5288C15.75 10.7416 15.6782 10.9198 15.5345 11.0633C15.391 11.207 15.2128 11.2788 15 11.2788C14.7872 11.2788 14.609 11.207 14.4655 11.0633C14.3218 10.9198 14.25 10.7416 14.25 10.5288V8.27881H9.75V10.5288C9.75 10.7416 9.67817 10.9198 9.5345 11.0633C9.391 11.207 9.21283 11.2788 9 11.2788C8.78717 11.2788 8.609 11.207 8.4655 11.0633C8.32183 10.9198 8.25 10.7416 8.25 10.5288V8.27881H6.30775C6.23075 8.27881 6.16025 8.31089 6.09625 8.37506C6.03208 8.43906 6 8.50956 6 8.58656V19.9711C6 20.0481 6.03208 20.1186 6.09625 20.1826C6.16025 20.2467 6.23075 20.2788 6.30775 20.2788ZM9.75 6.77881H14.25V6.52881C14.25 5.90198 14.0317 5.37023 13.5953 4.93356C13.1588 4.49706 12.627 4.27881 12 4.27881C11.373 4.27881 10.8413 4.49706 10.4048 4.93356C9.96825 5.37023 9.75 5.90198 9.75 6.52881V6.77881Z" fill="white" />
						</g>
					</svg></div>
			</a>
		</div>
	</div>
</div>
