<?php
/**
 * WP Bootstrap right sidebar template
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
		<aside id="rightSidebar" class="col-xs-12 col-sm-3 sidebar">
			<?php if (get_option('right_sidebar_menu') && has_nav_menu('right-sidebar-menu')) : ?>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'right-sidebar-menu',
						'container'      => false,
						'menu_class'     => 'nav flex-column nav-pills',
						'fallback_cb'    => '__return_false',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'          => 2,
						'walker'         => new nav_walker()
					)
				); ?>
			<?php endif; ?>
			<?php if (get_option('right_sidebar') && is_active_sidebar('right-sidebar')): ?>
			<?php dynamic_sidebar('right-sidebar'); ?>
			<?php endif; ?>
		</aside>
