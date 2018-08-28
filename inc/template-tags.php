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
		$logotype = '';
		if($logotype_id = get_theme_mod('custom_logo')){
			$logotype = wp_get_attachment_image($logotype_id, 'full', false, array(
				'class'    => 'd-inline-block align-top',
				'alt'    	=> bloginfo('name'),
				'itemprop' => 'logo',
			));
		}
		echo $logotype;
	}
endif;

?>
