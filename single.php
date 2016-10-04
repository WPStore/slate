<?php
/**
 * The template for displaying all single posts.
 *
 * @package Slate
 * @since 4.0
 */
get_header(); ?>

			<div class="container">
				<div class="page-title">
					<h2><?php single_post_title(); ?></h2>
					<?php
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

					<div class="blog-navigation">
						<div class="alignleft"><?php previous_post_link('%link', __( 'Previous Post', 'slate' ), TRUE); ?></div>
						<div class="alignright"><?php next_post_link('%link', __( 'Next Post', 'slate' ), TRUE); ?></div>
					</div>

					<!-- Post navigation -->
					<?php slate_page_has_nav(); ?>

					<!-- Comments -->
						<?php if ('open' == $post->comment_status) { ?>
							<div class="comments">
								<?php comments_template(); ?>
							</div>
						<?php } ?>

					<?php endif; ?>

					<?php wp_reset_query(); ?>

				</div><!-- content -->

				<?php get_sidebar(); ?>
		</div><!-- container -->

<?php get_footer();
