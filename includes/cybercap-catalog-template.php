<?php

namespace cc\catalog\template;

if (!defined('ABSPATH')) {
    exit;
}

// Required
require_once('cybercap-catalog-utils.php');
use const cc\catalog\utils\CC_CAT_CPT_NAME as CC_CAT_CPT_NAME;
use const cc\catalog\utils\CC_CAT_TAXONOMY as CC_CAT_TAXONOMY;
use const cc\catalog\utils\CC_CAT_SHORTCODE_ERR_MSG as CC_CAT_SHORTCODE_ERR_MSG;
use const cc\catalog\utils\CC_CAT_SHORTCODE_TERM_ERR_MSG as CC_CAT_SHORTCODE_TERM_ERR_MSG;

// Hooks
add_action('init', __NAMESPACE__ . '\add_shortcode_cc_catalog');


/**
 * Adds the shortcodes
 */
function add_shortcode_cc_catalog() {
    add_shortcode( 'cybercap-catalog', __NAMESPACE__ . '\cc_catalog_shortcode' );
}

/**
 * Creates the catalog
 */
function cc_catalog_shortcode( $atts = [], $content = null, $tag = '' ) {

    $atts = array_change_key_case( (array) $atts, CASE_LOWER);
    $ccc_atts = shortcode_atts(
        array(
        ), $atts, $tag
    );
    $output = '<div class="cc-activites-wrapper">';
    if ( is_null($content) || strlen($content) < 1 ) {
        $output .= "<p class=cc-shortcode-err>" . CC_CAT_SHORTCODE_ERR_MSG . "</p>";
    } else {
        $content = sanitize_title($content);
        if ( !term_exists($content, CC_CAT_TAXONOMY) ) {
            $output .= "<p class=cc-shortcode-err>" . CC_CAT_SHORTCODE_TERM_ERR_MSG . "</p>";
        } else {
            //$output .= "<p class=cc-shortcode-err>le terme existe</p>";
            $args = array(
                'post_type'         =>      CC_CAT_CPT_NAME,
                'posts_per_page'    =>      -1,
                'tax_query'         =>      array(
                                            'taxonomy'  =>  CC_CAT_TAXONOMY,
                                            'field'     =>  'slug',
                                            'terms'     =>  $content
                                        )
            );
            $posts = get_posts($args);
            $first = true;
            $output .= '<div class="cc-activites-list">';
            foreach ( $posts as $post ) {
                if ( get_post_meta($post->ID, CC_CAT_TAXONOMY, true ) == $content ) {
                    $output .= '<div class="cc-activites-item">';
                    $output .= '<h4>' . $post->post_title . '</h4>';
                    $output .= '</div>';
                    if ( $first ) { $first = false; }
                }
            }
            $output .= '</div>';
        }
        
        
    }
        /*if ( in_array($content, $terms::to_array()) ) {
            $output .= '<p>baanen</p>';
        }*/
    $output .= '</div>';
    return $output;

    // get posts
    // get terms
    // for each term : echo query object
    // for earch query object : echo params
        /*$cc_terms = get_terms(array(
                                'taxonomy'      =>      'ccc_curriculum',
                                'hide_empty'    =>      false
        ));
        $q_args = array(
                        'post_type' =>  'ccc_course',
                        'taxonomy'  =>  'ccc_curriculum'
                    );
        $cc_query = new WP_Query( $q_args );

        if ( $cc_query->have_posts() ) : ?>
            <h3>Catalogue d'activités</h3>
            <?php while ( $cc_query->have_posts() ) : ?>
                <?php $cc_query->the_post(); the_title();?>
            <?php endwhile; ?>
        <?php endif;*/
}
?>