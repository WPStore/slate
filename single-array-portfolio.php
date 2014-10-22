<?php
/**
 * Displays single portfolio items.
 *
 * @package Slate
 * @since 1.0
 */
get_header(); ?>

		<div class="container">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="page-title page-title-portfolio">
					<div class="portfolio-titles">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<?php if ( get_post_meta( $post->ID, 'subtitle', true ) ) { ?>
							<h3><?php echo get_post_meta( $post->ID, 'subtitle', true ) ?></h3>
						<?php } ?>
					</div>

					<div class="project-nav">
						<span class="prev-project"><?php previous_post_link( '%link', __( '<span><i class="icon-caret-left"></i> Previous</span>', 'slate' ) ) ?></span>
						<span class="next-project"><?php next_post_link( '%link', __( '<span>Next <i class="icon-caret-right"></i></span>', 'slate' ) ) ?></span>
					</div>
				</div>

				<!-- Get the video custom field -->
				<?php if ( get_post_meta( $post->ID, 'arrayvideo', true ) ) { ?>
					<div class="arrayvideo">
						<?php echo get_post_meta( $post->ID, 'arrayvideo', true ) ?>
					</div>
				<?php } else { ?>

					<!-- Otherwise, get the gallery -->
					<?php if ( 'gallery' == get_post_format() ) { ?>
						<?php if ( function_exists( 'array_gallery' ) ) { array_gallery(); } ?>
					<?php } else { ?>
						<!-- If there is no gallery, just show the featured image instead -->
						<div class="portfolio-big-slide">
							<!--Large Portfolio Item-->
							<div class="portfolio-block-large clearfix">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="portfolio-large-image"><?php the_post_thumbnail( 'large-image' ); ?></a>
							</div>
						</div>
					<?php } ?>
				<?php } ?>

				<div class="content content-tablet">
					<div class="blog-entry">
						<div class="blog-content">
							<?php the_content(); ?>
						</div><!-- blog content -->
					</div><!-- blog entry -->
				</div><!-- content -->

				<div class="portfolio-sidebar">
					<div class="portfolio-meta">
						<h3><?php _e( 'Details', 'slate' ); ?></h3>
						<ul class="portfolio-meta-links">
					    	<li>
					    		<span><?php _e( 'Date:', 'slate' ); ?></span>
					    		<?php echo get_the_date(); ?>
					    	</li>
					    	<?php echo get_the_term_list( $post->ID, 'categories', '<li><span>' . __( 'Category: ', 'slate' ) . '</span>', '<br/>', '</li>' ); ?>
					    </ul>
					</div><!-- portfolio meta -->
				</div><!-- sidebar -->

			<?php endwhile; ?>
			<?php endif; ?>
		</div><!-- container -->

		<!-- footer -->
		<?php get_footer(); ?>