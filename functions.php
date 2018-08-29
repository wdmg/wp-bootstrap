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
add_action('after_setup_theme', function() {
	global $wp_version;
	if (version_compare($wp_version, '3.4', '>=')):
		add_theme_support('custom-header');
	else :
		add_custom_image_header($wp_head_callback, $admin_head_callback);
	endif;

	if (!session_id() && get_option('enable_sessions'))
		session_start();
	
	add_theme_support('title-tag');

	load_theme_textdomain('wp-bootstrap', get_template_directory().'/languages');
});

// Include custom navigation walker
include 'inc/nav-walker.php';

// Include custom pagination
include 'inc/nav-pagination.php';

// Include custom template tags
include 'inc/template-tags.php';

// Include theme-options.php for admin theme settings
include 'theme-options.php';


// Enqueue admin assets (only for console)
add_action('admin_head', function() {
	wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/assets/css/admin.css', null, null);
	wp_enqueue_script('admin-js', get_template_directory_uri().'/assets/js/admin.js', null, null, true);
});

// Enqueue front-end assets (css & js)
add_action('wp_enqueue_scripts', function() {
	global $version;
	for ($i=1; $i <= 10; $i++) {
		if(get_option('enqueue_css_'.$i)) {
			$media = 'all';
			$url = get_option('enqueue_css_'.$i);
			$parse_url = wp_parse_url($url);

			if(isset($parse_url['host']))
				$path = '//'.$parse_url['host'].$parse_url['path'];
			else
				$path = wp_make_link_relative($url);

			wp_register_style('theme_css_'.$i, $path, array(), null, $media);
			wp_enqueue_style('theme_css_'.$i);
		}
	}
	for ($i=1; $i <= 10; $i++) {
		if(get_option('enqueue_js_'.$i)) {
			$in_footer = false;
			$url = get_option('enqueue_js_'.$i);
			$parse_url = wp_parse_url($url);

			if(isset($parse_url['host']))
				$path = '//'.$parse_url['host'].$parse_url['path'];
			else
				$path = wp_make_link_relative($url);

			wp_register_script('theme_js_'.$i, $path, array(), null, $in_footer);
			wp_enqueue_script('theme_js_'.$i);
		}
	}
});

// Register head and body code
add_action('wp_head', function() {
	if(get_option('header_code')) {
		echo get_option('header_code');
	}
}, 99);
add_action('wp_footer', function() {
	if(get_option('footer_code')) {
		echo get_option('footer_code');
	}
}, 99);

// Add support for custom flexible header
add_theme_support('custom-header', array(
	'default-image' => get_stylesheet_directory_uri().'/assets/images/logotype.svg',
	'width' => 260,
	'height' => 100,
	'flex-width' => true,
	'flex-height' => true,
	'header-selector' => '.site-title a',
	'header-text' => false
));

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
	for ($i=1; $i <= 4; $i++) {
		if(get_option('footer_sidebar_'.$i)) {
			register_sidebar(
				array(
					'name' => sprintf(esc_html__('Footer Sidebar %d', 'wp-bootstrap'), $i),
					'id' => 'footer-sidebar-'.$i,
					'before_widget' => '',
					'after_widget' => '',
					'before_title' => '',
					'after_title' => '',
				)
			);
		}
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

/*
// Add other mime type for support
add_filter('upload_mimes', function() {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
});
*/
?>
