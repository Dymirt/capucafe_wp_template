<?php
// home.php — Overrides the Posts page (Aktualności) in Storefront.
// Requires Tailwind to be loaded on the front-end.
if (!defined('ABSPATH')) exit;

get_header();

$paged   = max(1, get_query_var('paged', 1));
$found   = $GLOBALS['wp_query']->found_posts ?? 0;
$ppp     = (int) get_query_var('posts_per_page', get_option('posts_per_page'));
$shown   = min($found, (($paged - 1) * $ppp) + $GLOBALS['wp_query']->post_count);
$title   = get_the_title((int) get_option('page_for_posts'));
?>

<main id="primary" class="site-main">

	<!-- Hero -->
	<div class="self-stretch flex flex-col justify-start items-start relative">

			<div class="self-stretch min-w-56 pt-24 pb-44 bg-[#F2EDE7] inline-flex justify-center items-center gap-2.5 absolute top-0 w-full z-[-1]">
				<h1 class="text-center justify-start text-stone-700 text-5xl font-normal font-['Didot_LT_Pro']">
					<?php echo esc_html($title ?: 'Aktualności'); ?>
				</h1>
			</div>
		<!-- Cards grid -->
		<div class="self-stretch inline-flex justify-center items-start gap-10 flex-wrap content-start pt-60">


			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article <?php post_class('flex-1 min-w-72 inline-flex flex-col justify-start items-start'); ?>>

						<a href="<?php the_permalink(); ?>" class="self-stretch !h-56 w-full py-4 inline-flex justify-center items-center gap-2.5">
							<?php if (has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('large', ['class' => 'w-full !h-full object-cover rounded']); ?>
							<?php else : ?>
								<img src="https://placehold.co/371x220" alt="" class="w-full h-full object-cover rounded" />
							<?php endif; ?>
						</a>

						<div class="self-stretch flex flex-col justify-start items-start">
							<div class="self-stretch pt-4 pb-2 inline-flex justify-start items-start gap-3">
								<div class="justify-start text-zinc-500 text-xs font-normal">
									<?php echo esc_html(date_i18n('j F Y', get_post_timestamp())); ?>
								</div>
							</div>

							<div class="self-stretch border-stone-400 flex flex-col justify-start items-center gap-2.5">
								<div class="self-stretch justify-start text-zinc-800 text-lg font-bold leading-relaxed">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
								<div class="self-stretch justify-start text-zinc-800 text-sm font-normal leading-tight">
									<?php $text = get_the_excerpt();
									echo esc_html(wp_html_excerpt($text, 100, '…')); // 100 chars + ellipsis
									?>
								</div>
							</div>
						</div>
					</article>
				<?php endwhile;
			else : ?>
				<p class="px-32 py-16">Brak wpisów.</p>
			<?php endif; ?>

		</div>
	</div>

	<!-- Progress + Show more -->
	<div class="self-stretch pb-8 flex flex-col justify-start items-center gap-3.5 mt-12">
		<div class="w-64 h-1 relative bg-stone-300 overflow-hidden">
			<?php
			$pct = ($found > 0) ? max(0, min(100, round(($shown / $found) * 100))) : 0;
			?>
			<div class="h-1 left-0 top-0 absolute bg-stone-400" style="width: <?php echo (int)$pct; ?>%"></div>
		</div>
		<div class="text-center justify-center text-zinc-800 text-sm font-normal leading-tight">
			<?php echo esc_html($shown . ' z ' . $found . ' artykułów'); ?>
		</div>

		<?php if (get_next_posts_link('', $found)) : ?>
			<div class="h-12 px-7 rounded outline outline-1 outline-offset-[-1px] outline-stone-400 inline-flex justify-center items-center gap-2.5">
				<?php next_posts_link(
					'<span class="justify-center text-zinc-800 text-sm font-bold uppercase leading-tight">Pokaż więcej</span>'
				); ?>
			</div>
		<?php endif; ?>
	</div>

	<!--- instagram section -->
	<?php
	require_once get_stylesheet_directory() . '/inc/instagram.php';
	?>

</main>

<?php get_footer();
