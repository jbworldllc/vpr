<?php 


     vc_map( array(
        "name"                      => esc_html__("Portfolios Carousel", 'balkon-add-ons'),
        "description"               => esc_html__("Carousel slider of portfolio items",'balkon-add-ons'),
        "base"                      => "balkon_portfolios_carousel",
        "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_portfolios_carousel.php',
        "category"                  => 'Balkon Portfolio',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__("Portfolio Category IDs to include", 'balkon-add-ons'), 
                "param_name"    => "cat_ids", 
                "description"   => esc_html__("Enter portfolio category ids to include, separated by a comma. Leave empty to get portfolios from all categories.", 'balkon-add-ons')
            ), 
            
            array(
                "type"          => "textfield", 
                "holder"        => "div",
                "heading"       => esc_html__("Enter Portfolio IDs", 'balkon-add-ons'), 
                "param_name"    => "ids", 
                "description"   => esc_html__("Enter portfolio ids to show, separated by a comma.", 'balkon-add-ons')
            ), 
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__("Portfolio IDs to Exclude", 'balkon-add-ons'), 
                "param_name"    => "ids_not", 
                "description"   => esc_html__("Enter portfolio ids to exclude, separated by a comma. Use if the field above is empty. Leave empty to get all.", 'balkon-add-ons')
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Order Portfolios by', 'balkon-add-ons'), 
                "param_name"    => "order_by", 
                "value"         => array(
                                    esc_html__('Date', 'balkon-add-ons') => 'date', 
                                    esc_html__('ID', 'balkon-add-ons') => 'ID', 
                                    esc_html__('Author', 'balkon-add-ons') => 'author', 
                                    esc_html__('Title', 'balkon-add-ons') => 'title', 
                                    esc_html__('Modified', 'balkon-add-ons') => 'modified',
                                    esc_html__('Random', 'balkon-add-ons') => 'rand',
                ), 
                "description"   => esc_html__("Order Portfolios by", 'balkon-add-ons'), 
                "std"           => 'date',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Sort Order', 'balkon-add-ons'), 
                "param_name"    => "order", 
                "value"         => array(
                                    esc_html__('Ascending', 'balkon-add-ons') => 'ASC',
                                    esc_html__('Descending', 'balkon-add-ons') => 'DESC', 
                    
                ), 
                "description"   => esc_html__("Order Portfolios", 'balkon-add-ons'),
                "std"           => 'DESC',
            ), 
            array(
                "type"          => "textfield",
                "holder"        => "div",
                "heading"       => esc_html__("Post to show", 'balkon-add-ons'),
                "param_name"    => "posts_per_page",
                "description"   => esc_html__("Number of portfolio items to show (-1 for all).", 'balkon-add-ons'),
                "value"         => '10',
            ),
            
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Show Date', 'balkon-add-ons'), 
                "param_name"    => "show_date", 
                "value"         => array(
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes',
                                    esc_html__('No', 'balkon-add-ons') => 'no',
                ), 
                "std"           => 'no',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Show Category', 'balkon-add-ons'), 
                "param_name"    => "show_cat", 
                "value"         => array(
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes',
                                    esc_html__('No', 'balkon-add-ons') => 'no',
                ), 
                "std"           => 'no',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Show Excerpt', 'balkon-add-ons'), 
                "param_name"    => "show_excerpt", 
                "value"         => array(
                                    esc_html__('No', 'balkon-add-ons') => 'no',
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                ), 
                "std"           => 'yes',
            ), 
            array(
                "type"          => "dropdown", 
                "class"         => "", 
                "heading"       => esc_html__('Show View Project', 'balkon-add-ons'), 
                "param_name"    => "show_view_project", 
                "value"         => array(
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                                    esc_html__('No', 'balkon-add-ons') => 'no', 
                ), 
                "std"           => 'yes',
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
                'std'           =>'no'
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
                "heading"       => esc_html__('Show Scroll Bar', 'balkon-add-ons'),
                "param_name"    => "show_scrollbar",
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
        )
    ));
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Balkon_Portfolios_Carousel extends WPBakeryShortCode {}
    }
