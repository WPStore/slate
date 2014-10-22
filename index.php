<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Slate
 * @since Slate 1.0
 */
get_header(); ?>

			<div class="container">
				<div class="page-title">
					<h2><?php single_post_title(); ?></h2>
					<?php
						$page_object = get_queried_object();
						$page_id = get_queried_object_id();
						if ( get_post_meta( $page_id, 'subtitle', true ) ) {
							echo '<h3>' . get_post_meta( $page_id, 'subtitle', true ) . '</h3>';
						}
					?>
				</div>

				<div class="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post clearfix'); ?>>
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div><!-- blog post -->

					<?php endwhile; ?>

					<!-- Next post navigation for single pages -->
					<?php if ( is_single() ) { ?>
						<div class="blog-navigation">
							<div class="alignleft"><?php previous_post_link('%link', 'Previous Post', TRUE); ?></div>
							<div class="alignright"><?php next_post_link('%link', 'Next Post', TRUE); ?></div>
						</div>
					<?php } ?>

					<!-- Post navigation -->
					<?php slate_page_has_nav(); ?>

					<!-- Comments -->
					<?php if( is_single() ) { ?>
						<?php if ('open' == $post->comment_status) { ?>
							<div class="comments">
								<?php comments_template(); ?>
							</div>
						<?php } ?>
					<?php } ?>

					<?php endif; ?>

					<?php wp_reset_query(); ?>

				</div><!-- content -->

				<?php get_sidebar(); ?>
		</div><!-- container -->

<?php get_footer(); ?>