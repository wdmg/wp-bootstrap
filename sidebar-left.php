<?php
/**
 * WP Bootstrap left sidebar template
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
<?php if (get_option('left_sidebar_menu') && has_nav_menu('left-sidebar-menu')) : ?>
	<?php wp_nav_menu(
		array(
			'theme_location' => 'left-sidebar-menu',
			'container'      => false,
			'menu_class'     => 'nav flex-column nav-pills',
			'fallback_cb'    => '__return_false',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'          => 2,
			'walker'         => new nav_walker()
		)
	); ?>
<?php endif; ?>
<?php if (get_option('left_sidebar') && is_active_sidebar('left-sidebar')): ?>
<?php dynamic_sidebar('left-sidebar'); ?>
<?php endif; ?>
