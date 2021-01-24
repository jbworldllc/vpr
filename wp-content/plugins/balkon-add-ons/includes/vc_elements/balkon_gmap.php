<?php

 vc_map( array(
            "name"      => esc_html__("Google Map", 'balkon-add-ons'),
            "description" => esc_html__("Balkon google map style",'balkon-add-ons'),
            "base"      => "balkon_gmap",
            "class"     => "",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_gmap.php',
            "category"  => 'Balkon Theme',
            
            "show_settings_on_create" => true,
            "params"    => array(
                array(
                    "type" => "textfield",
                    "class"=>"",
                    "holder"=>'div',
                    "heading" => esc_html__('Address Latitude', 'balkon-add-ons'),
                    "param_name" => "map_lat",
                    "value" => "40.7143528",
                    "description" => wp_kses(__("Enter your address latitude. You can get your value from: <a href='http://www.gps-coordinates.net/' target='_blank'>http://www.gps-coordinates.net/</a>", 'balkon-add-ons'),array('a'=>array('href'=>array(),'target'=>array()))),
                ),
                array(
                    "type" => "textfield",
                    "class"=>"",
                    "holder"=>'div',
                    "heading" => esc_html__('Address Longtitude', 'balkon-add-ons'),
                    "param_name" => "map_long",
                    "value" => "-74.0059731",
                    "description" => wp_kses(__("Enter your address longtitude. You can get your value from: <a href='http://www.gps-coordinates.net/' target='_blank'>http://www.gps-coordinates.net/</a>", 'balkon-add-ons'),array('a'=>array('href'=>array(),'target'=>array()))), 
                    
                ),
                array(
                    "type" => "textfield",
                    "class"=>"",
                    "holder"=>'div',
                    "heading" => esc_html__('Address String', 'balkon-add-ons'),
                    "param_name" => "map_address",
                    "value" => "Our office - New York City",
                    "description" => esc_html__("Address String", 'balkon-add-ons'), 
                ),
                array(
                    "type"      => "textarea",
                    "class"     => "",
                    "holder"     => "span",
                    "heading"   => esc_html__("Additional Address Setting", 'balkon-add-ons'),
                    "param_name"=> "add_address",
                    "value"     => "",
                    "description" => wp_kses(__("Address must be separated by `|`. Format: Latitude;Longitude;String_Address<p>Ex: 40.7168183;-73.9973402;Balkon - Washington|40.73334016;-73.99330616;Balkon - Florida</p>", 'balkon-add-ons'),array('p'=>array('class'=>array(),),) ), 
                ),
                array(
                    "type" => "textfield",
                    "class"=>"",
                    "holder"=>'div',
                    "heading" => esc_html__('Map Zoom', 'balkon-add-ons'),
                    "param_name" => "map_zoom",
                    "value" => "14",
                    "description" => esc_html__("Map Zoom", 'balkon-add-ons'), 
                    
                ),
                array(
                    "type"      => "attach_image",
                    "class"     => "",
                    "heading"   => esc_html__("Map Marker", 'balkon-add-ons'),
                    "param_name"=> "map_marker",
                    "value"     => "",
                    "description" => esc_html__("Upload google map marker or leave it empty to use default.", 'balkon-add-ons')
                ),
                array(
                    "type" => "textfield",
                    "class"=>"",
                    // "holder"=>'div',
                    "heading" => esc_html__('Map Height', 'balkon-add-ons'),
                    "param_name" => "map_height",
                    "value" => "500",
                    "description" => esc_html__("Enter your map height in pixel. Default: 500", 'balkon-add-ons'), 
                    
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Use Default Style', 'balkon-add-ons'),
                    "param_name" => "default_style",
                    "value" => array(   
                                    esc_html__('No', 'balkon-add-ons') => 'false',  
                                    esc_html__('Yes', 'balkon-add-ons') => 'true',                                                                                
                                ),
                    "description" => esc_html__("Set this to Yes to use default Google map style.", 'balkon-add-ons'), 
                    'std'=>'false'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Show Zoom Control', 'balkon-add-ons'),
                    "param_name" => "zoom_control",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Show MapType Control', 'balkon-add-ons'),
                    "param_name" => "maptype_control",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Show Scale Control', 'balkon-add-ons'),
                    "param_name" => "scale_control",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Scroll Wheel Control', 'balkon-add-ons'),
                    "param_name" => "scroll_wheel",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'0'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Street View Control', 'balkon-add-ons'),
                    "param_name" => "street_view",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                array(
                    "type" => "dropdown",
                    
                    "heading" => esc_html__('Draggable Control', 'balkon-add-ons'),
                    "param_name" => "draggable",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                                ),
                    
                    'std'=>'1'
                ),
                
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
            class WPBakeryShortCode_Balkon_Gmap extends WPBakeryShortCode {}
        }

