<?php
vc_map( array(
            "name"      => esc_html__("Portfolio Comment", 'balkon-add-ons'),
        
            "base"      => "balkon_portfolio_comment",
        
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_portfolio_comment.php',
            "category"  => 'Balkon Portfolio',
     
            "show_settings_on_create" => false,
            "params"    => array(
                
                
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'balkon-add-ons'),
                    "param_name" => "el_class",
                    "value"=>'',
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
            class WPBakeryShortCode_Balkon_Portfolio_Comment extends WPBakeryShortCode {}
        }