<?php

/*******************************************************************************
//
//
//
//  #PAGINATION
//  -> Functions for pagination
//
//
//
*******************************************************************************/

// Custom page pagination
function kennytranco_page_pagination() {
    if(is_singular())
        return;

    global $wp_query;

    if($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    if($paged >= 1)
        $links[] = $paged;

    if($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if(($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="c-pagination">';
    echo '<div class="c-pagination__count">' . $paged . ' of ' . $max . '</div>';
    echo '<ul>';

    if(get_previous_posts_link())
        echo '<li>'.get_previous_posts_link('Prev').'</li>';

    if(!in_array(1, $links)) {
        echo '<li><a href="'.esc_url(get_pagenum_link(1)).'">1</a></li>';

        if(!in_array(2, $links))
            echo '<li>...</li>';
    }

    sort($links);

    foreach((array) $links as $link) {
        $class = $paged == $link ? ' class="active"' : '';

        echo '<li>';

        if($paged == $link) {
            echo '<span>'.$link.'</span>';
        } else {
            echo '<a href="'.esc_url(get_pagenum_link($link)).'">'.$link.'</a>';
        }

        echo '</li>';
    }

    if(!in_array($max, $links)) {
        if(!in_array($max - 1, $links))
            echo '<li>...</li>';
            echo '<li>';

            if($paged == $max) {
                echo '<span>'.$max.'</span>';
            } else {
                echo '<a href="'.esc_url(get_pagenum_link($max)).'">'.$max.'</a>';
            }

            echo '</li>';
    }

    if(get_next_posts_link())
        echo '<li>'.get_next_posts_link('Next').'</li>';

    echo '</ul>';
    echo '</div>';
}

?>
