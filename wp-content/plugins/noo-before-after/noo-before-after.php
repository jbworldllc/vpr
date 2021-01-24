<?php
/**
 * Plugin Name: Noo Before After
 * Plugin URI: https://www.nootheme.com
 * Version: 1.0.7
 * Author: NooTheme
 * Author URI: https://www.nootheme.com
 * Description: Add button create image comparison to TinyMCE.
 * Text Domain: noo-before-after
 * License: GPLv2 or later
 */

global $noo_ba_dir, $noo_ba_uri;
$noo_ba_dir = apply_filters( 'noo_ba_dir', plugin_dir_path( __FILE__ ) ); // Expect to run inside a plugin
$noo_ba_uri = apply_filters( 'noo_ba_uri', plugins_url( '', __FILE__ ) ); // Expect to run inside a plugin

require $noo_ba_dir . 'functions/helper.php';
require $noo_ba_dir . 'class-noo-before-after-elements.php';
require $noo_ba_dir . 'class-noo-before-after-params.php';
require $noo_ba_dir . 'functions/functions.php';
require $noo_ba_dir . 'class-noo-before-after.php';
require $noo_ba_dir . 'class-noo-before-after-elementor.php';

$noo_before_after = new Noo_Before_After;

// Ajax requests
if ( is_admin() AND isset( $_POST['action'] ) AND substr( $_POST['action'], 0, 4 ) == 'nba_' ) {
	require $noo_ba_dir . 'functions/ajax.php';
}
