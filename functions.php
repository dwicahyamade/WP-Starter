<?php

// ======================================
// Functions Partial -- start
// ======================================

include_once 'inc/functions-custom.php';
include_once 'inc/functions-plugin.php';
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

/*
===========================

REMOVE P TAG FROM CONTACT FORM 7

===========================
*/
add_filter('wpcf7_autop_or_not', '__return_false');
remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_select_enum_rules', 20, 2 ); // https://stackoverflow.com/questions/78101215/contact-form-undefined-value-was-submitted-through-this-field