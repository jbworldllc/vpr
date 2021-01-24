<?php 

vc_map( array(
        "name"                      => esc_html__("Section Title", 'balkon-add-ons'),
        "description"               => esc_html__("Section Title for Balkon",'balkon-add-ons'),
        "base"                      => "balkon_section_title",
        "content_element"           => true,
        "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
        //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_section_title.php',
        "category"                  => 'Balkon Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            
            array(
                "type"          => "textfield",
                "holder"        => "div",
                "heading"       => esc_html__("Title Text", 'balkon-add-ons'),
                "param_name"    => "title_text",
                "value"         => "Our Featured Work",

            ),
            array(
                "type"          => "textfield",
                "holder"        => "div",
                "heading"       => esc_html__("SubTitle Text", 'balkon-add-ons'),
                "param_name"    => "subtitle_text",
                "value"         => "Lorem Ipsum generators on the Internet tend to repeat king this the first true generator . ",

            ),
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("More Info", 'balkon-add-ons'),
                "param_name"    => "content",
                
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
        class WPBakeryShortCode_Balkon_Section_Title extends WPBakeryShortCode {}
    }