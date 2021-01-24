<?php
vc_map( array(
        "name" => esc_html__("Landing Page", 'balkon-add-ons'),
        "description" => esc_html__("Showcase your demos",'balkon-add-ons'),
        "base" => "balkon_landing",
        "category"  => 'Balkon Theme',
        "as_parent" => array('only' => 'balkon_landing_item'), 
        "content_element" => true,
        "show_settings_on_create" => true,
        "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
        //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_landing.php',
        "params" => array(
            array(
                "type"          => "attach_image",
                'admin_label'   => true,
                "heading"       => esc_html__("Light Demos Logo", 'balkon-add-ons'),
                "param_name"    => "light_logo",
                'value'         => '806'
               
            ),
            array(
                "type"          => "attach_image",
                'admin_label'   => true,
                "heading"       => esc_html__("Dark Demos Logo", 'balkon-add-ons'),
                "param_name"    => "dark_logo",
                'value'         => '1146'
               
            ),
            array(
                'type'          => 'textarea',
                'heading'       => esc_html__( 'Introduction Text', 'balkon-add-ons' ),
                'param_name'    => 'introtext',
                'value'         => '<h2>Creative Responsive Architecture WordPress <br>Theme</h2>',
            ),

            array(
                "type"          => "vc_link",
                "heading"       => esc_html__("Cal To Action Link", 'balkon-add-ons'),
                "param_name"    => "cta_link",
                'value'         => 'url:'. esc_url( 'https://themeforest.net/user/cththemes/portfolio?ref=cththemes' ) .'|title:Buy Now $59|target:_blank'

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
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map( array(
        "name" => esc_html__("Landing Item", 'balkon-add-ons'),
        "base" => "balkon_landing_item",
        "content_element" => true,
        "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
        //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_landing_item.php',
        "as_child" => array('only' => 'balkon_landing'),
        "params" => array(
            array(
                "type"              => "textfield",
                'admin_label'       => true,
                "heading"           => esc_html__("Title", 'balkon-add-ons'),
                "param_name"        => "title",
                'value'             => 'Light Skin'
            ),
            array(
                "type"              => "textarea",
                'admin_label'       => true,
                "heading"           => esc_html__("SubTitle", 'balkon-add-ons'),
                "param_name"        => "subtitle",
                'value'             => ''
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Demos', 'balkon-add-ons' ),
                'param_name' => 'demos',
                'params' => array(
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Demo title', 'balkon-add-ons' ),
                        'param_name'    => 'demo_title',
                        'admin_label'   => true,
                        'value'         => 'Slider'
                    ),
                    array(
                        "type"          => "attach_image",
                        'admin_label'   => true,
                        "heading"       => esc_html__("Demo Thumbnail", 'balkon-add-ons'),
                        "param_name"    => "demo_img",
                        'value'         => '1163'
                       
                    ),
                    array(
                        "type"          => "vc_link",
                        "heading"       => esc_html__("Demo Button 1", 'balkon-add-ons'),
                        "param_name"    => "demo_prev1",
                        'value'         => 'url:'.esc_url( home_url('/home-slider/' ) ).'|title:Multipage|target:_blank'
        
                    ),
                    array(
                        "type"          => "vc_link",
                        "heading"       => esc_html__("Demo Button 2", 'balkon-add-ons'),
                        "param_name"    => "demo_prev2",
                        'value'         => 'url:'.esc_url( home_url('/onepage-slider/' ) ).'|title:Onepage|target:_blank'
                    ),
                    
                ),
            ),
            array(
                "type"                  => "dropdown",
                "heading"               => esc_html__('Is Dark Demo?', 'balkon-add-ons'),
                "param_name"            => "is_dark",
                "value"                 => array(   
                    esc_html__('Yes', 'balkon-add-ons')     => 'yes',  
                    esc_html__('No', 'balkon-add-ons')      => 'no',                                                                                           
                ),
                'std'                   =>'no'
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

    
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Balkon_Landing extends WPBakeryShortCodesContainer {}
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Balkon_Landing_Item extends WPBakeryShortCode {     
        }
    }
