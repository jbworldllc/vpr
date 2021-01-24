<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!class_exists('Noo_Image_Comparion_BeforeAfter_Params'))
{
    class Noo_Before_After_Params
    {
        protected static $params = array();
        protected static $scripts = array();

        public static function addField( $name = '', $form_field_callback, $base_type = '', $script_url = '' ) {

			if ( ! empty( $name ) && ! empty( $form_field_callback ) ) {
				self::$params[ $name ] = array(
					'callbacks' => array(
						'form' => $form_field_callback,
					),
				);

				self::$params[ $name ]['base'] = ! empty( $base_type ) ? $base_type : $name;

				if ( is_string( $script_url ) && ! in_array( $script_url, self::$scripts ) ) {
					self::$scripts[] = $script_url;
				}

				return true;
			}

			return false;
		}

		public static function renderField( $name, $field, $value, $tag = '' ) {
			if ( isset( self::$params[ $name ]['callbacks']['form'] ) ) {
				return call_user_func( self::$params[ $name ]['callbacks']['form'], $field, $value, $tag );
			}

			do_action( 'nic_render_param_' . $name, $field, $value, $tag );

			return '';
		}

		public static function getFieldBase( $name ) {
			if ( isset( self::$params[ $name ]['base'] ) ) {
				return self::$params[ $name ]['base'];
			}

			return $name;
		}

		/**
		 * List of javascript files urls for shortcode attributes.
		 *
		 * @return array - list of js scripts
		 */
		public static function getScripts() {
			return self::$scripts;
		}
    }
}
