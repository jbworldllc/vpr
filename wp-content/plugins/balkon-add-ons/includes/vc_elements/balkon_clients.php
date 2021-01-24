<?php

vc_map( array(
            "name"      => esc_html__("Our Clients", 'balkon-add-ons'),
            "description" => esc_html__("List of our clients or partners",'balkon-add-ons'),
            "base"      => "balkon_clients",
            "class"     => "",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_clients.php',
            "category"  => 'Balkon Theme',

            "show_settings_on_create" => true,
            "params"    => array(

                array(
                    "type"      => "attach_images",
                    "holder"    => "div",
                    "class"     => "ajax-vc-img",
                    "heading"   => esc_html__("Partner Images", 'balkon-add-ons'),
                    "param_name"=> "partnerimgs",
           
                    "value"     => '876,872,875,874,873',
                ),



                array(
                    "type"      => "textarea",
                    "holder"    => "span",
                    "class"     => "",
                    "heading"   => esc_html__("Partner Links", 'balkon-add-ons'),
                    "param_name"=> "content",
                    "value"     => '#
#
#
#
#',
                    "description" => esc_html__("Enter links for each partner (Note: divide links with linebreaks (Enter) and no spaces).", 'balkon-add-ons')
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Target', 'balkon-add-ons'),
                    "param_name" => "target",
                    "value" => array(   
                                    esc_html__('Opens Partner link in new window', 'balkon-add-ons') => '_blank',  
                                    esc_html__('Opens Partner link in the same window', 'balkon-add-ons') => '_self',                                                                               
                                ),
                    "std" => '_blank', 
                ),




                array(
                    "type" => "dropdown",
                    "class"=>"",
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
                    "holder" => "div",
                    "heading" => esc_html__("Thumbnail size", 'balkon-add-ons'),
                    "param_name" => "thumbnail_size",
                    "description" => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).','balkon-add-ons' ),
                    "value"=> 'balkon-partner',
                    
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
            class WPBakeryShortCode_Balkon_Clients extends WPBakeryShortCode {}
        }
