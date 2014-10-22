<?php
/**
 * Template part for displaying home page portfolio items.
 * @since 4.0
 */
 ?>
					<!-- Portfolio -->
					<div class="section section-portfolio">
						<?php if ( get_option( 'slate_theme_customizer_portfolio_title_home' ) ) { ?>
							<div class="section-title">
								<span>
									<?php echo get_option( 'slate_theme_customizer_portfolio_title_home' ); ?>
								</span>
							</div>
						<?php } ?>

						<div class="portfolio-blocks-wrap">
							<ul class="portfolio-blocks">
								<?php
								// Check for cached portfolio posts
								$home_portfolio_query = get_transient( 'slate_home_portfolio_posts' );

								if ( false == $home_portfolio_query ) {
									// No portfolio posts in cache
									$home_portfolio_query_args = array(
										'posts_per_page' => 12,
										'post_type' => 'array-portfolio'
									);
									$home_portfolio_query = new WP_Query( $home_portfolio_query_args );

									// Save portfolio posts to cache for one hour
									set_transient( 'slate_home_portfolio_posts', $home_portfolio_query, 3600 );
								}

								while( $home_portfolio_query->have_posts() ) : $home_portfolio_query->the_post() ?>
									<li class="portfolio-block">
										<div class="portfolio-block-inside">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="portfolio-small-image"><?php the_post_thumbnail( 'portfolio-image' ); ?></a>
										</div>
									</li>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</ul>
						</div><!-- portfolio blocks wrap -->
					</div><!-- section -->