<?php
/**
 * WP Bootstrap functions and definitions
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 */



// Load theme languages
function load_theme_langs() {
	load_theme_textdomain('wp-bootstrap', get_template_directory().'/languages');
}
add_action('after_setup_theme', 'load_theme_langs');

// Include theme-options.php for admin theme settings
include 'theme-options.php';

// Enqueue admin assets
function admin_assets() {
	wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/assets/css/admin.css', null, null);
	wp_enqueue_script('admin-js', get_template_directory_uri().'/assets/js/admin.js', null, null, true);
}
add_action('admin_head', 'admin_assets');


?>
