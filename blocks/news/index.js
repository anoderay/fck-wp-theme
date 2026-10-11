/**
 * Editor-Anbindung für den Block „Aktuelle News" – ohne Build-Schritt.
 *
 * Nutzt die globalen `wp.*`-Pakete (als Script-Abhängigkeiten in functions.php
 * deklariert) und zeigt im Editor per ServerSideRender dieselbe Ausgabe wie im
 * Frontend. Einstellbar sind Überschrift, Kategorie, Beitragsanzahl und ob eine
 * Seiten-Navigation (Paginierung) ausgegeben wird.
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

		var options = [ { label: __( 'Alle Kategorien', 'fechtclub' ), value: 0 } ];
		if ( categories ) {
			categories.forEach( function ( cat ) {
				options.push( { label: cat.name, value: cat.id } );
			} );
		}
		return options;
	}

	blocks.registerBlockType( 'fechtclub/news', {
		edit: function ( props ) {
			var attributes    = props.attributes;
			var setAttributes = props.setAttributes;
			var categoryOptions = useCategoryOptions();
			var blockProps      = blockEditor.useBlockProps();

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
					el( components.SelectControl, {
						label: __( 'Kategorie', 'fechtclub' ),
						help: __( 'Nur Beiträge dieser Kategorie zeigen. „Alle Kategorien“ blendet Ankündigungen aus.', 'fechtclub' ),
						value: attributes.category,
						options: categoryOptions,
						onChange: function ( value ) {
							setAttributes( { category: parseInt( value, 10 ) || 0 } );
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
					} ),
					el( components.ToggleControl, {
						label: __( 'Seiten-Navigation anzeigen', 'fechtclub' ),
						help: __( 'Blättern durch alle Beiträge (für eine eigene News-Seite). Ersetzt den „Mehr“-Button.', 'fechtclub' ),
						checked: !! attributes.showPagination,
						onChange: function ( value ) {
							setAttributes( { showPagination: value } );
						},
					} ),
					el( components.ToggleControl, {
						label: __( '„Mehr“-Button anzeigen', 'fechtclub' ),
						help: __( 'Button unter den Karten. Wird bei aktiver Seiten-Navigation nicht gezeigt.', 'fechtclub' ),
						checked: !! attributes.showMore,
						onChange: function ( value ) {
							setAttributes( { showMore: value } );
						},
					} ),
					attributes.showMore && el( components.TextControl, {
						label: __( 'Button-Beschriftung', 'fechtclub' ),
						value: attributes.moreLabel,
						onChange: function ( value ) {
							setAttributes( { moreLabel: value } );
						},
					} ),
					attributes.showMore && el( components.TextControl, {
						label: __( 'Button-Ziel (URL)', 'fechtclub' ),
						help: __( 'Wohin der Button führt, z. B. die News-Seite oder ein Kategorie-Archiv.', 'fechtclub' ),
						type: 'url',
						value: attributes.moreUrl,
						onChange: function ( value ) {
							setAttributes( { moreUrl: value } );
						},
					} )
				)
			);

			// apiVersion 3: Der Editor umschließt den Block nicht automatisch –
			// useBlockProps liefert den auswählbaren Wrapper. Ohne ihn lässt sich
			// der Block nicht anklicken und Klicks treffen die Links der
			// Vorschau. <Disabled> macht die ServerSideRender-Vorschau inert,
			// damit diese Links im Editor nicht navigieren.
			var preview = el(
				components.Disabled,
				null,
				el( ServerSideRender, {
					block: 'fechtclub/news',
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
