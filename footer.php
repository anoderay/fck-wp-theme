<?php
/**
 * Fußbereich: schließt das Dokument.
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="site-footer">
	<div class="site-footer__inner">
		<p class="site-footer__brand"><?php bloginfo( 'name' ); ?></p>
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'site-footer__menu',
					'container'      => false,
					'depth'          => 1,
				)
			);
		}
		?>
		<p class="site-footer__copy">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
