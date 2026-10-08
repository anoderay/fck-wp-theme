<?php
/**
 * Title: FCK Was macht Fechten besonders
 * Slug: fechtclub/features
 * Categories: fechtclub
 * Description: Dunkler Abschnitt mit drei Karten (Icon, Titel, Text).
 */
$icon = function ( $name ) {
	return esc_url( get_theme_file_uri( 'assets/icons/' . $name . '.svg' ) );
};
?>
<!-- wp:group {"align":"full","className":"is-style-section-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-dark"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"70%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:70%"><!-- wp:heading {"className":"is-style-mit-welle"} -->
<h2 class="wp-block-heading is-style-mit-welle">Was macht Fechten so besonders?</h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:30%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-secondary"} -->
<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="/probetraining">Kostenloses Probetraining</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-card-dark"><!-- wp:image {"width":"44px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo $icon( 'koerper-geist' ); ?>" alt="" style="width:44px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Körperliche &amp; geistige Herausforderung</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-muted-light"} -->
<p class="is-style-muted-light">Fechten erfordert schnelle Reflexe, Ausdauer, Koordination und strategisches Denken. Der Sport bietet sowohl körperliche als auch geistige Herausforderungen.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-card-dark"><!-- wp:image {"width":"44px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo $icon( 'tradition' ); ?>" alt="" style="width:44px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Tradition und Kultur</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-muted-light"} -->
<p class="is-style-muted-light">Fechten ist ein Sport mit einer reichen Geschichte und Tradition, die bis ins Mittelalter zurückreicht. Viele Fechter schätzen die Etikette und Disziplin, die damit verbunden sind.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-card-dark"><!-- wp:image {"width":"44px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo $icon( 'wettkampf' ); ?>" alt="" style="width:44px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Wettkampf und Gemeinschaft</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-muted-light"} -->
<p class="is-style-muted-light">Fechten bietet die Möglichkeit, sich in Wettkämpfen mit anderen Fechtern zu messen und international an Turnieren teilzunehmen.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
