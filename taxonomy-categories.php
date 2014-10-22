<?php
/**
 * Template for displaying Portfolio category archives.
 */

 get_header();?>

				<div class="container">
					<div class="page-title">
						<h2><?php _e( 'Category', 'slate' ); ?>: <?php single_cat_title(); ?></h2>
					</div>

					<div class="portfolio-full">
						<div class="portfolio-blocks-wrap">
							<ul class="portfolio-blocks">
		                    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				                    <li class="portfolio-block">
			                    		<div class="portfolio-block-inside">
			                    			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="portfolio-small-image"><?php the_post_thumbnail( 'portfolio-image' ); ?></a>
			                    		</div>
									</li>

								<?php endwhile; ?>
								<?php endif; ?>

								<?php slate_page_has_nav(); ?>
		                    </ul>
						</div><!-- portfolio blocks wrap -->
					</div><!-- content -->
				</div><!-- container -->

<?php get_footer(); ?>