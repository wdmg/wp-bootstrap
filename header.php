<?php
/**
 * WP Bootstrap header template
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
        <?php wp_head(); ?>
    </head>
	<body <?php body_class(); ?> role="document">
		<header>
			<?php if ((get_option('top_menu') && has_nav_menu('top-menu')) || (get_option('top_sidebar') && is_active_sidebar('top-sidebar'))) : ?>
			<nav class="navbar navbar-dark bg-dark">
				<div class="container">
					<div class="col-xs-12 col-sm-6">
						<?php if (get_option('top_menu') && has_nav_menu('top-menu')) : ?>
							<?php wp_nav_menu(
								array(
									'theme_location' => 'top-menu',
									'container'      => false,
									'menu_class'     => 'nav navbar-nav',
									'fallback_cb'    => '__return_false',
									'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'          => 2,
									'walker'         => new nav_walker()
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
					<a class="navbar-brand mb-0 h1" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('description'); ?>">
						<?php get_theme_logo(); ?>
					</a>
					<div class="collapse navbar-collapse" id="mainNavbar">
						<?php if (get_option('main_menu') && has_nav_menu('main-menu')) : ?>
							<?php wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'container'      => false,
									'menu_class'     => 'nav navbar-nav',
									'fallback_cb'    => '__return_false',
									'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'          => 2,
									'walker'         => new nav_walker()
								)
							); ?>
						<?php endif; ?>
						<?php if (get_option('header_sidebar') && is_active_sidebar('header-sidebar')): ?>
							<?php dynamic_sidebar('header-sidebar'); ?>
						<?php endif; ?>
						<?php get_search_form(); ?>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
				</div>
			</nav>
		</header>
