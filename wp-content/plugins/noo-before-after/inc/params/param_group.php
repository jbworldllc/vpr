<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! function_exists( 'noo_before_after_param_group_param' ) ) {
    function noo_before_after_param_group_param($settings, $value) {
        global $noo_before_after_form_index;
        $field_id_pattern = isset( $field_id_pattern ) ? $field_id_pattern : ( 'noo_before_after_form_' . $noo_before_after_form_index . '_%s' );

        $name    = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
        $id      = isset( $settings['id'] ) ? $settings['id'] : $settings['param_name'];
        $options = isset( $settings['value'] ) && ! empty( $settings['value'] ) ? $settings['value'] : array();

        $output = '<ul class="nba_param_group-list nba_settings">';
        $output1 = '<li class="nba_param wpb_nba_row nba_param_group-collapsed">';
        $output1 .= '<div class="nba_controls nba_controls-row nba_clearfix nba_param_group-controls">
	<a class="nba_control column_move nba_move-param" href="#" title="' . __( 'Drag row to reorder', 'js_composer' ) . '" data-vc-control="move">
	    <i class="nba-icon nba-icon-dragndrop fa fa-arrows-alt"></i>
	</a>
	<span class="nba_param-group-admin-labels"></span>
	<span class="nba_row_edit_clone_delete">
		<a class="nba_control column_delete nba_delete-param" href="#" title="' . __( 'Delete this param', 'js_composer' ) . '">
		    <i class="nba-icon nba-icon-delete_empty fa fa-times"></i>
		</a>
		<a class="nba_control column_clone" href="#" title="' . __( 'Clone this row', 'js_composer' ) . '">
		    <i class="nba-icon nba-icon-content_copy fa fa-clone"></i>
		</a>
		<a class="nba_control column_toggle" href="#" title="' . __( 'Toggle row', 'js_composer' ) . '">
		    <i class="nba-icon nba-icon-arrow_drop_down fa fa-caret-up"></i>
		</a>
	</span>
</div>
<div class="nba-wpb_element_wrapper">
	<div class="nba_row nba_row-fluid wpb_row_container">
		<div class="wpb_nba_column wpb_sortable nba_col-sm-12 wpb_content_holder nba_empty-column">
			<div class="wpb_element_wrapper">
				<div class="nba_fields nba_clearfix">';

        foreach($settings['params'] as $k => $setting) {
            $param['id']     = sprintf( $field_id_pattern, $setting['param_name'] );
            $param_base_type = noo_before_after_get_param_base_type( $setting['type'] );

            $output1 .= '<div class="nba-form-control type_' . $param_base_type . '" data-param_name="' . $setting['param_name'] . '" data-param_type="' . $param_base_type . '">';
            //field heading
            if ( isset( $setting['heading'] ) AND ! empty( $setting['heading'] ) ) {
                $output1 .= '<div class="nba-form-control-title">';
                $output1 .= '<label>' . $setting['heading'] . '</label>';
                $output1 .= '</div>';
            }
            $output1 .= '<div class="nba-form-control-field">';
            $value  = isset( $value[ $setting['param_name'] ] ) ? $value[ $setting['param_name'] ] : '';
            $output1 .= noo_before_after_render_param( $setting['type'], $setting, $value, $setting['param_name'] );
            $output1 .= '</div>';
            $output1 .= '</div>';
        }
        $output1 .= '
				</div>
			</div>
		</div>
	</div>
</div>';
        $output1 .='</li>';
        $output .= '<li class="wpb_nba_row nba_param_group-collapsed nba_param_group_blank">';
        $output .= '<div class="nba_controls nba_controls-row nba_clearfix nba_param_group-controls">
	<a class="nba_control column_move nba_move-param" href="#" title="' . __( 'Drag row to reorder', 'noo-before-after' ) . '" data-vc-control="move">
	    <i class="nba-icon nba-icon-dragndrop fa fa-arrows-alt"></i>
	</a>
	<span class="nba_param-group-admin-labels">'. __( 'Item', 'noo-before-after' ) .'</span>
	<span class="nba_row_edit_clone_delete">
		<a class="nba_control column_delete nba_delete-param" href="#" title="' . __( 'Delete this param', 'noo-before-after' ) . '">
		    <i class="nba-icon nba-icon-delete_empty fa fa-times"></i>
		</a>
		<a class="nba_control column_clone" href="#" title="' . __( 'Clone this row', 'noo-before-after' ) . '">
		    <i class="nba-icon nba-icon-content_copy fa fa-clone"></i>
		</a>
		<a class="nba_control column_toggle" href="#" title="' . __( 'Toggle row', 'noo-before-after' ) . '">
		    <i class="nba-icon nba-icon-arrow_drop_down fa fa-caret-up"></i>
		</a>
	</span>
</div>
<div class="nba-wpb_element_wrapper">
	<div class="nba_row nba_row-fluid wpb_row_container">
		<div class="wpb_nba_column wpb_sortable nba_col-sm-12 wpb_content_holder nba_empty-column">
			<div class="wpb_element_wrapper">
				<div class="nba_fields nba_clearfix">';

        foreach($settings['params'] as $k => $setting) {
            $param['id']     = sprintf( $field_id_pattern, $setting['param_name'] );
            $param_base_type = noo_before_after_get_param_base_type( $setting['type'] );

            $output .= '<div class="nba-form-control type_' . $param_base_type . '" data-param_name="' . $setting['param_name'] . '" data-param_type="' . $param_base_type . '">';
            //field heading
            if ( isset( $setting['heading'] ) AND ! empty( $setting['heading'] ) ) {
                $output .= '<div class="nba-form-control-title">';
                $output .= '<label>' . $setting['heading'] . '</label>';
                $output .= '</div>';
            }
            $output .= '<div class="nba-form-control-field">';
            $value  = isset( $value[ $setting['param_name'] ] ) ? $value[ $setting['param_name'] ] : '';
            $output .= noo_before_after_render_param( $setting['type'], $setting, $value, $setting['param_name'] );
            $output .= '</div>';
            $output .= '</div>';
        }
        $output .= '
				</div>
			</div>
		</div>
	</div>
</div>';
        $output .='</li>';
        $output .= '<li class="nba_wpb_column_container nba_container_for_children nba_param_group-add_content"></li>';
        $output .= '</ul>';
        return $output;
    }
    noo_before_after_add_shortcode_param( 'param_group', 'noo_before_after_param_group_param' );
}
