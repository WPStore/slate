<?php
/*
Template Name: Portfolio
*/
get_header();?>

				<div class="container">
					<div class="portfolio-big-title">
						<?php if ( get_option( 'slate_theme_customizer_portfolio_page_title' ) ) { ?>
							<h2><?php echo get_option( 'slate_theme_customizer_portfolio_page_title' ); ?></h2>
						<?php } ?>

						<?php if ( get_option( 'slate_theme_customizer_portfolio_page_sub_title' ) ) { ?>
							<h3><?php echo get_option( 'slate_theme_customizer_portfolio_page_sub_title' ); ?></h3>
						<?php } ?>
					</div>

					<div class="portfolio-blocks-wrap">
						<ul class="portfolio-blocks">

						<?php
						$portfolio_posts = new WP_Query(
							array(
								'posts_per_page' => 14,
								'paged'          => get_query_var( 'paged' ),
								'post_type'      => 'array-portfolio'
							)
						);

						// Counter for determining which image to display
						$count = 0;

						if ( $portfolio_posts->have_posts() ) : while( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();

						// Increment the counter and set the image size
						$count++;
						$image_size = ( $count == 1 ) ? 'large-image' : 'portfolio-image'; ?>

							<li class="portfolio-block">
								<div class="portfolio-block-inside">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="portfolio-small-image"><?php the_post_thumbnail( $image_size ); ?></a>
								</div>
							</li>


						<?php endwhile; endif; ?>
						</ul>
					</div><!-- portfolio blocks wrap -->

					<!-- post navigation -->
					<?php if ( $portfolio_posts->max_num_pages > 1 ) : ?>
						<div class="portfolio-navigation">
							<div class="alignleft">
								<?php next_posts_link( __( 'Older Entries', 'slate' ) , $portfolio_posts->max_num_pages) ?>
							</div>
							<div class="alignright">
								<?php previous_posts_link(__( 'Newer Entries', 'slate' ), $portfolio_posts->max_num_pages) ?>
							</div>
						</div>
					<?php endif; //post navigation ?>

				</div><!-- container -->

<?php get_footer();
