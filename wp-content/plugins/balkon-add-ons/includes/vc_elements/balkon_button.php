<?php 

vc_map( array(
           "name"      => esc_html__("Balkon Button", 'balkon-add-ons'),
           "base"      => "balkon_button",
           "class"     => "",
           "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            ////"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_button.php',
           "category"  => 'Balkon Theme',
           "show_settings_on_create" => true,
           "params"    => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Button Title', 'balkon-add-ons' ),
                    'holder' => 'div',
                    'param_name' => 'title',
                    'value' => "View More",
                ),

                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'balkon-add-ons' ),
                    'param_name' => 'icon',
                    'value' => '', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => true,
                        // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'balkon-add-ons' ),
                ),

                array(
                    "type" => "vc_link",
                    "heading" => esc_html__("Button Link", 'balkon-add-ons'),
                    "param_name" => "link",
    
                ),

                
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Is Page Scrolling Button?', 'balkon-add-ons'),
                    "param_name" => "is_scrolling",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                    esc_html__('No', 'balkon-add-ons') => 'no',                                                                                
                                ),
                    "std" => 'no', 
                ),
        
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'balkon-add-ons'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'balkon-add-ons')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'balkon-add-ons' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'balkon-add-ons' ),
                ),
            )));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Balkon_Button extends WPBakeryShortCode {}
        }
