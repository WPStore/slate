<?php
/**
 * Template part for displaying home page slider.
 * @since 4.0
 */

					// Check for cached slider posts
					$slider_query = get_transient( 'slate_slider_posts' );

					if( false === $slider_query ) {
						// No slider posts in cache
						$slider_args = array(
							'posts_per_page' => 9,
							'post_type'      => 'array-slider'
							);
						$slider_query = new WP_Query( $slider_args );

						// Save slider posts to cache for one hour
						set_transient( 'slate_slider_posts', $slider_query, 3600 );
					}

					if ( $slider_query ) { ?>
						<!-- Intro Message -->
						<div class="section section-slider">
							<!-- Slides -->
							<div class="flexslider">
								<ul class="slides">
									<?php while( $slider_query->have_posts() ) : $slider_query->the_post() ?>
										<li>
											<?php
											if ( get_post_meta( $post->ID, '_cmb_slide_link', true ) ) {
												global $post;
												$slidelink = get_post_meta( $post->ID, '_cmb_slide_link', true );
											?>
											<a href="<?php echo esc_url( $slidelink ); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
											<?php
											} else {
												the_post_thumbnail( 'large-image' );
											} ?>
										</li>
									<?php endwhile;
									wp_reset_postdata(); ?>
								</ul>
							</div>
						</div><!-- slider section -->
					<?php } // $slider_query
