<?php
/**
 * Recent Portfolio Widget Class
 */

add_action( 'widgets_init', 'load_slate_recent_portfolio' );

function load_slate_recent_portfolio() {
	register_widget( 'slate_recent_portfolio' );
} // END load_slate_recent_portfolio()

class slate_recent_portfolio extends WP_Widget {

	public function __construct() {

		parent::__construct(
			false,
			$name = __( 'Slate Sidebar Portfolio Widget', 'slate' )
		);

	} // END __construct()

	public function widget( $args, $instance ) {
		extract( $args );
		global $posttypes;
		$title  = apply_filters( 'widget_title', $instance['title'] );
		$number = apply_filters( 'widget_title', $instance['number'] );

		echo $before_widget;
		if ( $title ) { echo $before_title . $title . $after_title; } ?>

		<div id="portfolio-sidebar" class="portfolio-sidebar flexslider">

			<ul class="slides">
				<?php
					$global_posts_query = new WP_Query(
						array(
							'posts_per_page' => 5,
							'post_type' => 'array-portfolio'
						)
					);

					if( $global_posts_query->have_posts() ) : while( $global_posts_query->have_posts() ) : $global_posts_query->the_post();
				?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="portfolio-small-image"><?php the_post_thumbnail( 'sidebar-image' ); ?></a>
					</li>
				<?php endwhile; endif; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
		<?php echo $after_widget;

	} // END widget()

	public function update( $new_instance, $old_instance ) {

		global $posttypes;

		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;

	} // END update()

	public function form( $instance ) {

		$posttypes = get_post_types( '', 'objects' );

		$title = esc_attr( $instance['title'] );
		$cat = esc_attr( $instance['cat'] );
		$number = esc_attr( $instance['number'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'slate' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number to Show:', 'slate' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
		<?php

	} // END form()

} // END class slate_recent_portfolio
