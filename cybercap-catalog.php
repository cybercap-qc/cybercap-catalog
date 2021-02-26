<?php
/**
 * Plugin Name: Cybercap Catalog
 * Plugin URI: https://cybercap.qc.ca
 * Description: Creates a catalog of activities, split into different curriculums
 * Version: 0.0.1
 * Author: Alix Jasmin-Morissette for Cybercap
 * License: GPLv2
 * Text Domain: cc-catalogu
 * Domain Path: /languages/
 */

if (!defined('ABSPATH')) {
    exit;
}

// Constants
define( 'CYBERCAP_CATALOG_DIR', plugin_dir_path(__FILE__) ) ;

// Classes
require_once( dirname(__FILE__) . '/classes/cybercap-catalog-initialiser.php'); // activation, deactivation, uninstall


// Activation, deactivation, removal
register_activation_hook( __FILE__, array('CC_Catalog_Initialiser', 'init') );
add_action('admin_menu', function() {
    require_once( dirname(__FILE__) . '/classes/cybercap-catalog-admin.php' );
    $catalog_admin = new CC_Catalog_Admin();
    $catalog_admin->add_menu_page_catalog();
});
/*
register_deactivation_hook( __FILE__, array() );
register_uninstall_hook( __FILE__, array('class.cc-catalog', 'destroy') );
*/
?>