<?php
vc_map( array(
            "name"                      => esc_html__("Portfolio Details", 'balkon-add-ons'),
            "base"                      => "balkon_portfolio_details",
            "category"                  => 'Balkon Portfolio',
            "icon"                      => CTH_DIR_URL . "assets/cththemes-logo.png",
            "html_template"             => CTH_ABSPATH.'/vc_templates/balkon_portfolio_details.php',
            "show_settings_on_create"   => true,
            "params"                    => array(
                array(
                    "type"          => "textarea_raw_html",
                    "heading"       => esc_html__("Content", 'balkon-add-ons'),
                    "holder"        =>'div',
                    "param_name"    => "content",
                    "value"         =>base64_encode(rawurlencode('<div class="clearfix"></div>
<span class="bold-separator"></span>
<ul class="pr-list">
    <li><span>Date :</span> 26.05.2014 </li>
    <li><span>Client :</span>  House Big </li>
    <li><span>Status :</span> Completed </li>
    <li><span>Location : </span>  <a href="https://goo.gl/maps/UzN5m" target="_blank"> Kharkiv Ukraine  </a></li>
</ul>
<span class="dec-border fl-wrap"></span>')),
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
            class WPBakeryShortCode_Balkon_Portfolio_Details extends WPBakeryShortCode {}
        }