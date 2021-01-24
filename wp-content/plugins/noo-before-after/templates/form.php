<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $noo_before_after_form_index;
$field_id_pattern = isset( $field_id_pattern ) ? $field_id_pattern : ( 'noo_before_after_form_' . $noo_before_after_form_index . '_%s' );
$values           = ( isset( $values ) AND is_array( $values ) ) ? $values : array();

// Validating, sanitizing and grouping params
$groups = array();
foreach ( $params as &$param ) {
	$param_name = $param['param_name'];

	$param['type'] = isset( $param['type'] ) ? $param['type'] : 'textfield';

	if ( $param['type'] == 'textarea_html' AND $param_name != 'content' ) {
		// For VC-compatibility we may have only one wysiwyg field and it should be called content
		$param['type'] = 'textarea_raw_html';
	}
	$param['classes'] = isset( $param['classes'] ) ? $param['classes'] : '';
	$param['std']     = noo_before_after_map_get_param_default( $param );
	// Filling missing values with standard ones
	if ( ! isset( $values[ $param_name ] ) ) {
		$values[ $param_name ] = $param['std'];
	}
	$group = isset( $param['group'] ) ? $param['group'] : __( 'General', 'noo-before-after' );
	if ( ! isset( $groups[ $group ] ) ) {
		$groups[ $group ] = array();
	}
	$groups[ $group ][ $param_name ] = &$param;
}
$output = '<div class="nba-form" data-shortcode="' . $name . '"><div class="nba-form-h">';
if ( count( $groups ) > 1 ) {
	$group_index = 0;
	$output      .= '<div class="nba-tabs">';
	$output      .= '<div class="nba-tabs-list">';
	foreach ( $groups as $group => &$group_params ) {
		$output .= '<div class="nba-tabs-item' . ( $group_index ? '' : ' active' ) . '">' . $group . '</div>';
		$group_index ++;
	}
	$output .= '</div>';
}
$output .= '<div class="nba-tabs-sections">';

$group_index = 0;
foreach ( $groups as &$group_params ) {
	$output .= '<div class="nba-tabs-section" style="display: ' . ( $group_index ? 'none' : 'block' ) . '">';
	$output .= '<div class="nba-tabs-section-h">';
	foreach ( $group_params as $param_name => &$param ) {
		// Field params
		$param['id']     = sprintf( $field_id_pattern, $param_name );
		$param_base_type = noo_before_after_get_param_base_type( $param['type'] );

		// Handle dynamical field visibility
		$field_is_shown = isset( $param['dependency'] ) ? noo_before_after_check_visible_by_dependency( $param['dependency'],
			$values ) : true;

		$output .= '<div class="nba-form-control type_' . $param_base_type . ' ' . $param['classes'] . '" data-param_name="' . $param_name . '" data-param_type="' . $param_base_type . '"' . ( $field_is_shown ? '' : ' style="display: none"' ) . '>';
		if ( isset( $param['heading'] ) AND ! empty( $param['heading'] ) ) {
			$output .= '<div class="nba-form-control-title">';
			$output .= '<label for="' . esc_attr( $param['id'] ) . '">' . $param['heading'] . '</label>';
			$output .= '</div>';
		}
		$output .= '<div class="nba-form-control-field">';

		if ( $param['type'] == 'attach_images' ) {
			$param['multiple'] = true;
		}
		$value  = isset( $values[ $param_name ] ) ? $values[ $param_name ] : $param['std'];
		$output .= noo_before_after_render_param( $param['type'], $param, $value, $name );

		$output .= '</div>';
		if ( isset( $param['description'] ) AND ! empty( $param['description'] ) ) {
			$output .= '<div class="nba-form-control-description">' . $param['description'] . '</div>';
		}
		if ( isset( $param['dependency'] ) AND ! empty( $param['dependency'] ) ) {
			$output .= '<div class="nba-form-control-dependency"' . nba_pass_data_to_js( $param['dependency'] ) . '></div>';
		}
		$output .= '</div><!-- .nba-form-control -->';
	}
	$output .= '</div></div><!-- .nba-tabs-section -->';
	$group_index ++;
}
$output .= '</div><!-- .nba-tabs-sections -->';

if ( count( $groups ) > 1 ) {
	$output .= '</div><!-- .nba-tabs -->';
}

// Param scripts
$output .= noo_before_after_enqueue_param_scripts();

$output .= '</div></div>';
echo $output;
