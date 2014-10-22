<?php
/*
Template Name: Full-Width
*/
get_header(); ?>

				<div class="container">
						<div class="page-title">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<?php if ( get_post_meta( $post->ID, 'subtitle', true ) ) { ?>
								<h3><?php echo get_post_meta( $post->ID, 'subtitle', true ); ?></h3>
							<?php } ?>
						</div>

						<div class="content content-full">

							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<div class="blog_entry">
								<?php if ( '' != get_the_post_thumbnail() ) { ?>
								<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'full-image' ); ?></a>
								<?php } ?>

								<?php the_content(''); ?>
							</div><!-- blog entry -->

							<?php endwhile; ?>
							<?php endif; ?>

						</div><!-- content -->
				</div><!-- container -->

<?php get_footer(); ?>