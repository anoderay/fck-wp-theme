<?php
/**
 * Title: FCK Hero
 * Slug: fechtclub/hero
 * Categories: fechtclub
 * Description: Dunkler Startbereich mit Titel, Buttons, Bild und drei Vorteilen.
 * Inserter: true
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"ink","textColor":"base","className":"fck-section fck-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull fck-section fck-hero has-base-color has-ink-background-color has-text-color has-background"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%"><!-- wp:paragraph {"className":"fck-eyebrow"} -->
<p class="fck-eyebrow">Fechtclub Kassel</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Entdecke die Magie des Fechtens.</h1>
<!-- /wp:heading -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/probetraining">Kostenloses Probetraining</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-secondary fck-button-ghost"} -->
<div class="wp-block-button is-style-secondary fck-button-ghost"><a class="wp-block-button__link wp-element-button" href="/mitglied-werden">Mitglied werden</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%"><!-- wp:group {"className":"fck-bars-frame","layout":{"type":"default"}} -->
<div class="wp-block-group fck-bars-frame"><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/hero-elisa.png' ) ); ?>" width="750" height="913" alt="Elisa vom Fechtclub Kassel mit Maske und Florett"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"fck-star"} -->
<p class="fck-star">Kostenloses Probetraining</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"fck-star"} -->
<p class="fck-star">Ein Sport für jede Altersklasse</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"fck-star"} -->
<p class="fck-star">Werde der nächste D’Artagnan</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
