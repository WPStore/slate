<?php
/*-----------------------------------------------------------------------------------*/
/* Text Column
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'load_slate_text_column_widget' );

function load_slate_text_column_widget() {
	register_widget( 'slate_text_column' );
}

class slate_text_column extends WP_Widget {

	function slate_text_column() {
		$widget_ops = array(
			'classname'   => 'slate-text-column',
			'description' => __( 'Slate Text Column Widget', 'slate' )
			);
		$control_ops = array(
			'width'   => 200,
			'height'  => 350,
			'id_base' => 'slate-text-column'
			);
		$this->WP_Widget( 'slate-text-column', __( 'Slate Text Column', 'slate'), $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {

		extract( $args );
		$columntitle     = $instance['column_title'];
		$columntitlelink = $instance['column_title_link'];
		$columnicon      = $instance['column_icon'];
		$columncontent   = $instance['column_content'];
		echo $before_widget;
?>

				<div class="services">
					<span class="service-icon">
						<?php if ( $columnicon ) { ?>
							<i class="fa <?php echo $instance['column_icon']; ?>"></i>
						<?php } else { ?>
							<i class="fa fa-file-text"></i>
						<?php } ?>
					</span>

					<div class="services-title">
						<h3><a href="<?php echo $instance['column_title_link']; ?>"><?php echo $instance['column_title']; ?></a></h3>
					</div>

					<div class="clear"></div>

					<p><?php echo $instance['column_content']; ?></p>
				</div>

<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['column_title']      = $new_instance['column_title'];
		$instance['column_title_link'] = $new_instance['column_title_link'];
		$instance['column_icon']       = $new_instance['column_icon'];
		$instance['column_content']    = $new_instance['column_content'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'             => '',
			'column_title'      => '',
			'column_icon'       => '',
			'column_content'    => '',
			'column_title_link' => ''
			)
		);
		$instance['column_title']      = $instance['column_title'];
		$instance['column_title_link'] = $instance['column_title_link'];
		$instance['column_icon']       = $instance['column_icon'];
		$instance['column_content']    = $instance['column_content'];
?>
			<p>
				<label for="<?php echo $this->get_field_id( 'column_title' ); ?>"><?php _e( 'Column Title', 'slate' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id( 'column_title' ); ?>" name="<?php echo $this->get_field_name( 'column_title' ); ?>" type="text" value="<?php echo esc_attr( $instance['column_title'] ); ?>" /></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'column_title_link' ); ?>"><?php _e( 'Column Title Link', 'slate' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id( 'column_title_link' ); ?>" name="<?php echo $this->get_field_name( 'column_title_link' ); ?>" type="text" value="<?php echo esc_attr( $instance['column_title_link'] ); ?>" /></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'column_icon' ); ?>"><?php _e( 'Column Icon', 'slate' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id( 'column_icon' ); ?>" name="<?php echo $this->get_field_name( 'column_icon' ); ?>" type="text" value="<?php echo esc_attr( $instance['column_icon'] ); ?>" /></label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'column_content' ); ?>"><?php _e( 'Column Content', 'slate' ); ?>:
				<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id( 'column_content' ); ?>" name="<?php echo $this->get_field_name( 'column_content' ); ?>"><?php echo $instance['column_content']; ?></textarea>
			</p>
<?php
	}
}
