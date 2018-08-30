<?php
/**
 * WP Bootstrap Nav Pagination
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 */

function nav_pagination( $args = array() ) {

    $defaults = array(
		'show_all' => false,
        'custom_query'    => false,
		'prev_next' => false,
		'first_last' => false,
		'first_text' => false,
		'last_text' => false,
		'end_size' => false,
		'mid_size' => false,
		'prev_text' => __('Previous'),
		'next_text' => __('Next'),
		'add_fragment' => '',
		'before_page_number' => '',
		'after_page_number' => '',
		'before_output' => '<nav aria-label="..."><ul class="pagination">',
		'after_output' => '</ul></nav>',
    );

    $args = wp_parse_args(
        $args,
        apply_filters('wp_bootstrap_pagination_defaults', $defaults)
    );

    $args['mid_size'] = (int) $args['mid_size'] - 1;
    if (!$args['custom_query'])
        $args['custom_query'] = @$GLOBALS['wp_query'];

    $echo = '';
    $start = '';
    $end = '';
    $count = (int) $args['custom_query']->max_num_pages;
    $page = intval(get_query_var('paged'));
    $ceil = ceil($args['mid_size'] / 2);

    if ($count <= 1)
        return false;

    if (!$page)
        $page = 1;

    if (!$args['show_all'] && $count > $args['mid_size']) {
        if ($page <= $args['mid_size']) {
            $min = 1;
            $max = $args['mid_size'] + 1;
        } elseif ($page >= ($count - $ceil)) {
            $min = $count - $args['mid_size'];
            $max = $count;
        } elseif ($page >= $args['mid_size'] && $page < ($count - $ceil)) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }


    if ($args['first_last'] && $args['first_text']) {
    	$firstpage = esc_attr(get_pagenum_link(1));

		if ($firstpage && (1 != $page))
			$echo .= '<li class="page-item first"><a href="'.$firstpage.'" class="page-link">'.$args['first_text'].'</a>'.$args['add_fragment'].'</li>';
		else
			$echo .= '<li class="page-item first disabled"><span class="page-link">'.$args['first_text'].'</span></li>';
	}

    if ($args['prev_next'] && $args['prev_text']) {
		$previous = intval($page) - 1;
		$previous = esc_attr(get_pagenum_link($previous));

		if ($previous && (1 != $page))
			$echo .= '<li class="page-item prev"><a href="'.$previous.'" class="page-link" title="'.$args['prev_text'].'">'.$args['prev_text'].'</a>'.$args['add_fragment'].'</li>';
		else
			$echo .= '<li class="page-item prev disabled"><span class="page-link">'.$args['prev_text'].'</span></li>';
	}

    if ($args['end_size']) {
        for($i = 1; $i <= $args['end_size'] + 1; $i++) {
			if ($page !== $i)
            	$start .= sprintf('<li class="page-item"><a href="%s" class="page-link">'.$args['before_page_number'].'%002d'.$args['after_page_number'].'</a>'.$args['add_fragment'].'</li>', esc_attr(get_pagenum_link($i)), $i);
        }
    }
    if (!empty($min) && !empty($max)) {
        for($i = $min; $i <= $max; $i++) {
            if ($page == $i) {
                $echo .= '<li class="page-item active"><span class="page-link">'.$args['before_page_number'].''.str_pad((int)$i, 2, '0', STR_PAD_LEFT).''.$args['after_page_number'].'</span><span class="sr-only">(current)</span></li>';
            } else {
                $echo .= sprintf('<li class="page-item"><a href="%s" class="page-link">'.$args['before_page_number'].'%002d'.$args['after_page_number'].'</a>'.$args['add_fragment'].'</li>', esc_attr(get_pagenum_link($i)), $i);
            }
        }
    }
    if ($args['end_size']) {
        for($i = $count-$args['end_size']; $i <= $count; $i++) {
			if ($page !== $i)
            	$end .= sprintf('<li class="page-item"><a href="%s" class="page-link">'.$args['before_page_number'].'%002d'.$args['after_page_number'].'</a>'.$args['add_fragment'].'</li>', esc_attr(get_pagenum_link($i)), $i);
        }
    }

    if ($args['prev_next'] && $args['next_text']) {
		$next = intval($page) + 1;
		$next = esc_attr(get_pagenum_link($next));

		if ($next && ($count != $page))
			$echo .= '<li class="page-item next"><a href="'.$next.'" class="page-link" title="'.$args['next_text'].'">'.$args['next_text'].'</a>'.$args['add_fragment'].'</li>';
		else
			$echo .= '<li class="page-item next disabled"><span class="page-link">'.$args['next_text'].'</span></li>';
	}

    if ($args['first_last'] && $args['last_text']) {
		$lastpage = esc_attr(get_pagenum_link($count));

		if ($lastpage)
			$echo .= '<li class="page-item last"><a href="'.$lastpage.'" class="page-link">'.$args['last_text'].'</a>'.$args['add_fragment'].'</li>';
		else
			$echo .= '<li class="page-item last disabled"><span class="page-link">'.$args['last_text'].'</span></li>';
	}

    if (isset($echo))
        echo $args['before_output'].$start.$echo.$end.$args['after_output'];
}

?>
