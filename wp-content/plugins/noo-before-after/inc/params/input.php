<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Default input shortcode param.
 *
 * @param $settings
 * @param $value
 *
 * @return string - html string.
 */
if ( ! function_exists( 'noo_before_after_input_param' ) ) :

	function noo_before_after_input_param( $settings, $value ) {
		$name  = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$id    = isset( $settings['id'] ) ? $settings['id'] : $settings['param_name'];
		$type  = isset( $settings['type'] ) ? $settings['type'] : 'text';
		$class = 'wpb_vc_param_value wpb-input ' . $name . ' ' . $settings['type'] . '_field';

		$attributes = '';
		foreach ( array( 'min', 'max', 'step', 'maxlength', 'placeholder' ) as $attr ) {
			$attributes .= ( isset( $settings[ $attr ] ) && ! empty( $settings[ $attr ] ) ) ? ' ' . $attr . '="' . $settings[ $attr ] . '"' : '';
		}

		$output = '<input type="' . esc_attr( $type ) . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . esc_attr( $value ) . '" class="' . esc_attr( $class ) . '" ' . $attr . '/>';

		return $output;
	}

	noo_before_after_add_shortcode_param( 'text', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'url', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'number', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'email', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'password', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'date', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'datetime', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'time', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'week', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'month', 'noo_before_after_input_param' );
	noo_before_after_add_shortcode_param( 'range', 'noo_before_after_input_param' );

endif;
