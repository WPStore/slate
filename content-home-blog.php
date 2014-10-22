<?php
/**
 * Template part for displaying home page blog posts.
 * @since 4.0
 */
 ?>
					<!-- Blog -->
					<div class="section section-blog">
						<?php if ( get_option( 'slate_theme_customizer_blog_title' ) ) { ?>
							<div class="section-title">
								<span>
										<?php echo get_option( 'slate_theme_customizer_blog_title' ); ?>
								</span>
							</div>
						<?php } ?>

						<div class="home-blog clearfix">
							<ul>
								<?php
								// Check for cached blog posts
								$home_blog_query = get_transient( 'slate_home_blog_posts' );

								if( false === $home_blog_query ) {
									// No blog posts in cache
									$home_blog_args = array(
										'posts_per_page' => 3
										);
									$home_blog_query = new WP_Query( $home_blog_args );

									// Save blog posts to cache for one hour
									set_transient( 'slate_home_blog_posts', $home_blog_query, 3600 );
								}

								while( $home_blog_query->have_posts() ) : $home_blog_query->the_post() ?>
									<li class="home-blog-post">
										<div class="blog-thumb">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_post_thumbnail( 'blog-thumb' ); ?>
											</a>
										</div>

										<div class="blog-title">
											<div class="big-comment">
												<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											</div>

											<p class="home-blog-post-meta"><?php echo get_the_date(); ?></p>
										</div>

										<div class="excerpt">
											<?php the_excerpt(); ?>
										</div>

										<div class="blog-read-more">
											<a href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'slate' ); ?></a>
										</div>
									</li>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							  </ul>
						</div><!-- home blog -->
					</div><!-- blog section -->