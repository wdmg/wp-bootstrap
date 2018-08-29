<?php
/**
 * WP Bootstrap page template
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
			?>
			<?php get_sidebar('after'); ?>
		</main>
		<?php get_sidebar('right'); ?>
	</div>
</section>
<?php get_footer(); ?>
