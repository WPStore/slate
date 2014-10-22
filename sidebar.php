<?php
/**
 * Template for the sidebar and its widgets.
 *
 * @package Slate
 * @since 1.0
 */
?>
					<div id="sidebar">
						<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
							<div id="archives" class="widget">
								<h2><?php _e( 'Archives', 'pubilsher' ); ?></h2>
								<ul>
									<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
								</ul>
							</div>

							<div id="meta" class="widget">
								<h2><?php _e( 'Meta', 'pubilsher' ); ?></h2>
								<ul>
									<?php wp_register(); ?>
									<li><?php wp_loginout(); ?></li>
									<?php wp_meta(); ?>
								</ul>
							</div>

							<div id="search" class="widget widget_search">
								<?php get_search_form(); ?>
							</div>
						<?php endif; // end sidebar widget area ?>
					</div><!-- sidebar -->