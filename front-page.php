<?php
/**
 * Startseite.
 *
 * Rendert den Inhalt der statischen Startseite (Blöcke/Patterns aus der DB).
 * Die Abschnitte werden im Block-Editor gepflegt, das Design liefert das Theme
 * (assets/css/main.css + theme.json). Voraussetzung: Unter Einstellungen →
 * Lesen ist eine statische Seite als Startseite gesetzt.
 */

defined( 'ABSPATH' ) || exit;

get_header();
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
