/**
 * Editor-Anbindung für den Block „Ankündigungen" – ohne Build-Schritt.
 *
 * Die Inhalte kommen aus Beiträgen der gewählten Kategorie; im Editor sind
 * Kategorie und Darstellungsoptionen (Anzahl, Kürzungslänge) einstellbar. Die
 * Ausgabe zeigt ServerSideRender identisch zum Frontend.
 */
( function ( blocks, element, blockEditor, components, ServerSideRender, i18n, data ) {
	var el = element.createElement;
	var __ = i18n.__;

	// Kategorien aus dem „core“-Store lesen und als Auswahl aufbereiten.
	function useCategoryOptions() {
		var categories = data.useSelect( function ( select ) {
			return select( 'core' ).getEntityRecords( 'taxonomy', 'category', {
				per_page: -1,
				_fields: 'id,name',
				orderby: 'name',
				order: 'asc',
			} );
		}, [] );

		var options = [ { label: __( 'Standard-Ankündigungskategorie', 'fechtclub' ), value: 0 } ];
		if ( categories ) {
			categories.forEach( function ( cat ) {
				options.push( { label: cat.name, value: cat.id } );
			} );
		}
		return options;
	}

	blocks.registerBlockType( 'fechtclub/ankuendigung', {
		edit: function ( props ) {
			var attributes    = props.attributes;
			var setAttributes = props.setAttributes;
			var categoryOptions = useCategoryOptions();
			var blockProps    = blockEditor.useBlockProps();

			var controls = el(
				blockEditor.InspectorControls,
				null,
				el(
					components.PanelBody,
					{ title: __( 'Ankündigungen', 'fechtclub' ) },
					el( components.SelectControl, {
						label: __( 'Kategorie', 'fechtclub' ),
						help: __( 'Welche Kategorie als Ankündigungen angezeigt wird. „Standard“ nutzt die konfigurierte Ankündigungskategorie.', 'fechtclub' ),
						value: attributes.category,
						options: categoryOptions,
						onChange: function ( value ) {
							setAttributes( { category: parseInt( value, 10 ) || 0 } );
						},
					} ),
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
	window.wp.i18n,
	window.wp.data
);
