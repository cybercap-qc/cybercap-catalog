<?php

namespace cc\catalog\taxonomy;

if (!defined('ABSPATH')) {
    exit;
}

// Required
require_once('cybercap-catalog-utils.php');
use const cc\catalog\utils\CC_CAT_TAXONOMY as CC_CAT_TAXONOMY;
use const cc\catalog\utils\CC_CAT_CPT_NAME as CC_CAT_CPT_NAME;
use const cc\catalog\utils\CC_CAT_COLOUR_ID as CC_CAT_COLOUR_ID;

// Hooks
add_action( 'init', __NAMESPACE__ . '\register_taxonomy_curriculum' );
add_action( 'save_post', __NAMESPACE__ . '\save_metabox_curriculum' );
/*add_action(CC_CAT_TAXONOMY . '_add_form_fields', __NAMESPACE__ . '\update_colour_meta_select');
add_action(CC_CAT_TAXONOMY . '_edit_form_fields', __NAMESPACE__ . '\update_colour_meta_select');
add_action('created_' . CC_CAT_TAXONOMY, __NAMESPACE__ . '\save_colour_meta');
add_action('edited_' . CC_CAT_TAXONOMY, __NAMESPACE__ . '\update_colour_meta');*

// Functions
/**
 * Adds the Curriculum taxonomy
 */
function register_taxonomy_curriculum() {
    $labels     =   array(
        'name'                  =>      _x( 'Curriculums', 'taxonomy general name' ),
        'singular name'         =>      _x( 'Curriculum', 'taxonomy singular name' ),
        'all_itmes'             =>      __( 'Tous les curriculums' ),
        'menu_name'             =>      __( 'Curriculum' ),
        'add_new_item'          =>      __( 'Ajouter un curriculum' )
    );
    $args       =   array(
        'labels'                =>      $labels,
        'description'           =>      'Un ensemble de cours',
        'hierarchical'          =>      false,
        'public'                =>      true,
        'show_ui'               =>      true,
        'meta_box_cb'           =>      __NAMESPACE__ . '\display_metabox_curriculum',
        //'meta_box_sanitize_cb'  =>      array( $this, 'taxonomy_meta_box_sanitize_cb_input'),
        'rewrite'               =>      array( 'slug'  =>  'curriculum' ),
    );
    register_taxonomy( CC_CAT_TAXONOMY, CC_CAT_CPT_NAME, $args );
    register_taxonomy_for_object_type( CC_CAT_TAXONOMY, CC_CAT_CPT_NAME );
}

/**
 * Displays the custom taxonomy metabox
 */
function display_metabox_curriculum() {
    if ( !taxonomy_exists( CC_CAT_TAXONOMY ) ) {
        ?> <p>Aucun curriculum n'a encore été créé.</p>" <?php
    } else {
        global $post;
        $post_metas = get_post_meta( (int)$post->ID, CC_CAT_TAXONOMY, false );
        $terms = get_terms( array( CC_CAT_TAXONOMY ), array('hide_empty' => false) );
        ?>
            <select
                name="<?php echo CC_CAT_TAXONOMY; ?>" id="cybercatalog-curriculum-select"
            >
                <option value="">--Choisir un curriculum--</option>
                <?php foreach ( $terms as $term ): ?>
                    <option
                        value="<?php echo $term->slug ?>"
                        <?php if ( count($post_metas) == 1 && isset($post_metas[0]) && $post_metas[0] === $term->slug): ?>
                        selected
                        <?php endif; ?>
                    >
                    <?php echo $term->name; ?></option>
                <?php endforeach; ?>
            </select>
            <?php foreach(get_terms( array('taxonomy' => CC_CAT_TAXONOMY )) as $boo) {
                echo $boo;
            } ?>
        <?php
    }
}

/**
 * Saves the selection of the taxonomy metabox
 */
function save_metabox_curriculum() {
    if ( isset( $_POST['post_ID'] ) && isset( $_POST[CC_CAT_TAXONOMY] ) ) {
        update_post_meta($_POST['post_ID'], CC_CAT_TAXONOMY, $_POST[CC_CAT_TAXONOMY], CC_CAT_TAXONOMY);
    }
}

/**
 * Registers the colour term meta
 */
function register_colour_meta() {
    register_meta(
        'term',
        'colour',
        array(
            'type'              =>      'string',
            'description'       =>      'La couleur associée au curriculum',
            'single'            =>      true,
            'default'           =>      '#ffffff',
            'show_in_rest'      =>      true
        ));
}

/**
 * Selects the colour term meta to create
 */
function add_colour_meta_select() {
    ?>
    <div class="form-field">
        <label for="<?php CC_CAT_COLOUR_ID; ?>"><?php _e('Curriculum colour', 'textdomain');?>
            <input
                type="color"
                id="curriculum-colour"
                name="curriculum-colour"
                value="<?php echo isset($_POST['curriculum-colour']) ? $_POST['curriculum-colour'] : '#ffffff' ?>"
            >
        </label>
    </div>
    <?php
}

/**
 * Selects the colour term meta to update
 */
function update_colour_meta_select() {
    ?>
    <tr class="form-field term-color-wrap">
        <th scope="row">
            <label for="curriculum-colour"><?php _e('Curriculum colour', 'textdomain');?></label>
        </th>
        <td>
            <input
                type="color"
                id="curriculum-colour"
                name="curriculum-colour"
                value="<?php echo isset($_POST['curriculum-colour']) ? $_POST['curriculum-colour'] : '#ffffff' ?>"
            >
        </td>
    </tr>
    <?php
}

/**
 * Saves the colour meta to the database
 */
function save_colour_meta() {

}

?>