<?php
/**
 * Page not found template.
 *
 * @package Slate
 * @since Slate 1.0
 */
get_header(); ?>
				<div class="container">
					<div class="page-title">
						<h2><?php _e( '404', 'slate' ); ?></h2>
						<h3><?php _e( 'This page was not found.', 'slate' ); ?></h3>
					</div>

					<div class="content content-full">
						<div class="blog_entry">
							<div class="search-404">
								<?php _e( 'Sorry, but the page you are looking for has moved or no longer exists. Please use the search below, or the menu above to locate the missing page.', 'slate' ); ?>
								<?php get_search_form(); ?>
							</div>
						</div><!-- blog entry -->
					</div><!-- content -->
				</div><!-- container -->

<?php get_footer();
