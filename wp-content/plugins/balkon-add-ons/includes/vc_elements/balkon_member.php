<?php
vc_map( array(
           "name"      => esc_html__("Single Member", 'balkon-add-ons'),
           "description" => esc_html__("Single member",'balkon-add-ons'),
           "base"      => "balkon_member",
           "class"     => "",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_member.php',
           "category"  => 'Balkon Theme',
           "show_settings_on_create" => true,
           "params"    => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Enter Member ID", 'balkon-add-ons'),
                    "param_name" => "id",
                    "description" => esc_html__("Enter Member id to show (Ex: 99).", 'balkon-add-ons')
                ), 
                
                

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Excerpt', 'balkon-add-ons'), 
                    "param_name" => "show_excerpt", 
                    "value" => array(
                        esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                        esc_html__('No', 'balkon-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
                ),

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Link to Member detail\'s page', 'balkon-add-ons'), 
                    "param_name" => "show_readmore", 
                    "value" => array(
                        esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                        esc_html__('No', 'balkon-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
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
            )
        ));
        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Balkon_Member extends WPBakeryShortCode {}
        }