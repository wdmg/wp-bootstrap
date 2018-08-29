<?php
/**
 * WP Bootstrap main template
 *
 * This is the most generic template file in a WordPress theme.
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
<?php get_header(); ?>
<section class="container">
	<div class="row">
		<?php get_sidebar('left'); ?>
		<main id="mainContent" class="col-xs-12 col-sm-6 content" role="main">
			<?php get_sidebar('before'); ?>
			<?php
				while (have_posts()) : the_post();
					get_template_part('template-parts/content', 'page');
					if (comments_open() || get_comments_number()) {
						comments_template();
					}
				endwhile;
				nav_pagination(
					array(
						'prev_text' => __('Previous page', 'wp-bootstrap'),
						'next_text' => __('Next page', 'wp-bootstrap'),
						'prev_next' => true,
						'mid_size' => 5,
						'before_page_number' => '',
						'after_page_number' => '',
						'before_output' => '<nav aria-label="..."><ul class="pagination justify-content-center">',
						'after_output' => '</ul></nav>',
					)
				);
			?>
			<?php get_sidebar('after'); ?>
		</main>
		<?php get_sidebar('right'); ?>
	</div>
</section>
<?php get_footer(); ?>
