<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Output elements list to choose from
 */

$elements = noo_before_after_get_elements();

$output = '<div class="nba-shortcode-list"><div class="nba-shortcode-list-h">';
$output .= '<h2 class="nba-shortcode-list-title">' . __( 'Insert shortcode', 'noo-before-after' ) . '</h2>';
$output .= '<div class="nba-shortcode-list-closer">&times;</div>';
$output .= '<ul class="nba-shortcode-list-list">';
foreach ( $elements as $name => $elm ) {
	$output .= '<li class="nba-shortcode-list-item for_' . $name . '" data-name="' . $name . '"><div class="nba-shortcode-list-item-h">';
	$output .= '<div class="nba-shortcode-list-item-icon"><i class="nba-item-icon';
	if ( isset( $elm['icon'] ) AND ! empty( $elm['icon'] ) ) {
		$output .= ' ' . esc_attr( $elm['icon'] );
	}
	$output .= '"></i></div>';
	$output .= '<div class="nba-shortcode-list-item-title">' . ( isset( $elm['name'] ) ? $elm['name'] : $name ) . '</div>';
	if ( isset( $elm['description'] ) AND ! empty( $elm['description'] ) ) {
		$output .= '<div class="nba-shortcode-list-item-description">' . $elm['description'] . '</div>';
	}
	$output .= '</div></li>';
}
$output .= '</ul></div></div>';

echo $output;
