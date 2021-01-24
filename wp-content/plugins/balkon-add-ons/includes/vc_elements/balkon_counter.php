<?php 

vc_map( array(
            "name"                      => esc_html__("Animated Counter", 'balkon-add-ons'),
            "base"                      => "balkon_counter",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_counter.php',
            "category"                  => 'Balkon Theme',
            "show_settings_on_create"   => true,
            "params"                    => array(
                
                array(
                    "type"          => "textfield",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Number", 'balkon-add-ons'),
                    "param_name"    => "number",
                    "value"         => "461"
                ),
                array(
                    "type"          => "textarea",
                    'admin_label'   => true,
                    "heading"       => esc_html__("Content", 'balkon-add-ons'),
                    "param_name"    => "content",
                    "value"         =>'<h6>Finished projects</h6>',
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => esc_html__( 'Icon', 'balkon-add-ons' ),
                    'param_name'    => 'icon_class',
                    'value'         => '', // default value to backend editor admin_label
                    'settings'      => array(
                        'emptyIcon'     => true,
                        // default true, display an "EMPTY" icon?
                        'iconsPerPage'  => 4000,
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Is last item on row', 'balkon-add-ons'),
                    "param_name"    => "is_last",
                    "value"         => array(   
                                        esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                        esc_html__('No', 'balkon-add-ons') => 'no',                                                                                
                                    ),
                    "std"           => 'no', 
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
        class WPBakeryShortCode_Balkon_Counter extends WPBakeryShortCode {}
    }
