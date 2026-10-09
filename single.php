<?php
/**
 * Einzelner Beitrag.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="site-main">
	<div class="wrap">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<p class="entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>
<?php
get_footer();
