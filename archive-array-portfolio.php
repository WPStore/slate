<?php
/**
 * Template for displaying Portfolio archives.
 */

 get_header();?>

				<div class="container">
						<div class="portfolio-full archive-full">
							<div class="portfolio-blocks-wrap">
								<ul class="portfolio-blocks">
			                    	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					                    <li class="portfolio-block">
				                    		<div class="portfolio-block-inside">
				                    			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="portfolio-small-image"><?php the_post_thumbnail( 'portfolio-image' ); ?></a>
				                    		</div>
										</li>

									<?php endwhile; endif; ?>
									<?php wp_reset_postdata(); ?>

									<!-- post navigation -->

										<div class="portfolio-navigation">
											<div class="alignleft">
												<?php next_posts_link( __( 'Older Entries', 'slate' ) ) ?>
											</div>
											<div class="alignright">
												<?php previous_posts_link(__( 'Newer Entries', 'slate' ) ) ?>
											</div>
										</div>

			                    </ul>
							</div><!-- portfolio blocks wrap -->
						</div><!-- content -->
				</div><!-- container -->

<?php get_footer();
