<?php
/**
 * Template for displaying the footer.
 *
 * @package Slate
 * @since 1.0
 */
?>
	<div class="footer-wrap">
		<div class="footer">
			<?php if ( is_active_sidebar( 'footer' ) ) { ?>
				<div class="footer-widgets clearfix">
					<div class="footer-widgets-wrap clearfix">
						<?php dynamic_sidebar( 'footer' ); ?>
					</div>
				</div>
			<?php } ?>

			<div class="footer-text">
				<div class="footer-text-left">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'nav-footer' ) ); ?>
				</div>

				<div class="footer-text-right">
					<div class="copyright">&copy; <?php echo date("Y"); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a> | <?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?></div>
				</div>
			</div>
		</div><!-- footer -->
	</div><!-- footer wrap -->
</div><!-- main wrapper -->

<?php wp_footer(); ?>

</body>
</html>