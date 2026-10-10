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
		</div>
	</main>
	<?php
endwhile;

get_footer();
