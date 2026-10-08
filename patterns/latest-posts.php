<?php
/**
 * Title: FCK Neueste Beiträge
 * Slug: fechtclub/latest-posts
 * Categories: fechtclub
 * Description: Die drei neuesten Blogbeiträge als Raster.
 */
?>
<!-- wp:group {"align":"wide","className":"is-style-section-plain","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide is-style-section-plain"><!-- wp:heading -->
<h2 class="wp-block-heading">Nichts verpassen!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Schau öfter mal in unseren Blog vorbei, denn wir nehmen Dich mit auf Turniere und zeigen Dir Einblicke hinter die Kulissen.</p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2"} /-->

<!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:post-excerpt {"excerptLength":20} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/blog">Alle Beiträge</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
