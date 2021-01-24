<?php
vc_map( array(
            "name"      => esc_html__("Gallery Masonry", 'balkon-add-ons'),
            "description" => esc_html__("with images selected",'balkon-add-ons'),
            "base"      => "balkon_images_gallery_masonry",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_images_gallery_masonry.php',
            "category"  => 'Balkon Portfolio',
            "params"    => array(

                array(
                    "type"          => "attach_images",
                    "holder"        => "div",
                    "class"         => "ajax-vc-img",
                    "heading"       => esc_html__("Image Source", 'balkon-add-ons'),
                    "param_name"    => "galleryimgs",
                    'value'         => '891,888,895,898,899,909,905,798'
                   
                ),

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("First Load items", 'balkon-add-ons'),
                    "param_name"    => "loaded",
                    "value"         => '10',
                    "description"   => esc_html__("Number of images you want to display in the first load. Should be maller than your total images number to use INFINITE scroll option bellow.", 'balkon-add-ons')
                ),

                array(
                    "type"          => "dropdown",
                    "class"         => "",
                    "heading"       => esc_html__('Use INFINITE scroll load more items?', 'balkon-add-ons'),
                    "param_name"    => "show_loadmore",
                    "value"         => array(   
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes',  
                        esc_html__('No', 'balkon-add-ons')      => 'no',  
                    ), 
                    "std"           =>'yes',    
                    "description"   => esc_html__("Images will automatically load and adding when you scroll to the bottom.", 'balkon-add-ons')
                ),

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Load more items", 'balkon-add-ons'),
                    "param_name"    => "lmore_items",
                    "value"         => '3',
                    "description"   => esc_html__("Number of images you want to get in the next loadings.", 'balkon-add-ons')
                ),

                array(
                    "type"          => "dropdown",
                    "class"         => "",
                    "heading"       => esc_html__('Columns Grid', 'balkon-add-ons'),
                    "param_name"    => "columns",
                    "value"         => array(   
                        esc_html__('One Column', 'balkon-add-ons')      => 'one',  
                        esc_html__('Two Columns', 'balkon-add-ons')     => 'two',  
                        esc_html__('Three Columns', 'balkon-add-ons')   => 'three',        
                        esc_html__('Four Columns', 'balkon-add-ons')    => 'four',        
                        esc_html__('Five Columns', 'balkon-add-ons')    => 'five',        
                    ),
                    "std"           =>'three',    
                ),
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Spacing', 'balkon-add-ons'), 
                    "param_name"    => "spacing", 
                    "value"         => array(
                        esc_html__('None', 'balkon-add-ons')            => 'none', 
                        esc_html__('Extra Small', 'balkon-add-ons')     => 'extrasmall',
                        esc_html__('Small', 'balkon-add-ons')           => 'small',
                        esc_html__('Medium', 'balkon-add-ons')          => 'medium',
                        esc_html__('Big', 'balkon-add-ons')             => 'big', 
                    ), 
                    "std"           => 'extrasmall',
                ),

                array(
                    "type"          => "dropdown",
                    "class"         =>"",
                    "heading"       => esc_html__('Show image title', 'balkon-add-ons'),
                    "param_name"    => "show_img_title",
                    "value"         => array(   
                        esc_html__('Yes', 'balkon-add-ons')         => 'yes',  
                        esc_html__('No', 'balkon-add-ons')          => 'no',  
                    ), 
                    "std"           =>'no',    
                ),

                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Show image description', 'balkon-add-ons'),
                    "param_name"    => "show_img_desc",
                    "value"         => array(   
                        esc_html__('Yes', 'balkon-add-ons')         => 'yes',  
                        esc_html__('No', 'balkon-add-ons')          => 'no',  
                    ), 
                    "std"           =>'no',    
                ),

                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Use Popup Gallery', 'balkon-add-ons'),
                    "param_name"    => "show_zoom",
                    "value"         => array(   
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes',  
                        esc_html__('No', 'balkon-add-ons')      => 'no',  
                    ), 
                    "std"           =>'yes',    
                ),

                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Show filter', 'balkon-add-ons'),
                    "param_name"    => "show_filter",
                    "value"         => array(   
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes',  
                        esc_html__('No', 'balkon-add-ons')      => 'no',  
                    ), 
                    "std"           =>'no',    
                ),

                array(
                    "type"          => "textarea",
                    "heading"       => esc_html__("Filter List", 'balkon-add-ons'),
                    "param_name"    => "filter_list",
                    "value"         => 'Departments|Design|Houses|Interior',
                    "description"   => esc_html__("Note: separate filter texts with | character. Ex: \"Departments|Design|Houses|Interior\". Each image can have one or more filter texts in its caption field wrapped with \"-f-FILTER_TEXT-f-\" ( -f-Departments-f- ) and separate by a space or linebreak.", 'balkon-add-ons'),
                    'dependency'    => array(
                        'element'   => 'show_filter',
                        'value'     => array( 'yes'),
                        'not_empty' => false,
                    ),
                ),

                
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name", 'balkon-add-ons'),
                    "param_name"    => "el_class",
                    "value"         =>'',
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
            class WPBakeryShortCode_Balkon_Images_Gallery_Masonry extends WPBakeryShortCode {}
        }
