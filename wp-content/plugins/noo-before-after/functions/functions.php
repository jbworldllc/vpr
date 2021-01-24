<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if(!function_exists('noo_before_after_map'))
{
    /**
     * Add new shortcode to shortcode list
     * @param  array $attributes
     * @return [type]             [description]
     */
    function noo_before_after_map($attributes)
    {
        if(!isset($attributes['base']))
        {
            trigger_error(__('Wrong ns_map object. Base attribute is required', 'noo-before-after'), E_USER_ERROR);
            die;
        }
        Noo_Before_After_Elements::addElement( $attributes['base'], $attributes );

		//map elements to visual composer
        if(function_exists('vc_map')) {
			vc_map( $attributes );
		}
		//TO DO: map elements to Elementor page builder
    }
}

if(!function_exists('noo_before_after_get_elements'))
{
    /**
     * Get all registered elements
     * @return array
     */
    function noo_before_after_get_elements()
    {
        return Noo_Before_After_Elements::getElements();
    }
}

if ( ! function_exists( 'noo_before_after_add_shortcode_param' ) )
{

	/**
	 * Shorthand function to register hook for the new shortcode param.
	 *
	 * @param $name                - param name
	 * @param $form_field_callback - hook, will be called when settings form is shown and param added to shortcode
	 *                             param list
	 * @param $base_type           - the type this new param is base on
	 *
	 * @param $script_url          - javascript file url which will be attached at the end of settings form.
	 */
	function noo_before_after_add_shortcode_param( $name, $form_field_callback, $base_type = '', $script_url = null ) {
		$result = Noo_Before_After_Params::addField( $name, $form_field_callback, $base_type, $script_url );

		if ( function_exists( 'vc_add_shortcode_param' ) ) {
			global $vc_params_list;
			if ( empty( $vc_params_list ) || ! in_array( $name, $vc_params_list ) ) {
				vc_add_shortcode_param( $name, $form_field_callback, $script_url );
			}
		}

		return $result;
	}
}

if ( ! function_exists( 'noo_before_after_render_param' ) ) :

	/**
	 * Shorthand function to render new shortcode param.
	 *
	 * @param $name
	 * @param $settings
	 * @param $value
	 *
	 * @return string - html string
	 */
	function noo_before_after_render_param( $name, $settings, $value, $tag = '' ) {

		return Noo_Before_After_Params::renderField( $name, $settings, $value, $tag );
	}

endif;

if ( ! function_exists( 'noo_before_after_get_param_base_type' ) ) :

	/**
	 * Shorthand function to get the type of the shortcode param.
	 *
	 * @param string $name - param type name
	 *
	 * @return string - param type, base on a standard type or a new type.
	 */
	function noo_before_after_get_param_base_type( $name ) {

		return Noo_Before_After_Params::getFieldBase( $name );
	}

endif;
