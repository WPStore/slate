<?php
/**
 * Template part for displaying home page testimonials.
 * @since 4.0
 */
 ?>
					<!-- Testimonials -->
					<div class="section section-testimonials">
						<?php if ( get_option( 'slate_theme_customizer_testimonial_title' ) ) { ?>
							<div class="section-title">
								<span>
									<?php echo get_option( 'slate_theme_customizer_testimonial_title' ); ?>
								</span>
							</div>
						<?php } ?>

						<div id="testimonial-slider" class="flexslider">
							<ul class="testimonials slides">
								<?php dynamic_sidebar( 'testimonials' ); ?>
							</ul>
						</div>
					</div><!-- testimonial section -->