<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

</div><!-- .col-full -->
</div><!-- #content -->

<?php do_action('storefront_before_footer'); ?>

<footer id="colophon" class="site-footer p-0" role="contentinfo" style="padding: 0;">
	<div class="w-full">

		<?php
		/**
		 * Functions hooked in to storefront_footer action
		 *
		 * @hooked storefront_footer_widgets - 10
		 * @hooked storefront_credit         - 20
		 */
		// do_action( 'storefront_footer' );
		?>

		<div data-property-1="mobile v2" class="w-full self-stretch px-5 pt-36 relative bg-stone-700 inline-flex flex-col justify-start items-start gap-14">
			<?php
			wp_nav_menu([
				'theme_location' => 'footer-menu-location',
				'walker'         => new Footer_Walker_Nav_Menu(),
				'container'      => false,
				'items_wrap'     => '%3$s', // no ul
				'fallback_cb'    => '',     // IMPORTANT! <- Empty string, not false!
			]);
			?>
			<div class="self-stretch flex flex-col justify-start items-center gap-6">
				<div class="self-stretch inline-flex justify-between items-center">
					<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Sklep</div>
					<div class="w-6 h-6 bg-zinc-300"></div>
					<div class="w-1.5 h-3 origin-top-left rotate-180 bg-stone-400"></div>
				</div>
				<div class="self-stretch inline-flex justify-between items-center">
					<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Pracownia tortów</div>
					<div class="w-6 h-6 bg-zinc-300"></div>
					<div class="w-1.5 h-3 origin-top-left rotate-180 bg-stone-400"></div>
				</div>
				<div class="self-stretch inline-flex justify-between items-center">
					<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Kawiarnie</div>
					<div class="w-6 h-6 bg-zinc-300"></div>
					<div class="w-1.5 h-3 origin-top-left rotate-180 bg-stone-400"></div>
				</div>
				<div class="self-stretch inline-flex justify-between items-center">
					<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Słodkie stoły</div>
					<div class="w-6 h-6 bg-zinc-300"></div>
					<div class="w-1.5 h-3 origin-top-left rotate-180 bg-stone-400"></div>
				</div>
				<div class="self-stretch inline-flex justify-between items-center">
					<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Kontakt</div>
					<div class="w-6 h-6 bg-zinc-300"></div>
					<div class="w-1.5 h-3 origin-top-left rotate-180 bg-stone-400"></div>
				</div>
				<div class="self-stretch h-6 inline-flex justify-between items-center">
					<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">O nas</div>
				</div>
				<div class="self-stretch h-6 inline-flex justify-between items-center">
					<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Aktualności</div>
				</div>
				<div class="self-stretch h-6 inline-flex justify-between items-center">
					<div class="flex-1 h-3.5 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Regulamin</div>
				</div>

				<!-- Socials -->
				<div class="self-stretch py-1 flex flex-col justify-center items-start gap-4">
					<div class=" h-6 justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Śledź nas:</div>
					<div class="inline-flex justify-start items-start gap-2.5">
						<div class="bg-stone-200 rounded-[40px] flex justify-center items-center gap-2.5">
							<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="40" height="40" rx="20" fill="#F2EDE7" />
								<path d="M25.34 13.46C25.1027 13.46 24.8707 13.5304 24.6733 13.6622C24.476 13.7941 24.3222 13.9815 24.2313 14.2008C24.1405 14.4201 24.1168 14.6613 24.1631 14.8941C24.2094 15.1269 24.3236 15.3407 24.4915 15.5085C24.6593 15.6764 24.8731 15.7906 25.1059 15.8369C25.3387 15.8832 25.5799 15.8595 25.7992 15.7687C26.0185 15.6778 26.2059 15.524 26.3378 15.3267C26.4696 15.1293 26.54 14.8973 26.54 14.66C26.54 14.3417 26.4136 14.0365 26.1885 13.8115C25.9635 13.5864 25.6583 13.46 25.34 13.46ZM29.94 15.88C29.9206 15.0503 29.7652 14.2294 29.48 13.45C29.2257 12.7831 28.83 12.1793 28.32 11.68C27.8248 11.1674 27.2196 10.7742 26.55 10.53C25.7727 10.2362 24.9508 10.0772 24.12 10.06C23.06 10 22.72 10 20 10C17.28 10 16.94 10 15.88 10.06C15.0492 10.0772 14.2273 10.2362 13.45 10.53C12.7817 10.7766 12.1769 11.1696 11.68 11.68C11.1674 12.1752 10.7742 12.7804 10.53 13.45C10.2362 14.2273 10.0772 15.0492 10.06 15.88C10 16.94 10 17.28 10 20C10 22.72 10 23.06 10.06 24.12C10.0772 24.9508 10.2362 25.7727 10.53 26.55C10.7742 27.2196 11.1674 27.8248 11.68 28.32C12.1769 28.8304 12.7817 29.2234 13.45 29.47C14.2273 29.7638 15.0492 29.9228 15.88 29.94C16.94 30 17.28 30 20 30C22.72 30 23.06 30 24.12 29.94C24.9508 29.9228 25.7727 29.7638 26.55 29.47C27.2196 29.2258 27.8248 28.8326 28.32 28.32C28.8322 27.8226 29.2283 27.2182 29.48 26.55C29.7652 25.7706 29.9206 24.9497 29.94 24.12C29.94 23.06 30 22.72 30 20C30 17.28 30 16.94 29.94 15.88ZM28.14 24C28.1327 24.6348 28.0178 25.2637 27.8 25.86C27.6403 26.2952 27.3839 26.6884 27.05 27.01C26.7256 27.3405 26.3332 27.5964 25.9 27.76C25.3037 27.9778 24.6748 28.0927 24.04 28.1C23.04 28.15 22.67 28.16 20.04 28.16C17.41 28.16 17.04 28.16 16.04 28.1C15.3809 28.1123 14.7246 28.0109 14.1 27.8C13.6858 27.6281 13.3114 27.3728 13 27.05C12.6681 26.7287 12.4148 26.3352 12.26 25.9C12.0159 25.2952 11.8804 24.6519 11.86 24C11.86 23 11.8 22.63 11.8 20C11.8 17.37 11.8 17 11.86 16C11.8645 15.3511 11.983 14.7079 12.21 14.1C12.386 13.6779 12.6563 13.3017 13 13C13.3038 12.6562 13.6793 12.3831 14.1 12.2C14.7096 11.98 15.352 11.8651 16 11.86C17 11.86 17.37 11.8 20 11.8C22.63 11.8 23 11.8 24 11.86C24.6348 11.8673 25.2637 11.9822 25.86 12.2C26.3144 12.3687 26.7223 12.6428 27.05 13C27.3777 13.3072 27.6338 13.6827 27.8 14.1C28.0223 14.7089 28.1373 15.3518 28.14 16C28.19 17 28.2 17.37 28.2 20C28.2 22.63 28.19 23 28.14 24ZM20 14.87C18.9858 14.872 17.995 15.1745 17.1527 15.7394C16.3103 16.3043 15.6544 17.1062 15.2676 18.0438C14.8809 18.9813 14.7807 20.0125 14.9798 21.0069C15.1789 22.0014 15.6682 22.9145 16.3861 23.631C17.1039 24.3474 18.018 24.835 19.0129 25.0321C20.0077 25.2293 21.0387 25.1271 21.9755 24.7385C22.9123 24.35 23.7129 23.6924 24.2761 22.849C24.8394 22.0056 25.14 21.0142 25.14 20C25.1413 19.3251 25.0092 18.6566 24.7512 18.033C24.4933 17.4093 24.1146 16.8428 23.6369 16.3661C23.1592 15.8893 22.5919 15.5117 21.9678 15.2549C21.3436 14.9982 20.6749 14.8674 20 14.87ZM20 23.33C19.3414 23.33 18.6976 23.1347 18.15 22.7688C17.6023 22.4029 17.1755 21.8828 16.9235 21.2743C16.6714 20.6659 16.6055 19.9963 16.734 19.3503C16.8625 18.7044 17.1796 18.111 17.6453 17.6453C18.111 17.1796 18.7044 16.8625 19.3503 16.734C19.9963 16.6055 20.6659 16.6714 21.2743 16.9235C21.8828 17.1755 22.4029 17.6023 22.7688 18.15C23.1347 18.6976 23.33 19.3414 23.33 20C23.33 20.4373 23.2439 20.8703 23.0765 21.2743C22.9092 21.6784 22.6639 22.0454 22.3547 22.3547C22.0454 22.6639 21.6784 22.9092 21.2743 23.0765C20.8703 23.2439 20.4373 23.33 20 23.33Z" fill="#42352F" />
							</svg>
						</div>
						<div class="bg-stone-200 rounded-[40px] flex justify-center items-center gap-2.5">
							<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="40" height="40" rx="20" fill="#F2EDE7" />
								<path d="M23.12 13.32H25V10.14C24.0897 10.0454 23.1751 9.99865 22.26 10C19.54 10 17.68 11.66 17.68 14.7V17.32H14.61V20.88H17.68V30H21.36V20.88H24.42L24.88 17.32H21.36V15.05C21.36 14 21.64 13.32 23.12 13.32Z" fill="#42352F" />
							</svg>

						</div>
						<div class="bg-stone-200 rounded-[40px] flex justify-center items-center gap-2.5">
							<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="40" height="40" rx="20" fill="#F2EDE7" />
								<path d="M24.1176 9L20.6193 9.00066V23.4413C20.6204 24.0471 20.4412 24.6395 20.1045 25.1431C19.7678 25.6467 19.2888 26.0387 18.7285 26.2691C18.1696 26.5022 17.5539 26.5636 16.96 26.4454C16.366 26.3273 15.8207 26.035 15.3935 25.6058C14.9641 25.1783 14.6716 24.6326 14.5534 24.0384C14.4351 23.4441 14.4964 22.8281 14.7295 22.2687C14.9601 21.7088 15.3522 21.2301 15.8558 20.8937C16.3594 20.5573 16.9517 20.3785 17.5573 20.38H18.6889V16.8816H17.558C16.2608 16.883 14.993 17.2684 13.9145 17.9893C12.836 18.7101 11.995 19.7341 11.4977 20.9322C11.0024 22.1311 10.8732 23.4497 11.1262 24.7219C11.3792 25.9941 12.0032 27.163 12.9195 28.0811C13.8377 28.9972 15.0066 29.621 16.2788 29.8739C17.551 30.1268 18.8696 29.9975 20.0684 29.5023C21.2662 29.0047 22.2899 28.1636 23.0105 27.0851C23.7311 26.0067 24.1163 24.739 24.1176 23.4419V15.434C25.0699 16.0014 26.1942 16.418 27.5783 16.418H29.3269V12.919H27.5783C25.6109 12.919 25.0779 12.1188 24.611 11.1037C24.1441 10.0892 24.1176 9 24.1176 9Z" fill="#42352F" />
							</svg>

						</div>
					</div>
				</div>
				<!-- END Socials -->


				<div class="py-5 inline-flex justify-center items-center gap-2.5">
					<div class="text-center justify-start text-stone-200 text-[10px] font-normal font-['Mulish']">© 2025 Copyright Capuccino Cafe</div>
				</div>
			</div>
			<div class="w-36 h-2.5 left-[21px] top-[197px] absolute"></div>
			<div class="w-36 h-2.5 left-[21px] top-[251px] absolute"></div>
			<div class="w-40 h-12 left-[20px] top-[40px] absolute overflow-hidden">
				<?php echo get_custom_logo(); ?>
			</div>
		</div>

	</div><!-- .col-full -->
</footer><!-- #colophon -->

<?php do_action('storefront_after_footer'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>



</body>

</html>
