<?php
/**
 * Slate functions
 *
 * @package Slate
 * @since Slate 1.0
 */

/* Set the content width */
if ( ! isset( $content_width ) )
	$content_width = 760; /* pixels */


if ( ! function_exists( 'slate_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @since Slate 1.0
 */
function slate_setup() {



	if ( is_admin() ) {

		/* Load Getting Started page and initialize EDD update class */
		require( get_template_directory() . '/includes/admin/getting-started/getting-started.php' );

		/* Load custom metabox */
		require( get_template_directory() . '/includes/admin/metabox/metabox.php' );

		/* Add extra post styles */
		require( get_template_directory() . '/includes/editor/add-styles.php' );
		add_editor_style();

	}

	/* Add Customizer settings */
	require( get_template_directory() . '/customizer.php' );

	/* Load widgets */
	require( get_template_directory() . '/includes/widgets/recent-widgets.php' );
	require( get_template_directory() . '/includes/widgets/text-column.php' );
	require( get_template_directory() . '/includes/widgets/recent-portfolio.php' );

	// Add support for legacy widgets
    add_theme_support( 'array_toolkit_legacy_widgets' );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Enable support for Post Thumbnails */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Default Thumb
	add_image_size( 'portfolio-image', 450, 309, true ); // Portfolio Block Image
	add_image_size( 'large-image', 980, 9999, false ); // Large Image
	add_image_size( 'sidebar-image', 400, 275, true ); // Sidebar Slider Image
	add_image_size( 'blog-image', 800, 9999, false ); // Blog Image
	add_image_size( 'blog-thumb', 360, 200, true ); // Blog Thumb

	/* Enable portfolio, gallery, slider and metabox */
	add_theme_support('array_themes_portfolio_support');
	add_theme_support('array_themes_gallery_support');
	add_theme_support('array_themes_slider_support');
	add_theme_support('array_themes_metabox_support');

	/* Custom Background Support */
	add_theme_support( 'custom-background' );

	/* Register Menu */
	register_nav_menus( array(
		'header' => __( 'Header Menu', 'slate' ),
		'footer' => __( 'Footer Menu', 'slate' ),
		'custom' => __( 'Custom Menu', 'slate' )
	) );

	/* Make theme available for translation */
	load_theme_textdomain( 'slate', get_template_directory() . '/languages' );

	/* Gallery Post Format */
	add_theme_support( 'post-formats', array( 'gallery' ) );

}
endif; // slate_setup
add_action( 'after_setup_theme', 'slate_setup' );


/* Load Scripts & Styles */
function slate_scripts_styles() {

	// Load Styles

	//Main Stylesheet
	wp_enqueue_style( 'slate-style', get_stylesheet_uri() );

	//Media Queries CSS
	wp_enqueue_style( 'media-queries-css', get_template_directory_uri() . "/media-queries.css", array( 'slate-style' ), '0.1', 'screen' );

	//Dark Stylesheet
	if ( get_option( 'slate_theme_customizer_color_scheme' ) == 'dark' ) {
		wp_enqueue_style( 'slate-style-dark', get_template_directory_uri() . "/style-dark.css", array(), '0.1', 'screen' );
	}

	//Add Flexslider Styles
	wp_enqueue_style( 'flex-css', get_template_directory_uri() . '/includes/js/flex/flexslider.css', array(), '0.1', 'screen' );

	//Font Awesome CSS
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . "/includes/fonts/fontawesome/font-awesome.min.css", array(), '4.3.0', 'screen' );

	//Google Merriweather Font
	wp_enqueue_style( 'google-merriweather', '//fonts.googleapis.com/css?family=Merriweather:400,700' );

	// Load Scripts

	// Comment Reply Script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Custom JS
	wp_enqueue_script('custom-js', get_template_directory_uri() . '/includes/js/custom/custom.js', array( 'jquery' ), '20130731', true );

	//Localize custom-js
	wp_localize_script('custom-js', 'custom_js_vars', array(
			'flexslider_auto' => get_option( 'slate_theme_customizer_slider_auto' )
		)
	);

	//Flex
	wp_enqueue_script( 'flex-js', get_template_directory_uri() . '/includes/js/flex/jquery.flexslider.js', array( 'jquery' ), '20130731', true );

	//Tabs
	wp_enqueue_script( 'tabs-js', get_template_directory_uri() . '/includes/js/tabs/jquery.tabs.min.js', array( 'jquery' ), '20130731', true );

	//Fitvid
	wp_enqueue_script( 'fitvid-js', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', array( 'jquery' ), '20130731', true );

	//Mobile Menu
	wp_enqueue_script( 'mobile-js', get_template_directory_uri() . '/includes/js/menu/jquery.mobilemenu.js', array( 'jquery' ), '20130731', true );

}
add_action( 'wp_enqueue_scripts', 'slate_scripts_styles' );


/* Add Customizer CSS To Header */
function slate_customizer_css() {
	?>
	<style type="text/css">
		a {
			color: <?php echo get_theme_mod( 'slate_theme_customizer_link', '#60BDDB' ); ?>;
		}

		<?php echo get_theme_mod( 'slate_theme_customizer_css', '' ); ?>
	</style>
	<?php
}
add_action('wp_head', 'slate_customizer_css');


/* Pagination */
function slate_page_has_nav() {
	// Return early if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	} ?>

	<div class="blog-navigation">

		<?php if( get_next_posts_link() ) : ?>
		<div class="alignleft"><?php next_posts_link( __( 'Older Posts', 'slate' ) ) ?></div>
		<?php endif; ?>

		<?php if( get_previous_posts_link() ) : ?>
		<div class="alignright"><?php previous_posts_link( __( 'Newer Posts', 'slate' ) ) ?></div>
		<?php endif; ?>

	</div>
	<?php
}


/* Register Widget Areas */
register_sidebar( array(
	'name' 			=> __( 'Header Toggle Icons', 'slate' ),
	'id'            => 'header-toggle-icons',
	'description' 	=> __( 'This section is for the social media icons widget provided by the Array Toolkit.', 'slate' ),
	'before_widget' => '<div id="%1$s" class="%2$s">',
	'after_widget' 	=> '</div>'
) );

register_sidebar( array(
	'name' 			=> __( 'Services Text Columns', 'slate' ),
	'id'            => 'services-text-columns',
	'description' 	=> __( 'This section is for the Services section on the homepage.', 'slate' ),
	'before_widget' => '<div id="%1$s" class="column %2$s">',
	'after_widget' 	=> '</div>'
) );

register_sidebar( array(
	'name' 			=> __( 'Testimonials', 'slate' ),
	'id'            => 'testimonials',
	'description' 	=> __( 'Widgets in this area will be shown on the left side of the note area on the homepage.', 'slate' ),
	'before_widget' => '<li id="%1$s" class="%2$s">',
	'after_widget' 	=> '</li>'
) );

register_sidebar( array(
	'name' 			=> __( 'Sidebar', 'slate' ),
	'id'            => 'sidebar',
	'description' 	=> __( 'Widgets in this area will be shown on the sidebar of all pages.', 'slate' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' 	=> '</div>',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>'
) );

register_sidebar( array(
	'name' 			=> __( 'Footer', 'slate' ),
	'id'            => 'footer',
	'description' 	=> __( 'Widgets in this area will be shown own on the left side of the footer of all pages.', 'slate' ),
	'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
	'after_widget' 	=> '</div>'
) );


/* Custom Comment Output */
function slate_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">

		<div class="comment-block" id="comment-<?php comment_ID(); ?>">
			<div class="comment-info">
				<div class="comment-author vcard clearfix">
					<?php echo get_avatar( $comment->comment_author_email, 35 ); ?>

					<div class="comment-meta commentmetadata">
						<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ) ?>
						<div class="clear"></div>
						<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __( '%1$s at %2$s', 'slate' ), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'slate' ), '  ','' ) ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="comment-text">
				<?php comment_text() ?>
				<p class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
				</p>
			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'slate' ) ?></em>
			<?php endif; ?>
		</div>
<?php
}


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function slate_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'slate' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'slate_wp_title', 10, 2 );


/**
 * Deletes transient cache entries when posts are
 * saved, trashed, or deleted.
 */
function slate_delete_transients() {

	delete_transient( 'slate_slider_posts' );
	delete_transient( 'slate_home_portfolio_posts' );
	delete_transient( 'slate_home_blog_posts' );
}
add_action( 'save_post',     'slate_delete_transients' );
add_action( 'wp_trash_post', 'slate_delete_transients' );
add_action( 'delete_post',   'slate_delete_transients' );



/**
 * Modifies the post query on portfolio archive views.
 */
function slate_portfolio_archive_query( $query ) {

	if ( is_post_type_archive( 'array-portfolio' ) )
		{ $query->set( 'posts_per_page', 12 ); }
}
add_action( 'pre_get_posts', 'slate_portfolio_archive_query' );
