<?php
/*
Plugin Name: Balkon Add-Ons
Plugin URI: https://demowp.cththemes.net/balkon/
Description: A custom plugin for Balkon - Responsive Photography Portfolio WordPress Theme
Version: 1.3.1
Author: CTHthemes
Author URI: http://themeforest.net/user/cththemes
Text Domain: balkon-add-ons
Domain Path: /languages/
License: GNU General Public License version 3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined('ABSPATH') ) {
    die('Please do not load this file directly!');
}

if ( ! defined( 'CTH_PLUGIN_FILE' ) ) {
    define( 'CTH_PLUGIN_FILE', __FILE__ );
}

if ( ! class_exists( 'Balkon_Addons' ) ) {
    include_once dirname( __FILE__ ) . '/includes/class-addons.php';
}

function CTH_ADO() {
    return Balkon_Addons::getInstance();
}

CTH_ADO();




