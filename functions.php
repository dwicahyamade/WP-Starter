<?php

// ======================================
// Functions Partial -- start
// ======================================

include_once 'inc/functions-custom.php';
include_once 'inc/functions-plugin.php';
include_once 'inc/functions-navwalker.php';
include_once 'inc/functions-style-script.php';
include_once 'inc/functions-acf.php';
include_once 'inc/functions-polylang.php';
include_once 'inc/functions-theme-setup.php';

// ======================================
// Functions Partial -- end
// ======================================

function components($name, $args = []) {
    return get_template_part('/template-parts/components/' . $name, null, $args);
}

function icons($name, $args = []) {
    return get_template_part('/template-parts/icons/' . $name, null, $args);
}

/*
===========================

REMOVE P TAG FROM CONTACT FORM 7

===========================
*/
add_filter('wpcf7_autop_or_not', '__return_false');

/*
===========================

FIX UNDEFINED VALUE IN CONTACT FORM 7

===========================
*/
remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_select_enum_rules', 20, 2 ); // https://stackoverflow.com/questions/78101215/contact-form-undefined-value-was-submitted-through-this-field


/*
===========================

CREATE CUSTOM SHORTCODE FOR CONTACT FORM 7

===========================
*/
function custom_cf7_shortcode( $output, $name, $html ) {
    if ( 'custom_site_url' == $name ) {
        $output = get_site_url();
    } else if ( 'custom_site_logo_url' == $name ) {
        $output = esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] );
    } else if ( 'custom_site_name' == $name ) {
        $output = get_bloginfo('name');
    }

    return $output;
}
add_filter( 'wpcf7_special_mail_tags', 'custom_cf7_shortcode', 10, 3 );