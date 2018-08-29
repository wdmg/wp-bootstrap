<?php
/**
 * WP Bootstrap after content sidebar template
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
<?php if (get_option('after_content') && is_active_sidebar('after-content')): ?>
<?php dynamic_sidebar('after-content'); ?>
<?php endif; ?>
