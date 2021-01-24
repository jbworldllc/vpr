<?php

 vc_map( array(
            "name"      => esc_html__("Post List Grid", 'balkon-add-ons'),
            
            "base"      => "balkon_post_grid_list",
            "class"     => "",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_post_grid_list.php',
            "category"  => 'Balkon Theme',
            "show_settings_on_create" => true,
            "params"    => array( 
                array(
                    "type" => "textfield", 
                    "heading" => esc_html__("Post Category IDs to include", 'balkon-add-ons'), 
                    "param_name" => "cat_ids", 
                    "description" => esc_html__("Enter post category ids to include, separated by a comma. Leave empty to get posts from all categories.", 'balkon-add-ons')
                ), 
                array(
                    "type" => "textfield", 
                    "holder" => "div",
                    "heading" => esc_html__("Enter Post IDs", 'balkon-add-ons'), 
                    "param_name" => "ids", 
                    "description" => esc_html__("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'balkon-add-ons')
                ), 
                array(
                    "type" => "textfield", 
                    // "holder" => "div",
                    "heading" => esc_html__("Or Post IDs to Exclude", 'balkon-add-ons'), 
                    "param_name" => "ids_not", 
                    "description" => esc_html__("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'balkon-add-ons')
                ), 
                
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Order by', 'balkon-add-ons'), 
                    "param_name" => "order_by", 
                    "value" => array(
                        esc_html__('Date', 'balkon-add-ons') => 'date', 
                        esc_html__('ID', 'balkon-add-ons') => 'ID', 
                        esc_html__('Author', 'balkon-add-ons') => 'author', 
                        esc_html__('Title', 'balkon-add-ons') => 'title', 
                        esc_html__('Modified', 'balkon-add-ons') => 'modified',
                        esc_html__('Random', 'balkon-add-ons') => 'rand',
                        esc_html__('Comment Count', 'balkon-add-ons') => 'comment_count',
                        esc_html__('Menu Order', 'balkon-add-ons') => 'menu_order',
                    ), 
                    "description" => esc_html__("Select how to sort retrieved posts. More at ", 'balkon-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
                    "std" => 'date',
                ), 
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Sort Order', 'balkon-add-ons'), 
                    "param_name" => "order", 
                    "value" => array(
                        esc_html__('Ascending', 'balkon-add-ons') => 'ASC',
                        esc_html__('Descending', 'balkon-add-ons') => 'DESC', 
                        
                    ), 
                    "description" => esc_html__("Select Ascending or Descending order. More at", 'balkon-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
                    "std" => 'DESC',
                ), 
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => esc_html__("Posts to show", 'balkon-add-ons'),
                    "param_name" => "posts_per_page",
                    "description" => esc_html__("Number of posts to show (-1 for all).", 'balkon-add-ons'),
                    "value"=> '4',
                ),

                
                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => esc_html__('Show Pagination', 'balkon-add-ons'), 
                    "param_name" => "show_pagination", 
                    "value" => array(
                        esc_html__('Yes', 'balkon-add-ons') => 'yes', 
                        esc_html__('No', 'balkon-add-ons') => 'no', 
                    ), 
                    
                    "std" => 'yes',
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
            class WPBakeryShortCode_Balkon_Post_Grid_List extends WPBakeryShortCode {}
        }
