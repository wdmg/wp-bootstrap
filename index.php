<?php
/**
 * WP Bootstrap main template file
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
<main role="main" class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-3 sidebar">
			<?php get_sidebar('left'); ?>
		</div>
		<div class="col-xs-12 col-sm-6 content">
			<?php get_sidebar('before'); ?>

			<?php get_sidebar('after'); ?>
		</div>
		<div class="col-xs-12 col-sm-3 sidebar">
			<?php get_sidebar('right'); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
