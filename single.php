<?php
/**
 * Einzelner Beitrag.
 *
 * Geteilter Kopf (Titel/Meta links, Beitragsbild rechts, im Hero-Stil),
 * darunter der Artikeltext. Das dunkle Standard-Titelbanner entfällt hier
 * zugunsten dieses Beitrags-Kopfs.
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<header class="post-hero">
		<div class="post-hero__inner">
			<div class="post-hero__text">
				<?php
				$fck_cats = get_the_category();
				if ( ! empty( $fck_cats ) ) :
					?>
					<p class="post-hero__eyebrow"><?php echo esc_html( $fck_cats[0]->name ); ?></p>
				<?php endif; ?>
				<h1 class="post-hero__title"><?php the_title(); ?></h1>
				<p class="post-hero__meta"><?php echo esc_html( get_the_date() ); ?></p>
			</div>
			<?php
			if ( has_post_thumbnail() ) :
				// Titelbild als Core-Bild-Block ausgeben, damit es dieselbe native
				// Lightbox erhält wie die Inhaltsbilder (der render_block_data-Filter
				// aktiviert sie auf Einzelbeiträgen).
				$fck_thumb_id  = get_post_thumbnail_id();
				$fck_thumb_img = wp_get_attachment_image( $fck_thumb_id, 'large', false, array( 'class' => 'wp-image-' . (int) $fck_thumb_id ) );
				$fck_thumb_blk = sprintf(
					'<!-- wp:image {"id":%1$d,"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large">%2$s</figure><!-- /wp:image -->',
					(int) $fck_thumb_id,
					$fck_thumb_img
				);
				?>
				<div class="post-hero__media"><?php echo do_blocks( $fck_thumb_blk ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Core rendert/escaped den Bild-Block. ?></div>
				<?php
			endif;
			?>
		</div>
	</header>

	<main class="site-main">
		<div class="wrap">
			<article <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
			$fck_news_page = fck_news_page_id();
			if ( $fck_news_page && get_permalink( $fck_news_page ) ) :
				/* translators: %s: Titel der News-Seite (z. B. „News“). */
				$fck_back_label = sprintf( __( 'Mehr %s', 'fechtclub' ), get_the_title( $fck_news_page ) );
				?>
				<p class="post-nav-back">
					<a class="button button--outline" href="<?php echo esc_url( get_permalink( $fck_news_page ) ); ?>"><?php echo esc_html( $fck_back_label ); ?></a>
				</p>
			<?php endif; ?>
		</div>
	</main>
	<?php
endwhile;

get_footer();
