<?php

vc_map( array(
            "name"      => esc_html__("Portfolios Masonry", 'balkon-add-ons'),
            "description" => esc_html__("Masonry layout of portfolio items",'balkon-add-ons'),
            "base"      => "balkon_portfolios",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_portfolios.php',
           "category"  => 'Balkon Portfolio',
           "show_settings_on_create" => true,
           "params"    => array(
                array(
                    "type"          => "dropdown", 
                    "heading"       => esc_html__('Grid Style', 'balkon-add-ons'), 
                    "param_name"    => "hoz_style", 
                    "value"         => array(
                        esc_html__('Style 1', 'balkon-add-ons') => 'style1', 
                        esc_html__('Style 2', 'balkon-add-ons') => 'style2', 
                    ), 
                    "std"           => 'style1',
                ),
                array(
                    "type"          => "textfield", 
                    "heading"       => esc_html__("Portfolio Category IDs to exclude", 'balkon-add-ons'), 
                    "param_name"    => "cat_ids", 
                    "description"   => esc_html__("Enter portfolio category ids to exclude, separated by a comma. Leave empty to display all categories.", 'balkon-add-ons')
                ), 
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Order Portfolio Categories by', 'balkon-add-ons'), 
                    "param_name"    => "cat_order_by", 
                    "value"         => array(
                        esc_html__('Name', 'balkon-add-ons')    => 'name', 
                        esc_html__('ID', 'balkon-add-ons')      => 'id', 
                        esc_html__('Count', 'balkon-add-ons')   => 'count', 
                        esc_html__('Slug', 'balkon-add-ons')    => 'slug', 
                        esc_html__('None', 'balkon-add-ons')    => 'none',
                    ), 
                    "std"           => 'name',
                ), 
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Sort Order', 'balkon-add-ons'), 
                    "param_name"    => "cat_order", 
                    "value"         => array(
                        esc_html__('Ascending', 'balkon-add-ons')   => 'ASC',
                        esc_html__('Descending', 'balkon-add-ons')  => 'DESC', 
                        
                    ), 
                    "std"           => 'ASC',
                ), 
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Show Filter', 'balkon-add-ons'), 
                    "param_name"    => "show_filter", 
                    "value"         => array(
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes', 
                        esc_html__('No', 'balkon-add-ons')      => 'no', 
                    ),  
                    "std"           => 'yes',
                ),
                
                array(
                    "type"          => "dropdown", 
                    "heading"       => esc_html__('Is Sidebar Filter', 'balkon-add-ons'), 
                    "param_name"    => "sidebar_filter", 
                    "value"         => array(
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes', 
                        esc_html__('No', 'balkon-add-ons')      => 'no', 
                    ),  
                    "std"           => 'no',
                    'dependency'        => array(
                        'element'   => 'show_filter',
                        'value'     => array( 'yes' ),
                        'not_empty' => false,
                    ),
                ),
                array(
                    "type" => "textfield", 
                    "holder" => "div",
                    "heading" => esc_html__("Sidebar Title", 'balkon-add-ons'), 
                    "param_name" => "sidebar_title", 
                    'value'         => 'Our Portfolios',
                    'dependency'        => array(
                        'element'   => 'sidebar_filter',
                        'value'     => array( 'yes' ),
                        'not_empty' => false,
                    ),
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Filter Width', 'balkon-add-ons'), 
                    "param_name" => "filter_width", 
                    "value" => array(
                        esc_html__('Fixed Width', 'balkon-add-ons') => 'container', 
                        esc_html__('Fullwidth', 'balkon-add-ons') => 'full-container', 
                    ), 
                    
                    "std" => 'full-container',
                    'dependency'        => array(
                        'element'   => 'show_filter',
                        'value'     => array( 'yes' ),
                        'not_empty' => false,
                    ),
                ), 

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Counter', 'balkon-add-ons'), 
                    "param_name" => "show_counter", 
                    "value" => array(
                        esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                        esc_html__('No', 'balkon-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
                    'dependency'        => array(
                        'element'   => 'show_filter',
                        'value'     => array( 'yes' ),
                        'not_empty' => false,
                    ),
                ), 

                array(
                    "type" => "textfield", 
                    "holder" => "div",
                    "heading" => esc_html__("Enter Portfolio IDs", 'balkon-add-ons'), 
                    "param_name" => "ids", 
                    "description" => esc_html__("Enter portfolio ids to show, separated by a comma. Leave empty to get all.", 'balkon-add-ons')
                ), 
                array(
                    "type" => "textfield", 
                    // "holder" => "div",
                    "heading" => esc_html__("Portfolio IDs to Exclude", 'balkon-add-ons'), 
                    "param_name" => "ids_not", 
                    "description" => esc_html__("Enter portfolio ids to exclude, separated by a comma. Use if the field above is empty. Leave empty to get all.", 'balkon-add-ons')
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Order Portfolios by', 'balkon-add-ons'), 
                    "param_name" => "order_by", 
                    "value" => array(
                        esc_html__('Date', 'balkon-add-ons') => 'date', 
                        esc_html__('ID', 'balkon-add-ons') => 'ID', 
                        esc_html__('Author', 'balkon-add-ons') => 'author', 
                        esc_html__('Title', 'balkon-add-ons') => 'title', 
                        esc_html__('Modified', 'balkon-add-ons') => 'modified',
                    ), 
                    "description" => esc_html__("Order Portfolios by", 'balkon-add-ons'), 
                    "std" => 'date',
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Order Portfolios', 'balkon-add-ons'), 
                    "param_name" => "order", 
                    "value" => array(
                        esc_html__('Ascending', 'balkon-add-ons') => 'ASC',
                        esc_html__('Descending', 'balkon-add-ons') => 'DESC', 
                        
                    ), 
                    "description" => esc_html__("Order Portfolios", 'balkon-add-ons'),
                    "std" => 'DESC',
                ), 
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => esc_html__("Post to show", 'balkon-add-ons'),
                    "param_name" => "posts_per_page",
                    "description" => esc_html__("Number of portfolio items to show (-1 for all).", 'balkon-add-ons'),
                    "value"=> '-1',
                ),
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Grid Columns', 'balkon-add-ons'), 
                    "param_name" => "columns_grid", 
                    "value" => array(
                        esc_html__('One Column', 'balkon-add-ons') => 'one',
                        esc_html__('Two Columns', 'balkon-add-ons') => 'two', 
                        esc_html__('Three Columns', 'balkon-add-ons') => 'three', 
                        esc_html__('Four Columns', 'balkon-add-ons') => 'four', 
                        esc_html__('Five Columns', 'balkon-add-ons') => 'five', 
                        
                    ), 
                    
                    "std" => 'three',
                ),
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Spacing', 'balkon-add-ons'), 
                    "param_name" => "spacing", 
                    "value" => array(
                        esc_html__('Extra Small', 'balkon-add-ons') => 'extrasmall',
                        esc_html__('Small', 'balkon-add-ons') => 'small',
                        esc_html__('Medium', 'balkon-add-ons') => 'medium',
                        esc_html__('Big', 'balkon-add-ons') => 'big', 
                        esc_html__('None', 'balkon-add-ons') => 'no',  
                        
                    ), 
                    "std" => 'extrasmall',
                ),

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Categories', 'balkon-add-ons'), 
                    "param_name" => "show_cat", 
                    "value" => array(
                        esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                        esc_html__('No', 'balkon-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
                ), 

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Excerpt', 'balkon-add-ons'), 
                    "param_name" => "show_excerpt", 
                    "value" => array(
                        esc_html__('No', 'balkon-add-ons') => 'no',
                        esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                         
                    ), 
                  
                    "std" => 'no',
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show View Project', 'balkon-add-ons'), 
                    "param_name" => "show_view_project", 
                    "value" => array(
                        esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                        esc_html__('No', 'balkon-add-ons') => 'no', 
                    ), 
                
                    "std" => 'yes',
                ), 


                


                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Enable Gallery', 'balkon-add-ons'), 
                    "param_name" => "enable_gallery", 
                    "value" => array(
                        esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                        esc_html__('No', 'balkon-add-ons') => 'no', 
                    ), 
                    "std" => 'yes',
                    
                ), 

                
                array(
                    "type"              => "dropdown", 
                    "class"             => "", 
                    "heading"           => esc_html__('Use INFINITE scroll to load more items?', 'balkon-add-ons'), 
                    "param_name"        => "show_loadmore", 
                    "value" => array(
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes', 
                        esc_html__('No', 'balkon-add-ons')      => 'no', 
                    ), 
                    "std"               => 'yes',
                ), 

                array(
                    "type"              => "textfield",
                    "holder"            => "div",
                    "heading"           => esc_html__("Load more items", 'balkon-add-ons'),
                    "param_name"        => "loadmore_posts",
                    "description"       => esc_html__("Number of items to get on additional load.", 'balkon-add-ons'),
                    "value"             => '3',
                    'dependency'        => array(
                        'element'   => 'show_loadmore',
                        'value'     => array( 'yes' ),
                        'not_empty' => false,
                    ),
                ),

                array(
                    "type"              => "dropdown", 
                    "class"             => "", 
                    "heading"           => esc_html__('Show Pagination', 'balkon-add-ons'), 
                    "param_name"        => "show_pagination", 
                    "value"             => array(
                        esc_html__('Yes', 'balkon-add-ons')         => 'yes', 
                        esc_html__('No', 'balkon-add-ons')          => 'no', 
                    ), 
                    "std"               => 'no',
                    'dependency'        => array(
                        'element'   => 'show_loadmore',
                        'value'     => array( 'no' ),
                        'not_empty' => false,
                    ),
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


            )));


        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Balkon_Portfolios extends WPBakeryShortCode {}
        }
