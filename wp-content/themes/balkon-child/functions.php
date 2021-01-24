<?php
/**
 * @package Balkon - Creative  Responsive  Architecture WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date: 10-07-2017
 * @version: 1.0
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
// Your php code goes here
function balkon_child_enqueue_styles() {
    $parent_style = 'balkon-style'; // This is 'balkon-style' for the Anakual theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('google-fonts','balkon-plugins'), null );
    wp_enqueue_style( 'balkon-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'balkon_child_enqueue_styles' );