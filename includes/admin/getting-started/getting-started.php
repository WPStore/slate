<?php
/**
 * @author    WP-Store.io <code@wp-store.io>
 * @copyright Copyright (c) 2016, WP-Store.io
 * @copyright Copyright (c) 2012-2016, Array
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   WPStore\Themes\Slate
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Adds the Getting Started page.
 */
class Slate_GettingStarted {

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 5.0.0
	 *
	 * @return void
	 */
	public function __construct() {

		add_action( 'admin_init',            array( $this, 'redirect_on_activation' ) );
		add_action( 'admin_menu',            array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ) );
		
	} // END __construct()

	/**
	 * Add Getting Started menu item
	 */
	public function admin_menu() {
		add_theme_page(
			__( 'About Slate', 'slate' ),
			__( 'About Slate', 'slate' ),
			'manage_options',
			'about-slate',
			array( $this, 'page' )
		);
	} // END add_page()

	/**
	 * Load Getting Started styles in the admin
	 */
	public function load_admin_scripts() {

		// Load styles only on our page
		global $pagenow;
		if ( 'themes.php' != $pagenow )
			{ return; }

		// Getting started script and styles
		wp_enqueue_script( 'getting-started', get_template_directory_uri() . '/includes/admin/getting-started/getting-started.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'getting-started-fitvid', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', array( 'jquery' ), '1.0.3', true );
		wp_register_style( 'getting-started', get_template_directory_uri() . '/includes/admin/getting-started/getting-started.css', false, '1.0.0' );
		wp_enqueue_style( 'getting-started' );

		// Thickbox
		add_thickbox();

	} // END load_admin_scripts()

	/**
	 * Redirect to Getting Started page on theme activation
	 *
	 * @since 5.0.0
	 * @author Array <https://arraythemes.com/>
	 *
	 */
	public function redirect_on_activation() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

			wp_redirect( admin_url( "themes.php?page=about-slate" ) );

		}
	} // END redirect_on_activation()

	/**
	 * Create the Getting Started page and settings
	 */
	public function page() {

		// Theme info
		$theme              = wp_get_theme( 'slate' );

		// Lowercase theme name for resources links
		$theme_name_lower   = get_template();

		// Grab the CHANGELOG and parse proper HTML output
		$changelog = wp_remote_get( 'https://gitlab.com/wpstore-themes/slate/raw/master/CHANGELOG.md' );
		if( $changelog && !is_wp_error( $changelog ) ) {
			$changelog = $changelog['body'];
		} else {
			$changelog = __( 'There seems to be a problem retrieving the CHANGELOG from the GitLab repository. Please check back later.', 'slate' );
		}

		// Array Toolkit URL
		if( is_multisite() ) {
			$adminurl = network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=array-toolkit&TB_iframe=true&width=640&height=589' );
		} else {
			$adminurl = admin_url( 'plugin-install.php?tab=plugin-information&plugin=array-toolkit&TB_iframe=true&width=640&height=589' );
		}

		?>
		<div class="wrap getting-started">
			<div class="intro-wrap">
				<img class="theme-image" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" alt="" />
				<div class="intro">
					<h2><?php printf( __( 'Getting started with %1$s', 'slate' ), $theme['Name'] ); ?></h2>

					<h3><?php printf( __( 'Thanks for purchasing %1$s! We truly appreciate the support and the opportunity to share our work with you. Please visit the tabs below to get started setting up your theme!', 'slate' ), $theme['Name'] ); ?></h3>
				</div>
			</div>

			<div class="panels">
				<h2 class="nav-tab-wrapper wp-clearfix">
					<a class="nav-tab nav-tab-active" href="#"><?php _e( 'Help', 'slate' ); ?></a>
					<a class="nav-tab" href="#"><?php _e( 'License', 'slate' ); ?></a>
					<a class="nav-tab" href="#"><?php _e( 'Changelog', 'slate' ); ?></a>
					<a class="nav-tab" href="https://gitlab.com/wpstore-themes/slate/issues" title="<?php esc_attr_e( __( 'View/Open Issues on GitLab', 'slate' ) ); ?>" target="_blank"><?php _e( 'GitLab Issues &rarr;', 'slate' ); ?></a>
				</h2>

				<!-- Help file panel -->
				<div id="help-panel" class="panel visible clearfix">
					<div class="panel-left">
						<!-- Slate Install Video / will not load remotely via iframe -->

						<div class="arrayvideo">
							<iframe src="http://player.vimeo.com/video/61424358?title=0&amp;byline=0&amp;portrait=0" width="790" height="494" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>

						<!-- Grab feed of help file -->
						<?php
							include_once( ABSPATH . WPINC . '/feed.php' );

							$rss = fetch_feed( 'http://array.is/articles/' . $theme_name_lower . '/feed/?withoutcomments=1' );

							if ( ! is_wp_error( $rss ) ) :
								$maxitems = $rss->get_item_quantity( 1 );
								$rss_items = $rss->get_items( 0, $maxitems );
							endif;
						?>

						<!-- Output the feed -->
						<?php if ( is_wp_error( $rss ) ) : ?>
							<p><?php _e( 'This help file feed seems to be temporarily down. You can view the help file on Array in the mean time.', 'slate' ); ?> <a href="https://array.is/articles/<?php echo $theme_name_lower; ?>" title="View help file"><?php echo $theme['Name']; ?> <?php _e( 'Help File &rarr;', 'slate' ); ?></a></p>
						<?php else : ?>
							<?php foreach ( $rss_items as $item ) : ?>
								<?php echo $item->get_content(); ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<div class="panel-right">
						<!-- Check to see if theme requires the Array Toolkit -->
					<?php
						if( current_theme_supports( 'array_themes_portfolio_support' ) ||
							current_theme_supports( 'array_themes_gallery_support' ) ||
							current_theme_supports( 'array_themes_slider_support' ) ||
							current_theme_supports( 'array_themes_metabox_support' ) ) {

						if ( !class_exists( 'Array_Toolkit' ) ) { ?>
							<div class="panel-aside">

									<h4><?php _e( 'Install the Array Toolkit', 'slate' ); ?></h4>
									<p><?php _e( 'The Array Toolkit is a plugin that adds various features to your theme.', 'slate' ); ?> <?php echo $theme['Name']; ?> <?php _e( 'requires the Array Toolkit to enable the following features:', 'slate' ); ?></p>

									<ul>
										<?php if( current_theme_supports( 'array_themes_portfolio_support' ) ) { ?>
											<li><?php _e( 'Portfolio Items', 'slate' ); ?></li>
										<?php } ?>

										<?php if( current_theme_supports( 'array_themes_gallery_support' ) ) { ?>
											<li><?php _e( 'Custom Galleries', 'slate' ); ?></li>
										<?php } ?>

										<?php if( current_theme_supports( 'array_themes_slider_support' ) ||
												current_theme_supports( 'array_themes_metabox_support' ) ) { ?>
											<li><?php _e( 'Slider Items', 'slate' ); ?></li>
										<?php } ?>
									</ul>

									<a class="button button-primary thickbox onclick" href="<?php echo esc_url( $adminurl ); ?>" title="<?php esc_attr_e( __( 'Install Array toolkit', 'slate' ) ); ?>"><?php _e( 'Install Array Toolkit Plugin', 'slate' ); ?></a>

							</div>
						<?php } else {
							do_action( 'array_toolkit_getting_started_theme_page' );
						}
					} ?>
					</div>
				</div><!-- #help-panel -->

				<!-- License panel -->
				<div id="license-panel" class="panel clearfix">
					<div class="panel-left">
						<h3><?php _e( 'Slate is free and 100% GPL-licensed!', 'slate' ); ?></h3>
						<p>
							<?php _e( 'It was created by Array in 2012 and retired in 2015.', 'slate' ); ?>
							<?php _e( 'Picked up in 2016 by WPStore.io.', 'slate' ); ?>
						</p>
					</div><!-- .panel-left -->

					<div class="panel-right">
						<div class="panel-aside">
							<p><strong><?php _e( 'About WPStore.io', 'slate' ); ?></strong></p>
							<p><?php _e( '@TODO text about wpstore and why picking up this', 'slate' ); ?></p>
						</div>
						<div class="panel-aside">
							<p><strong><?php _e( 'Updating the theme', 'slate' ); ?></strong></p>
							<p><?php _e( 'The theme will be updated through GitLab.', 'slate' ); ?></p>
						</div>
					</div><!-- .panel-right -->
				</div><!-- #license-panel -->

				<!-- Updates panel -->
				<div id="updates-panel" class="panel">
					<div class="panel-left">
						<h3><?php _e( 'Slate Changelog', 'slate' ); ?></h3>
						<p><?php echo $changelog; ?></p>
					</div><!-- .panel-left -->
				</div><!-- #updates-panel -->
			</div><!-- .panels -->
		</div><!-- .getting-started -->
		<?php
	} // END page()

} // END class Slate_GettingStarted

new Slate_GettingStarted();
