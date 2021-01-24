<?php 
vc_map( array(
        "name"                      => esc_html__("Home Image", 'balkon-add-ons'),
        "base"                      => "balkon_home_image",
        "content_element"           => true,
        "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
        ////"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_home_image.php',
        "category"                  => 'Balkon Theme',
        "show_settings_on_create"   => true,
        "params"                    => array(
            array(
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "ajax-vc-img",
                "heading"       => esc_html__("Background Image", 'balkon-add-ons'),
                "param_name"    => "bgimg",
                "description"   => esc_html__("Background image", 'balkon-add-ons'),
                "value"         => "811"
            ),
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content", 'balkon-add-ons'),
                "param_name"    => "content",
                "value"         => '<h2>Balkon<br>Creative  Architecture <br> Studio</h2>
<div class="clearfix"></div>
<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
<div class="clearfix"></div>
<div><a href="#sec2" class="btn float-btn flat-btn custom-scroll-link">Let\'s Start</a></div>'
            ), 
             
            
            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Overlay Opacity", 'balkon-add-ons'),
                "param_name"    => "opacity",
                "value"         => "0.3",
                "description"   => esc_html__("Overlay Opacity value 0.0 - 1. Default 0.3", 'balkon-add-ons')
            ),

            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Parallax Value", 'balkon-add-ons'),
                "param_name"    => "parallax_value",
                "description"   => esc_html__("Parallax CSS style values, separated by comma. Ex: translateY: '250px' ", 'balkon-add-ons').'<a href="'.esc_url('https://github.com/iprodev/Scrollax.js/blob/master/docs/Markup.md' ).'" target="_blank">'.esc_html__('Scrollax Documentation','balkon-add-ons' ).'</a>',
                "value"         => "translateY: '250px'"
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
        ),
        'admin_enqueue_js'      => CTH_DIR_URL . "inc/assets/balkon-elements.js",
        'js_view'               => 'BalkonImagesView',

    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Balkon_Home_Image extends WPBakeryShortCode {}
    }