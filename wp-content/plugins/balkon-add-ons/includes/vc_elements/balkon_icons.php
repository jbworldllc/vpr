<?php 


     vc_map( array(
           "name"      => esc_html__("Icons List", 'balkon-add-ons'),
           "description" => esc_html__("List of icons with link",'balkon-add-ons'),
           "base"      => "balkon_icons",
           "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            ////"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_icons.php',
           "category"  => 'Balkon Theme',
           "show_settings_on_create" => true,
           "params"    => array(
                
                array(
                    'type' => 'param_group',
                    'heading' => esc_html__( 'Icons', 'balkon-add-ons' ),
                    'param_name' => 'values',
                    'description' => esc_html__( 'Select icons with its link and title.', 'balkon-add-ons' ),
                    'value' => json_encode( array(
                        array(
                            'text' => 'Follow us on Facebook',
                            'url' => '#',
                            'icon' => 'fa fa-facebook',
                            'target' => '_blank',
                        ),
                        array(
                            'text' => 'Follow us on Twitter',
                            'url' => '#',
                            'icon' => 'fa fa-twitter',
                            'target' => '_blank',
                        ),
                        array(
                            'text' => 'Follow us on Instagram',
                            'url' => '#',
                            'icon' => 'fa fa-instagram',
                            'target' => '_blank',
                        ),

                        array(
                            'text' => 'Follow us on Pinterest',
                            'url' => '#',
                            'icon' => 'fa fa-pinterest',
                            'target' => '_blank',
                        ),
                        array(
                            'text' => 'Follow us on Tumblr',
                            'url' => '#',
                            'icon' => 'fa fa-tumblr',
                            'target' => '_blank',
                        ),
                        
                        
                    ) ),
                    'params' => array(
                        array(
                            'type' => 'iconpicker',
                            'heading' => esc_html__( 'Icon', 'balkon-add-ons' ),
                            'param_name' => 'icon',
                            'settings' => array(
                                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                                'type' => 'fontawesome',
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Icon Text', 'balkon-add-ons' ),
                            'param_name' => 'text',
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Icon URL', 'balkon-add-ons' ),
                            'param_name' => 'url',
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'URL Target (_blank or _self)', 'balkon-add-ons' ),
                            'param_name' => 'target',
                            'value' => '_blank',
                        ),
                        
                    ),
                ),

                array(
                    "type" => "dropdown",
                    "holder"=>"div",
                    "admin_label"=> true ,
                    "heading" => esc_html__('Columns Grid', 'balkon-add-ons'),
                    "param_name" => "columns",
                    "value" => array(   
                        esc_html__('One Column', 'balkon-add-ons') => 'one',  
                        esc_html__('Two Columns', 'balkon-add-ons') => 'two',  
                        esc_html__('Three Columns', 'balkon-add-ons') => 'three',        
                        esc_html__('Four Columns', 'balkon-add-ons') => 'four',        
                        esc_html__('Five Columns', 'balkon-add-ons') => 'five',        
                        esc_html__('Six Columns', 'balkon-add-ons') => 'six',        
                        esc_html__('Seven Columns', 'balkon-add-ons') => 'seven',        
                        esc_html__('Eight Columns', 'balkon-add-ons') => 'eight',        
                        esc_html__('Nine Columns', 'balkon-add-ons') => 'nine',        
                        esc_html__('Ten Columns', 'balkon-add-ons') => 'ten',        
                    ),
                   
                    "std"=>'five',    
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
            class WPBakeryShortCode_Balkon_Icons extends WPBakeryShortCode {}
        }
