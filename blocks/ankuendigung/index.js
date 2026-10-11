/**
 * Editor-Anbindung für den Block „Ankündigungen" – ohne Build-Schritt.
 *
 * Die Inhalte kommen aus Beiträgen der Ankündigungs-Kategorie; im Editor sind
 * nur Darstellungsoptionen einstellbar (Anzahl, Kürzungslänge). Die Ausgabe
 * zeigt ServerSideRender identisch zum Frontend.
 */
( function ( blocks, element, blockEditor, components, ServerSideRender, i18n ) {
	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType( 'fechtclub/ankuendigung', {
		edit: function ( props ) {
			var attributes    = props.attributes;
			var setAttributes = props.setAttributes;
			var blockProps    = blockEditor.useBlockProps();

			var controls = el(
				blockEditor.InspectorControls,
				null,
				el(
					components.PanelBody,
					{ title: __( 'Ankündigungen', 'fechtclub' ) },
					el( components.RangeControl, {
						label: __( 'Maximale Anzahl', 'fechtclub' ),
						help: __( '0 = alle veröffentlichten Ankündigungen zeigen.', 'fechtclub' ),
						value: attributes.count,
						min: 0,
						max: 10,
						onChange: function ( value ) {
							setAttributes( { count: value } );
						},
					} ),
					el( components.RangeControl, {
						label: __( 'Textlänge (Wörter)', 'fechtclub' ),
						help: __( 'Längere Texte werden mit „…“ abgeschnitten.', 'fechtclub' ),
						value: attributes.maxWords,
						min: 4,
						max: 40,
						onChange: function ( value ) {
							setAttributes( { maxWords: value } );
						},
					} )
				)
			);

			// apiVersion 3: useBlockProps liefert den auswählbaren Wrapper;
			// <Disabled> macht die Vorschau inert, damit die Einzeiler-Links im
			// Editor nicht zur Beitragsseite navigieren.
			var preview = el(
				components.Disabled,
				null,
				el( ServerSideRender, {
					block: 'fechtclub/ankuendigung',
					attributes: attributes,
				} )
			);

			return el( 'div', blockProps, controls, preview );
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
