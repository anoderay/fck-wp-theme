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

$fck_count   = isset( $attributes['count'] ) ? max( 1, (int) $attributes['count'] ) : 3;
$fck_heading = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : '';

$fck_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => $fck_count,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

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
		$fck_posts_page = (int) get_option( 'page_for_posts' );
		if ( $fck_posts_page && get_permalink( $fck_posts_page ) ) :
			?>
			<p class="fck-news__more">
				<a class="button button--outline" href="<?php echo esc_url( get_permalink( $fck_posts_page ) ); ?>"><?php esc_html_e( 'Mehr News', 'fechtclub' ); ?></a>
			</p>
		<?php endif; ?>
	</div>
</section>
<?php
wp_reset_postdata();
