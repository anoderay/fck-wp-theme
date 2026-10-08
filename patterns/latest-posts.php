<?php
/**
 * Title: FCK Neueste Beiträge
 * Slug: fechtclub/latest-posts
 * Categories: fechtclub
 * Description: Überschrift mit den drei neuesten Blogbeiträgen in einer Reihe.
 */
?>
<!-- wp:group {"align":"wide","className":"is-style-section-plain","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide is-style-section-plain"><!-- wp:columns {"verticalAlignment":"bottom"} -->
<div class="wp-block-columns are-vertically-aligned-bottom"><!-- wp:column {"verticalAlignment":"bottom","width":"70%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:70%"><!-- wp:heading {"className":"is-style-mit-welle"} -->
<h2 class="wp-block-heading is-style-mit-welle">Nichts verpassen!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-muted"} -->
<p class="is-style-muted">Schau öfter mal in unseren Blog vorbei, denn wir nehmen Dich mit auf Turniere und zeigen Dir Einblicke hinter die Kulissen.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:30%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-secondary"} -->
<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="/blog">Alle Beiträge</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

<!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:post-excerpt {"excerptLength":18} /-->

<!-- wp:read-more {"content":"Weiterlesen →"} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
