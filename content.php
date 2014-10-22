<?php

/**
 * Template for standard posts.
 *
 * @package Slate
 * @since Slate 1.0
 */
?>
						<?php if ( get_post_meta( $post->ID, 'arrayvideo', true ) ) { ?>
							<div class="arrayvideo">
								<?php echo get_post_meta( $post->ID, 'arrayvideo', true ) ?>
							</div>
						<?php } else { ?>

							<?php if ( '' != get_the_post_thumbnail() ) { ?>
								<a class="blog-image" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'blog-image' ); ?></a>
							<?php } ?>

						<?php } ?>

						<div class="blog-text">
							<?php if( is_single() ) {} else { ?>
								<div class="title-meta">
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
							<?php } ?>

							<div class="blog-entry">
								<div class="blog-content">
									<?php if( is_search() || is_archive() ) { ?>

										<div class="excerpt-more">
											<?php the_excerpt(__( 'Read More','slate')); ?>
										</div>

									<?php } else {
										the_content(__( 'Read more...', 'slate' ));
									}

									wp_link_pages(); ?>
								</div>
							</div><!-- blog entry -->
						</div><!-- blog text -->

						<div class="blog-meta">
							<ul class="meta-links">
						    	<li><?php echo get_the_date(); ?></li>
						    	<li><?php the_author_posts_link(); ?></li>
						    	<li><?php comments_popup_link( __( 'No Comments', 'slate' ), __( '1 Comment', 'slate' ), __( '% Comments', 'slate' ) ); ?></li>
						    </ul>

							<?php if( is_single() ) { ?>
								<ul class="meta-links">
									<li class="share-title"><?php _e( 'Category:', 'slate' ); ?></li>
									<li><?php the_category( '<br/>' ) ?></li>
									<?php
									$post_tags = wp_get_post_tags( $post->ID );
									if( !empty( $post_tags ) ) {
									?>
										<li class="share-title meta-tag-title"><?php _e( 'Tag:', 'slate' ); ?></li>
										<li>
											<?php the_tags( '', '<br />', '' ); ?>
										</li>
									<?php } ?>
								</ul>
							<?php } ?>

							<?php if( is_search() || is_archive() || is_attachment() ) {} else { ?>
								<ul class="meta-links">
									<li class="share-title"><?php _e( 'Share:', 'slate' ); ?></li>
									<li class="twitter">
										<a onclick="window.open('http://twitter.com/home?status=<?php the_title_attribute(); ?> - <?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title_attribute(); ?> - <?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" target="blank"><?php _e( 'Twitter', 'slate' ); ?></a>
									</li>

									<li class="facebook">
										<a onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"  target="blank"><?php _e( 'Facebook', 'slate' ); ?></a>
									</li>

									<li class="googleplus">
										<a class="share-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;"><?php _e( 'Google+', 'slate' ); ?></a>
									</li>
								</ul>
							<?php } ?>
						</div><!-- blog meta -->