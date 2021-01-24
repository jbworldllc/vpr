<?php

vc_map(array(
    "name"                    => esc_html__("Single Testimonial", 'balkon-add-ons'),
    "base"                    => "balkon_single_testimonial",
    "class"                   => "",
    "icon"                    => CTH_DIR_URL . "assets/cththemes-logo.png",
    //"html_template"             => CTH_ABSPATH.'/vc_templates/balkon_single_testimonial.php',
    "category"                => 'Balkon Theme',
    "show_settings_on_create" => true,
    "params"                  => array(

        array(
            "type"        => "textfield",
            "holder"      => "div",
            "heading"     => esc_html__("Testimonial ID", 'balkon-add-ons'),
            "param_name"  => "id",
            "value"       => "190",
            "description" => esc_html__("Enter testimonial id to show. Ex: 190", 'balkon-add-ons'),
        ),
        array(
            "type"        => "dropdown",
            "class"       => "",
            "heading"     => esc_html__('Show Avatar', 'balkon-add-ons'),
            "param_name"  => "show_avatar",
            "value"       => array(
                esc_html__('No', 'balkon-add-ons')  => 'no',
                esc_html__('Yes', 'balkon-add-ons') => 'yes',

            ),
            "description" => esc_html__("Show avatar", 'balkon-add-ons'),
            "std"         => "yes",
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Show Title", 'balkon-add-ons'),
            "param_name" => "show_title",

            "value"      => array(
                esc_html__('No', 'balkon-add-ons')  => 'no',
                esc_html__('Yes', 'balkon-add-ons') => 'yes',

            ),
            "std"        => 'yes',
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Show Rating", 'balkon-add-ons'),
            "param_name" => "show_rating",

            "value"      => array(
                esc_html__('No', 'balkon-add-ons')  => 'no',
                esc_html__('Yes', 'balkon-add-ons') => 'yes',

            ),
            "std"        => 'yes',
        ),

        array(
            "type"        => "textfield",
            "heading"     => esc_html__("Extra class name", 'balkon-add-ons'),
            "param_name"  => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'balkon-add-ons'),
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => esc_html__('Css', 'balkon-add-ons'),
            'param_name' => 'css',
            'group'      => esc_html__('Design options', 'balkon-add-ons'),
        ),
    )));

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Balkon_Single_Testimonial extends WPBakeryShortCode
    {}
}
