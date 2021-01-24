<?php
vc_map( array(
            "name"      => esc_html__("Portfolio Nav", 'balkon-add-ons'),
            "base"      => "balkon_portfolio_nav",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_portfolio_nav.php',
            "category"  => 'Balkon Portfolio',
            "show_settings_on_create" => true,
            "params"    => array(
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('In Same Terms', 'balkon-add-ons'),
                    "description"   => esc_html__("Whether previous/next posts must be within the same taxonomy term as the current post.", 'balkon-add-ons'),
                    "param_name"    => "same_term",
                    "value"         => array(   
                        esc_html__('No', 'balkon-add-ons')      => 'no', 
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes',                                                                                
                    ),
                    "std"           => 'no', 
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Show All Projects', 'balkon-add-ons'),
                    "param_name"    => "show_all",
                    "value"         => array(   
                        esc_html__('No', 'balkon-add-ons')      => 'no', 
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes',                                                                                
                    ),
                    "std"           => 'yes', 
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("All Projects Link", 'balkon-add-ons'),
                    "param_name"    => "all_link",
                    "value"         => '',
                    "description"   => esc_html__("Leave empty to use default portfolio archive link.", 'balkon-add-ons'),
                    "dependency"    => array(
                        'element'   => 'show_all',
                        'value'     => array('yes'),
                        'not_empty' => false
                    )
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'balkon-add-ons'),
                    "param_name"    => "el_class",
                    "value"         => '',
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'balkon-add-ons')
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
            class WPBakeryShortCode_Balkon_Portfolio_Nav extends WPBakeryShortCode {}
        }