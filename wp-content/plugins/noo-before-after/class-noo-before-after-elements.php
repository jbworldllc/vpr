<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!class_exists('Noo_Image_Comparion_BeforeAfter_Elements'))
{
    class Noo_Before_After_Elements
    {
        protected static $elements = array();

        /**
         * Map Shortcode
         * @param string $tag
         * @param array $attributes
         *
         * @return bool
         */
        public static function addElement( $tag, $attributes ) {
			if ( empty( $attributes['name'] ) ) {
				trigger_error( sprintf( __( 'Wrong name for shortcode:%s. Name required', 'noo-before-after' ), $tag ) );
			} elseif ( empty( $attributes['base'] ) ) {
				trigger_error( sprintf( __( 'Wrong base for shortcode:%s. Base required', 'noo-before-after' ), $tag ) );
			} else {
				self::$elements[ $tag ] = $attributes;

				return true;
			}

			return false;
		}

        public static function getElements() {
			return self::$elements;
		}
    }
}
