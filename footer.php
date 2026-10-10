<?php
/**
 * Fußbereich: schließt das Dokument.
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="site-footer">
	<div class="site-footer__inner">
		<a class="site-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<img src="<?php echo esc_url( get_theme_file_uri( 'assets/fck-logo-weiss.svg' ) ); ?>" width="160" height="61" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		</a>
		<?php
		if ( has_nav_menu( 'footernav' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'footernav',
					'menu_class'     => 'site-footer__menu',
					'container'      => false,
					'depth'          => 1,
				)
			);
		}
		?>
		<p class="site-footer__copy">
			<?php echo esc_html( get_theme_mod( 'fck_footer_copyright', '© Fechtclub Kassel e.V. ' . wp_date( 'Y' ) ) ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
