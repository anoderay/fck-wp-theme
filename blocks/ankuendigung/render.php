<?php
/**
 * Serverseitige Ausgabe des Blocks „Ankündigungen“.
 *
 * Zeigt veröffentlichte Beiträge der Ankündigungs-Kategorie als klickbare
 * Einzeiler (Titel fett, dahinter der gekürzte Auszug). Gibt es keine, wird
 * nichts ausgegeben – das Band verschwindet dann vollständig. Veröffentlichen
 * bzw. auf Entwurf stellen ist damit der Ein-/Aus-Schalter.
 *
 * Verfügbar: $attributes, $content, $block.
 */

defined( 'ABSPATH' ) || exit;

// Im Block gewählte Kategorie hat Vorrang; sonst die Standard-Ankündigungs-
// kategorie (siehe fck_announcement_category_id()).
$fck_cat = isset( $attributes['category'] ) ? (int) $attributes['category'] : 0;
if ( $fck_cat <= 0 ) {
	$fck_cat = fck_announcement_category_id();
}

// Ohne (eingerichtete) Kategorie nichts ausgeben.
if ( ! $fck_cat ) {
	return;
}

$fck_count = isset( $attributes['count'] ) ? (int) $attributes['count'] : 0;
$fck_words = isset( $attributes['maxWords'] ) ? max( 4, (int) $attributes['maxWords'] ) : 18;

$fck_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'cat'                 => $fck_cat,
		'posts_per_page'      => $fck_count > 0 ? $fck_count : -1,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

// Keine veröffentlichten Ankündigungen → Band ausblenden.
if ( ! $fck_query->have_posts() ) {
	wp_reset_postdata();
	return;
}

$fck_wrapper = get_block_wrapper_attributes( array( 'class' => 'fck-section fck-ankuendigung' ) );
?>
<section <?php echo $fck_wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- von Core escaped. ?>>
	<ul class="fck-ankuendigung__inner alignwide">
		<?php
		while ( $fck_query->have_posts() ) :
			$fck_query->the_post();
			$fck_text = wp_trim_words( get_the_excerpt(), $fck_words, '…' );
			?>
			<li class="fck-ankuendigung__item">
				<a class="fck-ankuendigung__link" href="<?php the_permalink(); ?>">
					<strong class="fck-ankuendigung__title"><?php the_title(); ?></strong>
					<?php if ( '' !== trim( $fck_text ) ) : ?>
						<span class="fck-ankuendigung__text"><?php echo esc_html( $fck_text ); ?></span>
					<?php endif; ?>
				</a>
			</li>
		<?php endwhile; ?>
	</ul>
</section>
<?php
wp_reset_postdata();
