<?php 

 vc_map( array(
            "name"      => esc_html__("Testimonial Slider", 'balkon-add-ons'),

            "base"      => "balkon_testimonials",
            "class"     => "",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_testimonials.php',
            "category"  => 'Balkon Theme',
            "show_settings_on_create" => true,
            "params"    => array(
                array(
                    "type"      => "textfield",
                    "holder"    => "div",
                    "class"     => "",
                    "heading"   => esc_html__("Count", 'balkon-add-ons'),
                    "param_name"=> "count",
                    "value"     => "3",
                    "description" => esc_html__("Number of testimonials to show", 'balkon-add-ons')
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Order by', 'balkon-add-ons'),
                    "param_name" => "order_by",
                    "value" => array(   
                        esc_html__('Date', 'balkon-add-ons') => 'date',  
                        esc_html__('ID', 'balkon-add-ons') => 'ID',  
                        esc_html__('Author', 'balkon-add-ons') => 'author',       
                        esc_html__('Title', 'balkon-add-ons') => 'title',  
                        esc_html__('Modified', 'balkon-add-ons') => 'modified',  
                    ),
                    "description" => esc_html__("Order by", 'balkon-add-ons'),  
                    "std"=>'date',    
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Sort Order', 'balkon-add-ons'),
                    "param_name" => "order",
                    "value" => array(   
                                    esc_html__('Descending', 'balkon-add-ons') => 'DESC',
                                    esc_html__('Ascending', 'balkon-add-ons') => 'ASC',  
                                                                                                                      
                                    ),  
                    "std" => "DESC"   
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Or Enter Testimonial IDs", 'balkon-add-ons'),
                    "param_name" => "ids",
                    "description" => esc_html__("Enter testimonial ids to show, separated by a comma. (ex: 99,100)", 'balkon-add-ons')
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Show Avatar', 'balkon-add-ons'),
                    "param_name" => "show_avatar",
                    "value" => array(   
                                    esc_html__('No', 'balkon-add-ons') => 'no',  
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes',
                                    
                                                                                                                      
                                    ),
                       
                    "std" => "no"     
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Title", 'balkon-add-ons'),
                    "param_name" => "show_title",
          
                    "value" => array( 
                        esc_html__('No', 'balkon-add-ons') => 'no',  
                        esc_html__('Yes', 'balkon-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Rating", 'balkon-add-ons'),
                    "param_name" => "show_rating",
                  
                    "value" => array( 
                        esc_html__('No', 'balkon-add-ons') => 'no',  
                        esc_html__('Yes', 'balkon-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),


                


                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Speed", 'balkon-add-ons'),
                    "param_name" => "speed",
                    "value"=>'1000',
                    "description" => esc_html__("Duration of transition between slides (in ms). Default: 1000", 'balkon-add-ons')
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Direction', 'balkon-add-ons'),
                    "param_name" => "direction",
                    "value" => array(   
                                    esc_html__('Horizontal', 'balkon-add-ons') => 'horizontal',  
                                    esc_html__('Vertical', 'balkon-add-ons') => 'vertical',                                                                                
                                ),
                    'std' => 'horizontal'
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Effect', 'balkon-add-ons'),
                    "param_name" => "effect",
                    "value" => array(   
                                    esc_html__('Slide', 'balkon-add-ons') => 'slide',  
                                    esc_html__('Fade', 'balkon-add-ons') => 'fade',                                                                                
                                    esc_html__('Cube', 'balkon-add-ons') => 'cube',                                                                                
                                    esc_html__('Coverflow', 'balkon-add-ons') => 'coverflow',                                                                                
                                    esc_html__('Flip', 'balkon-add-ons') => 'flip',                                                                                
                                ),
                    'std' => 'slide'
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Auto Play", 'balkon-add-ons'),
                    "param_name" => "autoplay",
                    "description" => esc_html__("Number in mili-second (5000), leave it blank to disable", 'balkon-add-ons'),
                    'value'=> ''
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Loop', 'balkon-add-ons'),
                    "param_name" => "loop",
                    "value" => array(   
                                    esc_html__('No', 'balkon-add-ons') => 'no',  
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes',                                                                                
                                ),
                    "description" => esc_html__("Set this to Yes to enable continuous loop mode", 'balkon-add-ons'), 
                    'std'=>'yes'
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Mouse Wheel Control', 'balkon-add-ons'),
                    "param_name" => "mousewheel",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                    esc_html__('No', 'balkon-add-ons') => 'no',                                                                                
                                ),
                    "description" => esc_html__("Set this to Yes if you want to enable navigation through slides using mouse wheel", 'balkon-add-ons'), 
                    'std'=>'no'
                ),
                array(
                    "type" => "dropdown",
                    "class"=>"",
                    "heading" => esc_html__('Keyboard Control', 'balkon-add-ons'),
                    "param_name" => "keyboard",
                    "value" => array(   
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                    esc_html__('No', 'balkon-add-ons') => 'no',                                                                                
                                ),
                    "description" => esc_html__("Set this to Yes if you want to enable navigation through slides using keyboard arrows", 'balkon-add-ons'), 
                    'std'=>'yes'
                ),

                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Navigation", 'balkon-add-ons'),
                    "param_name" => "show_navigation",
             
                    "value" => array( 
                        esc_html__('No', 'balkon-add-ons') => 'no',  
                        esc_html__('Yes', 'balkon-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Slider Count", 'balkon-add-ons'),
                    "param_name" => "show_count",
                    
                    "value" => array( 
                        esc_html__('No', 'balkon-add-ons') => 'no',  
                        esc_html__('Yes', 'balkon-add-ons') => 'yes',   
                        
                          
                    ),
                    "std"=>'yes', 
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
            class WPBakeryShortCode_Balkon_Testimonials extends WPBakeryShortCode {}
        }
