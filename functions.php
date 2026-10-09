<?php
/**
 * Fechtclub Kassel – Hybrid-Theme.
 *
 * Struktur/Design: klassische PHP-Templates + theme.json (Design-Tokens).
 * Inhalt: WordPress-DB (Block-Editor). Funktionen (Formulare, eigene
 * Post-Typen) gehören in ein eigenes Plugin, nicht hierher.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme-Supports und Menü-Registrierung.
 */
function fck_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Hauptnavigation', 'fechtclub' ),
		)
	);

	// Frontend-Styles auch im Block-Editor laden, damit Patterns dort ähnlich
	// aussehen wie auf der Seite.
	add_editor_style( 'assets/css/main.css' );
}
add_action( 'after_setup_theme', 'fck_setup' );

/**
 * Eigene Pattern-Kategorie für die Startseiten-Abschnitte.
 */
add_action(
	'init',
	function () {
		register_block_pattern_category(
			'fechtclub',
			array( 'label' => __( 'Fechtclub Kassel', 'fechtclub' ) )
		);
	}
);

/**
 * Stylesheet und Skripte einbinden.
 *
 * Die Dekor-SVGs werden als CSS-Variablen gesetzt, weil der Theme-Pfad erst
 * zur Laufzeit bekannt ist.
 */
function fck_assets() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'fck-main', get_theme_file_uri( 'assets/css/main.css' ), array(), $version );

	$decor = get_theme_file_uri( 'assets/decor/' );
	wp_add_inline_style(
		'fck-main',
		':root{--fck-bars:url("' . esc_url( $decor . 'bars.svg' ) . '");--fck-waves:url("' . esc_url( $decor . 'waves.svg' ) . '");}'
	);

	wp_enqueue_script( 'fck-nav', get_theme_file_uri( 'assets/js/nav.js' ), array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'fck_assets' );
