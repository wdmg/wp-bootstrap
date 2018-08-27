<?php
/**
 * WP Bootstrap functions and definitions
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 */

// Theme Information
$themename = "WP Bootstrap";
$developer_uri = "http://wdmg.com.ua/wp-bootstrap/";
$author = "Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>";
$shortname = "wp";
$version = '1.0.0';
$options = array();

// Load theme languages
function load_theme_langs() {
	load_theme_textdomain('wp-bootstrap', get_template_directory().'/languages');
}
add_action('after_setup_theme', 'load_theme_langs');

// Include theme-options.php for admin theme settings
include 'theme-options.php';

// Enqueue admin assets (only for console)
function admin_assets() {
	wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/assets/css/admin.css', null, null);
	wp_enqueue_script('admin-js', get_template_directory_uri().'/assets/js/admin.js', null, null, true);
}
add_action('admin_head', 'admin_assets');


// Register Sidebar`s
add_action('widgets_init', function() {
	if(get_option('header_sidebar')) {
		register_sidebar(
			array(
				'name' => __('Header Sidebar', 'wp-bootstrap'),
				'id' => 'header-sidebar',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '',
				'after_title' => '',
			)
		);
	}
	if(get_option('left_sidebar')) {
		register_sidebar(
			array(
				'name' => __('Left Sidebar', 'wp-bootstrap'),
				'id' => 'left-sidebar',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<div class="caption">',
				'after_title' => '</div>',
			)
		);
	}
	if(get_option('right_sidebar')) {
		register_sidebar(
			array(
				'name' => __('Right Sidebar', 'wp-bootstrap'),
				'id' => 'right-sidebar',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<div class="caption">',
				'after_title' => '</div>',
			)
		);
	}
	if(get_option('before_content')) {
		register_sidebar(
			array(
				'name' => __('Before Content', 'wp-bootstrap'),
				'id' => 'before-content',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			)
		);
	}
	if(get_option('after_content')) {
		register_sidebar(
			array(
				'name' => __('After Content', 'wp-bootstrap'),
				'id' => 'after-content',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			)
		);
	}
	if(get_option('footer_sidebar')) {
		register_sidebar(
			array(
				'name' => __('Footer Sidebar', 'wp-bootstrap'),
				'id' => 'footer-sidebar',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '',
				'after_title' => '',
			)
		);
	}
});


// Register Menu`s
add_action('after_setup_theme', function() {
	$menu = array();
	if(get_option('top_menu'))
		$menu['top-menu'] = __('Top Menu', 'wp-bootstrap');

	if(get_option('main_menu'))
		$menu['main-menu'] = __('Main Menu', 'wp-bootstrap');

	if(get_option('left_sidebar_menu'))
		$menu['left-sidebar-menu'] = __('Left Sidebar Menu', 'wp-bootstrap');

	if(get_option('right_sidebar_menu'))
		$menu['right-sidebar-menu'] = __('Right Sidebar Menu', 'wp-bootstrap');

	if(get_option('footer_menu'))
		$menu['footer-menu'] = __('Footer Menu', 'wp-bootstrap');

	register_nav_menus($menu);
});



?>
