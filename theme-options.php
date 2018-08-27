<?php
/**
 * WP Bootstrap theme options file
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

// Manage theme options page
function wp_bootstrap_options_callback() {

	global $themename, $shortname, $options, $current_screen;
	if (!current_user_can('manage_options'))
		wp_die('You do not have sufficient permissions to access this page.');

	$request = false;
	if(isset($_REQUEST["action"])) {
		$request['action'] = urldecode($_REQUEST['action']);
	} else {
		$request['action'] = false;
	}
	if(isset($_REQUEST["section"])) {
		$request['section'] = urldecode($_REQUEST['section']);
	} else {
		$request['section'] = trim(strstr($current_screen->id, '_page_'), '_page_');
	}

	// Header of theme options
	echo '<div class="wrap">';
	echo '<h1 class="wp-heading-inline">'. get_admin_page_title() .'<span class="title-count theme-count">'.$request['section'].'</span></h1>';
	echo '<hr/>';

	if($request['action'] == 'save')
		echo '<div class="notice notice-success inline wp-pp-notice"><p>Настройки темы <strong>'. $themename .'</strong> были успешно сохранены!</p></div>';

	if($request['action'] == 'reset')
		echo '<div class="notice notice-error inline wp-pp-notice"><p>Настройки темы <strong>'. $themename .'</strong> были сброшены!</p></div>';

	if($request['action'] == 'restore')
		echo '<div class="notice notice-warning inline wp-pp-notice"><p>Настройки темы <strong>'. $themename .'</strong> были восстановлены!</p></div>';

	// Theme options functionality
	if($request['section'] == 'head-body-options') {

	} else if($request['section'] == 'sidebar-menu-options') {

	} else if($request['section'] == 'backup-restore-options') {

	} else if($request['section'] == 'theme-credits') {

	} else { // default section: 'theme-options'

	}

	echo '</div>';
}

// Only admin actions
if (is_admin()) {

	// Add theme options
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

	// Add admin menu for theme options
	add_action('admin_menu', function() {
		add_menu_page(
			__('WP Bootstrap Theme options', 'wp-bootstrap'),
			__('Theme options', 'wp-bootstrap'),
			'manage_options',
			'theme-options',
			'wp_bootstrap_options_callback',
			'dashicons-welcome-widgets-menus',
			62 // Default position order for appearance menu + 2
		);
		add_submenu_page(
			'theme-options',
			__('Head &amp; Body options', 'wp-bootstrap'),
			__('&lt;head&gt; &amp; &lt;body&gt;', 'wp-bootstrap'),
			'manage_options',
			'head-body-options',
			'wp_bootstrap_options_callback'
		);
		add_submenu_page(
			'theme-options',
			__('Sidebar &amp; Menu options', 'wp-bootstrap'),
			__('Sidebar &amp; Menu', 'wp-bootstrap'),
			'manage_options',
			'sidebar-menu-options',
			'wp_bootstrap_options_callback'
		);
		add_submenu_page(
			'theme-options',
			__('BackUp &amp; Restore options', 'wp-bootstrap'),
			__('BackUp &amp; Restore', 'wp-bootstrap'),
			'manage_options',
			'backup-restore-options',
			'wp_bootstrap_options_callback'
		);
		add_submenu_page(
			'theme-options',
			__('Credits theme', 'wp-bootstrap'),
			__('Credits', 'wp-bootstrap'),
			'manage_options',
			'theme-credits',
			'wp_bootstrap_options_callback'
		);
    });

}




?>
