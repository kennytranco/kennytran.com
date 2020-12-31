<?php

/*
Plugin Name: Kenny Tran
Description: Site specific functions for kennytran.com
*/

/*******************************************************************************
//
//  TABLE OF CONTENTS
//
//  #BLOCKS
//  #IMAGES
//  #RSS
//  #SEARCH
//  #TIDY
//
*******************************************************************************/

/*******************************************************************************
//
//
//
//  #BLOCKS
//
//
//
*******************************************************************************/

// Allow specific blocks only
function kennytranco_allowed_block_types($allowed_blocks, $post) {
    $allowed_blocks = array(
        'core/code',
        'core/columns',
        'core/heading',
        'core/image',
        'core/list',
        'core/paragraph',
    );

    return $allowed_blocks;
}
add_filter('allowed_block_types', 'kennytranco_allowed_block_types', 10, 2);


// Remove patterns
remove_theme_support('core-block-patterns');


// Remove styles
function kennytranco_remove_block_style() {
    wp_register_script('remove-block-style', plugins_url('/includes/blocks/remove-styles.js', __FILE__), ['wp-blocks', 'wp-edit-post']);

    register_block_type('remove/block-style', [
        'editor_script' => 'remove-block-style',
    ]);
}
add_action('init', 'kennytranco_remove_block_style');


// Add custom patterns
function kennytranco_custom_wp_block_patterns() {
    register_block_pattern(
        'kennytranco/image-grid',
        array(
            'title' => __('Image Grid', 'image-grid'),
            'description' => _x('Includes a cover block, two columns with headings and text, a separator and a single-column text block.', 'Block pattern description', 'page-intro-block'),
            'content' => "<!-- wp:columns -->\n<div class=\"wp-block-columns is-image-grid\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":17,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"is-style-default\"} -->\n<figure class=\"wp-block-image size-large is-style-default\"><img src=\"http://dev.kennytran.com/wp-content/uploads/2020/12/visual-studio-code-screenshot-840x605.png\" alt=\"\" class=\"wp-image-17\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":17,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"is-style-default\"} -->\n<figure class=\"wp-block-image size-large is-style-default\"><img src=\"http://dev.kennytran.com/wp-content/uploads/2020/12/visual-studio-code-screenshot-840x605.png\" alt=\"\" class=\"wp-image-17\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
            'categories'  => array('header'),
        )
    );

}
add_action('init', 'kennytranco_custom_wp_block_patterns');





/*******************************************************************************
//
//
//
//  #IMAGES
//
//
//
*******************************************************************************/

// Remove default image sizes
function kennytranco_remove_default_image_sizes($sizes) {
    unset($sizes['thumbnail']);
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);

    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'kennytranco_remove_default_image_sizes', 10, 2);


// Update default image sizes
function kennytranco_update_image_sizes() {
    update_option('thumbnail_size_w', 0);
    update_option('thumbnail_size_h', 0);
    update_option('medium_size_w', 520);
    update_option('medium_size_h', 1000);
    update_option('medium_large_size_w', 660);
    update_option('medium_large_size_h', 1000);
    update_option('large_size_w', 800);
    update_option('large_size_h', 1000);
}
add_action('after_setup_theme', 'kennytranco_update_image_sizes');


// Add custom image size
add_image_size('extra_small', 300, 1000);
add_image_size('small', 400, 1000);
add_image_size('extra_large', 1000, 1000);


// Add custom sizes to menu
function kennytranco_add_custom_sizes_to_menu() {
    $custom_sizes['extra_large'] = 'Post';

    add_filter(
        'image_size_names_choose',
        function($sizes) use ($custom_sizes) {
            return array_merge($sizes, $custom_sizes);
        }
    );
}
add_action('admin_init', 'kennytranco_add_custom_sizes_to_menu');


// Add sizes attribute
function kennytranco_calculate_image_sizes($sizes, $size) {
    $width = $size[0];

    if($width >= 1000) {
        return '(min-width: 1400px) 1000px, (min-width: 960px) 800px, (min-width: 768px) calc(100vw - 120px), (min-width: 480px) calc(100vw - 60px), calc(100vw - 30px)';
    } if($width < 1000) {
        return '(min-width: 1400px) 485px, (min-width: 600px) 385px, (min-width: 480px) calc(100vw - 60px), calc(100vw - 30px)';
    } else {
        return $sizes;
    }
}
add_filter('wp_calculate_image_sizes', 'kennytranco_calculate_image_sizes', 10, 2);





/*******************************************************************************
//
//
//
//  #RSS
//
//
//
*******************************************************************************/

// Add posts and comments RSS feed links to head
add_theme_support('automatic-feed-links');





/*******************************************************************************
//
//
//
//  #SEARCH
//  -> Functions for search
//
//
//
*******************************************************************************/

// Enable /?s= to /search/ redirect
add_theme_support('nice-search');


// Redirects search results from /?s=query to /search/query/ and converts %20 to +
function kennytranco_search_redirect() {
    global $wp_rewrite;

    if(!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
        return;
    }

    $search_base = $wp_rewrite->search_base;

    if(is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
        wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
        exit();
    }
}
if(current_theme_supports('nice-search')) {
    add_action('template_redirect', 'kennytranco_search_redirect');
}


// Fix for empty search queries redirecting to home page
function kennytranco_request_filter($query_vars) {
    if(isset($_GET['s']) && empty($_GET['s']) && !is_admin()) {
        $query_vars['s'] = ' ';
    }

    return $query_vars;
}
add_filter('request', 'kennytranco_request_filter');





/*******************************************************************************
//
//
//
//  #TIDY
//
//
//
*******************************************************************************/

// Clean WordPress head
function kennytranco_clean_head() {
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_print_styles', 'print_emoji_styles');

    global $wp_widget_factory;
}
add_action('init', 'kennytranco_clean_head');

add_filter('emoji_svg_url', '__return_false');

// Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');
 
// Turn off oEmbed auto discovery.
add_filter('embed_oembed_discover', '__return_false');
 
// Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
 
// Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');
 
// Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');


// Remove unnecessary self-closing tags
function kennytranco_remove_self_closing_tags($input) {
    return str_replace(' />', '>', $input);
}
add_filter('get_avatar', 'kennytranco_remove_self_closing_tags');
add_filter('comment_id_fields', 'kennytranco_remove_self_closing_tags');
add_filter('post_thumbnail_html', 'kennytranco_remove_self_closing_tags');

?>
