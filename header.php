<?php
/**
 * WP Bootstrap header template file
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie ie6 lte9 lte8 lte7" lang="ru-RU" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 7]>
<html class="ie ie7 lte9 lte8 lte7" lang="ru-RU" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 lte9 lte8" lang="ru-RU" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 9]>
<html class="ie ie9" lang="ru-RU" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if gt IE 9]>
<html lang="ru-RU" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if !IE]><!-->
<html <?php language_attributes(); ?> class="no-svg no-flex no-js" prefix="og: http://ogp.me/ns#">
<!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <meta http-equiv="content-language" content="<?php bloginfo('language'); ?>">
		<?php echo get_option('header_code') ? get_option('header_code') : '<!-- header_code -->'."\r\n"; ?>
        <?php wp_head(); ?>
    </head>
	<body <?php body_class(); ?> role="document">
