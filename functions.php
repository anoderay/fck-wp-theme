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
	add_theme_support( 'align-wide' );
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
			'primary'   => __( 'Hauptnavigation', 'fechtclub' ),
			'footernav' => __( 'Footer-Navigation', 'fechtclub' ),
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
/**
 * Versionsstring für Assets: Datei-Zeitstempel statt Theme-Version, damit der
 * Browser bei jeder Dateiänderung automatisch neu lädt (kein manuelles
 * Cache-Leeren im Dev nötig; bustet den Cache auch bei jedem Deploy).
 */
function fck_asset_version( $relative_path ) {
	$file = get_theme_file_path( $relative_path );
	return file_exists( $file ) ? (string) filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

function fck_assets() {
	wp_enqueue_style( 'fck-main', get_theme_file_uri( 'assets/css/main.css' ), array(), fck_asset_version( 'assets/css/main.css' ) );

	$decor = get_theme_file_uri( 'assets/decor/' );
	wp_add_inline_style(
		'fck-main',
		':root{--fck-bars:url("' . esc_url( $decor . 'bars.svg' ) . '");--fck-waves:url("' . esc_url( $decor . 'waves.svg' ) . '");}'
	);

	wp_enqueue_script( 'fck-nav', get_theme_file_uri( 'assets/js/nav.js' ), array(), fck_asset_version( 'assets/js/nav.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'fck_assets' );

/**
 * Customizer: Header-Button (Zielseite + Beschriftung) ohne Code pflegbar.
 */
add_action(
	'customize_register',
	function ( $wp_customize ) {
		$wp_customize->add_section(
			'fck_header_cta',
			array(
				'title'    => __( 'Header-Button', 'fechtclub' ),
				'priority' => 30,
			)
		);

		$wp_customize->add_setting(
			'fck_cta_label',
			array(
				'default'           => __( 'Kostenloses Probetraining', 'fechtclub' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'fck_cta_label',
			array(
				'label'   => __( 'Beschriftung', 'fechtclub' ),
				'section' => 'fck_header_cta',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'fck_cta_page',
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			'fck_cta_page',
			array(
				'label'          => __( 'Zielseite', 'fechtclub' ),
				'description'    => __( 'Seite, auf die der Button verlinkt.', 'fechtclub' ),
				'section'        => 'fck_header_cta',
				'type'           => 'dropdown-pages',
				'allow_addition' => true,
			)
		);
	}
);

/**
 * Customizer: Footer – Copyright-Zeile.
 */
add_action(
	'customize_register',
	function ( $wp_customize ) {
		$wp_customize->add_section(
			'fck_footer',
			array(
				'title'    => __( 'Footer', 'fechtclub' ),
				'priority' => 35,
			)
		);
		$wp_customize->add_setting(
			'fck_footer_copyright',
			array(
				'default'           => '© Fechtclub Kassel e.V. ' . wp_date( 'Y' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'fck_footer_copyright',
			array(
				'label'   => __( 'Copyright-Zeile', 'fechtclub' ),
				'section' => 'fck_footer',
				'type'    => 'text',
			)
		);
	}
);
