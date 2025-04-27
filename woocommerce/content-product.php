<div class="w-64 inline-flex flex-col justify-start items-start snap-start width: 100%; color: #333333; font-size: 16px; font-family: Mulish; font-weight: 300; line-height: 22.40px; word-wrap: break-word">
	<a href="<?php the_permalink(); ?>">
		<?php woocommerce_show_product_sale_flash(); ?>
		<?php the_post_thumbnail('woocommerce_thumbnail', ['class' => 'w-64 h-64 object-cover']); ?>
	</a>
	<div class="self-stretch flex flex-col justify-start items-start">
		<div class="self-stretch h-20 py-4 border-t border-stone-400 flex flex-col justify-start items-center gap-2.5">
			<div class="self-stretch justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">
				<?php the_title(); ?>
			</div>
		</div>
		<div class="self-stretch inline-flex justify-start items-start gap-3 flex-wrap content-start">
			<div class="flex-1 h-12 inline-flex flex-col justify-center items-start">
				<div class="self-stretch min-w-32 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro'] ">
					<?php woocommerce_template_loop_price(); ?>
				</div>
			</div>
			<div class="h-12 min-w-12 p-4 bg-stone-400 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex flex-col justify-center items-center gap-2.5">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="21" viewBox="0 0 16 21" fill="none">
					<path d="M15 5.49998H12V4.49998C12 3.43911 11.5786 2.4217 10.8284 1.67155C10.0783 0.921405 9.06087 0.499977 8 0.499977C6.93913 0.499977 5.92172 0.921405 5.17157 1.67155C4.42143 2.4217 4 3.43911 4 4.49998V5.49998H1C0.734784 5.49998 0.48043 5.60533 0.292893 5.79287C0.105357 5.98041 0 6.23476 0 6.49998V17.5C0 18.2956 0.316071 19.0587 0.87868 19.6213C1.44129 20.1839 2.20435 20.5 3 20.5H13C13.7956 20.5 14.5587 20.1839 15.1213 19.6213C15.6839 19.0587 16 18.2956 16 17.5V6.49998C16 6.23476 15.8946 5.98041 15.7071 5.79287C15.5196 5.60533 15.2652 5.49998 15 5.49998ZM6 4.49998C6 3.96954 6.21071 3.46084 6.58579 3.08576C6.96086 2.71069 7.46957 2.49998 8 2.49998C8.53043 2.49998 9.03914 2.71069 9.41421 3.08576C9.78929 3.46084 10 3.96954 10 4.49998V5.49998H6V4.49998ZM14 17.5C14 17.7652 13.8946 18.0195 13.7071 18.2071C13.5196 18.3946 13.2652 18.5 13 18.5H3C2.73478 18.5 2.48043 18.3946 2.29289 18.2071C2.10536 18.0195 2 17.7652 2 17.5V7.49998H4V8.49998C4 8.76519 4.10536 9.01955 4.29289 9.20708C4.48043 9.39462 4.73478 9.49998 5 9.49998C5.26522 9.49998 5.51957 9.39462 5.70711 9.20708C5.89464 9.01955 6 8.76519 6 8.49998V7.49998H10V8.49998C10 8.76519 10.1054 9.01955 10.2929 9.20708C10.4804 9.39462 10.7348 9.49998 11 9.49998C11.2652 9.49998 11.5196 9.39462 11.7071 9.20708C11.8946 9.01955 12 8.76519 12 8.49998V7.49998H14V17.5Z" fill="white" />
				</svg>
			</div>
		</div>
	</div>
</div>

