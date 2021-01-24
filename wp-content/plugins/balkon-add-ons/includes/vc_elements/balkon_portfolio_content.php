<?php
vc_map( array(
            "name"                      => esc_html__("Portfolio Content", 'balkon-add-ons'),
            "base"                      => "balkon_portfolio_content",
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_portfolio_content.php',
            "category"                  => 'Balkon Portfolio',
            "show_settings_on_create"   => true,
            "params"                    => array(
                array(
                    "type"          => "textarea_html",
                    "heading"       => esc_html__("Content", 'balkon-add-ons'),
                    "holder"        =>'div',
                    "param_name"    => "content",
                    "value"         =>'<h3 class="pr-subtitle"> Internet tend to repeat predefined chunks as necessary.</h3>
<p class="no-rep">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words</p>
<p class="no-rep">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. </p>',        
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
            )
        ));

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Balkon_Portfolio_Content extends WPBakeryShortCode {}
        }
