<?php
/**
 * WP Bootstrap before content sidebar template
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
<?php if (get_option('before_content') && is_active_sidebar('before-content')): ?>
<?php dynamic_sidebar('before-content'); ?>
<?php endif; ?>
