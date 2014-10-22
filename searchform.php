<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="searchform">
		<input type="text" onfocus="if (this.value == '<?php esc_attr_e('Search this site...','slate'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search this site...','slate'); ?>';}" value="<?php esc_attr_e('Search this site...','slate'); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'slate' ); ?>" />
	</div>
</form>