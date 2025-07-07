<?php

get_header(); ?>

<style>
	.storefront-breadcrumb {
		display: none !important;
	}
</style>

<main>
	<!-- hero section -->
	<div class="hero-stoly bg-cover relative max-md:bg-center z-3">
		<div class="sticky top-0 z-4">
			<?php get_template_part('headers/header', 'homepage'); ?>
		</div>
		<div class="shadow w-full h-full absolute left-0 top-0 max-md:hidden"></div>
		<div class="relative h-screen max-md:h-[70vh]   flex items-center justify-center">
			<div class="!text-white">
				<div class="!text-white !text-[80px] max-md:!text-[40px] !font-['Didot_LT_Pro']">Słodkie stoły</div>
				<div class="text-center">– smak, elegancja i niezapomniane wrażenia</div>
			</div>
		</div>
	</div>

	<div class="self-stretch p-8 md:px-32 md:py-40 bg-white blur-[0px] inline-flex justify-center items-start gap-24">
		<div class="flex-1 text-center justify-start text-zinc-800 text-2xl font-light font-['Mulish'] leading-9">Słodkie stoły zachwycają bogactwem smaków i przepiękną aranżacją. Przygotowujemy je zgodnie z pomysłem Pary Młodej i wizją wydarzenia. Dokładamy starań, by były idealnie skomponowane z salą weselną i jej wystrojem.</div>
	</div>

	<div data-layer="dlaczego my" class="DlaczegoMy self-stretch py-28 bg-[#F9F8F6] inline-flex flex-col justify-start items-center gap-24">
		<div data-layer="title" class="Title self-stretch inline-flex justify-center items-start gap-2.5">
			<div data-layer="Dlaczego warto nam powierzyć tort weselny?" class="DlaczegoWartoNamPowierzyTortWeselny  px-10 pb-5 flex-1 md:text-center justify-start text-[#42352F] text-3xl md:text-5xl font-normal font-['Didot_LT_Pro']">Dlaczego warto nam powierzyć słodki stół?</div>
		</div>
		<div data-layer="div" class="Div w-full grid md:grid-cols-2">
			<div class="flex justify-center items-center">
				<img data-layer="image" class="Image  py-4 w-full object-cover !h-full" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/slodkie-stoly/2.jpg" />
			</div>
			<div data-layer="div" class="Div px-0 md:px-10 lg:px-28 inline-flex flex-col justify-center items-center">
				<div data-layer="txt" class="Txt self-stretch md:h-80 p-8 backdrop-blur-lg flex flex-col justify-center items-start gap-3 md:gap-8">
					<div data-layer="Proponujemy degustację" class="ProponujemyDegustacj self-stretch justify-start text-[#A9957B] text-3xl font-normal font-['Didot_LT_Pro']">Kompleksowa realizacja</div>
					<div data-layer="pomożemy Wam wybrać perfekcyjny smak Waszego tortu." class="PomoEmyWamWybraPerfekcyjnySmakWaszegoTortu self-stretch justify-start text-zinc-800 text-lg font-light font-['Mulish'] leading-relaxed">Od doradztwa w doborze słodkości, przez przygotowanie świeżych wypieków, po efektowną aranżację – zajmujemy się każdym detalem. Dzięki nam oszczędzasz czas i masz pewność spójnego stylu.</div>
				</div>
				<div data-layer="txt" class="Txt self-stretch md:h-80 p-8 backdrop-blur-lg flex flex-col justify-center items-start gap-3 md:gap-8">
					<div data-layer="Mistrzowska precyzja" class="MistrzowskaPrecyzja self-stretch justify-start text-[#A9957B] text-3xl font-normal font-['Didot_LT_Pro']">Nieograniczone możliwości dekoracji</div>
					<div data-layer="nasz zespół to doświadczeni cukiernicy oraz artystka specjalizująca się w ręcznych dekoracjach i figurkach." class="NaszZespToDoWiadczeniCukiernicyOrazArtystkaSpecjalizujCaSiWRCznychDekoracjachIFigurkach self-stretch justify-start text-zinc-800 text-lg font-light font-['Mulish'] leading-relaxed">Wypożyczamy unikatowe dodatki (beczki, drabinki) i tworzymy spersonalizowane kompozycje kwiatowe. Twój słodki stół będzie wyglądał jak z magazynu wnętrzarskiego!</div>
				</div>
				<div data-layer="txt" class="Txt self-stretch md:h-80 p-8 backdrop-blur-lg flex flex-col justify-center items-start gap-3 md:gap-8">
					<div data-layer="Pełne wsparcie" class="PeNeWsparcie self-stretch justify-start text-[#A9957B] text-3xl font-normal font-['Didot_LT_Pro']">Mistrzowska precyzja</div>
					<div data-layer="doradzimy w wyborze designu, rozmiaru i smaku, a także dostarczymy tort na salę, abyście mogli cieszyć się tym dniem bez stresu." class="DoradzimyWWyborzeDesignuRozmiaruISmakuATakEDostarczymyTortNaSalAbyCieMogliCieszySiTymDniemBezStresu self-stretch justify-start text-zinc-800 text-lg font-light font-['Mulish'] leading-relaxed">Nasi cukiernicy i floryści dbają o harmonię smaku i designu. Każdy element – od koloru posypki do układu kwiatów – jest przemyślany, by zachwycać gości.</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Galeria section -->
	<div class="min-h-[60vh] py-12 bg-[#F2EDE7]">
		<div class=" pl-[5%] ">
			<div data-layer="title" class="Title flex justify-between items-center w-full pr-[5%] py-[5vh]">
				<div class=" text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">
					Galeria stylów
				</div>
				<div data-layer="strzalki" class="Strzalki flex items-center gap-2.5">
					<div id="scrollLeft" data-layer="Header" data-property-1="default" class="Header size-7 p-2 -rotate-180 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 flex items-center justify-center">
						<div data-layer="Vector" class="Vector size-3.5 rotate-180"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
								<path d="M2.873 7.05175L14.25 7.05175C14.4628 7.05175 14.641 7.12358 14.7845 7.26725C14.9282 7.41075 15 7.58892 15 7.80175C15 8.01458 14.9282 8.19275 14.7845 8.33625C14.641 8.47992 14.4628 8.55175 14.25 8.55175L2.873 8.55175L8.04225 13.721C8.19092 13.8697 8.26433 14.0437 8.2625 14.243C8.2605 14.4423 8.182 14.6196 8.027 14.7747C7.87183 14.9196 7.69617 14.9946 7.5 14.9997C7.30383 15.0049 7.12817 14.9299 6.973 14.7747L0.632751 8.4345C0.539085 8.34083 0.473085 8.24208 0.434752 8.13825C0.396252 8.03442 0.377002 7.92225 0.377002 7.80175C0.377002 7.68125 0.396252 7.56908 0.434752 7.46525C0.473085 7.36142 0.539085 7.26267 0.632751 7.169L6.973 0.82875C7.1115 0.69025 7.283 0.619417 7.4875 0.616249C7.692 0.613083 7.87183 0.683916 8.027 0.82875C8.182 0.983917 8.2595 1.16208 8.2595 1.36325C8.2595 1.56458 8.182 1.74283 8.027 1.898L2.873 7.05175Z" fill="#A9957B" />
							</svg>
						</div>
					</div>
					<div id="scrollRight" data-layer="Header" data-property-1="default" class="Header size-7 p-2 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-400 flex items-center justify-center">
						<div data-layer="Vector" class="Vector size-3.5 "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
								<path d="M12.127 7.94825H0.75C0.537167 7.94825 0.359 7.87642 0.2155 7.73275C0.0718332 7.58925 0 7.41108 0 7.19825C0 6.98542 0.0718332 6.80725 0.2155 6.66375C0.359 6.52008 0.537167 6.44825 0.75 6.44825H12.127L6.95775 1.279C6.80908 1.13033 6.73567 0.956332 6.7375 0.756999C6.7395 0.557665 6.818 0.380416 6.973 0.22525C7.12817 0.0804164 7.30383 0.00541641 7.5 0.00024974C7.69617 -0.00491693 7.87183 0.0700831 8.027 0.22525L14.3672 6.5655C14.4609 6.65917 14.5269 6.75792 14.5652 6.86175C14.6037 6.96558 14.623 7.07775 14.623 7.19825C14.623 7.31875 14.6037 7.43092 14.5652 7.53475C14.5269 7.63858 14.4609 7.73733 14.3672 7.831L8.027 14.1712C7.8885 14.3097 7.717 14.3806 7.5125 14.3837C7.308 14.3869 7.12817 14.3161 6.973 14.1712C6.818 14.0161 6.7405 13.8379 6.7405 13.6367C6.7405 13.4354 6.818 13.2572 6.973 13.102L12.127 7.94825Z" fill="#A9957B" />
							</svg></div>
					</div>
				</div>
			</div>
			<div id="productScrollWrapper" class="flex flex-nowrap overflow-x-auto scroll-smooth w-full ">
				<div id="productScroll" class="flex flex-nowrap snap-x snap-mandatory gap-5 pb-5">
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/naturalna_galery/image.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/naturalna_galery/image-1.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/naturalna_galery/image-2.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/naturalna_galery/image-3.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/naturalna_galery/image-4.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/naturalna_galery/image-5.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/lesna_galery/image.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/lesna_galery/image-1.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/lesna_galery/image-2.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/lesna_galery/image-3.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/lesna_galery/image-4.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/rozana_galery/image.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/rozana_galery/image-1.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/rozana_galery/image-2.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/rozana_galery/image-3.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/rozana_galery/karta.png" />
					<img class="!h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/rozana_galery/karta-1.png" />
				</div>
			</div>
		</div>
	</div>


	<div class="w-full px-10 py-28 bg-stone-50 inline-flex flex-col justify-start items-center gap-14">
		<div class="self-stretch inline-flex justify-center items-center gap-2.5">
			<div class="flex-1 h-14 text-center justify-start text-stone-700 text-3xl md:text-5xl font-normal font-['Didot_LT_Pro']">Co może znaleźć się na słodkim stole?</div>
		</div>
		<div class="w-full inline-flex justify-start items-start gap-6 flex-wrap content-start">
			<div class="flex-1 max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image.png" />
				</div>
				<div class="w-full max-w-[800px] min-w-80 p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Mini torcik Rozetka
					</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Brownie z owocami,  – Z chrupiącą prażynką,  – Z białą czekoladą,  – Palona biała czekolada,  – Z czerwoną porzeczką,  – Malina z białą czekoladą,  – Mus cytrynowy,  – Z Aperolem.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">22 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-1.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Mini torcik Kubik</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Wiśnia z mleczną,  – I deserową czekoladą,  – Ferrero Rocher,  – Z ganachem czekoladowym,  – Z orzechem laskowym,  – Mango z marakują,  – Z kokosem.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">24 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-2.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Mini torcik Babel
					</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Pistacja z crunchem,  – Rokitnik z białą czekoladą,  – Czarna porzeczka,  – Mus pistacjowy z praliną,  – Czekoladową i liofilizowaną maliną.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">24 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-3.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Gniazdko bezowe</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Z kremem kawowym,  – Z pistacjami.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">22 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-4.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Mini torcik elipsa</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Brownie z owocami,  – Z chrupiącą prażynką,  – Z białą czekoladą,  – Palona biała czekolada,  – Z czerwoną porzeczką,  – Malina z białą czekoladą.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">22 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-5.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Mini torcik lód na patyku</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Truskawka z musem,  – Na bazie czekolady,  – Rokitnik lub malina z białą czekoladą,  – Palona biała czekolada,  – Z owocami czerwonej porzeczki.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">20 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-6.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Mini serniczek</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Oreo,  – Słony karmel,  – Malina,  – Mango.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">22 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-7.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Mini tarta</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Owocowa z kremem waniliowym,  – Pistacja z crunchem,  – Cytrusowa z włoską bezą,  – Karmelowa z orzechami.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">22 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-8.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Makaroniki</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Snickers,  – Oreo,  – Pistacja,  – Malina,  – Mięta.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">9 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-9.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Deserki</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Panna cotta z wanilią i owocami,  – Tiramisu z Amaretto,  – Wegański z owocami,  – Czekoladowy z owocami.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">10 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-10.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Cupcake</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Czekolada,  – Marchewka,  – Wanilia.  Do wyboru krem: wanilia, kakao, pistacja.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">20 zł/szt</div>
				</div>
			</div>
			<div class="flex-1 h-[666px] max-w-[500px] min-w-80 max-h-[1260px] bg-white inline-flex flex-col justify-center items-center">
				<div class="w-full h-80 max-w-[800px] max-h-[670.65px] inline-flex justify-start items-center gap-2.5">
					<img class="flex-1 self-stretch" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/mini_deser/image-11.png" />
				</div>
				<div class="w-full flex-1 max-w-[800px] p-8 backdrop-blur-lg flex flex-col justify-start items-start gap-6">
					<div class="w-full max-w-80 justify-start text-stone-400 text-3xl font-normal font-['Didot_LT_Pro']">Mini torcik cylinder</div>
					<div class="w-full max-w-80 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">– Palona biała czekolada z czerwoną porzeczką,  – Malina z białą czekoladą,  – Czekoladowo-pralinowy z orzechami,  – Truskawka z musem na bazie czekolady.</div>
					<div class="w-full max-w-80 justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">24 zł/szt</div>
				</div>
			</div>
		</div>
	</div>




	<!-- Pozostałe (section) -->
	<div class="self-stretch px-[5%] py-20 bg-st justify-start items-center gap-8 w-full">
		<h2 class="text-center  text-stone-700 !text-4xl py-16 max-md:p-4 font-['Didot_LT_Pro']">Nasze propozycje na najbliższy sezon!</h2>

		<div class="w-full flex justify-center items-center max-md:flex-col">
			<div class="flex-1  w-1/2 max-md:w-full  flex justify-start items-center gap-2.5">
				<img class="w-full max-h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu6.jpg" />
			</div>

			<div class="flex-1  self-stretch w-1/2 max-md:w-full p-4 flex justify-center items-center max-md:justify-start gap-6  max-md:mb-4">
				<div class="p-4">
					<h4 class="w-full  justify-start !text-stone-400 !text-4xl font-['Didot_LT_Pro']">Naturalna Elegancja</h4>
					<div class="w-full max-w-96 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Ta aranżacja emanuje subtelną elegancją i naturalnym pięknem. Stół pokryty lnianym obrusem prezentuje słodkości na marmurowych paterach, otoczonych designerską florystyką, ceramicznymi wazonami oraz naczyniami z bielonego drewna. Idealną na romantyczne przyjęcia.</div>
					<a href="<?php echo esc_url(page_url_by_slug('naturalna-elegancja')); ?>" class="h-12 px-7 mt-4 !rounded !outline !outline-1 !outline-offset-[-1px] !outline-stone-400 inline-flex justify-center items-center gap-2.5 hover:!bg-[#A9957B] group">
						<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight  group-hover:!text-white">Więcej</div>
						<div class="w-6 h-6 relative overflow-hidden">
							<div class="w-3.5 h-3.5 top-[2px] relative"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path class="group-hover:fill-white" d="M16.627 12.75H5.25C5.03717 12.75 4.859 12.6782 4.7155 12.5345C4.57183 12.391 4.5 12.2128 4.5 12C4.5 11.7872 4.57183 11.609 4.7155 11.4655C4.859 11.3218 5.03717 11.25 5.25 11.25H16.627L11.4577 6.08076C11.3091 5.93209 11.2357 5.75809 11.2375 5.55876C11.2395 5.35942 11.318 5.18217 11.473 5.02701C11.6282 4.88217 11.8038 4.80717 12 4.80201C12.1962 4.79684 12.3718 4.87184 12.527 5.02701L18.8672 11.3673C18.9609 11.4609 19.0269 11.5597 19.0652 11.6635C19.1037 11.7673 19.123 11.8795 19.123 12C19.123 12.1205 19.1037 12.2327 19.0652 12.3365C19.0269 12.4403 18.9609 12.5391 18.8672 12.6328L12.527 18.973C12.3885 19.1115 12.217 19.1823 12.0125 19.1855C11.808 19.1887 11.6282 19.1178 11.473 18.973C11.318 18.8178 11.2405 18.6397 11.2405 18.4385C11.2405 18.2372 11.318 18.0589 11.473 17.9038L16.627 12.75Z" fill="#A9957B" />
								</svg>

							</div>
						</div>
					</a>
				</div>
			</div>
		</div>



		<div class="w-full flex justify-center items-center max-md:flex-col-reverse">

			<div class="flex-1  self-stretch w-1/2 max-md:w-full p-4 flex justify-center max-md:justify-start items-center gap-6 ">
				<div class="p-4">
					<h4 class="w-full  justify-start !text-stone-400 !text-4xl font-['Didot_LT_Pro']">Leśna Harmonia</h4>
					<div class="w-full max-w-96 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Inspirowana barwami ziemi kompozycja, w której słodkości ułożone są wśród delikatnych liści na transparentnych paterach. Stół pokryty szałwiowym obrusem, ozdobiony świecami na kamiennych postumentach, nadaje aranżacji wykwintności i oryginalności. Idealna propozycja dla miłośników natury i rustykalnych klimatów.</div>
					<a href="<?php echo esc_url(page_url_by_slug('lesna-harmonia')); ?>" class="h-12 px-7 mt-4 !rounded !outline !outline-1 !outline-offset-[-1px] !outline-stone-400 inline-flex justify-center items-center gap-2.5 hover:!bg-[#A9957B] group">
						<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight  group-hover:!text-white">Więcej</div>
						<div class="w-6 h-6 relative overflow-hidden">
							<div class="w-3.5 h-3.5 top-[2px] relative"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path class="group-hover:fill-white" d="M16.627 12.75H5.25C5.03717 12.75 4.859 12.6782 4.7155 12.5345C4.57183 12.391 4.5 12.2128 4.5 12C4.5 11.7872 4.57183 11.609 4.7155 11.4655C4.859 11.3218 5.03717 11.25 5.25 11.25H16.627L11.4577 6.08076C11.3091 5.93209 11.2357 5.75809 11.2375 5.55876C11.2395 5.35942 11.318 5.18217 11.473 5.02701C11.6282 4.88217 11.8038 4.80717 12 4.80201C12.1962 4.79684 12.3718 4.87184 12.527 5.02701L18.8672 11.3673C18.9609 11.4609 19.0269 11.5597 19.0652 11.6635C19.1037 11.7673 19.123 11.8795 19.123 12C19.123 12.1205 19.1037 12.2327 19.0652 12.3365C19.0269 12.4403 18.9609 12.5391 18.8672 12.6328L12.527 18.973C12.3885 19.1115 12.217 19.1823 12.0125 19.1855C11.808 19.1887 11.6282 19.1178 11.473 18.973C11.318 18.8178 11.2405 18.6397 11.2405 18.4385C11.2405 18.2372 11.318 18.0589 11.473 17.9038L16.627 12.75Z" fill="#A9957B" />
								</svg>

							</div>
						</div>
					</a>
				</div>
			</div>

			<div class="flex-1  w-1/2 max-md:w-full flex justify-start items-center gap-2.5">
				<img class="w-full max-h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu7.jpg" />
			</div>
		</div>
		<div class="w-full flex justify-center items-center max-md:flex-col-reverse">
			<div class="flex-1  w-1/2 max-md:w-full flex justify-start items-center gap-2.5">
				<img class="w-full max-h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/rozana_stol.jpg" />
			</div>
			<div class="flex-1  self-stretch w-1/2 max-md:w-full p-4 flex justify-center items-center max-md:justify-start gap-6  max-md:mb-4">
				<div class="p-4">
					<div class="w-full  justify-start !text-stone-400 !text-4xl font-['Didot_LT_Pro']">Różana Romantyka</div>
					<div class="w-full max-w-96 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Delikatna, romantyczna stylizacja, w której białe patery wypełnione po brzegi słodkościami w ciepłych odcieniach różu skradną niejedno serce i podniebienie. Pastelowe świece i świeże kwiaty nadają aranżacji kunsztu i stylu, tworząc niezapomnianą oprawę dla wyjątkowych chwil.</div>
					<a href="<?php echo esc_url(page_url_by_slug('rozana-romantyka')); ?>" class="h-12 px-7 mt-4 !rounded !outline !outline-1 !outline-offset-[-1px] !outline-stone-400 inline-flex justify-center items-center gap-2.5 hover:!bg-[#A9957B] group">
						<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight  group-hover:!text-white">Więcej</div>
						<div class="w-6 h-6 relative overflow-hidden">
							<div class="w-3.5 h-3.5 top-[2px] relative"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path class="group-hover:fill-white" d="M16.627 12.75H5.25C5.03717 12.75 4.859 12.6782 4.7155 12.5345C4.57183 12.391 4.5 12.2128 4.5 12C4.5 11.7872 4.57183 11.609 4.7155 11.4655C4.859 11.3218 5.03717 11.25 5.25 11.25H16.627L11.4577 6.08076C11.3091 5.93209 11.2357 5.75809 11.2375 5.55876C11.2395 5.35942 11.318 5.18217 11.473 5.02701C11.6282 4.88217 11.8038 4.80717 12 4.80201C12.1962 4.79684 12.3718 4.87184 12.527 5.02701L18.8672 11.3673C18.9609 11.4609 19.0269 11.5597 19.0652 11.6635C19.1037 11.7673 19.123 11.8795 19.123 12C19.123 12.1205 19.1037 12.2327 19.0652 12.3365C19.0269 12.4403 18.9609 12.5391 18.8672 12.6328L12.527 18.973C12.3885 19.1115 12.217 19.1823 12.0125 19.1855C11.808 19.1887 11.6282 19.1178 11.473 18.973C11.318 18.8178 11.2405 18.6397 11.2405 18.4385C11.2405 18.2372 11.318 18.0589 11.473 17.9038L16.627 12.75Z" fill="#A9957B" />
								</svg>

							</div>
						</div>
					</a>
				</div>
			</div>


		</div>

	</div>


	<!--- contact section -->

	<div class="self-stretch px-10 py-28 bg-stone-200 flex flex-col justify-start items-center w-full">
		<div class="w-full max-w-[940px] flex flex-col justify-start items-start gap-4">
			<div class="self-stretch text-center justify-start text-stone-700 text-5xl font-normal font-['Didot_LT_Pro'] ">Chcesz słodki stół, o którym będą mówić jeszcze długo po imprezie?</div>
			<div class="self-stretch text-center   text-stone-700 text-lg font-light font-['Mulish'] leading-relaxed mb-4">Umów się na konsultację – stworzymy razem coś wyjątkowego!</div>
		</div>
		<div class="self-stretch pb-10 inline-flex justify-center items-center gap-3">
			<div class="w-7 h-7 relative overflow-hidden">
				<div class="w-6 h-6 left-[2.31px] absolute"><svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
						<path d="M23.18 15.8251C22.9233 15.8251 22.655 15.7435 22.3983 15.6851C21.8786 15.5706 21.3678 15.4185 20.87 15.2301C20.3288 15.0332 19.7338 15.0434 19.1997 15.2588C18.6656 15.4742 18.2299 15.8795 17.9767 16.3968L17.72 16.9218C16.5837 16.2897 15.5395 15.5046 14.6167 14.5885C13.7006 13.6656 12.9155 12.6215 12.2833 11.4851L12.7733 11.1585C13.2906 10.9052 13.6959 10.4696 13.9113 9.93543C14.1267 9.40128 14.1369 8.80635 13.94 8.26512C13.7548 7.76628 13.6028 7.25572 13.485 6.73679C13.4267 6.48012 13.38 6.21179 13.345 5.94346C13.2033 5.12168 12.7729 4.37749 12.1312 3.8449C11.4896 3.31232 10.6788 3.02633 9.845 3.03846H6.345C5.84221 3.03374 5.3443 3.13741 4.88516 3.34241C4.42603 3.54741 4.01647 3.84893 3.68434 4.22645C3.35221 4.60397 3.10533 5.04862 2.96049 5.53012C2.81565 6.01163 2.77626 6.51869 2.845 7.01679C3.46653 11.9044 5.6987 16.4456 9.18893 19.9232C12.6792 23.4007 17.2285 25.6164 22.1183 26.2201H22.5617C23.422 26.2214 24.2526 25.9057 24.895 25.3335C25.2641 25.0033 25.5589 24.5987 25.76 24.1462C25.9612 23.6937 26.064 23.2036 26.0617 22.7085V19.2085C26.0474 18.3981 25.7523 17.6178 25.2267 17.0007C24.7012 16.3837 23.9778 15.9682 23.18 15.8251ZM23.7633 22.8251C23.7631 22.9908 23.7276 23.1545 23.6593 23.3053C23.5909 23.4562 23.4911 23.5908 23.3667 23.7001C23.2388 23.8166 23.0866 23.9032 22.9212 23.9537C22.7557 24.0041 22.5811 24.0171 22.41 23.9918C18.0407 23.4316 13.9823 21.4327 10.8748 18.3105C7.7674 15.1882 5.78782 11.1203 5.24834 6.74846C5.22977 6.57756 5.24604 6.40467 5.29617 6.24025C5.3463 6.07582 5.42925 5.92326 5.54 5.79179C5.64933 5.66734 5.78391 5.5676 5.93478 5.49921C6.08565 5.43081 6.24935 5.39533 6.415 5.39512H9.915C10.1863 5.38909 10.4512 5.47782 10.6642 5.64604C10.8771 5.81426 11.0247 6.05145 11.0817 6.31679C11.1283 6.63568 11.1867 6.95068 11.2567 7.26179C11.3914 7.87679 11.5708 8.48117 11.7933 9.07012L10.16 9.82846C10.0203 9.89253 9.89473 9.98356 9.79035 10.0963C9.68598 10.2091 9.6049 10.3413 9.55179 10.4855C9.49867 10.6297 9.47455 10.7829 9.48083 10.9365C9.4871 11.09 9.52363 11.2408 9.58834 11.3801C11.2674 14.9767 14.1585 17.8677 17.755 19.5468C18.039 19.6635 18.3576 19.6635 18.6417 19.5468C18.7872 19.4947 18.9209 19.4143 19.035 19.3102C19.1492 19.206 19.2415 19.0802 19.3067 18.9401L20.03 17.3068C20.6331 17.5225 21.2487 17.7017 21.8733 17.8435C22.1844 17.9135 22.4994 17.9718 22.8183 18.0185C23.0837 18.0754 23.3209 18.223 23.4891 18.436C23.6573 18.6489 23.746 18.9138 23.74 19.1851L23.7633 22.8251ZM22.6667 12.3251C22.9761 12.3251 23.2728 12.2022 23.4916 11.9834C23.7104 11.7646 23.8333 11.4679 23.8333 11.1585V6.49179C23.8333 6.18237 23.7104 5.88562 23.4916 5.66683C23.2728 5.44804 22.9761 5.32512 22.6667 5.32512C22.3573 5.32512 22.0605 5.44804 21.8417 5.66683C21.6229 5.88562 21.5 6.18237 21.5 6.49179V11.1585C21.5 11.4679 21.6229 11.7646 21.8417 11.9834C22.0605 12.2022 22.3573 12.3251 22.6667 12.3251ZM18 12.3251C18.3094 12.3251 18.6062 12.2022 18.825 11.9834C19.0438 11.7646 19.1667 11.4679 19.1667 11.1585V6.49179C19.1667 6.18237 19.0438 5.88562 18.825 5.66683C18.6062 5.44804 18.3094 5.32512 18 5.32512C17.6906 5.32512 17.3938 5.44804 17.175 5.66683C16.9563 5.88562 16.8333 6.18237 16.8333 6.49179V11.1585C16.8333 11.4679 16.9563 11.7646 17.175 11.9834C17.3938 12.2022 17.6906 12.3251 18 12.3251Z" fill="#A9957B" />
					</svg></div>
			</div>
			<div class=" text-center justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">780 127 222</div>
		</div>
		<div class="w-full max-w-[940px] px-10 py-20 bg-white flex flex-col justify-start items-center gap-6">
			<div class="w-full max-w-[560px] pb-4 inline-flex justify-start items-end gap-3">
				<div class="flex-1 text-center justify-center text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">Formularz kontaktowy
				</div>
			</div>
			<div class="w-full max-w-[560px] min-w-72 flex flex-col justify-start items-start gap-5">
				<div data-layer="Base" data-property-1="Default" data-property-2="Default" class="Base self-stretch flex flex-col justify-start items-start gap-[5px]">
					<?php echo do_shortcode('[contact-form-7 id="633cabd" title="KONTAKT"]'); ?>
				</div>
			</div>
		</div>
	</div>
	<!--- instagram section -->
	<?php
	require_once get_stylesheet_directory() . '/inc/instagram.php';
	?>
</main>
<?php get_footer(); ?>
