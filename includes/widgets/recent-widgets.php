<?php
/*-----------------------------------------------------------------------------------*/
/* Slate Recent Widgets
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'load_slate_recent_widgets' );

function load_slate_recent_widgets() {
	register_widget( 'slate_recent_widgets' );
}

class slate_recent_widgets extends WP_Widget {

	function slate_recent_widgets() {
		$widget_ops = array(
			'classname'   => 'slate-recent-posts',
			'description' => __( 'A tabbed widget for displaying recent posts, popular posts, recent comments, and a tag cloud.', 'slate' )
		);
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'slate-recent-widgets'
		);
		$this->WP_Widget( 'slate-recent-widgets', __( 'Slate Recent Posts Widget', 'slate' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$recentcount  = $instance['recentcount'];
		$popularcount = $instance['popularcount'];
		$commentcount = $instance['commentcount'];
		$tagcount     = $instance['tagcount'];

		$count = 0;

		if( 0 != $recentcount )
			$count++;

		if( 0 != $popularcount )
			$count++;

		if( 0 != $commentcount )
			$count++;

		if( 0 != $tagcount )
			$count++;

		$class = '';

		switch( $count ) {

			case '1':
				$class = 'one';
				break;

			case '2':
				$class = 'two';
				break;

			case '3':
				$class = 'three';
				break;

			case '4':
				$class = 'four';
				break;
		}

		echo $before_widget;
?>

		<!-- Slate Recent Posts Widget -->
		<div class="slate-recent-posts">
			<ul class="tab-wrapper tabs">
			<?php if( 0 != $recentcount ) { ?>
				<li class="<?php echo $class; ?>"><a class="current" href="#"><i class="fa fa-file-text-o"></i></a></li>
			<?php } ?>

			<?php if( 0 != $popularcount ) { ?>
				<li class="<?php echo $class; ?>"><a class="" href="#"></span><i class="fa fa-heart"></i></a></li>
			<?php } ?>

			<?php if( 0 != $commentcount ) { ?>
					<li class="<?php echo $class; ?>"><a class="" href="#"><i class="fa fa-comment"></i></a></li>
			<?php } ?>

			<?php if( 0 != $tagcount ) { ?>
				<li class="<?php echo $class; ?>"><a class="" href="#"><i class="fa fa-tag"></i></a></li>
			<?php } ?>

			</ul>

			<div class="clear"></div>

			<div class="panes">
				<?php if( 0 != $recentcount ) { ?>
				<!-- Recent Posts -->

				<div class="pane">
					<ul class="recent-posts-widget">
						<?php
						$recent = new WP_Query( array(
							'posts_per_page' => (int) $instance['recentcount'],
							'post_status'    => 'publish',
							)
						);
						if ( $recent->have_posts() ) : while ( $recent->have_posts() ) : $recent->the_post(); ?>
							<li class="recent-posts">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php comments_popup_link( __( 'No Comments', 'slate' ), __( '1 Comment', 'slate' ), __( '% Comments', 'slate' ), 'recent-comment-link', '' ); ?></p>
							</li>
						<?php endwhile; endif; wp_reset_postdata(); ?>
					</ul>
				</div><!-- recent posts pane -->
				<?php } ?>

				<?php if( 0 != $popularcount ) { ?>
				<!-- Popular Posts -->
				<div class="pane">
					<ul class="recent-posts-widget">
						<?php
						$popular = new WP_Query( array(
							'orderby'        => 'comment_count',
							'order'          => 'DESC',
							'posts_per_page' => (int) $instance['popularcount'],
							'post_status'    => 'publish',
							)
						);
						if( $popular->have_posts() ) : while ( $popular->have_posts() ) : $popular->the_post(); ?>
							<li class="recent-posts">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php comments_popup_link( __( 'No Comments', 'slate' ), __( '1 Comment', 'slate' ), __( '% Comments', 'slate' ) ); ?></p>
							</li>
						<?php endwhile; endif; wp_reset_postdata(); ?>
					</ul>
				</div><!-- popular posts -->
				<?php } ?>

				<?php if( 0 != $commentcount ) { ?>
				<!-- Recent Comments -->
				<div class="pane">
					<ul class="recent-posts-widget">
						<?php $comments = get_comments( 'status=approve&number='. (int) $instance['commentcount'] );
						foreach( $comments as $comm ) :
							$url = '<a href="' . get_comment_link( $comm->comment_ID ) . '" title="' . esc_attr( $comm->comment_author ) . ' | ' . get_the_title( $comm->comment_post_ID ) . '">' . $comm->comment_author . '</a>';

							$length = 100; // adjust to needed length
							$thiscomment = $comm->comment_content;
							if ( strlen( $thiscomment ) > $length ) {
								$thiscomment = substr( $thiscomment, 0, $length );
								$thiscomment = $thiscomment .' ...';
							}
						?>
						<li class="recent-posts">
							<h3><?php echo $url; ?></h3>
							<p class="recent-comment-text"><a href="<?php echo esc_url( get_comment_link( $comm->comment_ID ) ); ?>"><?php echo esc_html( $thiscomment ); ?></a></p>
						</li>
						<?php endforeach;?>
					</ul>
				</div><!-- recent comments -->
				<?php } ?>

				<?php if( 0 != $tagcount ) { ?>
				<!-- Tag Cloud -->
				<div class="pane">
					<div class="tagcloud">
						<?php wp_tag_cloud( 'largest=18&number='.$tagcount.'' ); ?>
					</div>
					<div class="clear"></div>
				</div><!-- tags pane -->
				<?php } ?>
			</div><!-- panes -->
		</div><!-- recent post widget -->

		<?php wp_reset_query(); ?>

<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['recentcount']  = $new_instance['recentcount'];
		$instance['commentcount'] = $new_instance['commentcount'];
		$instance['popularcount'] = $new_instance['popularcount'];
		$instance['tagcount']     = $new_instance['tagcount'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'recenttitle' => '', 'recentcount' => '', 'commentcount' => '', 'popularcount' => '', 'tagcount' => '' ) );
		$instance['recentcount']  = $instance['recentcount'];
		$instance['commentcount'] = $instance['commentcount'];
		$instance['popularcount'] = $instance['popularcount'];
		$instance['tagcount']     = $instance['tagcount'];
?>

			<p><?php _e( 'Entering 0 for a count will hide it on your site.', 'slate' ); ?></p>

			<p>
				<label for="<?php echo $this->get_field_id( 'recentcount' ); ?>"><?php _e( 'Recent Posts Count', 'slate' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id( 'recentcount' ); ?>" name="<?php echo $this->get_field_name( 'recentcount' ); ?>" type="text" value="<?php echo $instance['recentcount']; ?>" /></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'popularcount' ); ?>"><?php _e( 'Popular Posts Count', 'slate' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id( 'popularcount' ); ?>" name="<?php echo $this->get_field_name( 'popularcount' ); ?>" type="text" value="<?php echo $instance['popularcount']; ?>" /></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'commentcount' ); ?>"><?php _e( 'Latest Comment Count', 'slate' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id( 'commentcount' ); ?>" name="<?php echo $this->get_field_name( 'commentcount' ); ?>" type="text" value="<?php echo $instance['commentcount']; ?>" /></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'tagcount' ); ?>"><?php _e( 'Tag Count', 'slate' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id( 'tagcount' ); ?>" name="<?php echo $this->get_field_name( 'tagcount' ); ?>" type="text" value="<?php echo $instance['tagcount']; ?>" /></label>
			</p>

  <?php
	}
}
