<?php
/**
 * Serverseitige Ausgabe des Blocks „Aktuelle News".
 *
 * Fragt die neuesten Beiträge ab und rendert sie mit derselben Karten-Vorlage
 * wie die Blog-Übersicht (template-parts/content-teaser.php). So gibt es nur
 * eine Quelle für das Karten-Design.
 *
 * Verfügbar: $attributes, $content, $block.
 */

defined( 'ABSPATH' ) || exit;

$fck_count    = isset( $attributes['count'] ) ? max( 1, (int) $attributes['count'] ) : 3;
$fck_heading  = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : '';
$fck_category = isset( $attributes['category'] ) ? (int) $attributes['category'] : 0;
$fck_paginate = ! empty( $attributes['showPagination'] );

$fck_show_more  = ! empty( $attributes['showMore'] );
$fck_more_label = isset( $attributes['moreLabel'] ) ? (string) $attributes['moreLabel'] : '';
$fck_more_url   = isset( $attributes['moreUrl'] ) ? trim( (string) $attributes['moreUrl'] ) : '';

// Aktuelle Seitenzahl: auf einer statischen Seite steckt sie in „page“, in
// Archiv-/Blog-Kontexten in „paged“.
$fck_paged = $fck_paginate
	? max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) )
	: 1;

$fck_args = array(
	'post_type'           => 'post',
	'posts_per_page'      => $fck_count,
	'ignore_sticky_posts' => true,
);

if ( $fck_category > 0 ) {
	// Bestimmte Kategorie gewählt.
	$fck_args['cat'] = $fck_category;
} elseif ( $fck_ann_cat = fck_announcement_category_id() ) {
	// „Alle Kategorien“: Ankündigungen (Banner) gehören nicht in den News-Strom.
	$fck_args['category__not_in'] = array( $fck_ann_cat );
}

if ( $fck_paginate ) {
	$fck_args['paged'] = $fck_paged;
} else {
	$fck_args['no_found_rows'] = true;
}

$fck_query = new WP_Query( $fck_args );

// Ohne Beiträge nichts ausgeben (im Editor zeigt der Block dann einen Hinweis).
if ( ! $fck_query->have_posts() ) {
	wp_reset_postdata();
	return;
}

// Wrapper-Attribute von WordPress (Ausrichtung, eigene CSS-Klasse der Instanz)
// zusammen mit den Theme-Klassen ausgeben.
$fck_wrapper = get_block_wrapper_attributes( array( 'class' => 'fck-section fck-news' ) );
?>
<section <?php echo $fck_wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- von Core escaped. ?>>
	<div class="fck-news__inner alignwide">
		<?php if ( '' !== trim( $fck_heading ) ) : ?>
			<h2 class="fck-news__heading"><?php echo esc_html( $fck_heading ); ?></h2>
		<?php endif; ?>
		<div class="post-grid">
			<?php
			while ( $fck_query->have_posts() ) :
				$fck_query->the_post();
				get_template_part( 'template-parts/content-teaser' );
			endwhile;
			?>
		</div>
		<?php
		if ( $fck_paginate && $fck_query->max_num_pages > 1 ) :
			$fck_links = paginate_links(
				array(
					'total'     => $fck_query->max_num_pages,
					'current'   => $fck_paged,
					'mid_size'  => 1,
					'prev_text' => __( '&laquo; Zurück', 'fechtclub' ),
					'next_text' => __( 'Weiter &raquo;', 'fechtclub' ),
				)
			);
			if ( $fck_links ) :
				?>
				<nav class="pagination" aria-label="<?php esc_attr_e( 'Beiträge', 'fechtclub' ); ?>">
					<div class="nav-links"><?php echo $fck_links; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- von Core escaped. ?></div>
				</nav>
				<?php
			endif;
		elseif ( $fck_show_more && '' !== $fck_more_url ) :
			$fck_more_label = '' !== trim( $fck_more_label ) ? $fck_more_label : __( 'Mehr News', 'fechtclub' );
			?>
			<p class="fck-news__more">
				<a class="button button--outline" href="<?php echo esc_url( $fck_more_url ); ?>"><?php echo esc_html( $fck_more_label ); ?></a>
			</p>
			<?php
		endif;
		?>
	</div>
</section>
<?php
wp_reset_postdata();
