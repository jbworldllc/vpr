<?php 


     vc_map( array(
            "name"                      => esc_html__("Circle Progress", 'balkon-add-ons'),
            "base"                      => "balkon_circle_progress",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            ////"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_circle_progress.php',
            "category"                  => 'Balkon Theme',
            "show_settings_on_create"   => true,
            "params"                    => array(
                
                array(
                    "type"          => "textfield",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Value", 'balkon-add-ons'),
                    'description'   => esc_html__('Enter value for graph (Note: choose range from 0 to 100).','balkon-add-ons' ),
                    "param_name"    => "value",
                    "value"         => "85"
                ),
                array(
                    "type"          => "textfield",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Units", 'balkon-add-ons'),
                    'description'   => esc_html__('Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).','balkon-add-ons' ),
                    "param_name"    => "units",
                    "value"         => ""
                ),

                array(
                    "type"          => "textfield",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Width", 'balkon-add-ons'),
                    'description'   => esc_html__('Pixel value for the graph width.','balkon-add-ons' ),
                    "param_name"    => "width",
                    "value"         => "150"
                ),

                array(
                    "type"          => "textfield",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Line Width", 'balkon-add-ons'),
                    'description'   => esc_html__('Pixel value for the graph line width.','balkon-add-ons' ),
                    "param_name"    => "line_width",
                    "value"         => "40"
                ),

                array(
                    "type"          => "colorpicker",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Color", 'balkon-add-ons'),
                    "param_name"    => "color",
                    "value"         => '#292929',
                ),

                array(
                    "type"          => "textarea",
                    "heading"       => esc_html__("Description", 'balkon-add-ons'),
                    "param_name"    => "content",
                    'admin_label'   => true,
                    "value"         =>'<h4>Design</h4>'
                ),  

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extraclass", 'balkon-add-ons'),
                    "param_name"    => "el_class",
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'balkon-add-ons'),
                    "value"         => ""
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'balkon-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'balkon-add-ons' ),
                ),
            )
    ));
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Balkon_Circle_Progress extends WPBakeryShortCode {}
    }
