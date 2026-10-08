<?php
/**
 * Fechtclub Kassel – Child-Theme von Twenty Twenty-Five.
 *
 * Bewusst minimal: Design gehört in theme.json und patterns/,
 * Funktionen (Formulare, eigene Post-Typen) in ein eigenes Plugin.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_block_pattern_category(
		'fechtclub',
		array( 'label' => __( 'Fechtclub Kassel', 'fechtclub' ) )
	);
} );
