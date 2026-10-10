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
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-hero__media"><?php the_post_thumbnail( 'large' ); ?></div>
			<?php endif; ?>
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
			$fck_posts_page = (int) get_option( 'page_for_posts' );
			if ( $fck_posts_page && get_permalink( $fck_posts_page ) ) :
				/* translators: %s: Titel der Beitragsseite (z. B. „News“). */
				$fck_back_label = sprintf( __( 'Mehr %s', 'fechtclub' ), get_the_title( $fck_posts_page ) );
				?>
				<p class="post-nav-back">
					<a class="button" href="<?php echo esc_url( get_permalink( $fck_posts_page ) ); ?>"><?php echo esc_html( $fck_back_label ); ?></a>
				</p>
			<?php endif; ?>
		</div>
	</main>
	<?php
endwhile;

get_footer();
