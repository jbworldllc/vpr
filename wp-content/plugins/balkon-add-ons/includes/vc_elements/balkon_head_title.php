<?php 

vc_map( array(
        "name"                      => esc_html__("Header Title", 'balkon-add-ons'),
        "description"               => esc_html__("Title for header section",'balkon-add-ons'),
        "base"                      => "balkon_head_title",
        "content_element"           => true,
        "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
        //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_head_title.php',
        "category"                  => 'Balkon Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Title Text", 'balkon-add-ons'),
                "param_name"    => "title_text",
                'admin_label'   => true,
                "value"         => "About Or Studio",

            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("SubTitle Text", 'balkon-add-ons'),
                "param_name"    => "subtitle_text",
                'admin_label'   => true,
                "value"         => "Who we are",

            ),
            array(
                "type"          => "dropdown", 
                "heading"       => esc_html__('Show Subtitle Separator', 'balkon-add-ons'), 
                "param_name"    => "show_sep", 
                "value"         => array(
                                    esc_html__('Yes', 'balkon-add-ons') => 'yes',
                                    esc_html__('No', 'balkon-add-ons') => 'no',
                ), 
                "std"           => 'yes',
            ), 
            array(
                "type"          => "textarea_html",
                "heading"       => esc_html__("More Info", 'balkon-add-ons'),
                "param_name"    => "content",
                'admin_label'   => true,
                'value'         => '<p>Curabitur bibendum mi sed rhoncus aliquet. Nulla blandit porttitor justo, at posuere sem accumsan nec.</p>'
                
            ), 

            
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__('Scroll button URL', 'balkon-add-ons'), 
                "param_name"    => "scroll_url", 
                'admin_label'   => true,
                "value"         => '#sec2'

            ), 
            array(
                'type'          => 'iconpicker',
                'heading'       => esc_html__( 'Scroll button Icon', 'balkon-add-ons' ),
                'param_name'    => 'scroll_icon',
                'value'         => 'fa fa-long-arrow-down',
                'settings'      => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type'      => 'fontawesome',
                ),
                'dependency'    => array(
                    'eleemnt'   => 'scroll_url',
                    'not_empty' => true
                ),
            ),
            array(
                "type"          => "textfield", 
                "heading"       => esc_html__('Scroll button Text', 'balkon-add-ons'), 
                "param_name"    => "scroll_text", 
                "value"         => 'scroll down',
                'dependency'    => array(
                    'eleemnt'   => 'scroll_url',
                    'not_empty' => true
                ),

            ), 
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name", 'balkon-add-ons'),
                "param_name"    => "el_class",
                "description"   => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'balkon-add-ons'),
                "value"         => "",
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
        class WPBakeryShortCode_Balkon_Head_Title extends WPBakeryShortCode {}
    }