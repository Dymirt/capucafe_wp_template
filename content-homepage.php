<?php

/**
 * The template used for displaying page content in template-homepage.php
 *
 * @package storefront
 */

?>
<?php
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
?>

<div class="w-full relative bg-white inline-flex flex-col justify-start items-start overflow-hidden">
	<div class="w-full self-stretch h-[570px] px-5 py-12 bg-gradient-to-b from-black/0 to-black flex flex-col justify-end items-start gap-10 overflow-hidden bg-[url('/app/themes/capuccinocafe_v2/resources/img/front_page_1.jpg')] bg-cover bg-right bg-no-repeat bg-[length:560px]">
		<div class="self-stretch flex flex-col justify-start items-start gap-6 ">
			<div class="self-stretch justify-start text-white text-4xl font-normal font-['Didot_LT_Pro']">O słodkościach Wiemy Wszystko</div>
			<div class="justify-center text-white text-base font-light font-['Mulish'] leading-snug">I chętnie się z wami tym podzielimy!</div>
		</div>
		<div class="self-stretch rounded inline-flex justify-start items-start gap-2.5 flex-wrap content-start">
			<div data-property-1="pasvie" class="flex-1 h-20 min-w-32 px-3 py-4 bg-[radial-gradient(ellipse_236.41%_558.53%_at_120.90%_37.16%,_#A9957B_0%,_rgba(177,_160,_142,_0)_100%)] rounded outline outline-1 outline-offset-[-1px] outline-stone-400 backdrop-blur-blur flex justify-center items-center gap-2">
				<div class="flex-1 inline-flex flex-col justify-start items-start gap-2">
					<div class="self-stretch justify-start text-white text-xs font-normal font-['Mulish']">01</div>
					<div class="self-stretch justify-center text-white text-xs font-bold font-['Mulish'] uppercase">Pracownia tortów</div>
				</div>
				<div class="w-6 h-6">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<mask id="mask0_2040_1908" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
							<rect width="24" height="24" fill="#D9D9D9" />
						</mask>
						<g mask="url(#mask0_2040_1908)">
							<path d="M4.3655 21.5C4.1205 21.5 3.915 21.4138 3.749 21.2413C3.583 21.0689 3.5 20.8603 3.5 20.6153V15.7308C3.5 15.2321 3.67658 14.8061 4.02975 14.4528C4.38308 14.0996 4.80908 13.923 5.30775 13.923H5.5V9.84626C5.5 9.34742 5.67658 8.92142 6.02975 8.56826C6.38308 8.21509 6.80908 8.03851 7.30775 8.03851H11.25V6.56926C10.9565 6.37559 10.7164 6.14834 10.5298 5.88751C10.3433 5.62667 10.25 5.31542 10.25 4.95376C10.25 4.72942 10.2936 4.51251 10.3808 4.30301C10.4679 4.09334 10.5987 3.90134 10.773 3.72701L11.6788 2.82126C11.7058 2.79426 11.8128 2.74742 12 2.68076C12.0333 2.68076 12.1404 2.72759 12.3212 2.82126L13.227 3.72701C13.4013 3.90134 13.5321 4.09334 13.6193 4.30301C13.7064 4.51251 13.75 4.72942 13.75 4.95376C13.75 5.31542 13.6567 5.62667 13.4703 5.88751C13.2836 6.14834 13.0435 6.37559 12.75 6.56926V8.03851H16.6923C17.1909 8.03851 17.6169 8.21509 17.9703 8.56826C18.3234 8.92142 18.5 9.34742 18.5 9.84626V13.923H18.6923C19.1909 13.923 19.6169 14.0996 19.9703 14.4528C20.3234 14.8061 20.5 15.2321 20.5 15.7308V20.6153C20.5 20.8603 20.4138 21.0689 20.2413 21.2413C20.0689 21.4138 19.8603 21.5 19.6152 21.5H4.3655ZM7 13.923H17V9.84626C17 9.75642 16.9712 9.68267 16.9135 9.62501C16.8558 9.56734 16.7821 9.53851 16.6923 9.53851H7.30775C7.21792 9.53851 7.14417 9.56734 7.0865 9.62501C7.02883 9.68267 7 9.75642 7 9.84626V13.923ZM5 20H19V15.7308C19 15.6409 18.9712 15.5672 18.9135 15.5095C18.8558 15.4518 18.7821 15.423 18.6923 15.423H5.30775C5.21792 15.423 5.14417 15.4518 5.0865 15.5095C5.02883 15.5672 5 15.6409 5 15.7308V20Z" fill="white" />
						</g>
					</svg>
				</div>
			</div>
			<div data-property-1="pasvie" class="flex-1 h-20 min-w-32 px-3 py-4 bg-[radial-gradient(ellipse_236.41%_558.53%_at_120.90%_37.16%,_#A9957B_0%,_rgba(177,_160,_142,_0)_100%)] rounded outline outline-1 outline-offset-[-1px] outline-stone-400 backdrop-blur-blur flex justify-center items-center gap-2">
				<div class="flex-1 inline-flex flex-col justify-start items-start gap-2">
					<div class="self-stretch justify-start text-white text-xs font-normal font-['Mulish']">02</div>
					<div class="self-stretch justify-center text-white text-xs font-bold font-['Mulish'] uppercase">Słodkie Stoły</div>
				</div>
				<div class="w-6 h-6 ">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="mask0_2030_6343" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
							<rect width="24" height="24" fill="#D9D9D9" />
						</mask>
						<g mask="url(#mask0_2030_6343)">
							<path d="M19.2931 17.1808C19.7099 17.4013 20.0616 17.3503 20.348 17.028C20.6344 16.7055 20.674 16.3449 20.4669 15.9462L18.7907 12.8038L17.4366 16.2155L19.2931 17.1808ZM14.1532 16.25H15.791L18.2038 10.2615C18.3048 10.0063 18.3116 9.79767 18.224 9.6355C18.1364 9.47333 17.998 9.35125 17.8088 9.26925L15.8142 8.46925C15.5878 8.38075 15.3688 8.38142 15.1572 8.47125C14.9456 8.56092 14.8232 8.72558 14.79 8.96525L14.1532 16.25ZM6.86909 16.25H8.50692L7.87014 8.927C7.8369 8.70517 7.71772 8.55125 7.5126 8.46525C7.30732 8.37942 7.08509 8.38075 6.8459 8.46925L4.85128 9.26925C4.6352 9.35775 4.49973 9.49267 4.44488 9.674C4.38986 9.8555 4.40648 10.0642 4.49475 10.3L6.86909 16.25ZM3.36704 17.1808L5.22353 16.2155L3.88863 12.8038L2.1932 15.9845C1.9733 16.3897 2.01452 16.7423 2.31687 17.0423C2.61922 17.3423 2.96928 17.3884 3.36704 17.1808ZM10.0029 16.25H12.6572L13.4244 7.56925C13.4576 7.34225 13.4011 7.149 13.2546 6.9895C13.1083 6.82983 12.9156 6.75 12.6764 6.75H9.98369C9.7932 6.75 9.61518 6.825 9.44963 6.975C9.28391 7.125 9.2126 7.31025 9.23571 7.53075L10.0029 16.25ZM2.8427 18.7693C2.20442 18.7693 1.67261 18.5388 1.24726 18.0778C0.821738 17.6169 0.608978 17.0667 0.608978 16.427C0.608978 16.2335 0.634908 16.0441 0.686768 15.8588C0.738462 15.6734 0.805864 15.4923 0.888973 15.3155L3.14065 11C2.91426 10.3782 2.90495 9.76308 3.11272 9.15475C3.3205 8.54642 3.71468 8.12175 4.29528 7.88075L6.2899 7.08075C6.54821 6.97825 6.80967 6.91833 7.07429 6.901C7.33891 6.88367 7.58757 6.93208 7.82027 7.04625C7.96355 6.54358 8.23017 6.11858 8.62012 5.77125C9.01006 5.42375 9.46949 5.25 9.9984 5.25H12.6764C13.202 5.25 13.6614 5.41892 14.0545 5.75675C14.4476 6.09458 14.7222 6.51158 14.8782 7.00775C15.0917 6.89742 15.3308 6.858 15.5955 6.8895C15.8602 6.92083 16.1184 6.98458 16.3702 7.08075L18.3648 7.88075C18.9659 8.12175 19.3802 8.54483 19.6077 9.15C19.8353 9.75517 19.8123 10.3552 19.5387 10.95L21.7903 15.2655C21.8773 15.4295 21.9457 15.598 21.9955 15.771C22.0454 15.944 22.0703 16.1242 22.0703 16.3115C22.0703 16.9973 21.836 17.5784 21.3675 18.0548C20.8987 18.5311 20.3238 18.7693 19.6426 18.7693C19.4761 18.7693 19.3132 18.75 19.1539 18.7115C18.9945 18.673 18.8351 18.6153 18.6757 18.5385L17.0915 17.75H5.53793L4.0841 18.5193C3.89362 18.6231 3.69224 18.6907 3.47998 18.722C3.26772 18.7535 3.0553 18.7693 2.8427 18.7693Z" fill="white" />
						</g>
					</svg>
				</div>
			</div>
			<div data-property-1="pasvie" class="flex-1 h-20 min-w-32 px-3 py-4 bg-[radial-gradient(ellipse_236.41%_558.53%_at_120.90%_37.16%,_#A9957B_0%,_rgba(177,_160,_142,_0)_100%)] rounded outline outline-1 outline-offset-[-1px] outline-stone-400 backdrop-blur-blur flex justify-center items-center gap-2">
				<div class="flex-1 inline-flex flex-col justify-start items-start gap-2">
					<div class="self-stretch justify-start text-white text-xs font-normal font-['Mulish']">03</div>
					<div class="self-stretch justify-center text-white text-xs font-bold font-['Mulish'] uppercase">Kawiarnia</div>
				</div>
				<div class="w-6 h-6">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="mask0_2030_6325" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
							<rect width="24" height="24" fill="#D9D9D9" />
						</mask>
						<g mask="url(#mask0_2030_6325)">
							<path d="M11.125 17.6152C9.29033 17.6152 7.7275 16.9874 6.4365 15.7317C5.1455 14.4759 4.5 12.9372 4.5 11.1155V5C4.5 4.591 4.64775 4.23875 4.94325 3.94325C5.23875 3.64775 5.591 3.5 6 3.5H18.375C19.238 3.5 19.9746 3.79842 20.5848 4.39525C21.1949 4.99208 21.5 5.71933 21.5 6.577C21.5 7.45333 21.1968 8.20125 20.5903 8.82075C19.9839 9.44025 19.2455 9.75 18.375 9.75H17.6538V11.1155C17.6538 12.9262 17.0195 14.4622 15.751 15.7235C14.4823 16.9847 12.9403 17.6152 11.125 17.6152ZM6 8.25H16.1538V5H6V8.25ZM11.125 16.1155C12.5212 16.1155 13.7083 15.6296 14.6865 14.6578C15.6647 13.6859 16.1538 12.5052 16.1538 11.1155V9.75H6V11.1155C6 12.5117 6.50192 13.694 7.50575 14.6625C8.50958 15.6312 9.716 16.1155 11.125 16.1155ZM17.6538 8.25H18.375C18.8302 8.25 19.2148 8.08733 19.5288 7.762C19.8429 7.43667 20 7.04167 20 6.577C20 6.13467 19.8398 5.76125 19.5193 5.45675C19.1988 5.15225 18.8173 5 18.375 5H17.6538V8.25ZM5.25 20.5C5.0375 20.5 4.85942 20.4281 4.71575 20.2843C4.57192 20.1404 4.5 19.9622 4.5 19.7498C4.5 19.5371 4.57192 19.359 4.71575 19.2155C4.85942 19.0718 5.0375 19 5.25 19H18.75C18.9625 19 19.1406 19.0719 19.2843 19.2158C19.4281 19.3596 19.5 19.5378 19.5 19.7502C19.5 19.9629 19.4281 20.141 19.2843 20.2845C19.1406 20.4282 18.9625 20.5 18.75 20.5H5.25Z" fill="white" />
						</g>
					</svg>

				</div>
			</div>
			<div data-property-1="pasvie" class="flex-1 h-20 min-w-32 px-3 py-4 bg-[radial-gradient(ellipse_236.41%_558.53%_at_120.90%_37.16%,_#A9957B_0%,_rgba(177,_160,_142,_0)_100%)] rounded outline outline-1 outline-offset-[-1px] outline-stone-400 backdrop-blur-blur flex justify-center items-center gap-2">
				<div class="flex-1 inline-flex flex-col justify-start items-start gap-2">
					<div class="self-stretch justify-start text-white text-xs font-normal font-['Mulish']">04</div>
					<div class="self-stretch justify-center text-white text-xs font-bold font-['Mulish'] uppercase">Sklep online</div>
				</div>
				<div class="w-6 h-6">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="mask0_2030_6377" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
							<rect width="24" height="24" fill="#D9D9D9" />
						</mask>
						<g mask="url(#mask0_2030_6377)">
							<path d="M6.65042 21.5C6.14661 21.5 5.72018 21.325 5.37112 20.975C5.02206 20.625 4.84753 20.1974 4.84753 19.6923V8.30775C4.84753 7.80258 5.02206 7.375 5.37112 7.025C5.72018 6.675 6.14661 6.5 6.65042 6.5H8.58744V6.25C8.58744 5.21417 8.95246 4.33017 9.68249 3.598C10.4127 2.866 11.2943 2.5 12.3274 2.5C13.3604 2.5 14.242 2.866 14.9722 3.598C15.7023 4.33017 16.0673 5.21417 16.0673 6.25V6.5H18.0043C18.5081 6.5 18.9345 6.675 19.2836 7.025C19.6326 7.375 19.8072 7.80258 19.8072 8.30775V19.6923C19.8072 20.1974 19.6326 20.625 19.2836 20.975C18.9345 21.325 18.5081 21.5 18.0043 21.5H6.65042ZM6.65042 20H18.0043C18.0811 20 18.1514 19.9679 18.2152 19.9038C18.2792 19.8398 18.3112 19.7693 18.3112 19.6923V8.30775C18.3112 8.23075 18.2792 8.16025 18.2152 8.09625C18.1514 8.03208 18.0811 8 18.0043 8H16.0673V10.25C16.0673 10.4628 15.9956 10.641 15.8523 10.7845C15.7092 10.9282 15.5315 11 15.3193 11C15.107 11 14.9293 10.9282 14.7862 10.7845C14.6429 10.641 14.5713 10.4628 14.5713 10.25V8H10.0834V10.25C10.0834 10.4628 10.0118 10.641 9.86849 10.7845C9.72538 10.9282 9.54769 11 9.33543 11C9.12317 11 8.94548 10.9282 8.80236 10.7845C8.65908 10.641 8.58744 10.4628 8.58744 10.25V8H6.65042C6.57363 8 6.50332 8.03208 6.43949 8.09625C6.3755 8.16025 6.3435 8.23075 6.3435 8.30775V19.6923C6.3435 19.7693 6.3755 19.8398 6.43949 19.9038C6.50332 19.9679 6.57363 20 6.65042 20ZM10.0834 6.5H14.5713V6.25C14.5713 5.62317 14.3536 5.09142 13.9183 4.65475C13.483 4.21825 12.9527 4 12.3274 4C11.702 4 11.1717 4.21825 10.7364 4.65475C10.3011 5.09142 10.0834 5.62317 10.0834 6.25V6.5Z" fill="white" />
						</g>
					</svg>

				</div>
			</div>
		</div>
	</div>
	<div class="self-stretch px-10 py-14 bg-white blur-[0px] flex flex-col justify-start items-start gap-6">
		<div class="self-stretch justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Capuccino Cafe to artystyczna pracownia tortów weselnych, komunijnych i okolicznościowych. Dzięki wieloletniemu doświadczeniu, kunsztowi naszych cukierników i najwyższej jakości składnikom zdobyliśmy renomę i zaufanie Klientów. Tworzymy wyjątkowe torty według autorskich pomysłów oraz wizji zamawiających, a także zachwycające słodkie stoły.</div>
		<div class="self-stretch justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">To także klimatyczne kawiarnie w nadmorskich kurortach, serwujące pyszne ciasta, desery i kawę z autorskiej mieszanki. W ofercie mamy bez, tarty, serniki, lody naturalne oraz propozycje niskokaloryczne.</div>
	</div>
	<div class="bg-[url('/app/themes/capuccinocafe_v2/resources/img/video_falback.jpg')] self-stretch h-44 flex flex-col justify-center items-center gap-2.5">
		<div class="w-14 h-14 bg-stone-400 rounded-full">
			<div class="w-12 h-12  relative top-[4px] left-[4px] rounded-[91px] outline outline-1 outline-offset-[-1px] outline-stone-700 inline-flex justify-center items-center gap-2.5">
				<div class="w-4 h-5 relative left-[2px]"><svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path id="sound_sampler" d="M0 18.9545V1.04581C0 0.630291 0.176594 0.325508 0.529786 0.13146C0.882977 -0.0625873 1.23949 -0.0418105 1.59933 0.193789L15.582 9.10668C15.9003 9.32816 16.0594 9.62588 16.0594 9.99985C16.0594 10.3738 15.9003 10.6717 15.582 10.8936L1.59933 19.8065C1.23949 20.0417 0.882977 20.0625 0.529786 19.8688C0.176594 19.6748 0 19.37 0 18.9545Z" fill="white" />
					</svg>
				</div>
			</div>
		</div>
	</div>
	<div class="relative md:grid md:grid-flow-col self-stretch px-5 py-14 bg-stone-200 flex flex-col justify-start items-center gap-7">
		<div class="md:top-4 md:row-span-3 md:h-full text-center justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">
			<div class="sticky top-4 flex flex-col relative">
				<div class="text-center text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">
					Capuccino Cafe to...
				</div>
			</div>
		</div>
		<div class="md:col-span-2 self-stretch flex flex-col justify-start items-start gap-5">
			<div class="self-stretch bg-white rounded inline-flex justify-start items-end flex-wrap content-end overflow-hidden">
				<img class="md:order-2 flex-1 h-full md:min-w-40 md:w-2/3 md:object-none" src="/app/themes/capuccinocafe_v2/resources/img/pracownia_tortow.png" />
				<div class="flex-1 min-w-72 p-5 inline-flex flex-col justify-start items-start gap-3">
					<div class="self-stretch justify-start text-stone-700 text-xl font-bold font-['Mulish']">Pracownia tortów</div>
					<div class="self-stretch justify-start text-zinc-500 text-sm font-normal font-['Mulish'] leading-tight">Wykonujemy torty na zamówienie, według projektu i wizji Młodej Pary. Służymy również fachowym doradztwem.</div>
				</div>
			</div>
			<div class="self-stretch bg-white rounded inline-flex justify-start items-end flex-wrap content-end overflow-hidden md:h-80">
				<img class="md:order-2 flex-1 h-full md:min-w-40 md:w-2/3 md:object-none" src="/app/themes/capuccinocafe_v2/resources/img/slodkie_stoly.jpg" />
				<div class="flex-1 min-w-72 p-6 inline-flex flex-col justify-start items-start gap-4">
					<div class="self-stretch justify-start text-stone-700 text-xl font-bold font-['Mulish']">Słodkie Stoły</div>
					<div class="self-stretch justify-start text-zinc-500 text-sm font-normal font-['Mulish'] leading-tight">Słodkie stoły zachwycają bogactwem smaków i przepiękną aranżacją. </div>
				</div>
			</div>
			<div class="self-stretch bg-white rounded inline-flex justify-start items-end flex-wrap content-end overflow-hidden">
				<img class="md:order-2 flex-1 h-full md:min-w-40 md:w-2/3 md:object-none" src="/app/themes/capuccinocafe_v2/resources/img/kawiarnie.png" />
				<div class="flex-1 min-w-72 p-6 inline-flex flex-col justify-start items-start gap-4">
					<div class="self-stretch justify-start text-stone-700 text-xl font-bold font-['Mulish']">Kawiarnie</div>
					<div class="self-stretch justify-start text-zinc-500 text-sm font-normal font-['Mulish'] leading-tight">Klimatyczne kawiarnie w nadmorskich kurortach. Najwyższej jakości ciasta i desery własnej produkcji oraz aromatyczna kawa.</div>
				</div>
			</div>
			<div class="self-stretch bg-white rounded inline-flex justify-start items-end flex-wrap content-end overflow-hidden">
				<img class="md:order-2 flex-1 h-full md:min-w-40 md:w-2/3 md:object-none" src="/app/themes/capuccinocafe_v2/resources/img/sklep_online.png" />
				<div class="flex-1 min-w-72 p-6 inline-flex flex-col justify-start items-start gap-4">
					<div class="self-stretch justify-start text-stone-700 text-xl font-bold font-['Mulish']">Sklep online</div>
					<div class="self-stretch justify-start text-zinc-500 text-sm font-normal font-['Mulish'] leading-tight">Zapewniamy kompleksową organizację imprez okolicznościowych.</div>
				</div>
			</div>
		</div>
		<div data-property-1="Default" class="h-12 px-7 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5">
			<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight">Więcej o nas</div>
			<div class="w-6 h-6 relative overflow-hidden">
				<div class="w-3.5 h-3.5 top-[2px] relative"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.627 12.75H5.25C5.03717 12.75 4.859 12.6782 4.7155 12.5345C4.57183 12.391 4.5 12.2128 4.5 12C4.5 11.7872 4.57183 11.609 4.7155 11.4655C4.859 11.3218 5.03717 11.25 5.25 11.25H16.627L11.4577 6.08076C11.3091 5.93209 11.2357 5.75809 11.2375 5.55876C11.2395 5.35942 11.318 5.18217 11.473 5.02701C11.6282 4.88217 11.8038 4.80717 12 4.80201C12.1962 4.79684 12.3718 4.87184 12.527 5.02701L18.8672 11.3673C18.9609 11.4609 19.0269 11.5597 19.0652 11.6635C19.1037 11.7673 19.123 11.8795 19.123 12C19.123 12.1205 19.1037 12.2327 19.0652 12.3365C19.0269 12.4403 18.9609 12.5391 18.8672 12.6328L12.527 18.973C12.3885 19.1115 12.217 19.1823 12.0125 19.1855C11.808 19.1887 11.6282 19.1178 11.473 18.973C11.318 18.8178 11.2405 18.6397 11.2405 18.4385C11.2405 18.2372 11.318 18.0589 11.473 17.9038L16.627 12.75Z" fill="#A9957B" />
					</svg>

				</div>
			</div>
		</div>
	</div>


	<!-- Nasze bestsellery -->
	<div class="self-stretch px-5 py-14 flex flex-col justify-center items-center gap-7">
		<div class="w-72 inline-flex justify-between items-center">
			<div class="justify-start text-stone-700 text-2xl font-normal font-['Didot_LT_Pro']">
				Nasze bestsellery
			</div>
			<div class="flex gap-2.5">
				<div id="scrollLeft" class="w-7 h-7 p-2 origin-top-left rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden">
					<div class="w-3.5 h-3.5"><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M2.873 7.05175L14.25 7.05175C14.4628 7.05175 14.641 7.12358 14.7845 7.26725C14.9282 7.41075 15 7.58892 15 7.80175C15 8.01458 14.9282 8.19275 14.7845 8.33625C14.641 8.47992 14.4628 8.55175 14.25 8.55175L2.873 8.55175L8.04225 13.721C8.19092 13.8697 8.26433 14.0437 8.2625 14.243C8.2605 14.4423 8.182 14.6196 8.027 14.7747C7.87183 14.9196 7.69617 14.9946 7.5 14.9997C7.30383 15.0049 7.12817 14.9299 6.973 14.7747L0.632751 8.4345C0.539085 8.34083 0.473085 8.24208 0.434752 8.13825C0.396252 8.03442 0.377002 7.92225 0.377002 7.80175C0.377002 7.68125 0.396252 7.56908 0.434752 7.46525C0.473085 7.36142 0.539085 7.26267 0.632751 7.169L6.973 0.82875C7.1115 0.69025 7.283 0.619417 7.4875 0.616249C7.692 0.613083 7.87183 0.683916 8.027 0.82875C8.182 0.983917 8.2595 1.16208 8.2595 1.36325C8.2595 1.56458 8.182 1.74283 8.027 1.898L2.873 7.05175Z" fill="#A9957B" />
						</svg>

					</div>
				</div>
				<div id="scrollRight" class="w-7 h-7 p-2 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex flex-col justify-start items-start gap-2.5 overflow-hidden">
					<div class="w-3.5 h-3.5"><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12.127 7.94825H0.75C0.537167 7.94825 0.359 7.87642 0.2155 7.73275C0.0718332 7.58925 0 7.41108 0 7.19825C0 6.98542 0.0718332 6.80725 0.2155 6.66375C0.359 6.52008 0.537167 6.44825 0.75 6.44825H12.127L6.95775 1.279C6.80908 1.13033 6.73567 0.956332 6.7375 0.756999C6.7395 0.557665 6.818 0.380416 6.973 0.22525C7.12817 0.0804164 7.30383 0.00541641 7.5 0.00024974C7.69617 -0.00491693 7.87183 0.0700831 8.027 0.22525L14.3672 6.5655C14.4609 6.65917 14.5269 6.75792 14.5652 6.86175C14.6037 6.96558 14.623 7.07775 14.623 7.19825C14.623 7.31875 14.6037 7.43092 14.5652 7.53475C14.5269 7.63858 14.4609 7.73733 14.3672 7.831L8.027 14.1712C7.8885 14.3097 7.717 14.3806 7.5125 14.3837C7.308 14.3869 7.12817 14.3161 6.973 14.1712C6.818 14.0161 6.7405 13.8379 6.7405 13.6367C6.7405 13.4354 6.818 13.2572 6.973 13.102L12.127 7.94825Z" fill="#A9957B" />
						</svg>
					</div>
				</div>
			</div>
		</div>

		<div id="productScrollWrapper" class="flex flex-nowrap overflow-x-auto scroll-smooth w-full">
			<div id="productScroll" class="flex flex-nowrap snap-x snap-mandatory gap-5 pb-5">
				<?php echo do_shortcode('[best_selling_products limit="6"]'); ?>
			</div>
		</div>

		<div class="h-12 px-7 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5 mt-8">
			<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight">
				Przejdź do sklepu
			</div>
			<div class="w-6 h-6 relative overflow-hidden">
				<div class="w-3.5 h-3.5"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.627 12.75H5.25C5.03717 12.75 4.859 12.6782 4.7155 12.5345C4.57183 12.391 4.5 12.2128 4.5 12C4.5 11.7872 4.57183 11.609 4.7155 11.4655C4.859 11.3218 5.03717 11.25 5.25 11.25H16.627L11.4577 6.08076C11.3091 5.93209 11.2357 5.75809 11.2375 5.55876C11.2395 5.35942 11.318 5.18217 11.473 5.02701C11.6282 4.88217 11.8038 4.80717 12 4.80201C12.1962 4.79684 12.3718 4.87184 12.527 5.02701L18.8672 11.3673C18.9609 11.4609 19.0269 11.5597 19.0652 11.6635C19.1037 11.7673 19.123 11.8795 19.123 12C19.123 12.1205 19.1037 12.2327 19.0652 12.3365C19.0269 12.4403 18.9609 12.5391 18.8672 12.6328L12.527 18.973C12.3885 19.1115 12.217 19.1823 12.0125 19.1855C11.808 19.1887 11.6282 19.1178 11.473 18.973C11.318 18.8178 11.2405 18.6397 11.2405 18.4385C11.2405 18.2372 11.318 18.0589 11.473 17.9038L16.627 12.75Z" fill="#A9957B" />
					</svg>
				</div>
			</div>
		</div>
	</div>

	<!-- END Nasze bestsellery -->

	<div class="self-stretch flex flex-col justify-start items-center md:p-10">
		<img class="md:order-2 self-stretch h-60 relative" src="/app/themes/capuccinocafe_v2/resources/img/jakosc_skladnokow.jpg" />
		<div class="self-stretch px-10 pt-10 pb-14 bg-white inline-flex justify-start items-start gap-24 flex-wrap content-start overflow-hidden">
			<div class=" flex-1 max-w-96 min-w-72 justify-start text-stone-700 text-4xl font-normal font-['Didot_LT_Pro']">Jakość składników</div>
			<div class="flex-1 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">W Capuccino Cafe doskonale wiemy, że nic nie zastąpi naturalnych i oryginalnych produktów. Korzystamy z wysokiej jakości składników, które kupujemy od lokalnych producentów z naszego regionu. Dzięki temu zapewniamy świeżość i najlepszą jakość wypieków, równocześnie kultywując pomorską tradycję kulinarną. W 2018 r. otrzymaliśmy Certyfikat Dziedzictwa Kulinarnego przyznawany przez Europejską Sieć Regionalnego Dziedzictwa Kulinarnego.</div>
		</div>
	</div>
	<div class="self-stretch pb-14 bg-[#42352F] inline-flex justify-start items-start gap-8 flex-wrap content-start overflow-hidden">
		<img class="flex-1 h-72 md:h-35" src="/app/themes/capuccinocafe_v2/resources/img/sopotski_mlyn.jpg" />
		<img class="px-9 w-44 h-11" src="/app/themes/capuccinocafe_v2/resources/img/sopotski_mlyn_logo.png" />
		<div class="flex-1 min-w-80 px-10 inline-flex flex-col justify-start items-start gap-7">
			<div class="self-stretch justify-start text-white text-4xl font-normal font-['Didot_LT_Pro']">Restauracja Sopocki Młyn </div>
			<div class="self-stretch justify-center text-stone-400 text-base font-light font-['Mulish'] leading-snug">Smak tradycji w sercu Sopotu!</div>
			<div data-property-1="Default" class="h-12 px-7 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5">
				<div class="justify-center text-white text-sm font-bold font-['Mulish'] uppercase leading-tight">Poznaj menu</div>
				<div class="w-6 h-6 relative overflow-hidden">
					<div class="w-3.5 h-4 top-[2px] relative origin-top-left"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15.7514 9.1233L7.70662 17.1681C7.55613 17.3186 7.37935 17.3937 7.17629 17.3936C6.97323 17.3937 6.79646 17.3186 6.64596 17.1681C6.49547 17.0176 6.42028 16.8408 6.42039 16.6377C6.42028 16.4347 6.49547 16.2579 6.64596 16.1074L14.6907 8.06264H7.38029C7.17004 8.06264 6.99509 7.99152 6.85544 7.84927C6.7159 7.70691 6.64608 7.52607 6.64596 7.30675C6.65327 7.09461 6.72445 6.91737 6.85951 6.775C6.99456 6.63264 7.17181 6.56146 7.39125 6.56145L16.3577 6.56145C16.4902 6.56145 16.6067 6.58461 16.7072 6.63093C16.8079 6.67713 16.9008 6.74283 16.986 6.82803C17.0712 6.91324 17.1369 7.00617 17.1831 7.10681C17.2294 7.20734 17.2526 7.32383 17.2526 7.4563L17.2526 16.4228C17.2526 16.6186 17.1814 16.79 17.039 16.9368C16.8967 17.0837 16.7194 17.1607 16.5073 17.1681C16.288 17.1679 16.1072 17.0968 15.9649 16.9545C15.8226 16.8121 15.7513 16.6313 15.7512 16.412L15.7514 9.1233Z" fill="#A9957B" />
						</svg>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="self-stretch px-5 py-14 bg-stone-200 flex flex-col justify-start items-center gap-7">
		<div class="self-stretch inline-flex justify-start items-center gap-11">
			<div class="flex-1 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">Najnowsze aktualności</div>
		</div>
		<?php echo do_shortcode('[recent_posts]'); ?>
		<div data-property-1="Default" class="h-12 px-7 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5">
			<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight">zobacz wszystkie</div>
			<div class="w-6 h-6 relative overflow-hidden">
				<div class="w-3.5 h-3.5  top-[1px] relative "><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.627 12.75H5.25C5.03717 12.75 4.859 12.6782 4.7155 12.5345C4.57183 12.391 4.5 12.2128 4.5 12C4.5 11.7872 4.57183 11.609 4.7155 11.4655C4.859 11.3218 5.03717 11.25 5.25 11.25H16.627L11.4577 6.08076C11.3091 5.93209 11.2357 5.75809 11.2375 5.55876C11.2395 5.35942 11.318 5.18217 11.473 5.02701C11.6282 4.88217 11.8038 4.80717 12 4.80201C12.1962 4.79684 12.3718 4.87184 12.527 5.02701L18.8672 11.3673C18.9609 11.4609 19.0269 11.5597 19.0652 11.6635C19.1037 11.7673 19.123 11.8795 19.123 12C19.123 12.1205 19.1037 12.2327 19.0652 12.3365C19.0269 12.4403 18.9609 12.5391 18.8672 12.6328L12.527 18.973C12.3885 19.1115 12.217 19.1823 12.0125 19.1855C11.808 19.1887 11.6282 19.1178 11.473 18.973C11.318 18.8178 11.2405 18.6397 11.2405 18.4385C11.2405 18.2372 11.318 18.0589 11.473 17.9038L16.627 12.75Z" fill="#A9957B" />
					</svg>
				</div>
			</div>
		</div>
	</div>
	<div class="self-stretch py-14 flex flex-col justify-start items-center">
		<div class="self-stretch px-10 flex flex-col justify-center items-start gap-2.5">
			<div class="self-stretch justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">Po więcej zapraszamy na nasz Instagram</div>
			<div class="w-60 justify-start text-zinc-800 text-base font-light font-['Mulish'] leading-snug">@capuccinocafe_sopot</div>
		</div>
		<div class="self-stretch py-10 inline-flex justify-center items-start gap-5">
			<div class="w-44 h-64 rounded outline outline-1 outline-offset-[-1px] outline-stone-200 inline-flex flex-col justify-start items-start overflow-hidden">
				<div class="self-stretch px-4 py-2.5 inline-flex justify-start items-center gap-2.5">
					<img class="w-6 h-6 rounded-[100px]" src="https://placehold.co/24x24" />
					<div class="justify-start text-zinc-800 text-[10px] font-normal font-['Mulish']">capuccinocafe_sopot</div>
				</div>
				<img class="w-48 h-60" src="https://placehold.co/189x237" />
			</div>
			<div class="w-44 h-64 rounded outline outline-1 outline-offset-[-1px] outline-stone-200 inline-flex flex-col justify-start items-start overflow-hidden">
				<div class="self-stretch px-4 py-2.5 inline-flex justify-start items-center gap-2.5">
					<img class="w-6 h-6 rounded-[100px]" src="https://placehold.co/24x24" />
					<div class="justify-start text-zinc-800 text-[10px] font-normal font-['Mulish']">capuccinocafe_sopot</div>
				</div>
				<img class="self-stretch flex-1" src="https://placehold.co/180x216" />
				<div class="w-6 h-6 bg-zinc-300"></div>
				<div class="w-5 h-4 bg-white"></div>
			</div>
			<div class="w-44 h-64 rounded outline outline-1 outline-offset-[-1px] outline-stone-200 inline-flex flex-col justify-start items-start overflow-hidden">
				<div class="self-stretch px-4 py-2.5 inline-flex justify-start items-center gap-2.5">
					<img class="w-6 h-6 rounded-[100px]" src="https://placehold.co/24x24" />
					<div class="justify-start text-zinc-800 text-[10px] font-normal font-['Mulish']">capuccinocafe_sopot</div>
				</div>
				<img class="self-stretch flex-1" src="https://placehold.co/180x216" />
			</div>
		</div>
		<div data-property-1="Default" class="h-12 px-7 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5">
			<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight">Dołącz do nas</div>
			<div class="w-6 h-6 relative overflow-hidden">
				<div class="w-3.5 h-4 left-[1.56px] top-[10.94px] absolute origin-top-left -rotate-45 bg-stone-400"></div>
			</div>
		</div>
	</div>
</div>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="<?php storefront_homepage_content_styles(); ?>" data-featured-image="<?php echo esc_url($featured_image); ?>">


	<div class="col-full">

		<?php
		/**
		 * Functions hooked in to storefront_page add_action
		 *
		 * @hooked storefront_homepage_header      - 10
		 * @hooked storefront_page_content         - 20
		 */
		do_action('storefront_homepage');
		?>
	</div>
</div><!-- #post-## -->
