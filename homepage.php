<?php
/*
Template Name: Homepage
*/
get_header(); ?>

			<div id="sections" class="clearfix">

				<div class="page-title page-title-portfolio">
					<?php if ( get_option( 'slate_theme_customizer_main_title' ) ) { ?>
						<h2><?php echo get_option( 'slate_theme_customizer_main_title', '' ) ;?></h2>
					<?php } ?>

					<?php if ( get_option( 'slate_theme_customizer_sub_title' ) ) { ?>
						<h3><?php echo get_option( 'slate_theme_customizer_sub_title', '' ) ;?></h3>
					<?php } ?>
				</div>

				<?php
				// Home page slider
				if ( 'enabled' == get_option( 'slate_theme_customizer_enable_slider', 'enabled' ) ) {
					get_template_part( 'content', 'home-slider' );
				}

				// Home page services
				if ( 'enabled' == get_option( 'slate_theme_customizer_enable_services', 'enabled' ) ) {
					get_template_part( 'content', 'home-services' );
				}

				// Home page portfolio
				if ( 'enabled' == get_option( 'slate_theme_customizer_enable_portfolio', 'enabled' ) ) {
					get_template_part( 'content', 'home-portfolio' );
				}

				// Home page blog posts
				if ( 'enabled' == get_option( 'slate_theme_customizer_enable_blog', 'enabled' ) ) {
					get_template_part( 'content', 'home-blog' );
				}

				// Home page testimonials
				if ( 'enabled' == get_option( 'slate_theme_customizer_enable_testimonials', 'enabled' ) ) {
					get_template_part( 'content', 'home-testimonials' );
				} ?>

			</div><!-- sections -->

<?php get_footer();
