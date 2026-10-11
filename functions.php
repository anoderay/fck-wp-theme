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
		// Auszug-Feld für Seiten aktivieren – dient als Eyebrow im Titelbanner.
		add_post_type_support( 'page', 'excerpt' );
	}
);

/**
 * Eigene Block-Kategorie, damit Theme-Blöcke im Inserter beieinanderstehen.
 */
add_filter(
	'block_categories_all',
	function ( $categories ) {
		array_unshift(
			$categories,
			array(
				'slug'  => 'fechtclub',
				'title' => __( 'Fechtclub Kassel', 'fechtclub' ),
				'icon'  => null,
			)
		);
		return $categories;
	}
);

/**
 * Theme-eigene Blöcke registrieren.
 *
 * „Aktuelle News" ist ein dynamischer Block: Das Editor-Skript wird mit seinen
 * wp-Abhängigkeiten angemeldet; die Frontend-Ausgabe erzeugt blocks/news/render.php.
 */
add_action(
	'init',
	function () {
		// News-Block: braucht zusätzlich wp-data/wp-core-data für die
		// Kategorie-Auswahl (liest die Kategorien aus dem „core“-Store).
		wp_register_script(
			'fck-news-editor',
			get_theme_file_uri( 'blocks/news/index.js' ),
			array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render', 'wp-i18n', 'wp-data', 'wp-core-data' ),
			fck_asset_version( 'blocks/news/index.js' ),
			true
		);
		register_block_type( get_theme_file_path( 'blocks/news' ) );

		wp_register_script(
			'fck-ankuendigung-editor',
			get_theme_file_uri( 'blocks/ankuendigung/index.js' ),
			array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render', 'wp-i18n' ),
			fck_asset_version( 'blocks/ankuendigung/index.js' ),
			true
		);
		register_block_type( get_theme_file_path( 'blocks/ankuendigung' ) );
	}
);

/**
 * WordPress-Lightbox („Beim Klick vergrößern“) für Inhaltsbilder aktivieren –
 * ausschließlich auf der Beitrags-Einzelseite. Betrifft Core-Bild-Blöcke im
 * Beitragstext; nicht global (z. B. Hero). Das Titelbild im Beitrags-Kopf ist
 * ein Template-Bild (kein Block) und bleibt daher unberührt. Eine im Editor
 * pro Bild getroffene Einstellung hat Vorrang.
 */
add_filter(
	'render_block_data',
	function ( $block ) {
		if ( 'core/image' === $block['blockName']
			&& is_singular( 'post' )
			&& ! isset( $block['attrs']['lightbox'] ) ) {
			$block['attrs']['lightbox'] = array( 'enabled' => true );
		}
		return $block;
	}
);

/**
 * Tabellen-Stil „Stundenplan": wählbar im Editor (Block → Stile). Erzeugt eine
 * dunkle Kopfzeile und gebänderte Zeilen (siehe .is-style-fck-stundenplan in
 * assets/css/main.css). Die Tabelle braucht dafür eine aktivierte Kopfzeile.
 */
add_action(
	'init',
	function () {
		register_block_style(
			'core/table',
			array(
				'name'  => 'fck-stundenplan',
				'label' => __( 'Stundenplan', 'fechtclub' ),
			)
		);
	}
);

/**
 * Versionsstring für Assets: Datei-Zeitstempel statt Theme-Version, damit der
 * Browser bei jeder Dateiänderung automatisch neu lädt (kein manuelles
 * Cache-Leeren im Dev nötig; bustet den Cache auch bei jedem Deploy).
 */
function fck_asset_version( $relative_path ) {
	$file = get_theme_file_path( $relative_path );
	return file_exists( $file ) ? (string) filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

/**
 * Term-ID der Ankündigungs-Kategorie – oder 0, falls (noch) nicht vorhanden.
 *
 * Diese Kategorie trennt Banner-Ankündigungen vom normalen News-Strom: Der
 * Block „Ankündigungen“ zeigt genau sie, während News-Block, Blog-Übersicht,
 * Suche und Feed sie ausblenden. Der Slug ist per Filter anpassbar; existiert
 * die Kategorie nicht, liefert die Funktion 0 und alle Aufrufer verhalten sich
 * neutral (kein Band, kein Ausschluss) – es geht also nichts kaputt.
 */
function fck_announcement_category_id() {
	$slug = apply_filters( 'fck_announcement_category_slug', 'ankuendigung' );
	$term = get_category_by_slug( $slug );
	return $term ? (int) $term->term_id : 0;
}

/**
 * Stylesheet und Navigations-Skript einbinden.
 */
function fck_assets() {
	wp_enqueue_style( 'fck-main', get_theme_file_uri( 'assets/css/main.css' ), array(), fck_asset_version( 'assets/css/main.css' ) );
	wp_enqueue_script( 'fck-nav', get_theme_file_uri( 'assets/js/nav.js' ), array(), fck_asset_version( 'assets/js/nav.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'fck_assets' );

/**
 * 12 Beiträge pro Seite in Blog-Übersicht und Archiven.
 */
add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( $query->is_home() || $query->is_archive() ) {
			$query->set( 'posts_per_page', 12 );
		}

		// Ankündigungen (Banner) gehören nicht in den allgemeinen News-Strom:
		// Blog-Übersicht, Suche und Feed blenden die Kategorie aus. Ihre eigene
		// Kategorie-Seite (/kategorie/ankuendigung/) bleibt bewusst unberührt.
		if ( $query->is_home() || $query->is_search() || $query->is_feed() ) {
			$fck_ann_cat = fck_announcement_category_id();
			if ( $fck_ann_cat ) {
				$query->set( 'category__not_in', array( $fck_ann_cat ) );
			}
		}
	}
);

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
