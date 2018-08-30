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

		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		
		$item_classes = empty($args->item_class) ? array('nav-item', 'nav-item-'.$item->ID) : (array) $args->item_class;
		$item_classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		if($depth && $args->walker->has_children) {
			$item_classes[] = 'dropdown-menu';
		}
		$item_classes =  array_merge($item->classes, $item_classes);
		$item_classes =  join(' ', apply_filters('nav_menu_css_class', array_filter($item_classes), $item, $args));
		$item_classes = ' class="'.esc_attr($item_classes).'"';
		
		$link_classes = empty($args->link_class) ? array('nav-link', 'nav-link-'.$item->ID) : (array) $args->link_class;
		$link_classes[] = ($item->current || $item->current_item_anchestor) ? ' active' : '';
		$link_classes =  join(' ', $link_classes);
		$link_classes = ($args->walker->has_children) ? ' class="'.esc_attr($item_classes).' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ' : ' class="'.esc_attr($link_classes).'" ';

		$output .= $indent.'<li '.$id.$value.$item_classes.$item_attributes.'>';

		$attributes = !empty($item->attr_title) ? ' title="'.esc_attr($item->attr_title).'"' : '';
		$attributes .= !empty($item->target) ? ' target="'.esc_attr($item->target).'"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="'.esc_attr($item->xfn).'"' : '';
		$attributes .= !empty($item->url) ? ' href="'.esc_attr($item->url).'"' : '';
		$attributes .= $link_classes;
		
		$item_output = $args->before;
		$item_output .= ($depth > 0) ? '<a class="dropdown-item"'.$attributes.'>' : '<a'.$attributes.'>';
		$item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

?>
