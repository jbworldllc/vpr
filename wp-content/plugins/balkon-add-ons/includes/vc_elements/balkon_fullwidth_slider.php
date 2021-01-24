<?php
vc_map( array(
            "name"                      => esc_html__("Fullwidth Slider", 'balkon-add-ons'),
            "description"               => esc_html__("with multi images selected",'balkon-add-ons'),
            "base"                      => "balkon_fullwidth_slider",
            "category"                  => 'Balkon Portfolio',
            "content_element"           => true,
            "show_settings_on_create"   => true,
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_fullwidth_slider.php',
            "params"                    => array(
                array(
                    "type"          => "attach_images",
                    "holder"        => "div",
                    "class"         => "ajax-vc-img",
                    "heading"       => esc_html__("Slide Images", 'balkon-add-ons'),
                    "param_name"    => "slideimages",
                    'value'         => '889,907,895,901,888,894,904'
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Speed", 'balkon-add-ons'),
                    "param_name"    => "speed",
                    "value"         =>'1000',
                    "description"   => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'balkon-add-ons')
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Direction', 'balkon-add-ons'),
                    "param_name"    => "direction",
                    "value"         => array(   
                                        esc_html__('Horizontal', 'balkon-add-ons') => 'horizontal',  
                                        esc_html__('Vertical', 'balkon-add-ons') => 'vertical',                                                                                
                                    ),
                    'std'           => 'horizontal'
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Effect', 'balkon-add-ons'),
                    "param_name"    => "effect",
                    "value"         => array(   
                                        esc_html__('Slide', 'balkon-add-ons') => 'slide',  
                                        esc_html__('Fade', 'balkon-add-ons') => 'fade',                                                                                
                                        esc_html__('Cube', 'balkon-add-ons') => 'cube',                                                                                
                                        esc_html__('Coverflow', 'balkon-add-ons') => 'coverflow',                                                                                
                                        esc_html__('Flip', 'balkon-add-ons') => 'flip',                                                                                
                                    ),
                    'std'           => 'slide'
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Auto Play", 'balkon-add-ons'),
                    "param_name"    => "autoplay",
                    "description"   => esc_html__("Number in mili-second (5000), leave it blank to disable", 'balkon-add-ons'),
                    'value'         => ''
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Loop', 'balkon-add-ons'),
                    "param_name"    => "loop",
                    "value"         => array(   
                                        esc_html__('No', 'balkon-add-ons') => 'no',  
                                        esc_html__('Yes', 'balkon-add-ons') => 'yes',                                                                                
                                    ),
                    "description"   => esc_html__("Set this to Yes to enable continuous loop mode", 'balkon-add-ons'), 
                    'std'           =>'yes'
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Show Navigation', 'balkon-add-ons'),
                    "param_name"    => "show_nav",
                    "value"         => array(   
                                        esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                        esc_html__('No', 'balkon-add-ons') => 'no',                                                                                
                                    ),
                    'std'           =>'yes'
                ),
                
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Mouse Wheel Control', 'balkon-add-ons'),
                    "param_name"    => "mousewheel",
                    "value"         => array(   
                                        esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                        esc_html__('No', 'balkon-add-ons') => 'no',                                                                                
                                    ),
                    "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'balkon-add-ons'), 
                    'std'           =>'no'
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Keyboard Control', 'balkon-add-ons'),
                    "param_name"    => "keyboard",
                    "value"         => array(   
                                        esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                        esc_html__('No', 'balkon-add-ons') => 'no',                                                                                
                                    ),
                    "description"   => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'balkon-add-ons'), 
                    'std'           =>'yes'
                ),

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Parallax Value", 'balkon-add-ons'),
                    "param_name"    => "parallax_value",
                    "description"   => esc_html__("Parallax CSS style values, separated by comma. Ex: translateY: '250px' ", 'balkon-add-ons').'<a href="'.esc_url('https://github.com/iprodev/Scrollax.js/blob/master/docs/Markup.md' ).'" target="_blank">'.esc_html__('Scrollax Documentation','balkon-add-ons' ).'</a>',
                    "value"         => "translateY: '250px'"
                ),
                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Disable Image Zoom', 'balkon-add-ons'),
                    "param_name"    => "disable_zoom",
                    "value"         => array(   
                                        esc_html__('No', 'balkon-add-ons') => 'no', 
                                        esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                                                                                                       
                                    ),
                    'std'           =>'no'
                    
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'balkon-add-ons'),
                    "param_name"    => "el_class",
                    "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'balkon-add-ons')
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => esc_html__( 'Css', 'balkon-add-ons' ),
                    'param_name'    => 'css',
                    'group'         => esc_html__( 'Design options', 'balkon-add-ons' ),
                ),
                
            ),
            'admin_enqueue_js'      => CTH_DIR_URL . "inc/assets/balkon-elements.js",
            'js_view'=> 'BalkonImagesView',
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Balkon_Fullwidth_Slider extends WPBakeryShortCode {}
        }