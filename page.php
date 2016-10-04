<?php
/**
 * Template for displaying pages.
 *
 * @package Slate
 * @since 1.0
 */
get_header(); ?>
				<div class="container">
					<div class="page-title">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<?php if ( get_post_meta( $post->ID, 'subtitle', true ) ) { ?>
							<h3><?php echo get_post_meta( $post->ID, 'subtitle', true ); ?></h3>
						<?php } ?>
					</div>

					<div class="content">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div class="blog_entry">
							<?php if ( get_post_meta( $post->ID, 'arrayvideo', true ) ) { ?>
								<div class="arrayvideo">
									<?php echo get_post_meta( $post->ID, 'arrayvideo', true ); ?>
								</div>
							<?php } else { ?>

								<?php if ( '' != get_the_post_thumbnail() ) { ?>
									<a class="blog-image" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'blog-image' ); ?></a>
								<?php }

							}

							the_content();
							wp_link_pages(); ?>
						</div><!-- blog entry -->

						<?php endwhile; ?>
						<?php endif; ?>

					</div><!-- content -->
					<?php get_sidebar(); ?>
				</div><!-- container -->

<?php get_footer();
