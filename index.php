<?php
/**
 * Fallback-Template / Blog-Übersicht.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="site-main">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'post-teaser' ); ?>>
					<h2 class="post-teaser__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<p class="post-teaser__meta"><?php echo esc_html( get_the_date() ); ?></p>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>

			<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Keine Beiträge gefunden.', 'fechtclub' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
