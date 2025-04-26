


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

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="w-full">

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' );
			?>

<div data-property-1="mobile v2" class="w-full self-stretch px-5 pt-36 relative bg-stone-700 inline-flex flex-col justify-start items-start gap-14">
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
		<?php
	wp_nav_menu([
    'theme_location' => 'footer-menu',
]);
?>
        <div class="self-stretch py-1 flex flex-col justify-center items-start gap-4">
            <div class="w-20 h-6 text-center justify-start text-stone-400 text-sm font-bold font-['Mulish'] uppercase leading-tight">Śledź nas:</div>
            <div class="inline-flex justify-start items-start gap-2.5">
                <div class="p-2 bg-stone-200 rounded-[40px] flex justify-center items-center gap-2.5">
                    <div class="w-6 h-6 relative overflow-hidden">
                        <div class="w-5 h-5 left-[2px] top-[2px] absolute bg-stone-700"></div>
                    </div>
                </div>
                <div class="p-2 bg-stone-200 rounded-[40px] flex justify-start items-start gap-2.5">
                    <div class="w-6 h-6 relative overflow-hidden">
                        <div class="w-2.5 h-5 left-[6.61px] top-[2px] absolute bg-stone-700"></div>
                    </div>
                </div>
                <div class="p-2 bg-stone-200 rounded-[40px] flex justify-center items-center gap-2.5">
                    <div class="w-6 h-6 relative overflow-hidden">
                        <div class="w-5 h-5 left-[3px] top-[1px] absolute bg-stone-700"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 inline-flex justify-center items-center gap-2.5">
            <div class="text-center justify-start text-stone-200 text-[10px] font-normal font-['Mulish']">© 2025 Copyright Capuccino Cafe</div>
        </div>
    </div>
    <div class="w-36 h-2.5 left-[21px] top-[197px] absolute"></div>
    <div class="w-36 h-2.5 left-[21px] top-[251px] absolute"></div>
    <div class="w-40 h-12 left-[20px] top-[40px] absolute overflow-hidden">
        <div class="w-1 h-1.5 left-[155.11px] top-[12.09px] absolute bg-white"></div>
        <div class="w-2.5 h-2.5 left-[151.98px] top-[9.92px] absolute bg-white"></div>
        <div class="w-10 h-9 left-[106.94px] top-[8.87px] absolute bg-white"></div>
        <div class="w-2.5 h-4 left-[100.31px] top-[15.33px] absolute bg-stone-400"></div>
        <div class="w-2.5 h-4 left-[88.49px] top-[15.52px] absolute bg-stone-400"></div>
        <div class="w-[1331.74px] h-[7657.65px] left-[-40.23px] top-[-21.39px] absolute bg-white"></div>
        <div class="w-[3.22px] h-[3.13px] left-[82.17px] top-[9.77px] absolute bg-stone-400"></div>
        <div class="w-[1331.74px] h-[7657.65px] left-[-40.23px] top-[-21.39px] absolute bg-white"></div>
        <div class="w-[3.22px] h-4 left-[82.17px] top-[15.75px] absolute bg-stone-400"></div>
        <div class="w-[1331.74px] h-[7657.65px] left-[-40.23px] top-[-21.39px] absolute bg-white"></div>
        <div class="w-2.5 h-4 left-[70.13px] top-[15.33px] absolute bg-stone-400"></div>
        <div class="w-[1331.74px] h-[7657.65px] left-[-40.23px] top-[-21.39px] absolute bg-white"></div>
        <div class="w-2.5 h-4 left-[58.41px] top-[15.33px] absolute bg-stone-400"></div>
        <div class="w-[1331.74px] h-[7657.65px] left-[-40.23px] top-[-21.39px] absolute bg-white"></div>
        <div class="w-2.5 h-4 left-[46.53px] top-[15.75px] absolute bg-stone-400"></div>
        <div class="w-[1331.74px] h-[7657.65px] left-[-40.23px] top-[-21.39px] absolute bg-white"></div>
        <div class="w-11 h-11 left-[1.01px] top-[1.07px] absolute bg-stone-400"></div>
    </div>
</div>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>



</body>
</html>
