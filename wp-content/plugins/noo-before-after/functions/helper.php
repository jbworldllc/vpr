<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (!function_exists('noo_before_after_load_template'))
{
	/**
	 * Load and output the template
	 *
	 * @param string $template Template path
	 * @param array  $vars     Variables that should be passed to the template
	 */
	function noo_before_after_load_template( $template, $vars = null ) {
		global $noo_ba_dir;

		if ( is_array( $vars ) AND ! empty( $vars ) ) {
			extract( $vars );
		}

		if ( ! file_exists( $noo_ba_dir . 'templates/' . $template . '.php' ) ) {
			wp_die( 'File not found: ' . $noo_ba_dir . 'templates/' . $template . '.php' );
		}

		include $noo_ba_dir . 'templates/' . $template . '.php';
	}
}

if (!function_exists('nba_pass_data_to_js'))
{
    function nba_pass_data_to_js($data) {
        return ' onclick=\'return ' . str_replace( "'", '&#39;', json_encode( $data ) ) . '\'';
    }
}

if ( ! function_exists( 'noo_before_after_get_template' ) )
{

	/**
	 * Get and return the template output
	 *
	 * @param string $template Template path
	 * @param array  $vars     Variables that should be passed to the template
	 *
	 * @return string Template output
	 */
	function noo_before_after_get_template( $template, $vars = null ) {
		ob_start();
	    noo_before_after_load_template( $template, $vars );

		return ob_get_clean();
	}
}

if ( ! function_exists( 'noo_before_after_check_visible_by_dependency' ) )
{

	/**
	 * Checks if the field is visible base on the values of dependent param
	 *
	 * Note: at any possible syntax error we choose to show the field so it will be functional anyway.
	 *
	 * @param array $dependency Showing condition:
	 *                          element   -  String    Param name (linked field) which will be observed for changes.
	 *                          value     -  Array     List of linked element's values which will allow to display param
	 *                          not_empty -  Boolean   Display field if value of linked field is not empty
	 *                          callback  -  String    javascript function name to be called when value of linked field is
	 *                          changed
	 * @param array $values
	 *
	 * @return bool
	 */
	function noo_before_after_check_visible_by_dependency( $dependency, $values ) {
		if ( ! is_array( $dependency ) OR count( $dependency ) < 2 OR ! isset( $dependency['element'] ) OR empty( $dependency['element'] ) ) {
			// Wrong condition
			$result = true;
		} else {
			$param = $dependency['element'];
			$check = $values[ $param ];
			$check = is_array( $check ) ? current( $check ) : $check;
			if ( isset( $dependency['not_empty'] ) ) {
				$result = ! empty( $check );
			} elseif ( isset( $dependency['value'] ) ) {
				$value = ! is_array( $dependency['value'] ) ? array( $dependency['value'] ) : $dependency['value'];

				$result = in_array( $check, $value );
			} else {
				$result = true;
			}
		}

		return $result;
	}
}

if ( ! function_exists( 'noo_before_after_map_get_param_default' ) )
{
	/**
	 * Function to get default value for shortcode param
	 *
	 * @since 1.0.0
	 *
	 * @param $param
	 *
	 * @return string
	 */
	function noo_before_after_map_get_param_default( $param ) {
		$value = '';

		if ( isset( $param['param_name'] ) && 'content' !== $param['param_name'] ) {
			if ( isset( $param['std'] ) ) {
				$value = $param['std'];
			} elseif ( isset( $param['value'] ) ) {
				if ( is_array( $param['value'] ) ) {
					$value = current( $param['value'] );
					if ( is_array( $value ) ) {
						// in case if two-dimensional array provided (vc_basic_grid)
						$value = current( $value );
					}
					// return first value from array (by default)
				} else {
					$value = $param['value'];
				}
			}

			if ( 'checkbox' === $param['type'] ) {
				$value = '';
				if ( isset( $param['std'] ) ) {
					$value = $param['std'];
				}
			}
		}

		return $value;
	}
}

if ( ! function_exists( 'noo_before_after_parse_multi_attribute' ) )
{

	/**
	 * 
	 * Copy of vc_parse_multi_attribute function
	 *
	 * @param       $value
	 * @param array $default
	 *
	 * @return array
	 */
	function noo_before_after_parse_multi_attribute( $value, $default = array() ) {
		$result       = $default;
		$params_pairs = explode( '|', $value );
		if ( ! empty( $params_pairs ) ) {
			foreach ( $params_pairs as $pair ) {
				$param = preg_split( '/\:/', $pair );
				if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
					$result[ $param[0] ] = rawurldecode( $param[1] );
				}
			}
		}

		return $result;
	}
}

if ( ! function_exists( 'noo_before_after_get_dropdown_option' ) )
{

	/**
	 * Copy of vc_get_dropdown_option function.
	 * Used for with or without Visual Composer
	 *
	 * @since 1.0.0
	 *
	 * @param $param
	 * @param $value
	 *
	 * @return mixed|string
	 */
	function noo_before_after_get_dropdown_option( $param, $value ) {
		if ( '' === $value && is_array( $param['value'] ) ) {
			$value = array_shift( $param['value'] );
		}
		if ( is_array( $value ) ) {
			reset( $value );
			$value = isset( $value['value'] ) ? $value['value'] : current( $value );
		}
		$value = preg_replace( '/\s/', '_', $value );

		return ( '' !== $value ? $value : '' );
	}
}

if ( ! function_exists( 'noo_before_after_value_from_safe' ) ) :

	/**
	 * Copy of vc_value_from_safe function.
	 * Get value from encoded data
	 *
	 * @param bool $encode
	 *
	 * @return string
	 */
	function noo_before_after_value_from_safe( $value, $encode = false ) {
		$value = preg_match( '/^#E\-8_/', $value ) ? rawurldecode( base64_decode( preg_replace( '/^#E\-8_/', '',
			$value ) ) ) : $value;
		if ( $encode ) {
			$value = htmlentities( $value, ENT_COMPAT, 'UTF-8' );
		}

		return $value;
	}

endif;


if ( ! function_exists( 'noo_before_after_enqueue_param_scripts' ) )
{

	/**
	 * Enqueue js scripts required by shortcode params.
	 *
	 * @return string
	 */
	function noo_before_after_enqueue_param_scripts() {
		$output  = '';
		$scripts = apply_filters( 'noo_before_after_form_scripts', Noo_Before_After_Params::getScripts() );
		foreach ( $scripts as $script ) {
			$output .= "\n\n" . '<script type="text/javascript" src="' . $script . '"></script>';
		}

		return $output;
	}
}
