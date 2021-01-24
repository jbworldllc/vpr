<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Color picker shortcode param.
 *
 * @param $settings
 * @param $value
 *
 * @return string - html string.
 */
if ( ! function_exists( 'noo_before_after_colorpicker_param' ) ) :

	function noo_before_after_colorpicker_param( $settings, $value ) {
		$name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$id   = isset( $settings['id'] ) ? $settings['id'] : $settings['param_name'];

		$output = '<input id="' . esc_attr( $id ) . '" type="text" data-default-color="' . esc_attr( $value ) . '"';
		$output .= ' name="' . esc_attr( $name ) . '" class="nba-color-picker" value="' . esc_attr( $value ) . '"/>';

		return $output;
	}

	noo_before_after_add_shortcode_param( 'colorpicker', 'noo_before_after_colorpicker_param' );

endif;
