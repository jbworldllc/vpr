<?php 
vc_map( array(
        "name"                      => esc_html__("Home Vimeo Video", 'balkon-add-ons'),
        "base"                      => "balkon_home_vimeo_video",
        "content_element"           => true,
        "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_home_vimeo_video.php',
        "category"                  => 'Balkon Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content", 'balkon-add-ons'),
                "param_name"    => "content",
                "value"         => '<h2>Balkon<br>Creative  Architecture <br> Studio</h2>
<div class="clearfix"></div>
<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
<div class="clearfix"></div>
<div><a href="#sec2" class="btn float-btn flat-btn custom-scroll-link">Let\'s Start</a></div>'
            ), 
             
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Your Vimeo Video ID", 'balkon-add-ons'),
                "param_name"    => "video",
                "value"         => "97871257",
                "description"   => esc_html__("Your Vimeo Video ID: 97871257", 'balkon-add-ons')
            ),
            array(
                "type"          => "dropdown",
                "class"         =>"",
                "heading"       => esc_html__('Video Quality', 'balkon-add-ons'),
                "param_name"    => "quality",
                "value"         => array(   
                                    esc_html__( '4K' , 'balkon-add-ons' )       => '4K',  
                                    esc_html__( '2K' , 'balkon-add-ons' )       => '2K',  
                                    esc_html__( '1080P' , 'balkon-add-ons' )    => '1080p',  
                                    esc_html__( '720P' , 'balkon-add-ons' )     => '720p',  
                                    esc_html__( '540P' , 'balkon-add-ons' )     => '540p',  
                                    esc_html__( '360P' , 'balkon-add-ons' )     => '360p',                                                                            
                ),
                "std"           => '1080p', 
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Mute', 'balkon-add-ons'),
                "param_name"    => "mute",
                "value"         => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                ),
                "std"           =>"1"
            ),

            array(
                "type"          => "dropdown",
                "heading"       => esc_html__('Loop', 'balkon-add-ons'),
                "param_name"    => "loop",
                "value"         => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                ),
                "std"           =>"1"
            ),
            
            array(
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Background Image", 'balkon-add-ons'),
                "param_name"    => "bgimg",
                "description"   => esc_html__("Background image", 'balkon-add-ons'),
                "value"         => "811"
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Overlay Opacity", 'balkon-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.3",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default 0.3", 'balkon-add-ons')
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Parallax Value", 'balkon-add-ons'),
                "param_name"    => "parallax_value",
                "description"   => esc_html__("Parallax CSS style values, separated by comma. Ex: translateY: '400px' ", 'balkon-add-ons').'<a href="'.esc_url('https://github.com/iprodev/Scrollax.js/blob/master/docs/Markup.md' ).'" target="_blank">'.esc_html__('Scrollax Documentation','balkon-add-ons' ).'</a>',
                "value"         => "translateY: '400px'"
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
        'js_view'               => 'BalkonImagesView',
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Balkon_Home_Vimeo_Video extends WPBakeryShortCode {     
        }
    }