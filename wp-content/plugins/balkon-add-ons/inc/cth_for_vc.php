<?php
/* add_ons_php */

function balkon_addons_register_wpbakerry_elements()
{

    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_swiper.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_swiper_multiimgs.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_home_image.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_home_youtube_video.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_home_vimeo_video.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_home_video.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_home_slideshow.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_carousel.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_carousel_multiimgs.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolios_carousel.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolios_parallax.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_circle_progress.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_icons.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_button.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_image.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_counter.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_head_title.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_section_title.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_service.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_testimonials.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_single_testimonial.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_clients.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolios.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_image_carousel.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_post_masonry_list.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_post_grid_list.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_gmap.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_members.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_member.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_resumes.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_landing.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_images_gallery_masonry.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_fullwidth_slider.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_slider.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolio_title.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolio_tags.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolio_content.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolio_details.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolio_nav.php';
    require_once CTH_ABSPATH . 'includes/vc_elements/balkon_portfolio_comment.php';



}
add_action('vc_before_init', 'balkon_addons_register_wpbakerry_elements');

// Add new Param in Row
function balkon_add_ons_add_vc_param()
{
    if (function_exists('vc_set_shortcodes_templates_dir')) {
        vc_set_shortcodes_templates_dir(CTH_ABSPATH . '/vc_templates/');
    }

    $new_row_params = array(
        array(
                "type" => "dropdown",
                "heading" => esc_html__('Balkon Predefined Section Layout', 'balkon-add-ons'),
                "param_name" => "cth_layout",
                "value" => array(   
                                esc_html__('Default', 'balkon-add-ons') => 'default',  
                                esc_html__('Balkon Home (Fullheight) Section', 'balkon-add-ons') => 'balkon_homefullheight_sec',
                                esc_html__('Balkon Page Header Section', 'balkon-add-ons') => 'balkon_head_sec',
                                esc_html__('Balkon Page Section', 'balkon-add-ons') => 'balkon_page_sec',
                                esc_html__('Balkon Background Video', 'balkon-add-ons') => 'balkon_video_bg_sec',

                ),
                "description" => esc_html__("Select one of the pre made page sections or using default", 'balkon-add-ons'), 
                "group" => "Balkon Theme",
            ) ,
array(
                                
                                "type" => "dropdown",
                                "heading" => esc_html__('Content Width', 'balkon-add-ons'),
                                "param_name" => "is_fullwidth",
                                "value" => array(   
                                                esc_html__('Full width','balkon-add-ons' ) => 'yes',  
                                                esc_html__('Fluid width','balkon-add-ons' ) => 'wide',  
                                                esc_html__('Fixed width','balkon-add-ons' ) => 'no',   
                                                                                                                                
                                            ),
                                "std" => 'no',
                                

                                'dependency' => array(
                                    'element' => 'cth_layout',
                                    'value' => array( 'balkon_homefullheight_sec','balkon_head_sec','balkon_page_sec','balkon_video_bg_sec'),
                                    'not_empty' => false,
                                ),


                                "group" => "Balkon Theme",
                            ) ,
array(
                                
                                "type" => "dropdown",
                                "heading" => esc_html__('No Padding', 'balkon-add-ons'),
                                "param_name" => "no_padding",
                                "value" => array(   
                                                esc_html__('Yes', 'balkon-add-ons') => 'yes',  
                                                esc_html__('No', 'balkon-add-ons') => 'no',   
                                                                                                                                
                                            ),
                                "std" => 'no',
                                'dependency' => array(
                                    'element' => 'cth_layout',
                                    'value' => array( 'balkon_page_sec','balkon_head_sec','balkon_video_bg_sec'),
                                    'not_empty' => false,
                                ),


                                "group" => "Balkon Theme",
                            ) ,
array(
                                
                                "type" => "dropdown",
                                "heading" => esc_html__('Background Color', 'balkon-add-ons'),
                                "param_name" => "balkon_bg_color",
                                "value" => array(   
                                                esc_html__( 'Theme Color','balkon-add-ons' ) => 'color-bg',
                                                esc_html__( 'White Color','balkon-add-ons' ) => 'white-color-bg',
                                                esc_html__( 'Dark Color','balkon-add-ons' ) => 'dark-bg',
                                                esc_html__( 'Gray Color','balkon-add-ons' ) => 'gray-bg',
                                                esc_html__( 'Transparent Color','balkon-add-ons' ) => 'transparent-color-bg',
                                                                                                                                
                                            ),
                                "std" => 'white-color-bg',
                                'dependency' => array(
                                    'element' => 'cth_layout',
                                    'value' => array( 'balkon_homefullheight_sec','balkon_head_sec','balkon_page_sec','balkon_video_bg_sec'),
                                    'not_empty' => false,
                                ),
                                "group" => "Balkon Theme",  
                            ) ,

array(
                                
                                "type" => "dropdown",
                                "heading" => esc_html__('Background Video Type', 'balkon-add-ons'),
                                "param_name" => "bg_video_type",
                                "value" => array(   
                                               esc_html__('Youtube Video','balkon-add-ons' ) => 'youtube',  
                                               esc_html__('Vimeo Video','balkon-add-ons' ) => 'vimeo',  
                                               esc_html__('Hosted Video','balkon-add-ons' ) => 'hosted',  
                                                                                                                                
                                            ),
                                "std" => 'hosted',
                                

                                'dependency' => array(
                                    'element' => 'cth_layout',
                                    'value' => array('balkon_video_bg_sec'),
                                    'not_empty' => false,
                                ),


                                "group" => "Balkon Theme",
                            ) ,
array(
                                "type" => "textfield",
                                "heading" => esc_html__('Video URL', 'balkon-add-ons'),
                                "param_name" => "bg_video",
                                "value" => "",
                                "description" => esc_html__("Enter your Youtube, Vimeo video ID or URL for hosted video.", 'balkon-add-ons'),
                                'dependency' => array(
                                    'element' => 'cth_layout',
                                    'value'     => array('balkon_video_bg_sec'),
                                    'not_empty' => false,
                                ),
                                "group" => "Balkon Theme",
                            ) ,
array(
                                "type"          => "dropdown",
                                "heading"       => esc_html__('Mute', 'balkon-add-ons'),
                                "param_name"    => "bg_video_mute",
                                "value"         => array(   
                                                    esc_html__('Yes', 'balkon-add-ons') => '1',  
                                                    esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                                ),
                                "std"           =>"1",
                                'dependency' => array(
                                    'element' => 'bg_video',
                                    'not_empty' => true,
                                ),


                                "group" => "Balkon Theme",  
                            ),
array(
                                    "type"          => "dropdown",
                                    "heading"       => esc_html__('Loop', 'balkon-add-ons'),
                                    "param_name"    => "bg_video_loop",
                                    "value"         => array(   
                                                        esc_html__('Yes', 'balkon-add-ons') => '1',  
                                                        esc_html__('No', 'balkon-add-ons') => '0',                                                                                
                                    ),
                                    "std"           =>"1",
                                    'dependency' => array(
                                        'element' => 'bg_video',
                                        'not_empty' => true,
                                    ),


                                    "group" => "Balkon Theme",  
                                ),
array(
                                    "type" => "attach_image",
                                    "heading" => esc_html__('Parallax Background Image', 'balkon-add-ons'),
                                    "param_name" => "parallax_inner",
                                    'dependency' => array(
                                        'element' => 'cth_layout',
                                        'value' => array('balkon_homefullheight_sec','balkon_head_sec', 'balkon_page_sec','balkon_video_bg_sec'),
                                        'not_empty' => false,
                                    ),
                                    "group" => "Balkon Theme",
                                ),

array(
                                
                                "type" => "dropdown",
                                "heading" => esc_html__('Background Image Position', 'balkon-add-ons'),
                                "param_name" => "parallax_inner_pos",
                                "value" => array(   
                                                esc_html__('Left','balkon-add-ons' ) => 'left',
                                                esc_html__('Cover','balkon-add-ons' ) => 'cover',
                                                esc_html__('Right','balkon-add-ons' ) => 'right',
                                                                                                                                
                                            ),
                                "std" => 'left',
                                'dependency' => array(
                                    'element' => 'parallax_inner',
                                    'not_empty' => true,
                                ),


                                "group" => "Balkon Theme",  
                            ) ,
array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Overlay Background Color', 'balkon-add-ons' ),
                        'param_name' => 'overlay_color',
                        'value'=>'rgba(0,0,0,1)',
                        'description' => esc_html__( 'Select custom background color color.', 'balkon-add-ons' ),
                        'dependency' => array(
                            'element' => 'parallax_inner',
                            'not_empty' => true,
                        ),

                        "group" => "Balkon Theme",
            ),

array(
                                "type" => "textfield",
                                "heading" => esc_html__('Background Parallax Value', 'balkon-add-ons'),
                                "param_name" => "parallax_inner_val",
                                "value" => "",
                                "description" => esc_html__("Parallax CSS style values, separated by comma. Ex: 'translateX': '50px','translateY': '250px' ", 'balkon-add-ons').'<a href="'.esc_url('https://github.com/iprodev/Scrollax.js/blob/master/docs/Markup.md' ).'" target="_blank">'.esc_html__('Scrollax Documentation','balkon-add-ons' ).'</a>',
                                'dependency' => array(
                                    'element' => 'parallax_inner',
                                    'not_empty' => true,
                                ),
                                "group" => "Balkon Theme",
                            ) ,

array(
                                
                                "type" => "dropdown",
                                "heading" => esc_html__('Use Particle Decoration', 'balkon-add-ons'),
                                "heading" => esc_html__('For creating an animated particle system which reacts to viewer\'s mouse position.', 'balkon-add-ons'),


                                "param_name" => "use_particle",
                                "value" => array(   
                                                esc_html__('Yes','balkon-add-ons' ) => 'yes',
                                                esc_html__('No','balkon-add-ons' ) => 'no',
                                                                                                                                
                                            ),
                                "std" => 'no',
              


                                "group" => "Balkon Theme",  
                            ) ,
array(
                                "type" => "textfield",
                                "heading" => esc_html__('Particle Count', 'balkon-add-ons'),
                                "param_name" => "particle_count",
                                "value" => "250",
                                "description" => esc_html__("Number of particles on the section", 'balkon-add-ons'),
                                'dependency' => array(
                                    'element' => 'use_particle',
                                    'value'=> array('yes'),
                                    'not_empty' => false,
                                ),
                                "group" => "Balkon Theme",
                            ) ,
array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Particle Color', 'balkon-add-ons' ),
                        'param_name' => 'particle_color',
                        'value'=>'#ccc',
                        'dependency' => array(
                            'element' => 'use_particle',
                            'value'=> array('yes'),
                            'not_empty' => false,
                        ),

                        "group" => "Balkon Theme",
            ),
    );
    if (function_exists('vc_add_params')) {
        vc_add_params('vc_row', $new_row_params);
    }

}

add_action('init', 'balkon_add_ons_add_vc_param');

