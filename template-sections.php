<?php
/**
 * Template Name: Volle Breite (Abschnitte)
 *
 * Für Seiten, die aus vollbreiten Block-Abschnitten bestehen (z. B. die
 * News-Seite): wie die Startseite rendert der Inhalt bündig und ohne
 * Lesespalten-Rahmen – `alignfull`-Blöcke laufen über die ganze Breite und
 * bringen ihren eigenen Abstand mit. Der Titelbalken (page-header) bleibt
 * erhalten; der erste Abschnitt sitzt direkt darunter (kein zusätzliches
 * oberes Padding von .site-main).
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/page-header' );
?>
<main class="site-main site-main--flush">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
