<?php

namespace cc\catalog\cpt;

if (!defined('ABSPATH')) {
    exit;
}

// Required
require_once('cybercap-catalog-utils.php');
use const cc\catalog\utils\CC_CAT_TAXONOMY as CC_CAT_TAXONOMY;
use const cc\catalog\utils\CC_CAT_CPT_NAME as CC_CAT_CPT_NAME;

// Hooks
add_action( 'init', __NAMESPACE__ . '\register_post_type_course' );

//Functions

/**
 * Adds the Course custom post type
 */
function register_post_type_course() {
    $labels     =   array(
        'name'                  =>      __('Cours', 'textdomain'),
        'singular_name'         =>      __('Cours', 'textdomain'),
        'add_new'               =>      __('Nouveau Cours', 'textdomain'),
        'add_new_item'          =>      __('Ajouter Cours', 'textdomain'),
        'edit_item'             =>      __('Modifier Cours', 'textdomain'),
        'new_item'              =>      __('Nouveau Cours', 'textdomain'),
        'view_item'             =>      __('Voir Cours', 'textdomain'),
    );
    $supports   =   array(
        'title',
        'custom-fields',
        'thumbnail',
    );
    $args       =   array(
        'labels'                =>      $labels,
        'supports'              =>      $supports,
        'description'           =>      'Un cours ou atelier à afficher',
        'public'                =>      true,
        'hierarchical'          =>      false,
        'has_archive'           =>      false,
        'rewrite'               =>      array( 'slug' => 'course'),
        'show_ui'               =>      true,
        'show_in_rest'          =>      true,
        'show_in_menu'          =>      true,
        //'taxonomies'            =>      array( CC_CAT_TAXONOMY )
    );
    register_post_type( CC_CAT_CPT_NAME, $args );
}

?>
