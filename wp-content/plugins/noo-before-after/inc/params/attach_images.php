<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Attach image(s) shortcode param.
 *
 * @param $settings
 * @param $value
 *
 * @return string - html string.
 */
if ( ! function_exists( 'noo_before_after_attach_images_param' ) ) :

	function noo_before_after_attach_images_param( $settings, $value ) {
		$name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';

		$img_ids  = empty( $value ) ? array() : array_map( 'intval', explode( ',', $value ) );
		$multiple = ( isset( $settings['multiple'] ) AND $settings['multiple'] );

		if ( $multiple ) {
			wp_enqueue_script( 'jquery-ui-sortable' );
		}

		$output = '<div class="nba-imgattach" data-multiple="' . intval( $multiple ) . '">';
		$output .= '<ul class="nba-imgattach-list">';
		foreach ( $img_ids as $img_id ) {
			$output .= '<li data-id="' . $img_id . '"><a href="javascript:void(0)" class="nba-imgattach-delete">&times;</a>' . wp_get_attachment_image( $img_id,
					'thumbnail', true ) . '</li>';
		}
		$output        .= '</ul>';
		$add_btn_title = $multiple ? __( 'Add images', 'noo-shortcode-builder' ) : __( 'Add image',
			'noo-shortcode-builder' );
		$output        .= '<a href="javascript:void(0)" class="nba-imgattach-add" title="' . $add_btn_title . '">+</a>';
		$output        .= '<input type="hidden" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" data-type="image"/>';
		$output        .= '</div>';

		return $output;
	}

	noo_before_after_add_shortcode_param( 'attach_image', 'noo_before_after_attach_images_param' );
	noo_before_after_add_shortcode_param( 'attach_images', 'noo_before_after_attach_images_param' );

endif;
