<?php

namespace cc\catalog\utils;

if (!defined('ABSPATH')) {
    exit;
}

// Constants
const CC_CAT_PLUGIN_NAME = 'cybercap-catalog';
const CC_CAT_CPT_NAME = 'ccc_course';
const CC_CAT_TAXONOMY = 'ccc_curriculum';
const CC_CAT_COLOUR_ID = 'curriculum-colour';
const CC_CAT_SHORTCODE_ERR_MSG = "Vous devez inclure le \"slug\" du curriculum à afficher comme suit :<br>
[cybercap-catalog]slug-du-curriculum[/cybercap-catalog]";
const CC_CAT_SHORTCODE_TERM_ERR_MSG = "Ce curriculum n'existe pas.";

// Hooks
add_action('init', __NAMESPACE__ . '\enqueue_scripts_and_styles');

// Functions
function enqueue_scripts_and_styles() {
    wp_register_style('cc-catalog-style', plugins_url(CC_CAT_PLUGIN_NAME . '/assets/ccc-style.css'), [], uniqid());
    wp_enqueue_style('cc-catalog-style');
}

?>