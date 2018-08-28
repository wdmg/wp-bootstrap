<?php
/**
 * WP Bootstrap template tags support
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 */

if (!function_exists('get_theme_logo')) :
	function get_theme_logo() {
		if($logotype_id = get_theme_mod('custom_logo')){
			echo wp_get_attachment_image($logotype_id, 'full', false, array(
				'class'    => 'd-inline-block align-top',
				'alt'    	=> get_bloginfo('name'),
				'itemprop' => 'logo',
			));
		} else if(get_header_image()) {
			echo '<img src="'.get_header_image().'" height="'.get_custom_header()->height.'" width="'.get_custom_header()->width.'" class="d-inline-block align-top" alt="'.get_bloginfo('name').'" />';
		} else {
			echo get_bloginfo('name');
		}
	}
endif;

?>
