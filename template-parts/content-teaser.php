<?php
/**
 * Beitrags-Karte für Listen (Blog-Übersicht und Startseite mit letzten
 * Beiträgen). Erwartet den aktuellen Post aus der Loop.
 */

defined( 'ABSPATH' ) || exit;

$fck_excerpt = get_the_excerpt();
?>
<article <?php post_class( 'post-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'medium_large' ); ?>
		</a>
	<?php endif; ?>
	<div class="post-card__body">
		<h2 class="post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<?php if ( '' !== $fck_excerpt ) : ?>
			<p class="post-card__excerpt"><?php echo esc_html( $fck_excerpt ); ?></p>
		<?php endif; ?>
		<a class="post-card__more" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Weiterlesen', 'fechtclub' ); ?>
		</a>
	</div>
</article>
