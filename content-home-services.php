<?php
/**
 * Template part for displaying home page services.
 * @since 4.0
 */
 ?>
					<!-- Services -->
					<?php if ( is_active_sidebar( 'services-text-columns' ) || get_option( 'slate_theme_customizer_services_title' ) ) { ?>
						<div class="section section-services">
							<?php if ( get_option( 'slate_theme_customizer_services_title' ) ) { ?>
								<div class="section-title">
									<span>
										<?php echo get_option( 'slate_theme_customizer_services_title' ); ?>
									</span>
								</div>
							<?php } ?>

							<div class="services-wrap" id="equalize">
								<?php dynamic_sidebar( 'services-text-columns' ); ?>
							</div>
						</div><!-- services section -->
					<?php } ?>