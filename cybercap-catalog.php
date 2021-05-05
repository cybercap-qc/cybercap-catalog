<?php
/**
 * Plugin Name: Cybercap Catalog
 * Description: Un catalogue d'activités pour Cybercap
 * Version: Zéro
 * Author: Alix Jasmin-Morissette
 * License: GPLv2
 * Text Domain: cc-cat
 */

namespace cc\catalog;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handles the activation and deactivation of the plugin
 */

// Required files
require_once('includes/cybercap-catalog-cpt.php');
require_once('includes/cybercap-catalog-taxonomy.php');
require_once('includes/cybercap-catalog-template.php');

// Registration, unregistration and uninstall hooks and functions
function activate() {
}

function deactivate() {
}

function uninstall() {

}

register_activation_hook( __FILE__, __NAMESPACE__ . '\activate' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate' );
register_uninstall_hook( __FILE__, __NAMESPACE__ . '\uninstall' );
?>