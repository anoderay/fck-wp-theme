<?php
/**
 * Kopfbereich: öffnet das Dokument und rendert die Kopfleiste mit
 * Logo, Hauptnavigation und CTA-Button.
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="site-header__inner">

		<div class="site-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<img src="<?php echo esc_url( get_theme_file_uri( 'assets/fck-logo.svg' ) ); ?>" width="150" height="57" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				</a>
			<?php endif; ?>
		</div>

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'fechtclub' ); ?>">
			<button class="site-nav__toggle" aria-expanded="false" aria-controls="primary-menu">
				<span class="screen-reader-text"><?php esc_html_e( 'Menü öffnen', 'fechtclub' ); ?></span>
				<span class="site-nav__icon" aria-hidden="true"></span>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'site-nav__menu',
					'container'      => false,
					'depth'          => 2,
					'fallback_cb'    => 'wp_page_menu',
				)
			);
			?>
		</nav>

		<a class="site-header__cta button" href="<?php echo esc_url( home_url( '/probetraining' ) ); ?>">
			<?php esc_html_e( 'Kostenloses Probetraining', 'fechtclub' ); ?>
		</a>

	</div>
</header>
