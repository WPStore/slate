<?php
/**
 * The template for display search result pages.
 *
 * @package Slate
 * @since 4.0
 */
get_header(); ?>

			<div class="container">
				<div class="page-title">
					<h2><?php printf( __( 'Search Results for: %s', 'slate' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</div>

				<div class="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post clearfix'); ?>>
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div><!-- blog post -->

					<?php endwhile; ?>

					<!-- Post navigation -->
					<?php slate_page_has_nav(); ?>

					<?php endif; ?>

				</div><!-- content -->

				<?php get_sidebar(); ?>
		</div><!-- container -->

<?php get_footer(); ?>