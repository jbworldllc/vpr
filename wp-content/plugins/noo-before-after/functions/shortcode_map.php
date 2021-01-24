<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$category_name = esc_html__( 'By NooTheme', 'noo-before-after' );

 /**
  * Create shortcode: [noo_beforeafter]
  */
  noo_before_after_map( array(
      'name'        => esc_html__( 'Noo Before After', 'noo-before-after' ),
      'base'        => 'noo_beforeafter',
      'description' => '',
      'icon'        => 'fa-picture-o',
      'category'    => $category_name,
      'params'      => array(
          array(
              'param_name'  => 'items',
              'heading'     => esc_html__('Items', 'noo-before-after'),
              'type'        => 'param_group',
              'params'      => array(
                  array(
                      'param_name'  => 'bimg',
                      'heading'     => esc_html__( 'Before Image', 'noo-before-after' ),
                      'type'        => 'attach_image',
                      'admin_label' => true,
                      'value'       => '',
                  ),
                  array(
                      'param_name'  => 'blabel',
                      'heading'     => esc_html__( 'Before Image Label (optional)', 'noo-before-after' ),
                      'description' => '',
                      'admin_label' => false,
                      'type'        => 'textfield',
                      'value'       => '',
                  ),

                  array(
                      'param_name'  => 'aimg',
                      'heading'     => esc_html__( 'After Image', 'noo-before-after' ),
                      'type'        => 'attach_image',
                      'admin_label' => true,
                      'value'       => '',
                  ),

                  array(
                      'param_name'  => 'alabel',
                      'heading'     => esc_html__( 'After Image Label (optional)', 'noo-before-after' ),
                      'description' => '',
                      'admin_label' => false,
                      'type'        => 'textfield',
                      'value'       => '',
                  ),

                  array(
                      'param_name'  => 'overlayimg',
                      'heading'     => esc_html__( 'Overlay Image', 'noo-before-after' ),
                      'type'        => 'attach_image',
                      'admin_label' => false,
                      'value'       => '',
                  ),
              ),
          ),
          array(
              'param_name'  => 'width',
              'heading'     => esc_html__( 'Width', 'noo-before-after' ),
              'description' => 'Default: 100%. Example: 50% or 200px',
              'type'        => 'textfield',
              'value'       => '',
          ),

          array(
              'param_name'  => 'direction',
              'heading'     => esc_html__( 'Comparison Direction', 'noo-before-after' ),
              'description' => '',
              'admin_label' => true,
              'type'        => 'dropdown',
              'value'       => array(
                  esc_html__( 'Horizontal', 'noo-before-after' )    => 'horizontal',
                  esc_html__( 'Vertical', 'noo-before-after' )      => 'vertical'
              ),
          ),

          array(
              'param_name'  => 'type',
              'heading'     => esc_html__( 'Comparison Type', 'noo-before-after' ),
              'description' => '',
              'admin_label' => true,
              'type'        => 'dropdown',
              'value'       => array(
                  esc_html__( 'Hover', 'noo-before-after' )    => 'mouse_move',
                  esc_html__( 'Click', 'noo-before-after' )      => 'click',
                  esc_html__( 'Drag', 'noo-before-after' )      => 'drag'
              ),
          ),

          array(
              'param_name'  => 'class',
              'heading'     => esc_html__( 'Class', 'noo-before-after' ),
              'description' => esc_html__('(Optional) Enter a unique class name.', 'noo-before-after'),
              'admin_label' => true,
              'type'        => 'textfield',
          ),

          array(
              'param_name' => 'control_offset',
              'heading'    => esc_html__( 'Offset', 'noo-timetable' ),
              'type'       => 'ui_slider',
              'value'      => '50',
              'data_min'   => '0',
              'data_max'   => '100',
              'description'	=> 'Default: 50 (%)',
              'group'         => esc_html__( 'Control Bar', 'noo-before-after' ),
          ),

          array(
              'param_name'  => 'control_color',
              'heading'     => esc_html__( 'Color', 'noo-before-after' ),
              'description' => '',
              'admin_label' => false,
              'type'        => 'colorpicker',
              'value'         => '',
              'group'         => esc_html__( 'Control Bar', 'noo-before-after' ),
          ),

          array(
              'param_name'  => 'items_display',
              'heading'     => esc_html__( 'Item Per Slide (Desktop)', 'noo-before-after' ),
              'description' => 'The number of items you want to see on the screen.',
              'type'        => 'dropdown',
              'value'       => array(
                  esc_html__( '1 item', 'noo-before-after' )    => '1',
                  esc_html__( '2 items', 'noo-before-after' )    => '2',
                  esc_html__( '3 items', 'noo-before-after' )    => '3',
                  esc_html__( '4 items', 'noo-before-after' )    => '4',
                  esc_html__( '5 items', 'noo-before-after' )    => '5',
                  esc_html__( '6 items', 'noo-before-after' )    => '6',
              ),
              'group'         => esc_html__( 'Slide Options', 'noo-before-after' ),
          ),

		  array(
              'param_name'  => 'items_display_tablet',
              'heading'     => esc_html__( 'Item Per Slide (Tablet - Breakpoint 1024px)', 'noo-before-after' ),
              'description' => 'The number of items you want to see on the tablet.',
              'type'        => 'dropdown',
              'value'       => array(
                  esc_html__( '1 item', 'noo-before-after' )    => '1',
                  esc_html__( '2 items', 'noo-before-after' )    => '2',
                  esc_html__( '3 items', 'noo-before-after' )    => '3',
                  esc_html__( '4 items', 'noo-before-after' )    => '4',
                  esc_html__( '5 items', 'noo-before-after' )    => '5',
                  esc_html__( '6 items', 'noo-before-after' )    => '6',
              ),
              'group'         => esc_html__( 'Slide Options', 'noo-before-after' ),
          ),

		  array(
              'param_name'  => 'items_display_mobile',
              'heading'     => esc_html__( 'Item Per Slide (Mobile - Breakpoint 768px)', 'noo-before-after' ),
              'description' => 'The number of items you want to see on the mobile.',
              'type'        => 'dropdown',
              'value'       => array(
                  esc_html__( '1 item', 'noo-before-after' )    => '1',
                  esc_html__( '2 items', 'noo-before-after' )    => '2',
                  esc_html__( '3 items', 'noo-before-after' )    => '3',
                  esc_html__( '4 items', 'noo-before-after' )    => '4',
                  esc_html__( '5 items', 'noo-before-after' )    => '5',
                  esc_html__( '6 items', 'noo-before-after' )    => '6',
              ),
              'group'         => esc_html__( 'Slide Options', 'noo-before-after' ),
          ),

          array(
              'param_name'  => 'loop',
              'heading'     => esc_html__( 'Loop', 'noo-before-after' ),
              'description' => 'Infinity loop. Duplicate last and first items to get loop illusion.',
              'type'        => 'checkbox',
              'value'       => '',
              'group'         => esc_html__( 'Slide Options', 'noo-before-after' ),
          ),

          array(
              'param_name'  => 'auto_height',
              'heading'     => esc_html__( 'Auto Height', 'noo-before-after' ),
              'description' => 'Enables adaptive height for single slide horizontal carousels.',
              'type'        => 'checkbox',
              'value'       => '',
              'group'         => esc_html__( 'Slide Options', 'noo-before-after' ),
          ),

          array(
              'param_name'  => 'auto_play',
              'heading'     => esc_html__( 'Auto Play', 'noo-before-after' ),
              'description' => 'Enables auto play for slide carousels.',
              'type'        => 'checkbox',
              'value'       => '',
              'group'         => esc_html__( 'Slide Options', 'noo-before-after' ),
          ),

          array(
              'param_name'  => 'margin',
              'heading'     => esc_html__( 'Item Spacing', 'noo-before-after' ),
              'description' => 'Space between each item',
              'type'        => 'textfield',
              'value'       => '0',
              'group'         => esc_html__( 'Slide Options', 'noo-before-after' ),
          ),
      ),
  ));
