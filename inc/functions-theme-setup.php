<?php

/**
 * Function to add custom logo upload via menu appearance > customize
 * This function also add support for <title> tag in wp_head, so you dont need to add it manually
 */
function tmdr_theme_setup() {
    /**
     * Enable title tag for wordpress
     * @link https://codex.wordpress.org/Title_Tag
     */
    add_theme_support( 'title-tag' );

    // Enable custom logo upload
    $defaults = array(
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme','tmdr_theme_setup');

/**
 * Enable wordpress submenu in admin under menu appearance
 * Also register starter menu which is main navbar and footer navbar
 * register_nav_menu need 2 parameter
 * First parameter is location identifier, like a slug
 * Second parameter is location descriptive text
 * @link https://developer.wordpress.org/reference/functions/register_nav_menu/
 */
function tmdr_menu_setup() {
    add_theme_support('menus');
    register_nav_menu('main_menu', 'Main Navbar');
    register_nav_menu('footer', 'Footer Navbar');
    
}
add_action('init', 'tmdr_menu_setup');

/**
 * Replace custom logo class
 */
function tmdr_change_logo_class($html) {
    $html = str_replace('custom-logo-link', 'custom-navbar__image-container primary', $html);
    $html = str_replace('custom-logo', 'ratio-item', $html);
    return $html;
}
add_filter('get_custom_logo', 'tmdr_change_logo_class');

/**
 * Function to disable wordpress scaling down image
 * @link https://stackoverflow.com/questions/75044018/selectively-prevent-wordpress-from-generating-additional-image-sizes-on-upload
 */
add_filter('intermediate_image_sizes_advanced', '__return_empty_array');