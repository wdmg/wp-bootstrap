<?php
/**
 * WP Bootstrap Nav Walker
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 */

class nav_walker extends Walker_Nav_menu {

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$submenu_class = ($depth > 0) ? ' sub-menu' : '';
		$depth_class = ($depth > 0) ? ' depth-'.$depth : '';
		$output .= "\r\n".$indent.'<ul class="dropdown-menu'.$submenu_class.$depth_class.'">'."\r\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$value = '';
		$class_names = '';
		$item_attributes = '';
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
		$classes[] = 'nav-item';
		$classes[] = 'nav-item-'.$item->ID;

		if($depth && $args->walker->has_children) {
			$classes[] = 'dropdown-menu';
		}
		$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="'.esc_attr($class_names).'"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';

		$output .= $indent.'<li '.$id.$value.$class_names.$item_attributes.'>';

		$attributes = !empty( $item->attr_title) ? ' title="'.esc_attr($item->attr_title).'"' : '';
		$attributes .= !empty( $item->target) ? ' target="'.esc_attr($item->target).'"' : '';
		$attributes .= !empty( $item->xfn) ? ' rel="'.esc_attr($item->xfn).'"' : '';
		$attributes .= !empty( $item->url) ? ' href="'.esc_attr($item->url).'"' : '';
		$attributes .= ($args->walker->has_children) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';

		$item_output = $args->before;
		$item_output .= ($depth > 0) ? '<a class="dropdown-item"'.$attributes.'>' : '<a'.$attributes.'>';
		$item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

?>
