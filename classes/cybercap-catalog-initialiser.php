<?php

if (!defined('ABSPATH')) {
    die();
}

if (!class_exists('CC_Catalog_Initialiser')) {

    class CC_Catalog_Initialiser {

        private static $initiated = false;

        public static function init() {
            if (!self::$initiated) {
                self::initialise();
            }
        }

        private static function initialise() {
            $initiated = true;

            // Database addons
            add_action( 'init', array('CC_Catalog', 'register_taxonomy_curriculum') );
            add_action( 'init', array('CC_Catalog', 'register_post_type_course') );
        }


        private static function register_taxonomy_curriculum() {
            $labels     =   array(
                'name'              =>      _x('Curriculums', 'taxonomy general name'),
                'singular name'     =>      _x('Curriculum', 'taxonomy singular name'),
                'all_itmes'         =>      __('All Curriculums'),
                'menu_name'         =>      __('Curriculum')
            );
            $args       =   array(
                'labels'            =>      $labels,
                'show_ui'           =>      true,
                'show_in_menu'      =>      true,
                'show_in_nav_menus' =>      false,
                'show_in_rest'      =>      true,
                'rewrite'           =>      array( 'slug'  =>  'path' ),
            );
            register_taxonomy('ccgrid_path', 'ccc_course', $args);
        }

        private static function register_post_type_course() {
            $labels     =   array(
                'name'              =>      __('Courses', 'textdomain'),
                'singular_name'     =>      __('Course', 'textdomain'),
                'add_new'           =>      __('New Course', 'textdomain'),
                'add_new_item'      =>      __('Add New Course', 'textdomain'),
                'edit_item'         =>      __('Edit Course', 'textdomain'),
                'new_item'          =>      __('New Course', 'textdomain'),
                'view_item'         =>      __('View Courses', 'textdomain'),
            );
            $supports   =   array(
                'title',
                'custom-fields',
                'thumbnail',
                'page-attributes',
            );
            $args       =   array(
                'labels'            =>      $labels,
                'supports'          =>      $supports,
                'description'       =>      'A course or workshop to be displayed in the grid',
                'public'            =>      true,
                'hierarchical'      =>      false,
                'has_archive'       =>      false,
                'rewrite'           =>      array( 'slug' => 'Course'),
                'show_in_rest'      =>      true,
    
            );
            register_post_type( 'ccc_course', $args);
        }

        public static function destroy() {

        }
    }

}

?>