<?php
/**
 * @package Balkon - Creative  Responsive  Architecture WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date: 31-07-2019
 * @version: 1.0
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
function balkon_dynamic_menu_options(){
    global $balkon_options;
    $return = array();
    if(!empty($balkon_options['dynamic_menus'])){
        foreach ($balkon_options['dynamic_menus'] as $key => $location) {
            $return[sanitize_title_with_dashes($location )] = $location;
        }
    }

    return $return;
}



add_action( 'cmb2_admin_init', 'balkon_cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function balkon_cmb2_sample_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_balkon_';

    $hidenav_cmb = new_cmb2_box( array(
        'id'                => 'hide_nav_options',
        'title'             => esc_html__( 'Header - Footer Options', 'balkon-add-ons' ),
        'object_types'      => array( 'post','page','portfolio','member','cth_resume'), // Post type
        'context'           => 'normal',// normal, side and advanced
        'priority'          => 'high',// default, high and low - core
        'show_names'        => true, // Show field names on the left
    ) );
    $hidenav_cmb->add_field( array(
        'name'              => esc_html__('Hide Header', 'balkon-add-ons' ),
        'id'                => $prefix . 'hide_navigation',
        'type'              => 'radio_inline',
        'default'           =>'no',
        'options'           => array(
            'yes'           => esc_html__( 'Yes', 'balkon-add-ons' ),
            'no'            => esc_html__( 'No', 'balkon-add-ons' ),
        ),
    ) );
    $hidenav_cmb->add_field( array(
        'name'              => esc_html__('Main Menu Position', 'balkon-add-ons' ),
        'id'                => $prefix . 'menu_position',
        'type'              => 'select',
        'show_option_none'  => false ,
        'default'           => balkon_get_option('menu_position'),
        'options'           => array(
            'top'           => esc_html__( 'Top Bar', 'balkon-add-ons' ),
            'sidebar'       => esc_html__( 'Side Bar', 'balkon-add-ons' ),
        ),
    ) );
    

    $hidenav_cmb->add_field( array(
        'name' => esc_html__('Hide Footer', 'balkon-add-ons' ),
        'id'   => $prefix . 'hide_footer',
        'type'    => 'radio_inline',
        'default'=>'no',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'balkon-add-ons' ),
            'no'   => esc_html__( 'No', 'balkon-add-ons' ),
            
        ),
    ) );
    $hidenav_cmb->add_field( array(
        'name' => esc_html__('Hide Left Sidebar', 'balkon-add-ons' ),
        'id'   => $prefix . 'hide_left',
        'type'    => 'radio_inline',
        'default'=>'no',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'balkon-add-ons' ),
            'no'   => esc_html__( 'No', 'balkon-add-ons' ),
            
        ),
    ) );

    $hidenav_cmb->add_field( array(
        'name'              => esc_html__( 'Right Scroll Nav Menu', 'balkon-add-ons' ),
        'id'                => $prefix . 'dynamic_menu',
        'type'              => 'select',
        'show_option_none'  => true,
        'default'           => '',
        'options'           => balkon_dynamic_menu_options(),
    ) );

    /**
     * Initiate Post metabox
     */
    $post_cmb = new_cmb2_box( array(
        'id'            => 'post_options',
        'title'         => esc_html__( 'Post Format Options', 'balkon-add-ons' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $post_cmb->add_field( array(
        'name' => esc_html__('Post Slider and Gallery Images', 'balkon-add-ons' ),
        'id'   => $prefix . 'post_slider_images',
        'type' => 'file_list',
        'preview_size' => array( 150, 150 ), // Default: array( 50, 50 )
    ) );

    $post_cmb->add_field( array(
        'name' => esc_html__('Gallery Columns', 'balkon-add-ons' ),
        'desc' => esc_html__('For Gallery post format only.','balkon-add-ons'),
        'id'   => $prefix . 'gallery_cols',
        'type'    => 'select',
        'default'=>'three',
        'options' => array(
            'one' => esc_html__( 'One column', 'balkon-add-ons' ),
            'two'   => esc_html__( 'Two columns', 'balkon-add-ons' ),
            'three'   => esc_html__( 'Three columns', 'balkon-add-ons' ),
            'four'   => esc_html__( 'Four columns', 'balkon-add-ons' ),
            'five'   => esc_html__( 'Five columns', 'balkon-add-ons' ),
            
        ),
    ) );

    $post_cmb->add_field( array(
        'name'       => esc_html__('oEmbed for Post Format', 'balkon-add-ons' ),
        'desc'       => wp_kses(__('Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'balkon-add-ons' ),array('a'=>array('href'=>array()))),
        'id'   => $prefix . 'embed_video',
        'type' => 'oembed',
    ) );

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Initiate Post metabox 2
     */
    $post2_cmb = new_cmb2_box( array(
        'id'            => 'post_layout_options',
        'title'         => esc_html__( 'Post Layout Options', 'balkon-add-ons' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

   

    $post2_cmb->add_field( array(
        'name' => esc_html__('Show Post Header', 'balkon-add-ons' ),
        'id'   => $prefix . 'show_page_header',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'balkon-add-ons' ),
            'no'   => esc_html__( 'No', 'balkon-add-ons' ),
            
        ),
    ) );

    $post2_cmb->add_field( array(
        'name' => esc_html__('Header Image Background', 'balkon-add-ons' ),
        'id'   => $prefix . 'page_header_bg',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => true, // Hide the text input for the url
            
        ),
    ) );

    $post2_cmb->add_field( array(
        'name' => esc_html__('Show Post Title in header', 'balkon-add-ons' ),
        'id'   => $prefix . 'show_page_title',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'balkon-add-ons' ),
            'no'   => esc_html__( 'No', 'balkon-add-ons' ),
            
        ),
    ) );



    $post2_cmb->add_field( array(
        'name' => esc_html__('Header Subtitle', 'balkon-add-ons' ),
        'id'   => $prefix . 'page_header_sub',
        'type' => 'text'
    ) );

    $post2_cmb->add_field( array(
        'name' => esc_html__('Header Additional Info', 'balkon-add-ons' ),
        'id'   => $prefix . 'page_header_intro',
        'type' => 'textarea_small'
    ) );



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Initiate Post featured
     */
    $post3_cmb = new_cmb2_box( array(
        'id'            => 'post_featured_options',
        'title'         => esc_html__( 'Featured', 'balkon-add-ons' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'side',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $post3_cmb->add_field( array(
        'name' => esc_html__( 'Is Featured post', 'balkon-add-ons' ),
        'id' => $prefix . 'is_featured',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => 'no',
        'options'          => array(
            'no' => esc_html__( 'No', 'balkon-add-ons' ),
            'yes' => esc_html__( 'Yes', 'balkon-add-ons' ),
        ),
    ) );


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Initiate Portfolio metabox
     */
    $folio_cmb = new_cmb2_box( array(
        'id'            => 'porfolio_list_fields',
        'title'         => esc_html__('Portfolio List Options', 'balkon-add-ons' ),
        'object_types'  => array( 'portfolio'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $folio_cmb->add_field( array(
        'name' => esc_html__('Video Link', 'balkon-add-ons' ),
        'desc' => wp_kses(__('Enter a youtube, twitter, or instagram URL to display video as a thumbnail. Supports services listed at <a href="http://codex.wordpress.org/Embeds" target="_blank">http://codex.wordpress.org/Embeds</a>.', 'balkon-add-ons' ),array('a'=>array('href'=>array(),'target'=>array()))),
        'id'   => $prefix . 'folio_video',
        'type' => 'oembed',
    ) );

    $folio_cmb->add_field( array(
        'name' => esc_html__( 'Masonry Size', 'balkon-add-ons' ),
        'desc' => esc_html__( 'Choose the size of item thumbnail that show in portfolio masonry grid. You must select a Feature image for this portfolio item.', 'balkon-add-ons' ),
        'id' => $prefix . 'masonry_size',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => 'one',
        'options' => array(
            'one' => esc_html__( 'Size One', 'balkon-add-ons' ),
            'second' => esc_html__( 'Size Two', 'balkon-add-ons' ),
            'three' => esc_html__( 'Size Three', 'balkon-add-ons' ),
        ),
    ) );

    // $folio_cmb->add_field( array(
    //     'name' => esc_html__('Popup Image or Video', 'balkon-add-ons' ),
    //     'desc' => esc_html__('Select image or Youtube, Vimeo video link for popup. Leave empty for single portfolio page link.', 'balkon-add-ons' ),
    //     'id'   => $prefix . 'folio_popup_link',
    //     'type'    => 'file',
    //     // Optional:
    //     'options' => array(
    //         'url' => true, // Hide the text input for the url
           
    //     ),
    // ) );


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Initiate Page metabox
     */
    $page_cmb = new_cmb2_box( array(
        'id'            => 'des_header',
        'title'         => esc_html__('Page Layout Options - For normal page template only', 'balkon-add-ons' ),
        'object_types'  => array( 'page'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

   

    $page_cmb->add_field( array(
        'name' => esc_html__('Show Post Header', 'balkon-add-ons' ),
        'id'   => $prefix . 'show_page_header',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'balkon-add-ons' ),
            'no'   => esc_html__( 'No', 'balkon-add-ons' ),
            
        ),
    ) );

    $page_cmb->add_field( array(
        'name' => esc_html__('Header Image Background', 'balkon-add-ons' ),
        'id'   => $prefix . 'page_header_bg',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => true, // Hide the text input for the url
            
        ),
    ) );

    $page_cmb->add_field( array(
        'name' => esc_html__('Show Post Title in header', 'balkon-add-ons' ),
        'id'   => $prefix . 'show_page_title',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'balkon-add-ons' ),
            'no'   => esc_html__( 'No', 'balkon-add-ons' ),
            
        ),
    ) );



    $page_cmb->add_field( array(
        'name' => esc_html__('Header Subtitle', 'balkon-add-ons' ),
        'id'   => $prefix . 'page_header_sub',
        'type' => 'text'
    ) );

    $page_cmb->add_field( array(
        'name' => esc_html__('Header Additional Info', 'balkon-add-ons' ),
        'id'   => $prefix . 'page_header_intro',
        'type' => 'textarea_small'
    ) );

    

//////////////////////////////////////////////////////////////////////////////////////


    $member_cmb2 = new_cmb2_box( array(
        'id'            => 'member_additional_mtb',
        'title'         => esc_html__('Social Links', 'balkon-add-ons' ),
        'object_types'  => array( 'member'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );


    $member_cmb2->add_field( array(
        'name' => esc_html__( 'Facebook URL', 'balkon-add-ons' ),
        'id'   => $prefix . 'facebookurl',
        'type' => 'text_url',
    ) );

    $member_cmb2->add_field( array(
        'name' => esc_html__( 'Twitter URL', 'balkon-add-ons' ),
        'id'   => $prefix . 'twitterurl',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
        'name' => esc_html__( 'Google+ URL', 'balkon-add-ons' ),
        'id'   => $prefix . 'googleplusurl',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
       'name' => esc_html__( 'Linkedin URL', 'balkon-add-ons' ),
        'id'   => $prefix . 'linkedinurl',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
       'name' => esc_html__( 'Instagram URL', 'balkon-add-ons' ),
        'id'   => $prefix . 'instagramurl',
        'type' => 'text_url',
    ) );
    $member_cmb2->add_field( array(
       'name' => esc_html__( 'Tumblr URL', 'balkon-add-ons' ),
        'id'   => $prefix . 'tumblrurl',
        'type' => 'text_url',
    ) );

    $member_cmb2->add_field( array(
       'name' => esc_html__( 'Behance URL', 'balkon-add-ons' ),
        'id'   => $prefix . 'behanceurl',
        'type' => 'text_url',
    ) );


    /**
     * Initiate Resumes metabox
     */
    $resume_cmb = new_cmb2_box( array(
        'id'            => 'resumes_mtb',
        'title'         => esc_html__('Resume Options', 'balkon-add-ons' ),
        'object_types'  => array( 'cth_resume'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $resume_cmb->add_field( array(
        'name' => esc_html__( 'Resume Date', 'balkon-add-ons' ),
        'id' => $prefix . 'resume_date',
        'type'             => 'text',
        'default'          => '2017',
        
    ) );

    /**
     * Initiate Testimonials metabox
     */
    $testim_cmb = new_cmb2_box( array(
        'id'            => 'testimonial_mtb',
        'title'         => esc_html__('Testimonial Meta Options', 'balkon-add-ons' ),
        'object_types'  => array( 'cth_testimonial'), // Post type
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'high',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    $testim_cmb->add_field( array(
        'name' => esc_html__( 'Rating Stars', 'balkon-add-ons' ),
       
        'id' => $prefix . 'testim_rate',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => 'five',
        'options' => array(
            'no' => esc_html__( 'Not Rate', 'balkon-add-ons' ),
            '1' => esc_html__( '1 Star', 'balkon-add-ons' ),
            '1.5' => esc_html__( '1.5 Stars', 'balkon-add-ons' ),
            '2' => esc_html__( '2 Stars', 'balkon-add-ons' ),
            '2.5' => esc_html__( '2.5 Stars', 'balkon-add-ons' ),
            '3' => esc_html__( '3 Stars', 'balkon-add-ons' ),
            '3.5' => esc_html__( '3.5 Stars', 'balkon-add-ons' ),
            '4' => esc_html__( '4 Stars', 'balkon-add-ons' ),
            '4.5' => esc_html__( '4.5 Stars', 'balkon-add-ons' ),
            '5' => esc_html__( '5 Stars', 'balkon-add-ons' ),
            
        ),
    ) );


    /**
     * Initiate User Profile metabox
     */
    $user_cmb = new_cmb2_box( array(
        'id'         => 'user_edit',
        'title'      => esc_html__( 'User Profile Metabox', 'balkon-add-ons' ),
        'object_types'  => array( 'user' ), // Tells CMB to use user_meta vs post_meta
        'context'       => 'normal',// normal, side and advanced
        'priority'      => 'core',// default, high and low - core
        'show_names'    => true, // Show field names on the left
    ) );

    

    $user_cmb->add_field( array(
        'name' => esc_html__('Show User Info Block', 'balkon-add-ons' ),
        // 'desc' => esc_html__('Select an image for resume grid view','balkon-add-ons'),
        'id'   => $prefix . 'show_user_info',
        'type'    => 'radio_inline',
        'default'=>'yes',
        'options' => array(
            'yes' => esc_html__( 'Yes', 'balkon-add-ons' ),
            'no'   => esc_html__( 'No', 'balkon-add-ons' ),
            
        ),
    ) );


    $user_cmb->add_field( array(
        'name' => esc_html__( 'Facebook URL', 'balkon-add-ons' ),
      
        'id'   => $prefix . 'facebookurl',
        'type' => 'text_url',
        
    ) );

    $user_cmb->add_field( array(
        'name' => esc_html__( 'Twitter URL', 'balkon-add-ons' ),
        
        'id'   => $prefix . 'twitterurl',
        'type' => 'text_url',
        
    ) );
    $user_cmb->add_field( array(
        'name' => esc_html__( 'Google+ URL', 'balkon-add-ons' ),
        
        'id'   => $prefix . 'googleplusurl',
        'type' => 'text_url',
        
    ) );
    $user_cmb->add_field( array(
       'name' => esc_html__( 'Linkedin URL', 'balkon-add-ons' ),
        
        'id'   => $prefix . 'linkedinurl',
        'type' => 'text_url',
        
    ) );
    $user_cmb->add_field( array(
       'name' => esc_html__( 'Instagram URL', 'balkon-add-ons' ),
        
        'id'   => $prefix . 'instagramurl',
        'type' => 'text_url',
        
    ) );
    $user_cmb->add_field( array(
       'name' => esc_html__( 'Tumblr URL', 'balkon-add-ons' ),
        
        'id'   => $prefix . 'tumblrurl',
        'type' => 'text_url',
        
    ) );

}