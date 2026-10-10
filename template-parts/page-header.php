<?php
/**
 * Titelbanner für Unterseiten.
 *
 * Design liegt im Theme; der Titel kommt aus dem jeweiligen Kontext (Seiten-
 * titel, Blog-/Archivtitel …), der Eyebrow aus dem manuellen Auszug der Seite.
 * Die Startseite bekommt KEIN Banner (früher Rücksprung).
 */

defined( 'ABSPATH' ) || exit;

if ( is_front_page() ) {
	return;
}

$fck_title   = '';
$fck_eyebrow = '';

if ( is_home() ) {
	// Blog-/Beitragsseite: Titel + Auszug der zugewiesenen „Beitragsseite".
	$fck_posts_page = (int) get_option( 'page_for_posts' );
	$fck_title      = $fck_posts_page ? get_the_title( $fck_posts_page ) : __( 'Blog', 'fechtclub' );
	$fck_eyebrow    = $fck_posts_page ? get_post_field( 'post_excerpt', $fck_posts_page ) : '';
} elseif ( is_archive() ) {
	$fck_title = get_the_archive_title();
} elseif ( is_search() ) {
	/* translators: %s: Suchbegriff. */
	$fck_title = sprintf( __( 'Suche: %s', 'fechtclub' ), get_search_query() );
} elseif ( is_404() ) {
	$fck_title = __( 'Seite nicht gefunden', 'fechtclub' );
} elseif ( is_singular() ) {
	$fck_title   = get_the_title();
	$fck_eyebrow = get_post_field( 'post_excerpt', get_queried_object_id() );
}

if ( '' === trim( wp_strip_all_tags( (string) $fck_title ) ) ) {
	return;
}
?>
<section class="page-header">
	<div class="page-header__inner">
		<?php if ( '' !== trim( (string) $fck_eyebrow ) ) : ?>
			<p class="page-header__eyebrow"><?php echo esc_html( $fck_eyebrow ); ?></p>
		<?php endif; ?>
		<div class="page-header__title-wrap">
			<h1 class="page-header__title"><?php echo wp_kses_post( $fck_title ); ?></h1>
		</div>
	</div>
</section>
