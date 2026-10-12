<?php
/**
 * Title: FCK Vorstand-Karte (einzeln)
 * Slug: fechtclub/vorstand-karte
 * Categories: fechtclub
 * Description: Einzelne Vorstands-Karte mit Foto, Name, Posten sowie E-Mail/Telefon (Zeilen bei Nichtbenutzung löschbar).
 * Inserter: true
 */
?>
<!-- wp:group {"className":"fck-vorstand__card","layout":{"type":"default"}} -->
<div class="wp-block-group fck-vorstand__card"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"fck-vorstand__photo"} -->
<figure class="wp-block-image size-large fck-vorstand__photo"><img alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"fck-vorstand__caption","layout":{"type":"default"}} -->
<div class="wp-block-group fck-vorstand__caption"><!-- wp:heading {"level":4,"textColor":"base"} -->
<h4 class="wp-block-heading has-base-color has-text-color">Name</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"accent-6","fontSize":"small"} -->
<p class="has-accent-6-color has-text-color has-small-font-size">Posten · <a class="fck-mail" href="mailto:vorname.nachname@fechtclub-kassel.de">Mail</a> · <a class="fck-tel" href="tel:+495610000000">Telefon</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
