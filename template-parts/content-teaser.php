<?php
/**
 * Beitrags-Teaser für Listen (Blog-Übersicht und Startseite mit letzten
 * Beiträgen). Erwartet den aktuellen Post aus der Loop.
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'post-teaser' ); ?>>
	<h2 class="post-teaser__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<p class="post-teaser__meta"><?php echo esc_html( get_the_date() ); ?></p>
	<?php the_excerpt(); ?>
</article>
