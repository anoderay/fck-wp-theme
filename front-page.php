<?php
/**
 * Startseite.
 *
 * Bei einer statischen Startseite (Einstellungen → Lesen → „Eine statische
 * Seite") werden deren Blöcke/Patterns gerendert. Ist stattdessen „Deine
 * letzten Beiträge" eingestellt, zeigt die Startseite die Beitragsübersicht,
 * statt ungeordnet den Inhalt jedes Beitrags auszugeben.
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( is_page() ) : ?>
	<main class="site-main site-main--flush">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</main>
	<?php
else :
	?>
	<main class="site-main">
		<div class="wrap">
			<?php if ( have_posts() ) : ?>
				<div class="post-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content-teaser' );
					endwhile;
					?>
				</div>
				<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Keine Beiträge gefunden.', 'fechtclub' ); ?></p>
			<?php endif; ?>
		</div>
	</main>
	<?php
endif;

get_footer();
