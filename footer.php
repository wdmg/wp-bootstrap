<?php
/**
 * WP Bootstrap footer template file
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
		<?php wp_footer(); ?>
		<?php echo get_option('footer_code') ? get_option('footer_code') : '<!-- footer_code -->'."\r\n"; ?>
	</body>
</html>
