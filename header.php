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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <?php wp_head(); ?>
    </head>
	<body <?php body_class(); ?> role="document">
		<header class="fixed-top">
			<?php if ((get_option('top_menu') && has_nav_menu('top-menu')) || (get_option('top_sidebar') && is_active_sidebar('top-sidebar'))) : ?>
			<nav class="navbar navbar-dark bg-dark">
				<div class="container">
					<div class="col-xs-12 col-sm-6">
						<?php if (get_option('top_menu') && has_nav_menu('top-menu')) : ?>
						<?php wp_nav_menu(
							array(
								'theme_location' => 'top-menu'
							)
						); ?>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-6">
						<?php if (get_option('top_sidebar') && is_active_sidebar('top-sidebar')): ?>
						<?php dynamic_sidebar('top-sidebar'); ?>
						<?php endif; ?>
					</div>
				</div>
			</nav>
			<?php endif; ?>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container">
					<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('description'); ?>">
						<img src="//getbootstrap.com/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="<?php bloginfo('name'); ?>" />
						<?php bloginfo('name'); ?>
					</a>
					<div class="collapse navbar-collapse" id="mainNavbar">
						<?php if (get_option('main_menu') && has_nav_menu('main-menu')) : ?>
						<?php wp_nav_menu(
							array(
								'theme_location' => 'main-menu'
							)
						); ?>
						<?php endif; ?>
						<?php if (get_option('header_sidebar') && is_active_sidebar('header-sidebar')): ?>
						<?php dynamic_sidebar('header-sidebar'); ?>
						<?php endif; ?>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
				</div>
			</nav>
		</header>