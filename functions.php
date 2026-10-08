<?php
/**
 * Fechtclub Kassel – Child-Theme von Twenty Twenty-Five.
 *
 * Bewusst minimal: Design gehört in theme.json, styles/blocks/*.json
 * und patterns/. Funktionen (Formulare, eigene Post-Typen) gehören in
 * ein eigenes Plugin.
 */

defined( 'ABSPATH' ) || exit;

/**
 * CSS-Variablen für Dekor-Grafiken (Pfad zum Theme ist erst zur Laufzeit bekannt).
 */
function fechtclub_decor_css() {
	$base = get_stylesheet_directory_uri() . '/assets/decor/';
	return ':root{--fck-bars:url("' . esc_url( $base . 'bars.svg' ) . '");--fck-waves:url("' . esc_url( $base . 'waves.svg' ) . '");}';
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'fechtclub-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	wp_add_inline_style( 'fechtclub-style', fechtclub_decor_css() );
} );

add_filter( 'block_editor_settings_all', function ( $settings ) {
	$settings['styles'][] = array( 'css' => fechtclub_decor_css() );
	return $settings;
} );

add_action( 'init', function () {
	register_block_pattern_category(
		'fechtclub',
		array( 'label' => __( 'Fechtclub Kassel', 'fechtclub' ) )
	);
} );
