<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Checkbox shortcode param.
 *
 * @param $settings
 * @param $value
 *
 * @return string - html string.
 */
if ( ! function_exists( 'noo_before_after_checkbox_param' ) ) :

	function noo_before_after_checkbox_param( $settings, $value ) {
		$name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$options = isset( $settings['value'] ) && ! empty( $settings['value'] ) ? $settings['value'] : $options = array( '' => true );
		$values  = explode( ',', $value );

		$output = '';
		foreach ( $options as $label => $option ) {
			$output .= '<label class="nba-checkbox">';
			$output .= '<input type="checkbox" value="' . esc_attr( $option ) . '"';
			if ( in_array( $option, $values ) ) {
				$output .= ' checked="checked"';
			}
			$output .= ' /> ' . $label . '</label>';
		}
		$output .= '<input type="hidden" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" />';

		return $output;
	}

	noo_before_after_add_shortcode_param( 'checkbox', 'noo_before_after_checkbox_param' );

endif;
