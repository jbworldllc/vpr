<?php
vc_map( array(
            "name"                      => esc_html__("Resumes List", 'balkon-add-ons'),
            "description"               => esc_html__("A list of Balkon Resumes items",'balkon-add-ons'),
            "base"                      => "balkon_resumes",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_resumes.php',
            "category"                  => 'Balkon Theme',
            "show_settings_on_create"   => true,
            "params"                    => array(
                array(
                    "type"          => "textfield",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Count", 'balkon-add-ons'),
                    "param_name"    => "count",
                    "value"         => "3",
                    "description"   => esc_html__("Number of Resumes to show. -1 to display all.", 'balkon-add-ons')
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Order by', 'balkon-add-ons'),
                    "param_name"    => "order_by",
                    "value"         => array(   
                        esc_html__('Date', 'balkon-add-ons')        => 'date',  
                        esc_html__('ID', 'balkon-add-ons')          => 'ID',  
                        esc_html__('Author', 'balkon-add-ons')      => 'author',       
                        esc_html__('Title', 'balkon-add-ons')       => 'title',  
                        esc_html__('Modified', 'balkon-add-ons')    => 'modified',  
                    ),
                    "description"   => esc_html__("Order by", 'balkon-add-ons'),  
                    "std"           =>'date',    
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__('Sort Order', 'balkon-add-ons'),
                    "param_name"    => "order",
                    "value"         => array(   
                        esc_html__('Descending', 'balkon-add-ons')  => 'DESC',
                        esc_html__('Ascending', 'balkon-add-ons')   => 'ASC',  
                                                                                                                      
                    ),
                    "description"   => esc_html__("Order", 'balkon-add-ons'),    
                    "std"           =>"DESC",  
                ),


                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Or Enter Resume IDs", 'balkon-add-ons'),
                    "param_name"    => "ids",
                    "description"   => esc_html__("Enter Resume ids to show, separated by a comma. (ex: 99,100)", 'balkon-add-ons')
                ),
                
                
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Grid Columns', 'balkon-add-ons'), 
                    "param_name"    => "thumbnail_cols", 
                    "value"         => array(
                        esc_html__('One Column', 'balkon-add-ons')      => 'col-md-12',
                        esc_html__('Two Columns', 'balkon-add-ons')     => 'col-md-6', 
                        esc_html__('Three Columns', 'balkon-add-ons')   => 'col-md-4', 
                          
                    ), 
                    "std"           => 'col-md-12',
                ), 
                array(
                    "type"          => "textfield", 
                    "heading"       => esc_html__('Date Columns', 'balkon-add-ons'), 
                    "description"   => esc_html__('Number of columns width (based on Bootstrap 12 columns) for Resume date. Leave empty to hide.', 'balkon-add-ons'), 
                    "param_name"    => "date_cols", 
                    "std"           => '4',
                ), 
                array(
                    "type"          => "dropdown", 
                    "heading"       => esc_html__('Content Type', 'balkon-add-ons'), 
                    "param_name"    => "content_type", 
                    "value"         => array(
                        esc_html__('Full Content', 'balkon-add-ons')    => 'content', 
                        esc_html__('Excerpt', 'balkon-add-ons')         => 'excerpt', 
                        esc_html__('None', 'balkon-add-ons')            => 'none', 
                    ), 
                    
                    "std"           => 'content',
                ),
                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Link to Resume detail\'s page', 'balkon-add-ons'), 
                    "param_name"    => "show_readmore", 
                    "value"         => array(
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes', 
                        esc_html__('No', 'balkon-add-ons')      => 'no', 
                    ), 
                    
                    "std"           => 'no',
                ),

                array(
                    "type"          => "dropdown", 
                    "class"         => "", 
                    "heading"       => esc_html__('Show Pagination', 'balkon-add-ons'), 
                    "param_name"    => "show_pagination", 
                    "value"         => array(
                        esc_html__('Yes', 'balkon-add-ons')     => 'yes', 
                        esc_html__('No', 'balkon-add-ons')      => 'no', 
                    ), 
                    
                    "std"           => 'yes',
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
            class WPBakeryShortCode_Balkon_Resumes extends WPBakeryShortCode {}
        }
