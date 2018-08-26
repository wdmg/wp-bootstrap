<?php
/**
 * WP Bootstrap functions and definitions
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 */

// Theme Information
$themename = "WoodPlast";
$developer_uri = "http://wdmg.com.ua/wp-bootstrap/";
$author = "Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>";
$shortname = "wp";
$version = '1.0.0';

	load_theme_textdomain('wp-bootstrap', get_template_directory().'/languages');
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
function register_theme_sidebars() {
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
	register_sidebar(
		array(
		'name' => __('Right Sidebar', 'wp-bootstrap'),
		'id' => 'right-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="caption">',
		'after_title' => '</div>',
	));
	register_sidebar(
		array(
		'name' => __('Left Sidebar', 'wp-bootstrap'),
		'id' => 'left-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="caption">',
		'after_title' => '</div>',
	));
	register_sidebar(
		array(
		'name' => __('Before Content', 'wp-bootstrap'),
		'id' => 'before-content',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(
		array(
		'name' => __('After Content', 'wp-bootstrap'),
		'id' => 'after-content',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
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
add_action('widgets_init', 'register_theme_sidebars');








?>
