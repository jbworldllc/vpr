<?php 

vc_map( array(
        "name"                          => esc_html__("Single Service", 'balkon-add-ons'),
        "base"                          => "balkon_service",
        "content_element"               => true,
        "icon"                          => CTH_DIR_URL . "assets/cththemes-logo.png",
        //"html_template"                 => CTH_ABSPATH.'/vc_templates/balkon_service.php',
        "category"                      => 'Balkon Theme',
        "show_settings_on_create"       => true,
        "params"                        => array(
            
            array(
                "type"              => "textfield",
                "admin_label"       => true,
                "heading"           => esc_html__("Service Title", 'balkon-add-ons'),
                "param_name"        => "ser_title",
                "value"             => "There are many variations of passages of Lorem Ipsum available",
         
            ),
            
            array(
                "type"              => "textarea_html",
                "admin_label"       => true,
                "heading"           => esc_html__("More Info", 'balkon-add-ons'),
                "param_name"        => "content",
                "value"             => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.
Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.</p>
<ul class="pr-list">
    <li><span class="no-rep">01.</span> Adipiscing elit</li>
    <li><span class="no-rep">02.</span> Cras lacinia</li>
    <li><span class="no-rep">03.</span> Vel molestie</li>
    <li><span class="no-rep">04.</span> Cras lacinia magna</li>
</ul>'
            ),  

            array(
                "type"              => "textfield",
                "admin_label"       => true,
                "heading"           => esc_html__("Service Price", 'balkon-add-ons'),
                "param_name"        => "ser_price",
                "value"             => "-span- Price -span- $250-$350",
              
            ),
             
            
            array(
                "type"              => "textfield",
                "heading"           => esc_html__("Extra class name", 'balkon-add-ons'),
                "param_name"        => "el_class",
                "description"       => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'balkon-add-ons'),
                "value"             => "",
            ),

            array(
                'type'              => 'css_editor',
                'heading'           => esc_html__( 'Css', 'balkon-add-ons' ),
                'param_name'        => 'css',
                'group'             => esc_html__( 'Design options', 'balkon-add-ons' ),
            ),
            
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Balkon_Service extends WPBakeryShortCode {}
    }