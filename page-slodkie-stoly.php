<?php

get_header(); ?>

<main>
<!-- hero section -->
<div class="hero-rozana relative h-screen max-md:h-[70vh] bg-cover max-md:bg-center flex items-center justify-center">
    	<div class="shadow w-full h-full absolute z-1  left-0 max-md:hidden"></div>
    <div class="!text-white z-50">
        <h1 class="!text-white !text-[80px] max-md:!text-[40px] !font-['Didot_LT_Pro']">Różana Romantyka</h1>
        <p class="text-center">Delikatna, romantyczna stylizacja. </p>

    </div>
</div>

<!-- Więcej o stylu section -->
<div class=" my-10">
	<div class="max-md:p-[7%] p-[5%] max-xl:py-16 flex max-md:flex-col max-2xl:flex-row max-lg:order-2 order-1">
		<h1 class="title max-md:w-full w-2/5">Więcej o stylu</h1>
		<div class=" max-md:w-full w-3/5">Pełna romantyzmu stylizacja słodkiego stołu dostarczy pięknych wrażeń na weselu. Białe patery wypełnione po brzegi słodkościami w ciepłych odcieniach różu skradną nie jedno serce wśród Waszych gości. Pastelowe świece i świeże kwiaty nadają całej aranżacji kunsztu i stylu, przy której nie da się przejść obojętnie</div>
	</div>
</div>


<!-- Galeria section -->
<div class="min-h-[60vh] py-12 bg-[#F2EDE7]">
	<div class=" pl-[5%] ">
		<div data-layer="title" class="Title flex justify-between items-center w-full pr-[5%] py-[5vh]">
			<div  class=" text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">
				Galeria stylu
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
						<img class="w-full max-md:h-auto max-h-[400px] object-cover lg:w-[90%]" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu1.png" />
                        <img class="w-full max-md:h-auto max-h-[400px] object-cover lg:w-[90%]" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu2.jpg" />
                        <img class="w-full max-md:h-auto max-h-[400px] object-cover lg:w-[90%]" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu3.png" />
                        <img class="w-full max-md:h-auto max-h-[400px] object-cover lg:w-[90%]" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu1.png" />
			</div>
		</div>
	</div>
</div>



        <div class="relative flex max-lg:h-auto h-[80vh] max-md:h-auto max-md:flex-col overflow-hidden">

                <div class=" self-stretch w-1/2 max-md:w-full backdrop-blur-lg inline-flex flex-col justify-center items-center gap-6 max-lg:p-[5%]">
                    <div class="w-full max-w-96 justify-start text-zinc-800 text-lg  max-lg:text-sm font-light font-['Mulish'] leading-relaxed">Słodkości przygotowane są w ilości około 200 gramów na osobę, co odpowiada 3 porcjom. <br/>W ramach usługi oferujemy kompleksową aranżację dekoracji oraz słodkości, wykonaną przez naszych doświadczonych artystów. Zapewniamy także demontaż i odbiór wypożyczonych elementów po zakończeniu imprezy.</div>
                    <div class="w-full max-w-96 flex flex-col justify-start items-start">
                        <div class="self-stretch justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">Cena: 70 zł/os.</div>
                        <div class="self-stretch justify-start text-zinc-500 text-xs font-normal font-['Mulish']">przy zamówieniu na 100 osób.</div>
                    </div>
                    <div class="w-full max-w-96 pt-3  max-md:pt-1 flex flex-col justify-start items-start gap-3">
                        <div class="self-stretch justify-start text-zinc-800 text-lg font-bold font-['Mulish'] leading-relaxed">Zamów</div>
                        <div class="self-stretch inline-flex justify-start items-center gap-3">
                            <div class="w-7 h-7 relative overflow-hidden">
                                <div class="w-6 h-6 left-[2.31px] top-[2.38px] absolute bg-stone-400"></div>
                            </div>
                            <div class="text-center justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">780 127 222</div>
                        </div>
                    </div>

                    
                </div>
                <div class="w-1/2 h-full max-md:w-full ">
                    <img class="w-full  object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu4.png" />
                </div>
        </div>


<!-- Pozostałe (section) -->
    <div class="self-stretch px-[5%] py-20 bg-st justify-start items-center gap-8 w-full">
    <h2 class="text-center  text-stone-700 !text-4xl py-16 max-md:p-4 font-['Didot_LT_Pro']">Pozostałe style</h2>

    <div class="w-full flex justify-center items-center max-md:flex-col">
        <div class="flex-1  w-1/2 max-md:w-full  flex justify-start items-center gap-2.5">
                                 <img class="w-full max-h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu6.jpg" />
        </div>

        <div class="flex-1  self-stretch w-1/2 max-md:w-full p-4 flex justify-center items-center max-md:justify-start gap-6  max-md:mb-4">
            <div class="p-4">
            <h4 class="w-full  justify-start !text-stone-400 !text-4xl font-['Didot_LT_Pro']">Naturalna Elegancja</h4>
            <div class="w-full max-w-96 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Ta aranżacja emanuje subtelną elegancją i naturalnym pięknem. Stół pokryty lnianym obrusem prezentuje słodkości na marmurowych paterach, otoczonych designerską florystyką, ceramicznymi wazonami oraz naczyniami z bielonego drewna. Idealną na romantyczne przyjęcia.</div>
				<div   class="h-12 px-7 mt-4 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5 hover:bg-[#A9957B] group">
					<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight  group-hover:!text-white">Więcej</div>
					<div class="w-6 h-6 relative overflow-hidden">
						<div class="w-3.5 h-3.5 top-[2px] relative"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path class="group-hover:fill-white" d="M16.627 12.75H5.25C5.03717 12.75 4.859 12.6782 4.7155 12.5345C4.57183 12.391 4.5 12.2128 4.5 12C4.5 11.7872 4.57183 11.609 4.7155 11.4655C4.859 11.3218 5.03717 11.25 5.25 11.25H16.627L11.4577 6.08076C11.3091 5.93209 11.2357 5.75809 11.2375 5.55876C11.2395 5.35942 11.318 5.18217 11.473 5.02701C11.6282 4.88217 11.8038 4.80717 12 4.80201C12.1962 4.79684 12.3718 4.87184 12.527 5.02701L18.8672 11.3673C18.9609 11.4609 19.0269 11.5597 19.0652 11.6635C19.1037 11.7673 19.123 11.8795 19.123 12C19.123 12.1205 19.1037 12.2327 19.0652 12.3365C19.0269 12.4403 18.9609 12.5391 18.8672 12.6328L12.527 18.973C12.3885 19.1115 12.217 19.1823 12.0125 19.1855C11.808 19.1887 11.6282 19.1178 11.473 18.973C11.318 18.8178 11.2405 18.6397 11.2405 18.4385C11.2405 18.2372 11.318 18.0589 11.473 17.9038L16.627 12.75Z" fill="#A9957B" />
							</svg>

						</div>
					</div>
				</div>
        </div>
        </div>
    </div>



     <div class="w-full flex justify-center items-center max-md:flex-col-reverse">

        <div class="flex-1  self-stretch w-1/2 max-md:w-full p-4 flex justify-center max-md:justify-start items-center gap-6 ">
            <div class="p-4">
            <h4 class="w-full  justify-start !text-stone-400 !text-4xl font-['Didot_LT_Pro']">Leśna Harmonia</h4>
            <div class="w-full max-w-96 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Inspirowana barwami ziemi kompozycja, w której słodkości ułożone są wśród delikatnych liści na transparentnych paterach. Stół pokryty szałwiowym obrusem, ozdobiony świecami na kamiennych postumentach, nadaje aranżacji wykwintności i oryginalności. Idealna propozycja dla miłośników natury i rustykalnych klimatów.</div>
				<div   class="h-12 px-7 mt-4 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5 hover:bg-[#A9957B] group">
					<div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight  group-hover:!text-white">Więcej</div>
					<div class="w-6 h-6 relative overflow-hidden">
						<div class="w-3.5 h-3.5 top-[2px] relative"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path class="group-hover:fill-white" d="M16.627 12.75H5.25C5.03717 12.75 4.859 12.6782 4.7155 12.5345C4.57183 12.391 4.5 12.2128 4.5 12C4.5 11.7872 4.57183 11.609 4.7155 11.4655C4.859 11.3218 5.03717 11.25 5.25 11.25H16.627L11.4577 6.08076C11.3091 5.93209 11.2357 5.75809 11.2375 5.55876C11.2395 5.35942 11.318 5.18217 11.473 5.02701C11.6282 4.88217 11.8038 4.80717 12 4.80201C12.1962 4.79684 12.3718 4.87184 12.527 5.02701L18.8672 11.3673C18.9609 11.4609 19.0269 11.5597 19.0652 11.6635C19.1037 11.7673 19.123 11.8795 19.123 12C19.123 12.1205 19.1037 12.2327 19.0652 12.3365C19.0269 12.4403 18.9609 12.5391 18.8672 12.6328L12.527 18.973C12.3885 19.1115 12.217 19.1823 12.0125 19.1855C11.808 19.1887 11.6282 19.1178 11.473 18.973C11.318 18.8178 11.2405 18.6397 11.2405 18.4385C11.2405 18.2372 11.318 18.0589 11.473 17.9038L16.627 12.75Z" fill="#A9957B" />
							</svg>

						</div>
					</div>
				</div>
        </div>
        </div>

                <div class="flex-1  w-1/2 max-md:w-full flex justify-start items-center gap-2.5">
                                 <img class="w-full max-h-[400px] object-cover" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/img/Galeria-stylu7.jpg" />
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
            <div class="w-6 h-6 left-[2.31px] top-[2.38px] absolute bg-stone-400"></div>
        </div>
        <div class=" text-center justify-start text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">780 127 222</div>
    </div>
    <div class="w-full max-w-[940px] px-10 py-20 bg-white flex flex-col justify-start items-center gap-6">
        <div class="w-full max-w-[560px] pb-4 inline-flex justify-start items-end gap-3">
            <div class="flex-1 text-center justify-center text-stone-700 text-3xl font-normal font-['Didot_LT_Pro']">Formularz kontaktowy
      </div>
        </div>
        <div class="w-full max-w-[560px] min-w-72 flex flex-col justify-start items-start gap-5">
            <div data-property-1="Default" data-property-2="Default" class="self-stretch flex flex-col justify-start items-start gap-[5px]">
                <div class="self-stretch inline-flex justify-start items-start gap-2.5 overflow-hidden">
                    <div class="justify-center"><span class="text-zinc-800 text-xs font-normal font-['Mulish']">Imię i nazwisko </span><span class="text-red-500 text-xs font-normal font-['Mulish']">*</span></div>
                </div>
                <div class="self-stretch p-2 bg-white rounded-[5px] outline outline-1 outline-offset-[-1px] outline-neutral-200 inline-flex justify-start items-center gap-2 overflow-hidden">
                    <div class="flex-1 h-6 flex justify-start items-center overflow-hidden">
                        <div class="flex-1 h-5 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">Jan Kowalski</div>
                    </div>
                </div>
            </div>
            <div data-property-1="Default" data-property-2="Default" class="self-stretch flex flex-col justify-start items-start gap-[5px]">
                <div class="self-stretch inline-flex justify-start items-start gap-2.5 overflow-hidden">
                    <div class="justify-center"><span class="text-zinc-800 text-xs font-normal font-['Mulish']">Twój adres e-mail </span><span class="text-red-500 text-xs font-normal font-['Mulish']">*</span></div>
                </div>
                <div class="self-stretch p-2 bg-white rounded-[5px] outline outline-1 outline-offset-[-1px] outline-neutral-200 inline-flex justify-start items-center gap-2 overflow-hidden">
                    <div class="flex-1 h-6 flex justify-start items-center overflow-hidden">
                        <div class="w-28 h-5 justify-start text-zinc-500 text-sm font-normal font-['Mulish'] leading-tight">Email</div>
                    </div>
                </div>
            </div>
            <div class="self-stretch inline-flex justify-start items-end gap-2.5">
                <div data-property-1="Default" data-property-2="Default" class="inline-flex flex-col justify-start items-start gap-[5px]">
                    <div class="self-stretch inline-flex justify-start items-start gap-2.5 overflow-hidden">
                        <div class="justify-center text-zinc-800 text-xs font-normal font-['Mulish']">Numer telefonu</div>
                    </div>
                    <div class="self-stretch p-2 bg-white rounded-[5px] outline outline-1 outline-offset-[-1px] outline-neutral-200 inline-flex justify-between items-center overflow-hidden">
                        <div class="h-6 flex justify-start items-center overflow-hidden">
                            <div class="justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">+48</div>
                        </div>
                        <div class="w-6 h-6 relative overflow-hidden">
                            <div class="w-2.5 h-1.5 left-[6.75px] top-[8.88px] absolute bg-stone-400"></div>
                        </div>
                    </div>
                </div>
                <div data-property-1="Default" data-property-2="Default" class="flex-1 inline-flex flex-col justify-start items-start gap-[5px]">
                    <div class="self-stretch p-2 bg-white rounded-[5px] outline outline-1 outline-offset-[-1px] outline-neutral-200 inline-flex justify-start items-center gap-2 overflow-hidden">
                        <div class="w-52 h-6 flex justify-start items-center overflow-hidden">
                            <div class="flex-1 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">123 456 789</div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-property-1="Default" data-property-2="Default" class="self-stretch flex flex-col justify-start items-start gap-[5px]">
                <div class="self-stretch inline-flex justify-start items-start gap-2.5 overflow-hidden">
                    <div class="justify-center text-zinc-800 text-xs font-normal font-['Mulish']">Planowana ilość osób</div>
                </div>
                <div class="self-stretch p-2 bg-white rounded-[5px] outline outline-1 outline-offset-[-1px] outline-neutral-200 inline-flex justify-start items-center gap-2 overflow-hidden">
                    <div class="flex-1 h-6 flex justify-start items-center overflow-hidden">
                        <div class="flex-1 h-5 justify-start text-zinc-800 text-sm font-normal font-['Mulish'] leading-tight">48</div>
                    </div>
                </div>
            </div>
            <div class="self-stretch h-40 flex flex-col justify-start items-start gap-[5px]">
                <div class="self-stretch h-4 relative overflow-hidden">
                    <div class="left-0 top-[1px] absolute justify-center"><span class="text-zinc-800 text-xs font-normal font-['Mulish']">Treść </span><span class="text-red-500 text-xs font-normal font-['Mulish']">*</span></div>
                </div>
                <div class="self-stretch flex-1 p-2 relative bg-white rounded-[5px] outline outline-1 outline-offset-[-1px] outline-neutral-200 inline-flex justify-center items-end gap-2 overflow-hidden">
                    <div class="flex-1 self-stretch flex justify-start items-center overflow-hidden">
                        <div class="flex-1 self-stretch justify-start text-zinc-500 text-sm font-normal font-['Mulish'] leading-tight">Treść wiadomości</div>
                    </div>
                    <div class="w-3.5 h-3.5 pt-24 left-[542px] top-[122px] absolute flex justify-end items-end gap-2.5">
                        <div class="w-2 h-2 outline outline-1 outline-offset-[-0.50px] outline-neutral-200"></div>
                    </div>
                </div>
            </div>
            <div data-active="off" data-enable="no" data-type="checkbox" class="self-stretch inline-flex justify-center items-start gap-2.5">
                <div class="flex justify-start items-start gap-2.5">
                    <div class="w-4 h-4 bg-white rounded border border-neutral-200"></div>
                </div>
                <div class="flex-1 justify-start text-zinc-500 text-xs font-normal font-['Mulish']">Wyrażam zgodę na przetwarzanie moich danych osobowych: imienia i nazwiska, numeru telefonu oraz adresu mailowego w celu przedstawienia oferty wykonanie dzieła, którego przedmiotem są usługi gastronomiczne oraz oświadczam, że zapoznałem/am się z zasadami i warunkami przetwarzania moich danych osobowych przez firmę KOPI Dominik Pawlak, które to zasady w pełni i dobrowolnie akceptuję.</div>
            </div>
            <div data-active="off" data-enable="no" data-type="checkbox" class="self-stretch inline-flex justify-center items-start gap-2.5">
                <div class="flex justify-start items-start gap-2.5">
                    <div class="w-4 h-4 bg-white rounded border border-neutral-200"></div>
                </div>
                <div class="flex-1 justify-start text-zinc-500 text-xs font-normal font-['Mulish']">Wyrażam zgodę na przesyłanie na udostępniony przeze mnie adres poczty elektronicznej informacji dotyczących szczegółów zawartej umowy o dzieło.</div>
            </div>
            <div data-active="off" data-enable="no" data-type="checkbox" class="self-stretch inline-flex justify-center items-start gap-2.5">
                <div class="flex justify-start items-start gap-2.5">
                    <div class="w-4 h-4 bg-white rounded border border-neutral-200"></div>
                </div>
                <div class="flex-1 justify-start text-zinc-500 text-xs font-normal font-['Mulish']">Wyrażam zgodę na kontaktowanie się ze mną telefonicznie w celu przedstawienia mi ofertę handlową firmy KOPI Dominik Pawlak.</div>
            </div>
            <div class="self-stretch pt-5 flex flex-col justify-start items-start gap-10">
                <div data-property-1="Default" class="h-12 px-7 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5">
                    <div class="justify-center text-zinc-800 text-sm font-bold font-['Mulish'] uppercase leading-tight">Wyślij</div>
                    <div class="w-6 h-6 relative overflow-hidden">
                        <div class="w-3.5 h-3.5 left-[4.50px] top-[4.80px] absolute bg-stone-400"></div>
                    </div>
                </div>
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