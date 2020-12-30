<?php

/*******************************************************************************
//
//  TABLE OF CONTENTS
//
//  #ADMIN
//  #SEARCH
//  #SCRIPTS
//  #STYLES
//  #INCLUDES
//
*******************************************************************************/

/*******************************************************************************
//
//
//
//  #ADMIN
//  -> Functions for admin
//
//
//
*******************************************************************************/

if(!isset($content_width)) {
    $content_width = 800;
}

// Setup
function kennytranco_admin_setup() {
    // Customise footer text in admin
    function kennytranco_admin_footer_text () {
        echo 'Created by <a href="https://kennytran.com">Kenny Tran Co</a>. Powered by <a href="http://WordPress.org">WordPress</a>.';
    }
    add_filter('admin_footer_text', 'kennytranco_admin_footer_text');
}
add_action('after_setup_theme', 'kennytranco_admin_setup');


// Remove admin bar for logged in users
add_filter('show_admin_bar', '__return_false');


// Enqueue custom CSS file for login page
function kennytranco_login_css() {
    wp_enqueue_style('login_css', get_template_directory_uri() . '/style-login.css');
}
add_action('login_enqueue_scripts', 'kennytranco_login_css');


// Customise logo link on login page
function kennytranco_login_headerurl() {
    return home_url();
}
add_filter('login_headerurl', 'kennytranco_login_headerurl');


// Customise logo title
function kennytranco_login_logo_title() {
    return get_option('blogname');
}
add_filter('login_headertext', 'kennytranco_login_logo_title');





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

// Tell WordPress to use searchform.php from the partials/ directory
function kennytranco_custom_get_search_form($form) {
    $form = '';
    locate_template('/template-parts/search/form.php', true, false);

    return $form;
}
add_filter('get_search_form', 'kennytranco_custom_get_search_form');





/*******************************************************************************
//
//
//
//  #SCRIPTS
//  -> Functions for scripts
//
//
//
*******************************************************************************/

// Deregister Scripts
function kennytranco_deregister_scripts() {
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'kennytranco_deregister_scripts');


// Enqueue Scripts
function kennytranco_enqueue_scripts() {
    if(!is_admin() && current_theme_supports('jquery-cdn')) {
        wp_deregister_script('jquery');
    }

    wp_register_script('script', get_template_directory_uri() . '/assets/scripts/main.min.js', 'jquery', filemtime(get_stylesheet_directory().'/assets/scripts/main.min.js'), true);

    wp_enqueue_script('script');
}
add_action('wp_enqueue_scripts', 'kennytranco_enqueue_scripts');





/*******************************************************************************
//
//
//
//  #STYLES
//  -> Functions for styles
//
//
//
*******************************************************************************/

// Enqueue Styles
function kennytranco_enqueue_styles() {
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/styles/main.min.css', false, filemtime(get_stylesheet_directory() . '/assets/styles/main.min.css'));
}
add_action('wp_enqueue_scripts', 'kennytranco_enqueue_styles');


// Change excerpt length
function kennytranco_excerpt_length() {
    return 50;
}
add_filter('excerpt_length', 'kennytranco_excerpt_length');


// Change excerpt suffix
function kennytranco_excerpt_more() {
    return '...';
}
add_filter('excerpt_more', 'kennytranco_excerpt_more');





/*******************************************************************************
//
//
//
//  #INCLUDES
//  -> Include files
//
//
//
*******************************************************************************/

require_once('includes/pagination.php');
require_once('includes/widget.php');
require_once('includes/wrapper.php');

?>
