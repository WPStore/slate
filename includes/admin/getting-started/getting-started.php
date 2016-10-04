<?php
/**
 * This template adds the Getting Started page, license settings and the theme updater.
 *
 * @package WordPress
 * @subpackage Slate
 */


/**
 * Add Getting Started menu item
 */
function slate_license_menu() {
	add_theme_page( __( 'Getting Started', 'slate' ), __( 'Getting Started', 'slate' ), 'manage_options', 'slate-getting-started', 'slate_getting_started_page' );
}
add_action('admin_menu', 'slate_license_menu');


/**
 * Load Getting Started styles in the admin
 */
function slate_start_load_admin_scripts() {

	// Load styles only on our page
	global $pagenow;
	if( 'themes.php' != $pagenow )
		return;

	// Getting started script and styles
	wp_enqueue_script( 'getting-started', get_template_directory_uri() . '/includes/admin/getting-started/getting-started.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'getting-started-fitvid', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', array( 'jquery' ), '1.0.3', true );
	wp_register_style( 'getting-started', get_template_directory_uri() . '/includes/admin/getting-started/getting-started.css', false, '1.0.0' );
	wp_enqueue_style( 'getting-started' );

	// Thickbox
	add_thickbox();
}
add_action( 'admin_enqueue_scripts', 'slate_start_load_admin_scripts' );


/**
 * Create the Getting Started page and settings
 */
function slate_getting_started_page() {

	// Theme info
	$theme              = wp_get_theme( 'slate' );

	// Lowercase theme name for resources links
	$theme_name_lower   = get_template();

	// Grab the change log from array.is for display in the Latest Updates tab
	$changelog = wp_remote_get( 'https://array.is/themes/slate-wordpress-theme/changelog/' );
	if( $changelog && !is_wp_error( $changelog ) ) {
		$changelog = $changelog['body'];
	} else {
		$changelog = __( 'There seems to be a problem retrieving the latest updates information from Array. Please check back later.', 'slate' );
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
				<h2><?php printf( __( 'Getting started with %1$s v%2$s', 'slate' ), $theme['Name'], $theme['Version'] ); ?></h2>

				<h3><?php printf( __( 'Thanks for purchasing %1$s! We truly appreciate the support and the opportunity to share our work with you. Please visit the tabs below to get started setting up your theme!', 'slate' ), $theme['Name'] ); ?></h3>
			</div>
		</div>

		<div class="panels">
			<ul class="inline-list">
				<span class="inline-list-links">
					<li class="current"><a id="help" href="#"><?php _e( 'Help File', 'slate' ); ?></a></li>
					<li class="license-tab"><a id="license" href="#"><?php _e( 'License', 'slate' ); ?></a></li>
					<li><a id="updates" href="#"><?php _e( 'Latest Updates', 'slate' ); ?></a></li>
				</span>
				<li>
					<a href="http://array.is/support/forum/<?php echo $theme_name_lower; ?>" title="<?php esc_attr_e( __( 'View support forum', 'slate' ) ); ?>"><?php _e( 'Support Forum &rarr;', 'slate' ); ?></a>
				</li>
			</ul>

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

					<div class="panel-aside">
						<h4><?php _e( 'Visit the Knowledge Base', 'slate' ); ?></h4>
						<p><?php _e( 'New to the WordPress world? Our Knowledge Base has over 20 video tutorials, from installing WordPress to working with themes and more.', 'slate' ); ?></p>

						<a class="button button-primary" href="https://array.is/articles/" title="<?php esc_attr_e( __( 'Visit the knowledge base', 'slate' ) ); ?>"><?php _e( 'Visit the Knowledge Base', 'slate' ); ?></a>
					</div>
				</div>
			</div><!-- #help-panel -->

			<!-- License panel -->
			<div id="license-panel" class="panel clearfix">
				<div class="panel-left">
					<p>
					</p>
				</div><!-- .panel-left -->

				<div class="panel-right">
					<div class="panel-aside">
					</div>
				</div><!-- .panel-right -->
			</div><!-- #license-panel -->

			<!-- Updates panel -->
			<div id="updates-panel" class="panel">
				<div class="panel-left">
					<h3><?php _e( 'Latest Theme Updates', 'slate' ); ?></h3>
					<p><?php echo $changelog; ?></p>
				</div><!-- .panel-left -->
			</div><!-- #updates-panel -->
		</div><!-- .panels -->
	</div><!-- .getting-started -->

	<?php
}

/**
 * Getting Started notice
 */

function slate_getting_started_notice() {
	global $current_user;
	$user_id = $current_user->ID;

	// Getting Started URL
	$getting_started_url = admin_url( 'themes.php?page=slate-getting-started' );

	if ( ! get_user_meta( $user_id, 'slate_getting_started_ignore_notice' ) ) {
		echo '<div class="updated"><p>';

		printf( __( ' %1$s activated! Visit the <a href="%2$s">Getting Started</a> page to view the help file, install the Array Toolkit or ask us a question. ', 'slate' ), wp_get_theme(), esc_url( $getting_started_url ) );

		printf( __( '<a href="%1$s">Hide this notice</a>', 'slate' ), '?slate_getting_started_nag_ignore=0' );

		echo "</p></div>";
	}
}
add_action( 'admin_notices', 'slate_getting_started_notice' );


function slate_getting_started_nag_ignore() {
	global $current_user;
		$user_id = $current_user->ID;
		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset( $_GET['slate_getting_started_nag_ignore'] ) && '0' == $_GET['slate_getting_started_nag_ignore'] ) {
			 add_user_meta( $user_id, 'slate_getting_started_ignore_notice', 'true', true );
	}
}
add_action( 'admin_init', 'slate_getting_started_nag_ignore' );
