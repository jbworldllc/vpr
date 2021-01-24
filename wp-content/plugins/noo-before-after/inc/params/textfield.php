<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Textfield shortcode param.
 *
 * @param $settings
 * @param $value
 *
 * @return string - html string.
 */
if ( ! function_exists( 'noo_before_after_textfield_param' ) ) :

	function noo_before_after_textfield_param( $settings, $value, $prefix = '' ) {
		$name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$id   = isset( $settings['id'] ) ? $settings['id'] : $settings['param_name'];

		$output = '<input type="text" name="' . esc_attr( $name ) . '" class="' . esc_attr( $id ) . '" value="' . esc_attr( $value ) . '" />';

		return $output;
	}

	noo_before_after_add_shortcode_param( 'textfield', 'noo_before_after_textfield_param' );
	noo_before_after_add_shortcode_param( 'el_id', 'noo_before_after_textfield_param', 'textfield' );
	noo_before_after_add_shortcode_param( 'tab_id', 'noo_before_after_textfield_param', 'textfield' );

endif;
