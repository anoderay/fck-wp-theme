/**
 * Editor-Anbindung für den Block „Aktuelle News" – ohne Build-Schritt.
 *
 * Nutzt die globalen `wp.*`-Pakete (als Script-Abhängigkeiten in functions.php
 * deklariert) und zeigt im Editor per ServerSideRender dieselbe Ausgabe wie im
 * Frontend. Einstellbar sind Überschrift und Beitragsanzahl.
 */
( function ( blocks, element, blockEditor, components, ServerSideRender, i18n ) {
	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType( 'fechtclub/news', {
		edit: function ( props ) {
			var attributes   = props.attributes;
			var setAttributes = props.setAttributes;

			var controls = el(
				blockEditor.InspectorControls,
				null,
				el(
					components.PanelBody,
					{ title: __( 'News-Einstellungen', 'fechtclub' ) },
					el( components.TextControl, {
						label: __( 'Überschrift', 'fechtclub' ),
						help: __( 'Leer lassen, um die Überschrift auszublenden.', 'fechtclub' ),
						value: attributes.heading,
						onChange: function ( value ) {
							setAttributes( { heading: value } );
						},
					} ),
					el( components.RangeControl, {
						label: __( 'Anzahl Beiträge', 'fechtclub' ),
						value: attributes.count,
						min: 1,
						max: 12,
						onChange: function ( value ) {
							setAttributes( { count: value } );
						},
					} )
				)
			);

			// Kein eigener useBlockProps-Wrapper: render.php liefert bereits die
			// Hülle (get_block_wrapper_attributes), die ServerSideRender im Editor
			// mitrendert – ein zweiter Wrapper würde Blockklasse/alignfull doppeln.
			var preview = el( ServerSideRender, {
				block: 'fechtclub/news',
				attributes: attributes,
			} );

			return el( element.Fragment, null, controls, preview );
		},
		// Dynamischer Block: die Ausgabe erzeugt render.php.
		save: function () {
			return null;
		},
	} );
} )(
	window.wp.blocks,
	window.wp.element,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.serverSideRender,
	window.wp.i18n
);
