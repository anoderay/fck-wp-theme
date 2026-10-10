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
	<noscript>
		<style>
			/* Ohne JavaScript lässt sich das mobile Menü nicht aufklappen –
			   daher dauerhaft (gestapelt) zeigen und den Toggle ausblenden. */
			@media (max-width: 860px) {
				.site-nav ul {
					display: flex !important;
					position: static;
					flex-direction: column;
					max-height: none;
					overflow: visible;
					opacity: 1;
					transform: none;
					pointer-events: auto;
				}
				.site-nav__toggle { display: none; }
			}
		</style>
	</noscript>
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
					// Nur relevant für den Fallback (wp_page_menu): Startseite ausblenden.
					'exclude'        => (int) get_option( 'page_on_front' ),
				)
			);
			?>
		</nav>

		<?php
		$fck_cta_url  = home_url( '/probetraining' );
		$fck_cta_page = (int) get_theme_mod( 'fck_cta_page', 0 );
		if ( $fck_cta_page && get_permalink( $fck_cta_page ) ) {
			$fck_cta_url = get_permalink( $fck_cta_page );
		}
		$fck_cta_label = get_theme_mod( 'fck_cta_label', __( 'Kostenloses Probetraining', 'fechtclub' ) );
		?>
		<a class="site-header__cta button" href="<?php echo esc_url( $fck_cta_url ); ?>">
			<?php echo esc_html( $fck_cta_label ); ?>
		</a>

	</div>
</header>
