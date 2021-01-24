<?php 

vc_map( array(
            "name" => esc_html__("Image Popup", 'balkon-add-ons'),
            "base" => "balkon_image",
            "content_element" => true,
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            ////"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_image.php',
            "category"  => 'Balkon Theme',
            "show_settings_on_create" => true,
            "params" => array(
                
                array(
                    "type"      => "attach_image",
                    "holder"    => "div",
                    "class"     => "ajax-vc-img",
                    "heading"   => esc_html__("Image Source", 'balkon-add-ons'),
                    "param_name"=> "img",
                    "value"=>'824'
                ),

                array(
                    "type" => "textfield",
                    'admin_label'   => true,
                    "heading" => esc_html__("Image size", 'balkon-add-ons'),
                    "param_name" => "thumbnail_size",
                    "description" => esc_html__('Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).','balkon-add-ons' ),
                    "value"=> 'full',
                ),

                array(
                    "type" => "colorpicker",
                    'admin_label'   => true,
                    "heading" => esc_html__("Overlay Color", 'balkon-add-ons'),
                    "param_name" => "over_color",
                    "value"=> '#000',
                ),

                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Click Action', 'balkon-add-ons'),
                    "param_name" => "action",
                    "value" => array(   
                                    esc_html__('Image Popup', 'balkon-add-ons') => 'image',  
                                    esc_html__('Video Popup', 'balkon-add-ons') => 'video',                                                                                
                                                                                                                   
                                ),
                    "std" => 'image', 
                ),

                array(
                    "type"      => "attach_image",
                    "holder"    => "div",
                    "class"     => "ajax-vc-img",
                    "heading"   => esc_html__("Popup Image", 'balkon-add-ons'),
                    "description"   => esc_html__("Leave empty to use thumbnail image.", 'balkon-add-ons'),
                    "param_name"=> "popup_img",
                    "value"     => '',
                    'dependency'=> array(
                        'element'=>'action',
                        'value'=>array('image'),
                        'not_empty'=>false
                    )
                ),

                array(
                    "type"      => "textfield",
                    'admin_label'   => true,
                    "heading"   => esc_html__("Popup Video URL", 'balkon-add-ons'),
                    "param_name"=> "video_url",
                    "value"     => "https://vimeo.com/24506451",
                    'dependency'=> array(
                        'element'=>'action',
                        'value'=>array('video'),
                        'not_empty'=>false
                    )
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
            'admin_enqueue_js'      => CTH_DIR_URL . "inc/assets/balkon-elements.js",
            'js_view'=> 'BalkonImagesView',
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Balkon_Image extends WPBakeryShortCode {     
            }
        }

