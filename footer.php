<?php
/**
 * WP Bootstrap footer template
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-3">
						<?php if (get_option('footer_menu') && has_nav_menu('footer-menu')) : ?>
							<?php wp_nav_menu(
								array(
									'theme_location' => 'footer-menu',
									'container'      => false,
									'menu_class'     => 'nav flex-column',
									'fallback_cb'    => '__return_false',
									'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'          => 2,
									'walker'         => new nav_walker()
								)
							); ?>
						<?php endif; ?>
						<?php if (get_option('footer_sidebar_1') && is_active_sidebar('footer-sidebar-1')): ?>
						<?php dynamic_sidebar('footer-sidebar-1'); ?>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-3">
						<?php if (get_option('footer_sidebar_2') && is_active_sidebar('footer-sidebar-2')): ?>
						<?php dynamic_sidebar('footer-sidebar-2'); ?>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-3">
						<?php if (get_option('footer_sidebar_3') && is_active_sidebar('footer-sidebar-3')): ?>
						<?php dynamic_sidebar('footer-sidebar-3'); ?>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-3">
						<?php if (get_option('footer_sidebar_4') && is_active_sidebar('footer-sidebar-4')): ?>
						<?php dynamic_sidebar('footer-sidebar-4'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
