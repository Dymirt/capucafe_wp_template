<div data-property-1="mobile 2" class="header-shop z-3 fixed h-[100px] flex items-center w-screen px-[5%] justify-between top-0">
	<div class="max-w-40 inline-flex flex-col justify-start items-start overflow-hidden">
		<div class="w-28 h-8 relative overflow-hidden">
			<a href="<?php echo esc_url(home_url('/')); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/logotype_2.svg" alt="Alternate Logo">
			</a>
		</div>

	</div>
	<div class="hidden md:flex">
		<?php
		wp_nav_menu([
			'theme_location' => 'top-menu',
			'walker'         => new Top_Walker_Nav_Menu(),
			'container'      => false,
			'items_wrap'     => '<div class="List  px-2 inline-flex justify-start items-center gap-6 white">%3$s</div>', // no ul
			'fallback_cb'    => '',     // IMPORTANT! <- Empty string, not false!
		]);
		?>
	</div>
	<div class="h-16 flex justify-center items-center gap-4">

		<div class="w-6 h-7 relative overflow-hidden group">

			<?php
			$page_moje_konto = get_page_by_path('moje-konto');
			$moje_konto_url = get_permalink($page_moje_konto->ID);
			?>
			<a href="<?php echo esc_url($moje_konto_url); ?>" data-property-1="Default" class="w-6 h-7 relative overflow-hidden ">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
					<path d="M15.71 13.21C16.6904 12.4386 17.406 11.3809 17.7572 10.1839C18.1085 8.98694 18.0779 7.71024 17.6698 6.53145C17.2617 5.35265 16.4963 4.33037 15.4801 3.60683C14.4639 2.8833 13.2474 2.49448 12 2.49448C10.7525 2.49448 9.53611 2.8833 8.51993 3.60683C7.50374 4.33037 6.73834 5.35265 6.33021 6.53145C5.92208 7.71024 5.89151 8.98694 6.24276 10.1839C6.59401 11.3809 7.3096 12.4386 8.29 13.21C6.61007 13.883 5.14428 14.9993 4.04889 16.4399C2.95349 17.8805 2.26956 19.5913 2.07 21.39C2.05555 21.5213 2.06711 21.6542 2.10402 21.781C2.14093 21.9079 2.20246 22.0262 2.28511 22.1293C2.45202 22.3375 2.69478 22.4708 2.96 22.5C3.22521 22.5292 3.49116 22.4518 3.69932 22.2849C3.90749 22.118 4.04082 21.8752 4.07 21.61C4.28958 19.6552 5.22168 17.8498 6.68822 16.5388C8.15475 15.2278 10.0529 14.503 12.02 14.503C13.9871 14.503 15.8852 15.2278 17.3518 16.5388C18.8183 17.8498 19.7504 19.6552 19.97 21.61C19.9972 21.8557 20.1144 22.0826 20.2991 22.247C20.4838 22.4114 20.7228 22.5015 20.97 22.5H21.08C21.3421 22.4698 21.5817 22.3373 21.7466 22.1312C21.9114 21.9252 21.9881 21.6623 21.96 21.4C21.7595 19.5962 21.0719 17.881 19.9708 16.4382C18.8698 14.9954 17.3969 13.8795 15.71 13.21ZM12 12.5C11.2089 12.5 10.4355 12.2654 9.77772 11.8259C9.11992 11.3863 8.60723 10.7616 8.30448 10.0307C8.00173 9.29981 7.92251 8.49554 8.07686 7.71962C8.2312 6.94369 8.61216 6.23096 9.17157 5.67155C9.73098 5.11214 10.4437 4.73118 11.2196 4.57684C11.9956 4.4225 12.7998 4.50171 13.5307 4.80446C14.2616 5.10721 14.8863 5.6199 15.3259 6.2777C15.7654 6.93549 16 7.70885 16 8.49998C16 9.56084 15.5786 10.5783 14.8284 11.3284C14.0783 12.0786 13.0609 12.5 12 12.5Z" fill="black" />
				</svg>
			</a>
			<div class="fixed top-[100px] right-20 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
				<div class="min-w-80 p-8 bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.10)] border-b border-neutral-200 inline-flex flex-col justify-start items-start gap-6">

					<?php if (is_user_logged_in()) :
						$u = wp_get_current_user();
						$display = trim($u->first_name . ' ' . $u->last_name);
						if ($display === '') {
							$display = $u->display_name ?: $u->user_login;
						}

						// WooCommerce endpoints (with safe fallbacks if Woo is off)
						$myaccount = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : admin_url('profile.php');
						$orders    = function_exists('wc_get_endpoint_url') ? wc_get_endpoint_url('orders', '', $myaccount)        : $myaccount;
						$addresses = function_exists('wc_get_endpoint_url') ? wc_get_endpoint_url('edit-address', '', $myaccount)  : $myaccount;
						$details   = function_exists('wc_get_endpoint_url') ? wc_get_endpoint_url('edit-account', '', $myaccount)  : admin_url('profile.php');
						$logout    = wp_logout_url(home_url('/'));
					?>
						<!-- Header -->
						<div class="flex flex-col justify-center items-start">
							<div class="inline-flex items-center gap-2.5">
								<div class="text-zinc-800 text-lg font-bold leading-relaxed">Witaj</div>
							</div>
							<div class="inline-flex items-center gap-2.5">
								<div class="text-zinc-500 text-sm"><?php echo esc_html($display); ?></div>
							</div>
						</div>

						<!-- Links -->
						<div class="flex flex-col justify-start items-start gap-3">
							<a href="<?php echo esc_url($myaccount); ?>" class="inline-flex items-center gap-3">
								<div class="w-6 h-6 relative overflow-hidden">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M15.71 12.71C16.6904 11.9387 17.406 10.8809 17.7572 9.68394C18.1085 8.48697 18.0779 7.21027 17.6698 6.03147C17.2617 4.85267 16.4963 3.83039 15.4801 3.10686C14.4639 2.38332 13.2474 1.99451 12 1.99451C10.7525 1.99451 9.53611 2.38332 8.51993 3.10686C7.50374 3.83039 6.73834 4.85267 6.33021 6.03147C5.92208 7.21027 5.89151 8.48697 6.24276 9.68394C6.59401 10.8809 7.3096 11.9387 8.29 12.71C6.61007 13.383 5.14428 14.4994 4.04889 15.9399C2.95349 17.3805 2.26956 19.0913 2.07 20.89C2.05555 21.0213 2.06711 21.1542 2.10402 21.2811C2.14093 21.4079 2.20246 21.5263 2.28511 21.6293C2.45202 21.8375 2.69478 21.9708 2.96 22C3.22521 22.0292 3.49116 21.9518 3.69932 21.7849C3.90749 21.618 4.04082 21.3752 4.07 21.11C4.28958 19.1552 5.22168 17.3498 6.68822 16.0388C8.15475 14.7278 10.0529 14.003 12.02 14.003C13.9871 14.003 15.8852 14.7278 17.3518 16.0388C18.8183 17.3498 19.7504 19.1552 19.97 21.11C19.9972 21.3557 20.1144 21.5827 20.2991 21.747C20.4838 21.9114 20.7228 22.0015 20.97 22H21.08C21.3421 21.9698 21.5817 21.8373 21.7466 21.6313C21.9114 21.4252 21.9881 21.1624 21.96 20.9C21.7595 19.0962 21.0719 17.381 19.9708 15.9382C18.8698 14.4954 17.3969 13.3795 15.71 12.71ZM12 12C11.2089 12 10.4355 11.7654 9.77772 11.3259C9.11992 10.8864 8.60723 10.2616 8.30448 9.53074C8.00173 8.79983 7.92251 7.99557 8.07686 7.21964C8.2312 6.44372 8.61216 5.73099 9.17157 5.17158C9.73098 4.61217 10.4437 4.2312 11.2196 4.07686C11.9956 3.92252 12.7998 4.00173 13.5307 4.30448C14.2616 4.60724 14.8863 5.11993 15.3259 5.77772C15.7654 6.43552 16 7.20888 16 8C16 9.06087 15.5786 10.0783 14.8284 10.8284C14.0783 11.5786 13.0609 12 12 12Z" fill="#333333" />
									</svg>
								</div>
								<span class="text-zinc-800 text-sm">Moje konto</span>
							</a>

							<a href="<?php echo esc_url($orders); ?>" class="inline-flex items-center gap-3">
								<div class="w-6 h-6 relative overflow-hidden">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M19 7H16V6C16 4.93913 15.5786 3.92172 14.8284 3.17157C14.0783 2.42143 13.0609 2 12 2C10.9391 2 9.92172 2.42143 9.17157 3.17157C8.42143 3.92172 8 4.93913 8 6V7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8V19C4 19.7956 4.31607 20.5587 4.87868 21.1213C5.44129 21.6839 6.20435 22 7 22H17C17.7956 22 18.5587 21.6839 19.1213 21.1213C19.6839 20.5587 20 19.7956 20 19V8C20 7.73478 19.8946 7.48043 19.7071 7.29289C19.5196 7.10536 19.2652 7 19 7ZM10 6C10 5.46957 10.2107 4.96086 10.5858 4.58579C10.9609 4.21071 11.4696 4 12 4C12.5304 4 13.0391 4.21071 13.4142 4.58579C13.7893 4.96086 14 5.46957 14 6V7H10V6ZM18 19C18 19.2652 17.8946 19.5196 17.7071 19.7071C17.5196 19.8946 17.2652 20 17 20H7C6.73478 20 6.48043 19.8946 6.29289 19.7071C6.10536 19.5196 6 19.2652 6 19V9H8V10C8 10.2652 8.10536 10.5196 8.29289 10.7071C8.48043 10.8946 8.73478 11 9 11C9.26522 11 9.51957 10.8946 9.70711 10.7071C9.89464 10.5196 10 10.2652 10 10V9H14V10C14 10.2652 14.1054 10.5196 14.2929 10.7071C14.4804 10.8946 14.7348 11 15 11C15.2652 11 15.5196 10.8946 15.7071 10.7071C15.8946 10.5196 16 10.2652 16 10V9H18V19Z" fill="#333333" />
									</svg>
								</div>
								<span class="text-zinc-800 text-sm">Zamówienia</span>
							</a>

							<a href="<?php echo esc_url($addresses); ?>" class="inline-flex items-center gap-3">
								<div class="w-6 h-6 relative overflow-hidden">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<mask id="mask0_484_14120" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="#D9D9D9" />
										</mask>
										<g mask="url(#mask0_484_14120)">
											<path d="M5 21C4.45 21 3.97917 20.8042 3.5875 20.4125C3.19583 20.0208 3 19.55 3 19V5C3 4.45 3.19583 3.97917 3.5875 3.5875C3.97917 3.19583 4.45 3 5 3H19C19.55 3 20.0208 3.19583 20.4125 3.5875C20.8042 3.97917 21 4.45 21 5V19C21 19.55 20.8042 20.0208 20.4125 20.4125C20.0208 20.8042 19.55 21 19 21H5ZM5 19H19V5H5V19ZM8 17H13C13.2833 17 13.5208 16.9042 13.7125 16.7125C13.9042 16.5208 14 16.2833 14 16C14 15.7167 13.9042 15.4792 13.7125 15.2875C13.5208 15.0958 13.2833 15 13 15H8C7.71667 15 7.47917 15.0958 7.2875 15.2875C7.09583 15.4792 7 15.7167 7 16C7 16.2833 7.09583 16.5208 7.2875 16.7125C7.47917 16.9042 7.71667 17 8 17ZM8 13H16C16.2833 13 16.5208 12.9042 16.7125 12.7125C16.9042 12.5208 17 12.2833 17 12C17 11.7167 16.9042 11.4792 16.7125 11.2875C16.5208 11.0958 16.2833 11 16 11H8C7.71667 11 7.47917 11.0958 7.2875 11.2875C7.09583 11.4792 7 11.7167 7 12C7 12.2833 7.09583 12.5208 7.2875 12.7125C7.47917 12.9042 7.71667 13 8 13ZM8 9H16C16.2833 9 16.5208 8.90417 16.7125 8.7125C16.9042 8.52083 17 8.28333 17 8C17 7.71667 16.9042 7.47917 16.7125 7.2875C16.5208 7.09583 16.2833 7 16 7H8C7.71667 7 7.47917 7.09583 7.2875 7.2875C7.09583 7.47917 7 7.71667 7 8C7 8.28333 7.09583 8.52083 7.2875 8.7125C7.47917 8.90417 7.71667 9 8 9Z" fill="#333333" />
										</g>
									</svg>
								</div>
								<span class="text-zinc-800 text-sm">Adresy</span>
							</a>

							<a href="<?php echo esc_url($details); ?>" class="inline-flex items-center gap-3">
								<div class="w-6 h-6 relative overflow-hidden">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<mask id="mask0_484_14127" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="#D9D9D9" />
										</mask>
										<g mask="url(#mask0_484_14127)">
											<path d="M5.85 17.1C6.7 16.45 7.65 15.9375 8.7 15.5625C9.75 15.1875 10.85 15 12 15C13.15 15 14.25 15.1875 15.3 15.5625C16.35 15.9375 17.3 16.45 18.15 17.1C18.7333 16.4167 19.1875 15.6417 19.5125 14.775C19.8375 13.9083 20 12.9833 20 12C20 9.78333 19.2208 7.89583 17.6625 6.3375C16.1042 4.77917 14.2167 4 12 4C9.78333 4 7.89583 4.77917 6.3375 6.3375C4.77917 7.89583 4 9.78333 4 12C4 12.9833 4.1625 13.9083 4.4875 14.775C4.8125 15.6417 5.26667 16.4167 5.85 17.1ZM12 13C11.0167 13 10.1875 12.6625 9.5125 11.9875C8.8375 11.3125 8.5 10.4833 8.5 9.5C8.5 8.51667 8.8375 7.6875 9.5125 7.0125C10.1875 6.3375 11.0167 6 12 6C12.9833 6 13.8125 6.3375 14.4875 7.0125C15.1625 7.6875 15.5 8.51667 15.5 9.5C15.5 10.4833 15.1625 11.3125 14.4875 11.9875C13.8125 12.6625 12.9833 13 12 13ZM12 22C10.6167 22 9.31667 21.7375 8.1 21.2125C6.88333 20.6875 5.825 19.975 4.925 19.075C4.025 18.175 3.3125 17.1167 2.7875 15.9C2.2625 14.6833 2 13.3833 2 12C2 10.6167 2.2625 9.31667 2.7875 8.1C3.3125 6.88333 4.025 5.825 4.925 4.925C5.825 4.025 6.88333 3.3125 8.1 2.7875C9.31667 2.2625 10.6167 2 12 2C13.3833 2 14.6833 2.2625 15.9 2.7875C17.1167 3.3125 18.175 4.025 19.075 4.925C19.975 5.825 20.6875 6.88333 21.2125 8.1C21.7375 9.31667 22 10.6167 22 12C22 13.3833 21.7375 14.6833 21.2125 15.9C20.6875 17.1167 19.975 18.175 19.075 19.075C18.175 19.975 17.1167 20.6875 15.9 21.2125C14.6833 21.7375 13.3833 22 12 22ZM12 20C12.8833 20 13.7167 19.8708 14.5 19.6125C15.2833 19.3542 16 18.9833 16.65 18.5C16 18.0167 15.2833 17.6458 14.5 17.3875C13.7167 17.1292 12.8833 17 12 17C11.1167 17 10.2833 17.1292 9.5 17.3875C8.71667 17.6458 8 18.0167 7.35 18.5C8 18.9833 8.71667 19.3542 9.5 19.6125C10.2833 19.8708 11.1167 20 12 20ZM12 11C12.4333 11 12.7917 10.8583 13.075 10.575C13.3583 10.2917 13.5 9.93333 13.5 9.5C13.5 9.06667 13.3583 8.70833 13.075 8.425C12.7917 8.14167 12.4333 8 12 8C11.5667 8 11.2083 8.14167 10.925 8.425C10.6417 8.70833 10.5 9.06667 10.5 9.5C10.5 9.93333 10.6417 10.2917 10.925 10.575C11.2083 10.8583 11.5667 11 12 11Z" fill="#333333" />
										</g>
									</svg>
								</div>
								<span class="text-zinc-800 text-sm">Dane osobowe</span>
							</a>
						</div>

						<!-- Logout -->
						<a href="<?php echo esc_url($logout); ?>"
							class="self-stretch h-11 px-7 !bg-[#A9957B] rounded outline outline-1 outline-offset-[-1px] !outline-[#A9957B] inline-flex justify-center items-center gap-4">
							<span class="text-white text-sm font-bold uppercase">Wyloguj się</span>
						</a>

					<?php else :
						// Not logged in → show login/register (Woo uses the same My Account page)
						$login_register = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url();
					?>
						<div class="p-8 inline-flex flex-col justify-start items-start gap-6">
							<div data-property-1="hover" class="self-stretch h-11 px-7 bg-[#A9957B] rounded outline outline-1 outline-offset-[-1px] outline-[#A9957B]  inline-flex justify-center items-center gap-4">
								<a href="<?php echo esc_url($login_register); ?>" class="justify-center text-white text-sm font-bold font-['Mulish'] uppercase leading-tight">Zaloguj się</a>
							</div>
							<div class="inline-flex justify-start items-center gap-3">
								<div class="flex justify-center items-center gap-2.5">
									<div class="justify-center text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Jesteś nowym klientem?</div>
								</div>
								<div data-property-1="Default" class="border-b border-zinc-800 flex justify-center items-center gap-2.5">
									<a href="<?php echo esc_url( $login_register); ?>" class="justify-center !text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Załóż konto teraz</a>
								</div>
							</div>
						</div>
					<?php endif; ?>

				</div>
			</div>

		</div>
		<div class="w-6 h-7 relative overflow-hidden group">
			<?php
			$page_koszyk = get_page_by_path('koszyk');
			$koszyk_url = get_permalink($page_koszyk->ID);
			?>
			<a href="<?php echo esc_url($koszyk_url); ?>" data-property-1="Default" class="w-6 h-6 relative overflow-hidden">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="21" viewBox="0 0 16 21" fill="none">
					<path d="M15 5.49998H12V4.49998C12 3.43911 11.5786 2.4217 10.8284 1.67155C10.0783 0.921405 9.06087 0.499977 8 0.499977C6.93913 0.499977 5.92172 0.921405 5.17157 1.67155C4.42143 2.4217 4 3.43911 4 4.49998V5.49998H1C0.734784 5.49998 0.48043 5.60533 0.292893 5.79287C0.105357 5.98041 0 6.23476 0 6.49998V17.5C0 18.2956 0.316071 19.0587 0.87868 19.6213C1.44129 20.1839 2.20435 20.5 3 20.5H13C13.7956 20.5 14.5587 20.1839 15.1213 19.6213C15.6839 19.0587 16 18.2956 16 17.5V6.49998C16 6.23476 15.8946 5.98041 15.7071 5.79287C15.5196 5.60533 15.2652 5.49998 15 5.49998ZM6 4.49998C6 3.96954 6.21071 3.46084 6.58579 3.08576C6.96086 2.71069 7.46957 2.49998 8 2.49998C8.53043 2.49998 9.03914 2.71069 9.41421 3.08576C9.78929 3.46084 10 3.96954 10 4.49998V5.49998H6V4.49998ZM14 17.5C14 17.7652 13.8946 18.0195 13.7071 18.2071C13.5196 18.3946 13.2652 18.5 13 18.5H3C2.73478 18.5 2.48043 18.3946 2.29289 18.2071C2.10536 18.0195 2 17.7652 2 17.5V7.49998H4V8.49998C4 8.76519 4.10536 9.01955 4.29289 9.20708C4.48043 9.39462 4.73478 9.49998 5 9.49998C5.26522 9.49998 5.51957 9.39462 5.70711 9.20708C5.89464 9.01955 6 8.76519 6 8.49998V7.49998H10V8.49998C10 8.76519 10.1054 9.01955 10.2929 9.20708C10.4804 9.39462 10.7348 9.49998 11 9.49998C11.2652 9.49998 11.5196 9.39462 11.7071 9.20708C11.8946 9.01955 12 8.76519 12 8.49998V7.49998H14V17.5Z" fill="black" />
				</svg>
				<div class="w-2.5 h-2.5 left-[13px] top-[13px] absolute bg-red-500 rounded-[30px] inline-flex flex-col justify-center items-center gap-2.5">
					<div class="justify-center text-white text-[6px] font-extrabold font-['Mulish'] uppercase leading-[7.80px]"><?php echo WC()->cart->get_cart_contents_count() ?></div>
				</div>
			</a>

			<div class=" fixed top-[100px] right-20 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
				<div class=" p-8 bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.10)] border-b border-neutral-200 inline-flex flex-col justify-start items-start gap-6">
					<div class="self-stretch justify-center text-zinc-800 text-sm font-bold uppercase leading-tight">
						Koszyk (<span class="js-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>)
					</div>
					<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
						$product   = $cart_item['data'];
						if (! $product || ! $product->exists() || $cart_item['quantity'] <= 0) continue;

						$qty = (int) $cart_item['quantity'];
						// Ensure variation thumbnails are used when available and allow filters to modify the output
						if ($product->is_type('variation')) {
							$img_id = $product->get_image_id();
							if (! $img_id) {
								$parent = wc_get_product($product->get_parent_id());
								$img_id = $parent ? $parent->get_image_id() : 0;
							}
						} else {
							$img_id = $product->get_image_id();
						}

						$thumb_url = $img_id
							? wp_get_attachment_image_url($img_id, 'woocommerce_thumbnail')
							: wc_placeholder_img_src('woocommerce_thumbnail');
						// Let plugins/themes alter the cart item thumbnail (matches Woo default template behavior)
						$name      = $product->get_name();
						$permalink = $product->is_visible() ? $product->get_permalink($cart_item) : '';
						$subtotal  = WC()->cart->get_product_subtotal($product, $qty); // formatted HTML
						$remove_url = wc_get_cart_remove_url($cart_item_key);
					?>
						<div class="inline-flex justify-start items-start gap-5" data-cart-item="<?php echo esc_attr($cart_item_key); ?>">
							<img class="w-24 h-24 py-4" src="<?php echo esc_url($thumb_url); ?>" />
							<div class="w-56 min-w-56 inline-flex flex-col justify-start items-start gap-3">
								<div class="self-stretch inline-flex justify-start items-start gap-3">
									<div class="flex-1 justify-center text-zinc-800 text-sm font-bold font-['Mulish'] leading-tight"><?php echo $name; ?></div>

									<div class="relative overflow-hidden">
										<a href="<?php echo esc_url($remove_url); ?>"
											class="w-4 h-4 relative overflow-hidden remove remove_from_cart_button"
											aria-label="<?php esc_attr_e('Usuń pozycję', 'woocommerce'); ?>"
											data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>"
											data-product_id="<?php echo esc_attr($product->get_id()); ?>"
											data-product_sku="<?php echo esc_attr($product->get_sku()); ?>">
										</a>
									</div>
								</div>
								<?php
								if (!empty($cart_item['custom_candies'])) {
									$output = '<ul class="custom-candies-list text-black" style="margin-top: 8px; font-size: 0.875rem;">';
									foreach ($cart_item['custom_candies'] as $candy) {
										$output .= '<li><strong>' . esc_html($candy['name']) . '</strong>: ' . esc_html($candy['quantity']) . ' szt.</li>';
									}
									$output .= '</ul>';
									echo $output;
								}
								?>
								<div class="self-stretch inline-flex justify-center items-center">
									<div class="h-8 px-1.5 py-2 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 flex items-center gap-2.5"
										data-qty-box
										data-cart-item="<?php echo esc_attr($cart_item_key); ?>">

										<!-- − -->
										<div
											class="w-5 h-5 flex items-center justify-center rounded border border-stone-400 js-qty-minus"
											aria-label="Mniej">−</div>

										<!-- value -->
										<span class="js-qty-val text-zinc-800 text-lg font-light leading-relaxed">
											<?php echo (int) $qty; ?>
										</span>

										<!-- + -->
										<div type=""
											class="w-5 h-5 flex items-center justify-center rounded border border-stone-400 js-qty-plus"
											aria-label="Więcej">+</div>
									</div>


									<div class="flex-1 flex justify-end items-start gap-2.5">
										<div class="flex-1 text-right justify-center text-zinc-800 text-sm font-normal leading-tight">
											<span class="js-line-subtotal">
												<?php echo wp_kses_post(WC()->cart->get_product_subtotal($product, $qty)); ?>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

					<div class="self-stretch pt-5 border-t border-neutral-200 flex flex-col justify-start items-start">

						<div class="self-stretch inline-flex justify-start items-start">
							<div class="flex-1 justify-center text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Razem</div>
							<div class="flex-1 text-right justify-center text-zinc-800 text-sm font-normal leading-tight">
								<span class="js-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
							</div>
						</div>
						<div class="self-stretch pt-5 inline-flex justify-start items-start gap-2.5">
							<a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" data-property-1="Default" class="flex-1 h-11 px-7 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 flex justify-center items-center gap-2.5">
								<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight">Kontynuj zakupy</div>
							</a>
							<a href="<?php echo esc_url($koszyk_url); ?>" data-property-1="hover" class="flex-1 h-11 px-7 !bg-[#A9957B] rounded outline outline-1 outline-offset-[-1px] !outline-[#A9957B] flex justify-center items-center gap-4">
								<div class="justify-center text-white text-sm font-bold uppercase leading-tight">
									koszyk (<span class="js-cart-button-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>)
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="w-6 h-6 relative overflow-hidden md:hidden" onclick="openMenu()">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 25" fill="none">
				<path d="M3 7.49998H21C21.2652 7.49998 21.5196 7.39462 21.7071 7.20708C21.8946 7.01955 22 6.76519 22 6.49998C22 6.23476 21.8946 5.98041 21.7071 5.79287C21.5196 5.60533 21.2652 5.49998 21 5.49998H3C2.73478 5.49998 2.48043 5.60533 2.29289 5.79287C2.10536 5.98041 2 6.23476 2 6.49998C2 6.76519 2.10536 7.01955 2.29289 7.20708C2.48043 7.39462 2.73478 7.49998 3 7.49998ZM21 17.5H3C2.73478 17.5 2.48043 17.6053 2.29289 17.7929C2.10536 17.9804 2 18.2348 2 18.5C2 18.7652 2.10536 19.0195 2.29289 19.2071C2.48043 19.3946 2.73478 19.5 3 19.5H21C21.2652 19.5 21.5196 19.3946 21.7071 19.2071C21.8946 19.0195 22 18.7652 22 18.5C22 18.2348 21.8946 17.9804 21.7071 17.7929C21.5196 17.6053 21.2652 17.5 21 17.5ZM21 11.5H3C2.73478 11.5 2.48043 11.6053 2.29289 11.7929C2.10536 11.9804 2 12.2348 2 12.5C2 12.7652 2.10536 13.0195 2.29289 13.2071C2.48043 13.3946 2.73478 13.5 3 13.5H21C21.2652 13.5 21.5196 13.3946 21.7071 13.2071C21.8946 13.0195 22 12.7652 22 12.5C22 12.2348 21.8946 11.9804 21.7071 11.7929C21.5196 11.6053 21.2652 11.5 21 11.5Z" fill="black" />
			</svg>
		</div>
	</div>
</div>
