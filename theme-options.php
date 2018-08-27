<?php
/**
 * WP Bootstrap theme options file
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */


function wp_bootstrap_options() {

	global $themename, $shortname, $options;
	if (!current_user_can('manage_options'))
		wp_die('You do not have sufficient permissions to access this page.');

	if($_REQUEST['action'] == 'save')
		echo '<div class="notice notice-success inline wp-pp-notice"><p>Настройки темы <strong>'. $themename .'</strong> были успешно сохранены!</p></div>';

	if($_REQUEST['reset'])
		echo '<div class="notice notice-error inline wp-pp-notice"><p>Настройки темы <strong>'. $themename .'</strong> были сброшены!</p></div>';

	if($_REQUEST['restore'])
		echo '<div class="notice notice-warning inline wp-pp-notice"><p>Настройки темы <strong>'. $themename .'</strong> были восстановлены!</p></div>';

}

// Only admin actions
if (is_admin()) {
	add_action('admin_init', function() {

		// Global html-code for head/body section
		register_setting('wp-bootstrap-options', 'header_code');
		register_setting('wp-bootstrap-options', 'footer_code');

		// Register setting for sidebar`s visibility
		register_setting('wp-bootstrap-options', 'header_sidebar');
		register_setting('wp-bootstrap-options', 'left_sidebar');
		register_setting('wp-bootstrap-options', 'right_sidebar');
		register_setting('wp-bootstrap-options', 'before_content');
		register_setting('wp-bootstrap-options', 'after_content');
		register_setting('wp-bootstrap-options', 'footer_sidebar');

		// Register setting for menu`s visibility
		register_setting('wp-bootstrap-options', 'top_menu');
		register_setting('wp-bootstrap-options', 'main_menu');
		register_setting('wp-bootstrap-options', 'left_sidebar_menu');
		register_setting('wp-bootstrap-options', 'right_sidebar_menu');
		register_setting('wp-bootstrap-options', 'footer_menu');

	});

	add_action('admin_menu', function() {
		add_menu_page(
			__('WP Bootstrap Theme options', 'wp-bootstrap'),
			__('Theme options', 'wp-bootstrap'),
			'manage_options',
			'theme-options',
			'wp_bootstrap_options',
			'dashicons-welcome-widgets-menus',
			62 // Default position order for appearance menu + 2
		);
    });

}




?>
