<?php
/**
 * Title: FCK Vorstand-Reihe (3 Karten)
 * Slug: fechtclub/vorstand-reihe
 * Categories: fechtclub
 * Description: Eine Reihe aus drei Vorstands-Karten. Spalten im Editor löschen/hinzufügen für weniger/mehr Personen pro Zeile.
 * Inserter: true
 */

defined( 'ABSPATH' ) || exit;

// Identische Karte wie im Abschnitts-Muster. Platzhalter im Editor ersetzen,
// Kontaktgruppe bei Bedarf löschen.
$fck_card = <<<'HTML'
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"fck-vorstand__card","layout":{"type":"default"}} -->
<div class="wp-block-group fck-vorstand__card"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"fck-vorstand__photo"} -->
<figure class="wp-block-image size-large fck-vorstand__photo"><img alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"fck-vorstand__caption","layout":{"type":"default"}} -->
<div class="wp-block-group fck-vorstand__caption"><!-- wp:heading {"level":4,"textColor":"base"} -->
<h4 class="wp-block-heading has-base-color has-text-color">Name</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"accent-6","fontSize":"small"} -->
<p class="has-accent-6-color has-text-color has-small-font-size">Posten</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"fck-vorstand__contact","layout":{"type":"default"}} -->
<div class="wp-block-group fck-vorstand__contact"><!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><a href="tel:+495610000000">0561 0000000</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><a href="mailto:vorname.nachname@fechtclub-kassel.de">vorname.nachname@fechtclub-kassel.de</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

HTML;
?>
<!-- wp:columns {"align":"wide","className":"fck-vorstand__row"} -->
<div class="wp-block-columns alignwide fck-vorstand__row"><?php echo str_repeat( $fck_card, 3 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- statisches Block-Markup. ?></div>
<!-- /wp:columns -->
