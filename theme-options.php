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
		echo '<div class="notice notice-success inline wp-pp-notice"><p>'.__('The theme settings have been successfully saved.', 'wp-bootstrap').'</p></div>';

	if($request['action'] == 'reset')
		echo '<div class="notice notice-error inline wp-pp-notice"><p>'.__('The theme settings have been reset.', 'wp-bootstrap').'</p></div>';

	if($request['action'] == 'restore')
		echo '<div class="notice notice-warning inline wp-pp-notice"><p>'.__('The theme settings were successfully restored.', 'wp-bootstrap').'</p></div>';

	// Theme options functionality
	if($request['section'] == 'head-body-options') {

		echo '<form method="POST" action="options.php">';
		settings_fields('wp-bootstrap-enqueue-options');
		do_settings_sections('head-body-options');
		submit_button();
		echo '</form>';

	} else if($request['section'] == 'sidebar-menu-options') {

		echo '<form method="POST" action="options.php">';
		settings_fields('wp-bootstrap-sidebar-menu-options');
		do_settings_sections('sidebar-menu-options');
		submit_button();
		echo '</form>';
		
	} else if($request['section'] == 'backup-restore-options') {

		echo '<form method="POST" action="options.php">';
		settings_fields('wp-bootstrap-backup-restore-options');
		do_settings_sections('backup-restore-options');
		submit_button(__('Download backup', 'wp-bootstrap'), 'secondary button-hero install-now', '', false, array('onclick' => "this.form.action='/download/theme-backup.json'"));
		echo '&nbsp;&nbsp;';
		submit_button(__('Import backup', 'wp-bootstrap'), 'primary button-hero install-now', '', false, array('onclick' => "this.form.action='/wp-admin/admin.php?page=backup-restore-options'"));
		echo '</form>';

	} else if($request['section'] == 'theme-credits') {

	} else { // default section: 'theme-options'
		
		echo '<form method="POST" action="options.php">';
		settings_fields('wp-bootstrap-global-options');
		do_settings_sections('theme-options');
		submit_button();
		echo '</form>';
		
	}

	echo '</div>';
}

// Register settings overlay function
function register_settings($slug, $name) {
	global $options;
	if($name)
		array_push($options, $name);

	register_setting($slug, $name);
}

// Generate BackUp code function
function get_backup_code() {
	global $options;
	$export = wp_load_alloptions();
	$filtered = array_filter(
		$export,
		function ($key) use ($options) {
			return in_array($key, $options);
		},
		ARRAY_FILTER_USE_KEY
	);
	return serialize($filtered);
}

// Download backup options
add_action('template_redirect', function() {
	if ($_SERVER['REQUEST_URI'] == '/download/theme-backup.json') {
		header('Content-disposition: attachment; filename=theme-backup.json');
		header('Content-type: application/json');
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $_POST["backup_code"];
		exit();
	}
});

// Only admin actions
if (is_admin()) {
	// Add theme options
	add_action('admin_init', function() {
		
		// Global options section
		register_settings('wp-bootstrap-global-options', 'enable_sessions');
		
		// Register enqueue script and css
		for ($i=1; $i <= 10; $i++) {
			register_settings('wp-bootstrap-enqueue-options', 'enqueue_css_'.$i);
			register_settings('wp-bootstrap-enqueue-options', 'enqueue_js_'.$i);
		}
		
		// Html-code for head/body section
		register_settings('wp-bootstrap-enqueue-options', 'header_code');
		register_settings('wp-bootstrap-enqueue-options', 'footer_code');

		// Register setting for sidebar`s visibility
		register_settings('wp-bootstrap-sidebar-menu-options', 'top_sidebar');
		register_settings('wp-bootstrap-sidebar-menu-options', 'header_sidebar');
		register_settings('wp-bootstrap-sidebar-menu-options', 'left_sidebar');
		register_settings('wp-bootstrap-sidebar-menu-options', 'right_sidebar');
		register_settings('wp-bootstrap-sidebar-menu-options', 'before_content');
		register_settings('wp-bootstrap-sidebar-menu-options', 'after_content');
		for ($i=1; $i <= 4; $i++) {
			register_settings('wp-bootstrap-sidebar-menu-options', 'footer_sidebar_'.$i);
		}

		// Register setting for menu`s visibility
		register_settings('wp-bootstrap-sidebar-menu-options', 'top_menu');
		register_settings('wp-bootstrap-sidebar-menu-options', 'main_menu');
		register_settings('wp-bootstrap-sidebar-menu-options', 'left_sidebar_menu');
		register_settings('wp-bootstrap-sidebar-menu-options', 'right_sidebar_menu');
		register_settings('wp-bootstrap-sidebar-menu-options', 'footer_menu');


		// Global options
		add_settings_section(
			'wp-bootstrap-global-options',
			__('Global settings and system variables', 'wp-bootstrap'),
			function() {
				echo __('<p>Here you can enable or disable the necessary options for work.</p>', 'wp-bootstrap');
			},
			'theme-options'
		);
		add_settings_field(
			'enable_sessions',
			__('Enable session support', 'wp-bootstrap'),
			function() {
				echo '<input name="enable_sessions" type="checkbox" '.checked(1, get_option('enable_sessions'), false).' value="1" />';
			},
			'theme-options',
			'wp-bootstrap-global-options'
		);
		
		
		// Enqueue scripts and css
		add_settings_section(
			'wp-bootstrap-enqueue-options',
			__('Enqueue scripts and css', 'wp-bootstrap'),
			function() {
				echo __('<p>Here you can connect your scripts and stylesheet files. You can specify both absolute and relative URLs.</p>', 'wp-bootstrap');
			},
			'head-body-options'
		);
		for ($i=1; $i <= 10; $i++) {
			add_settings_field(
				'enqueue_css_'.$i,
				sprintf(esc_html__('Theme stylesheet path [%d]', 'wp-bootstrap'), $i),
				function() use ($i) {
					echo '<input name="enqueue_css_'.$i.'" class="regular-text" value="'.get_option('enqueue_css_'.$i).'" />';
				},
				'head-body-options',
				'wp-bootstrap-enqueue-options'
			);

		}
		for ($i=1; $i <= 10; $i++) {
			add_settings_field(
				'enqueue_js_'.$i,
				sprintf(esc_html__('Theme javascript path [%d]', 'wp-bootstrap'), $i),
				function() use ($i) {
					echo '<input name="enqueue_js_'.$i.'" class="regular-text" value="'.get_option('enqueue_js_'.$i).'" />';
				},
				'head-body-options',
				'wp-bootstrap-enqueue-options'
			);
		}


		// Head & Body options
		add_settings_section(
			'wp-bootstrap-head-body-options',
			__('&lt;head&gt; &amp; &lt;body&gt;', 'wp-bootstrap'),
			function() {
				echo __('<p>Here you can specify special codes for counters, tracking scripts and meta tags.</p>', 'wp-bootstrap');
			},
			'head-body-options'
		);
		add_settings_field(
			'header_code',
			__('HTML-code before closing tag &lt;head&gt;', 'wp-bootstrap'),
			function() {
				echo '<textarea name="header_code" class="regular-text">'.get_option('header_code').'</textarea>';
			},
			'head-body-options',
			'wp-bootstrap-head-body-options'
		);
		add_settings_field(
			'footer_code',
			__('HTML-code before closing tag &lt;body&gt;', 'wp-bootstrap'),
			function() {
				echo '<textarea name="footer_code" class="regular-text">'.get_option('footer_code').'</textarea>';
			},
			'head-body-options',
			'wp-bootstrap-head-body-options'
		);


		// Sidebars visibility options
		add_settings_section(
			'wp-bootstrap-sidebar-options',
			__('Sidebars visibility', 'wp-bootstrap'),
			function() {
				echo __('<p>You can activate/deactivate the sidebars of your theme, if necessary.</p>', 'wp-bootstrap');
			},
			'sidebar-menu-options'
		);
		add_settings_field(
			'top_sidebar',
			__('Display top sidebar in the header', 'wp-bootstrap'),
			function() {
				echo '<input name="top_sidebar" type="checkbox" '.checked(1, get_option('top_sidebar'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-sidebar-options'
		);
		add_settings_field(
			'header_sidebar',
			__('Display sidebar in the header', 'wp-bootstrap'),
			function() {
				echo '<input name="header_sidebar" type="checkbox" '.checked(1, get_option('header_sidebar'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-sidebar-options'
		);
		add_settings_field(
			'left_sidebar',
			__('Display the left sidebar', 'wp-bootstrap'),
			function() {
				echo '<input name="left_sidebar" type="checkbox" '.checked(1, get_option('left_sidebar'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-sidebar-options'
		);
		add_settings_field(
			'right_sidebar',
			__('Display the right sidebar', 'wp-bootstrap'),
			function() {
				echo '<input name="right_sidebar" type="checkbox" '.checked(1, get_option('right_sidebar'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-sidebar-options'
		);
		add_settings_field(
			'before_content',
			__('Display sidebar before content', 'wp-bootstrap'),
			function() {
				echo '<input name="before_content" type="checkbox" '.checked(1, get_option('before_content'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-sidebar-options'
		);
		add_settings_field(
			'after_content',
			__('Display sidebar after content', 'wp-bootstrap'),
			function() {
				echo '<input name="after_content" type="checkbox" '.checked(1, get_option('after_content'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-sidebar-options'
		);
		for ($i=1; $i <= 4; $i++) {
			add_settings_field(
				'footer_sidebar_'.$i,
				sprintf(esc_html__('Display sidebar in the footer [%d]', 'wp-bootstrap'), $i),
				function() use ($i) {
					echo '<input name="footer_sidebar_'.$i.'" type="checkbox" '.checked(1, get_option('footer_sidebar_'.$i), false).' value="1" />';
				},
				'sidebar-menu-options',
				'wp-bootstrap-sidebar-options'
			);
		}


		// Menu visibility options
		add_settings_section(
			'wp-bootstrap-menu-options',
			__('Menu visibility', 'wp-bootstrap'),
			function() {
				echo __('<p>You can activate/deactivate the menu locations of your theme, if necessary.</p>', 'wp-bootstrap');
			},
			'sidebar-menu-options'
		);
		add_settings_field(
			'top_menu',
			__('Display top menu in the header', 'wp-bootstrap'),
			function() {
				echo '<input name="top_menu" type="checkbox" '.checked(1, get_option('top_menu'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-menu-options'
		);
		add_settings_field(
			'main_menu',
			__('Display main menu in the header', 'wp-bootstrap'),
			function() {
				echo '<input name="main_menu" type="checkbox" '.checked(1, get_option('main_menu'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-menu-options'
		);
		add_settings_field(
			'left_sidebar_menu',
			__('Display menu in the left sidebar', 'wp-bootstrap'),
			function() {
				echo '<input name="left_sidebar_menu" type="checkbox" '.checked(1, get_option('left_sidebar_menu'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-menu-options'
		);
		add_settings_field(
			'right_sidebar_menu',
			__('Display menu in the right sidebar', 'wp-bootstrap'),
			function() {
				echo '<input name="right_sidebar_menu" type="checkbox" '.checked(1, get_option('right_sidebar_menu'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-menu-options'
		);
		add_settings_field(
			'footer_menu',
			__('Display menu in the footer sidebar', 'wp-bootstrap'),
			function() {
				echo '<input name="footer_menu" type="checkbox" '.checked(1, get_option('footer_menu'), false).' value="1" />';
			},
			'sidebar-menu-options',
			'wp-bootstrap-menu-options'
		);


		// Backup Export/Import
		add_settings_section(
			'wp-bootstrap-backup-restore-options',
			__('Backup Export/Import settings', 'wp-bootstrap'),
			function() {
				echo __('<p>Here you can export the backup settings to the theme or download such settings from the backup file or by inserting the field below.</p>', 'wp-bootstrap');
			},
			'backup-restore-options'
		);
		add_settings_field(
			'backup_code',
			__('Export a backup copy of the settings', 'wp-bootstrap'),
			function() {
				echo '<textarea name="backup_code" readonly="readonly" class="regular-text">'.get_backup_code().'</textarea>';
			},
			'backup-restore-options',
			'wp-bootstrap-backup-restore-options'
		);
		add_settings_field(
			'import_code',
			__('Import a backup copy of the settings', 'wp-bootstrap'),
			function() {
				echo '<textarea name="import_code" class="regular-text"></textarea>';
			},
			'backup-restore-options',
			'wp-bootstrap-backup-restore-options'
		);


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
			__('Sidebars &amp; Menu options', 'wp-bootstrap'),
			__('Sidebars &amp; Menu', 'wp-bootstrap'),
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
