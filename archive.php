<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Slate
 * @since 4.0
 */
get_header(); ?>

			<div class="container">
				<div class="page-title">
					<h2>
					<?php if ( is_tag() ) {
						_e( 'Tag', 'slate' ); ?>: <?php single_tag_title();

					} else if ( is_day() ) {
						_e( 'Archive', 'slate' ); ?>: <?php echo get_the_date();

					} else if ( is_month() ) {
						_e( 'Archive', 'slate' ); ?>: <?php echo get_the_date('F Y');

					} else if ( is_year() ) {
						_e( 'Archive', 'slate' ); ?>: <?php echo get_the_date('Y');

					} else if ( is_category() ) {
						_e( 'Category', 'slate' ); ?>: <?php single_cat_title();

					} else if ( is_author() ) {
						the_author_posts(); ?> <?php _e('posts by','slate');
						$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) ); echo $curauth->nickname;

					} else {
						_e( 'Archives', 'slate' );
					} ?>
				</div>

				<div class="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post clearfix'); ?>>
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div><!-- blog post -->

					<?php endwhile; ?>

					<!-- Post navigation -->
					<?php slate_page_has_nav(); ?>

					<?php endif; ?>

				</div><!-- content -->

				<?php get_sidebar(); ?>
		</div><!-- container -->

<?php get_footer(); ?>