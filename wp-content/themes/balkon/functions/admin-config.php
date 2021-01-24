<?php
/**
 * @package Balkon - Creative  Responsive  Architecture WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date: 31-07-2019
 * @version: 1.0
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
 
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        // $balkon_default_options = '{"favicon":{"url":"'.addcslashes( home_url('/' ) ,'/').'wp-content\/themes\/balkon\/images\/favicon.ico"},"logo_first":{"url":"'.addcslashes( home_url('/' ) ,'/').'wp-content\/themes\/balkon\/images\/logo.png"},"logo_size_width":"143","logo_size_height":"40","logo_text":"","slogan":"","show_loader":true,"show_submenu_mobile":false,"disable_outer_border":false,"video_header_mute":true,"disable_parallax_effect":false,"pagination_type":"custom","dynamic_menus":["About Us page Scroll nav menu","About Personal page Scroll nav menu","Services page Scroll nav menu"],"show_search":true,"share_names":"","menu_position":"top","menusb_header_info":"<ul>\n    <li><a href=\"#\" target=\"_blank\"> <span>Call :<\/span> +7(111)123456789<\/a><\/li>\n    <li><a href=\"#\" target=\"_blank\"> <span>Write :<\/span> yourmail@domain.com<\/a><\/li>\n<\/ul>","menusb_logo":{"url":"'.addcslashes( home_url('/' ) ,'/').'wp-content\/themes\/balkon\/images\/logo.png"},"menusb_copyright":"<p>&copy; Balkon 2017. All rights reserved.<\/p>","show_left_bar":true,"show_fixed_title":true,"left_bar_width":"80px","left_socials":"<ul>\n    <li><a href=\"#\" target=\"_blank\" ><i class=\"fa fa-facebook\"><\/i><\/a><\/li>\n    <li><a href=\"#\" target=\"_blank\"><i class=\"fa fa-twitter\"><\/i><\/a><\/li>\n    <li><a href=\"#\" target=\"_blank\" ><i class=\"fa fa-instagram\"><\/i><\/a><\/li>\n    <li><a href=\"#\" target=\"_blank\" ><i class=\"fa fa-pinterest\"><\/i><\/a><\/li>\n    <li><a href=\"#\" target=\"_blank\" ><i class=\"fa fa-tumblr\"><\/i><\/a><\/li>\n<\/ul>","footer_widgets":["Logo Footer widget | col-md-3","Contact Footer widget | col-md-4","Newsletter Footer widget | col-md-5"],"footer_copyright":"<div class=\"col-md-3\"><\/div>\n<div class=\"col-md-9\">\n    <div class=\"fl-wrap policy-box\">\n        <p> &copy; Balkon 2017. All rights reserved.<\/p>\n    <\/div>\n<\/div>","to_top_icon":"<i class=\"fa fa-long-arrow-up\"><\/i>","mailchimp_api":"","mailchimp_list_id":"","enable_custom_sizes":false,"fullscreen_thumb":{"width":"9999","height":"9999","hard_crop":1},"horizontal_slider_thumb":{"width":"9999","height":"9999","hard_crop":1},"folio_grid_thumbnail_size":{"width":"700","height":"464","hard_crop":1},"galmasonry_thumbnail_size_one":{"width":"460","height":"305","hard_crop":1},"galmasonry_thumbnail_size_two":{"width":"920","height":"610","hard_crop":1},"galmasonry_thumbnail_size_three":{"width":"1380","height":"915","hard_crop":1},"galgrid_thumbnail_size":{"width":"460","height":"305","hard_crop":0},"team_member_thumb":{"width":"388","height":"388","hard_crop":1},"blog_image_thumb":{"width":"800","height":"530","hard_crop":1},"blog_image_large_thumb":{"width":"800","height":"530","hard_crop":1},"color-preset":"default","override-preset":false,"main-bg-color":"#f4f4f4","theme-bg-color-2":"#ffffff","theme-bg-color-3":"#ffffff","theme-bd-color":{"color":"#eeeeee","alpha":1},"theme-color":"#000000","body-text-color":"#000000","hyperlink-text-color":{"regular":"#000000","hover":"#000000","active":"#000000"},"paragraph-color":"#000000","header-color":{"color":"#ffffff","alpha":1},"submenu-bg-color":{"color":"#000000","alpha":0.71},"main-nav-menu-color":{"regular":"#999999","hover":"#000000","active":"#000000"},"submenu-color":{"regular":"#ffffff","hover":"#f5f5f5","active":"#f5f5f5"},"left-sidebar-bg-color":{"color":"#ffffff","alpha":1},"footer-bg-color":{"color":"#ffffff","alpha":1},"show_folio_header":true,"folio_head_title":"Our Portfolios","folio_head_subtitle":"Our Works","folio_head_desc":"<p>Curabitur bibendum mi sed rhoncus aliquet. Nulla blandit porttitor justo, at posuere sem accumsan nec.<\/p>","folio_header_image":{"url":"'.addcslashes( home_url('/' ) ,'/').'wp-content\/themes\/balkon\/images\/bg\/2.jpg"},"folio_layout":"masonry","folio_style":"style1","folio_grid_content_width":"boxed-container","folio_column":"three","folio_posts_per_page":12,"folio_archive_orderby":"date","folio_archive_order":"DESC","folio_pad":"no","folio_show_excerpt":false,"folio_show_cat_grid":true,"folio_show_readmore":true,"folio_enable_gallery":true,"folio_after_grid_content":"<div class=\"order-item fl-wrap margin-content\">\n    <div class=\"row\">\n        <div class=\"col-md-4\"><\/div>\n        <div class=\"col-md-4\">\n            <h3>Ready to order your project ? <\/h3>\n        <\/div>\n        <div class=\"col-md-4\"><a href=\"'.addcslashes( home_url('/' ) ,'/').'contact\/\" class=\"btn float-btn flat-btn\">Get in Touch<\/a><\/div>\n    <\/div>\n<\/div>","folio_parallax_first":"right","folio_parallax_colwidth":"7","folio_parallax_value":"translateY: \'-250px\'","folio_parallax_number":true,"folio_parallax_date":true,"folio_parallax_cats":true,"folio_parallax_excerpt":true,"folio_parallax_tosingle":true,"folio_show_filter":true,"folio_grid_filter_width":"big-container","folio_filter_orderby":"name","folio_filter_order":"ASC","folio_show_counter":true,"folio_filter_all":true,"folio_use_pagi_infinite":true,"folio_loadmore_items":3,"folio_show_pagination":false,"show_blog_header":false,"blog_head_title":"Our Journal","blog_head_title_sub":"Our Blog","blog_head_title_desc":"<p>Curabitur bibendum mi sed rhoncus aliquet. Nulla blandit porttitor justo, at posuere sem accumsan nec.<\/p>","blog_header_video":"","blog_header_image":{"url":"'.addcslashes( home_url('/' ) ,'/').'wp-content\/themes\/balkon\/images\/bg\/23.jpg"},"blog-grid-width":"blog-wide","blog_layout":"right_sidebar","blog-sidebar-width":"4","blog-grid-style":"list","blog-grid-columns":"two","blog_list_show_format":false,"blog_author":true,"blog_date":true,"blog_cats":true,"blog_tags":true,"blog_comments":true,"blog_show_views":true,"blog-single-width":"blog-wide","blog-single-sidebar-width":"4","blog_single_title":false,"blog_featured_single":true,"blog_date_single":true,"blog_cats_single":true,"blog_tags_single":true,"blog_author_single":true,"blog_single_navigation":true,"blog_single_nav_same_term":false,"blog_list_link":"'.addcslashes( home_url('/' ) ,'/').'?post_type=post","password_page_bg":{"url":"'.addcslashes( home_url('/' ) ,'/').'wp-content\/themes\/balkon\/images\/bg\/6.jpg"},"password_page_intro":"","password_page_home_link":"'.addcslashes( home_url('/' ) ,'/').'","404_intro":"<p> The Page you were looking for, couldn\'t be found.<\/p>","back_home_link":"'.addcslashes( home_url('/' ) ,'/').'","REDUX_last_saved":1501574431,"REDUX_LAST_SAVE":1501574431}';
        // $balkon_options = json_decode($balkon_default_options,true);
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "balkon_options";

    // This line is only for altering the demo. Can be easily removed.

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Balkon Options', 'balkon' ),
        'page_title'           => esc_html__( 'Balkon Options', 'balkon' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => false,
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'forced_dev_mode_off'   => false,
        // to forcefully disable dev mode
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( wp_kses(__( '<p><strong>Balkon - Creative  Responsive  Architecture WordPress Theme</strong> is perfect if you like a clean and modern design. This theme is ideal for designers, photographers, and those who need an easy, attractive and effective way to share their work with clients.</p>', 'balkon' ),array('p'=>array(),'strong'=>array()) ) , $v );
    } else {
        $args['intro_text'] =  wp_kses(__( '<p><strong>Balkon - Creative  Responsive  Architecture WordPress Theme</strong> is perfect if you like a clean and modern design. This theme is ideal for designers, photographers, and those who need an easy, attractive and effective way to share their work with clients.</p>', 'balkon' ),array('p'=>array(),'strong'=>array()) );
    }

    // Add content after the form.
    $args['footer_text'] = '<p>'.esc_html__('Thanks all of you who stay with us, your co-operation is our inspiration.','balkon' ).' <a href="'.esc_url('http://themeforest.net/user/cththemes/portfolio/' ).'" target="_blank">CTHthemes</a></p>';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
        //////////////// CUSTOM ///////////////

    // -> START General Settings

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('General', 'balkon'),
        'id'         => 'general-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'balkon' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'fa fa-cogs',
        'fields' => array(
            array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Custom Favicon', 'balkon'),
                'desc' => esc_html__('Upload your Favicon.', 'balkon'),
                'default' => array('url' => get_template_directory_uri().'/images/favicon.ico'),
            ),
            array(
                'id' => 'logo_first',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Your Logo', 'balkon'),

                'desc' => esc_html__('Upload your logo.', 'balkon'),

                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ),
            array(
                'id' => 'logo_size_width',
                'type' => 'text',
                'title' => esc_html__('Logo Size Width', 'balkon'),

                'default' => '143'
            ),
            array(
                'id' => 'logo_size_height',
                'type' => 'text',
                'title' => esc_html__('Logo Size Height', 'balkon'),

                'default' => '40'
            ),
            array(
                'id' => 'logo_text',
                'type' => 'text',
                'title' => esc_html__('Logo Text', 'balkon'),

                'default' => ''
            ),
            array(
                'id' => 'slogan',
                'type' => 'text',
                'title' => esc_html__('Slogan (Sub Logo Text)', 'balkon'),
                'default' => ''
            ),
            

            

            array(
                'id' => 'show_loader',
                'type' => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title' => esc_html__('Show animation loadder', 'balkon'),
                'subtitle' => esc_html__('Show animation loader', 'balkon'),
                'default' => true
            ),
            
            

            
            array(
                'id' => 'show_submenu_mobile',
                'type' => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title' => esc_html__('Show Submenu on Mobile', 'balkon'),
                'subtitle' => esc_html__('Set this option to Yes to display submenu items on mobile devices instead of hovering its parent.', 'balkon'),
                'default' => false
            ),

            array(
                'id' => 'disable_outer_border',
                'type' => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title' => esc_html__('Disable Outer Border', 'balkon'),
                'default' => false
            ),


            array(
                'id'       => 'video_header_mute',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Mute Header Video', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id' => 'disable_parallax_effect',
                'type' => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title' => esc_html__('Disable Parallax Effect', 'balkon'),
                'default' => false
            ),

            array(
                'id' => 'gmap_api_key',
                'type' => 'text',
                'title' => esc_html__('Google Map API Key', 'balkon'),
                'subtitle' => esc_html__('You have to enter your API key to use google map feature.', 'balkon'),
                'desc' => '<a href="'.esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key' ).'" target="_blank">Get a key</a>.',
            ),


            array(
                'id' => 'pagination_type',
                'type' => 'select',
                'title' => esc_html__('Pagination Style', 'balkon'),
                'options' => array(
                                'custom' => esc_html__('Theme Style','balkon'),
                                'default' => esc_html__('Default WordPress','balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => 'custom'
            ),

            array(
                'id'=>'dynamic_menus',
                'type' => 'multi_text',
                'title' => esc_html__('Additional Menu Locations', 'balkon'),
                'default'=> array(
                                
                                'About Us page Scroll nav menu',
                                'About Personal page Scroll nav menu',
                                'Services page Scroll nav menu',                            
                ),
                'show_empty'        => true,
                'subtitle' => wp_kses(__('These values will display on <strong>Appearance</strong> &gt; <strong>Menus</strong> then <strong>Display location</strong> option and <strong>Right Scroll Nav Menu</strong> on page, post or portfolio setting.', 'balkon'),array('strong'=>array(),'p'=>array()) ),
            ),
            
            
        ),
    ) );

    

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Header', 'balkon'),
        'id'         => 'header-settings',
        'subsection' => false,
        
        'icon'       => 'fa fa-header',
        'fields' => array(
            array(
                'id' => 'show_search',
                'type' => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title' => esc_html__('Show Topbar Search', 'balkon'),
                'default' => true
            ),
            array(
                'id' => 'share_names',
                'type' => 'text',
                'title' => esc_html__('Share Names', 'balkon'),
                'subtitle' => wp_kses('Enter your social share names separated by a comma.<br> List bellow are available names:<strong><br> facebook,twitter,linkedin,in1,tumblr,<br>digg,googleplus,reddit,pinterest<br>,stumbleupon,email,vk</strong>', array('br'=>array(),'strong'=>array()) ),
                
                'default' => "",
            ),

            array(
                'id' => 'menu_position',
                'type' => 'select',
                'title' => esc_html__('Main Menu Position', 'balkon'),

                'options' => array(
                                'top' => esc_html__('Top Bar','balkon'),
                                'sidebar' => esc_html__('Side Bar','balkon'),
                 ), 
                'default' => 'top'
            ),

            

        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Sidebar Menu Options', 'balkon'),
        'id'         => 'sidebar-menu-optons',
        'subsection' => true,
        'fields' => array(

            
            
            

            array(
                'id' => 'menusb_header_info',
                'type' => 'textarea',
                'title' => esc_html__('Header Info', 'balkon'),
                'default' => '<ul>
    <li><a href="#" target="_blank"> <span>Call :</span> +7(111)123456789</a></li>
    <li><a href="#" target="_blank"> <span>Write :</span> yourmail@domain.com</a></li>
</ul>',
            ),

            array(
                'id' => 'menusb_logo',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Logo', 'balkon'),

                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ),

            array(
                'id' => 'menusb_copyright',
                'type' => 'textarea',
                'title' => esc_html__('Copyright', 'balkon'),
                'default' => '<p>&copy; Balkon 2017. All rights reserved.</p>',
            ), 

              
        ),
    ));
    
    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Left Sidebar', 'balkon'),
        'id'         => 'left-hand-settings',
        'subsection' => false,
        
        'icon'       => 'fa fa-th-list',
        'fields' => array(

            array(
                'id' => 'show_left_bar',
                'type' => 'switch',
                'title' => esc_html__('Show Left Bar', 'balkon'),
                'desc' => esc_html__('Show left Blank bar on your site', 'balkon'),
                'default' => true
            ),
            array(
                'id' => 'show_fixed_title',
                'type' => 'switch',
                'title' => esc_html__('Show Left Title', 'balkon'),
                'desc' => esc_html__('Show title on the left of your page.', 'balkon'),
                'default' => true
            ),
            array(
                'id' => 'left_bar_width',
                'type' => 'text',
                'title' => esc_html__('Left Bar Width', 'balkon'),
                'desc' => esc_html__('Default: 80px. If you add more info to the footer section you must increase the value here.', 'balkon'),
                'default' => '80px',
            ),
            array(
                'id' => 'left_socials',
                'type' => 'ace_editor',
                'title' => esc_html__('Left Bar Icons', 'balkon'),
                'mode'=>'html',
                'full_width'=>true,
                'desc' => esc_html__('You should replace href attribute value with your social links, and get social icons from:', 'balkon').' <a href="http://fontawesome.io/icons/#brand" target="_blank">'.esc_html__(' Awesome Brand Icons','balkon' ).'</a>',
                'default' => '<ul>
    <li><a href="#" target="_blank" ><i class="fa fa-facebook"></i></a></li>
    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
    <li><a href="#" target="_blank" ><i class="fa fa-instagram"></i></a></li>
    <li><a href="#" target="_blank" ><i class="fa fa-pinterest"></i></a></li>
    <li><a href="#" target="_blank" ><i class="fa fa-tumblr"></i></a></li>
</ul>',
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Footer', 'balkon'),
        'id'         => 'footer-settings',
        'subsection' => false,
        
        'icon'       => 'el-icon-pencil',
        'fields' => array( 

            array(
                'id'=>'footer_widgets',
                'type' => 'multi_text',
                'title' => esc_html__('Register Default Footer widget areas', 'balkon'),
                'add_text'=> esc_html__('Add widget area','balkon' ),
                'default'=> array(
                                'Logo Footer widget | col-md-3',
                                'Contact Footer widget | col-md-4',
                                'Newsletter Footer widget | col-md-5',
                                
                            ),
                'desc' => wp_kses(__('<strong>WIDGET TITLE</strong> and <strong>COLUMN WIDTH CLASSES</strong> should be separated by <strong>|</strong> character. And <strong>WIDGET TITLE</strong> is unique. Ex: <strong>Logo Footer widget | col-md-3</strong>', 'balkon'),array('strong'=>array(),'p'=>array()) ),
            ),

            array(
                'id' => 'footer_copyright',
                'type' => 'ace_editor',
                'title' => esc_html__('Footer Copyright', 'balkon'),
                'mode'=>'html',
                'full_width'=>false,
                'default' => '<div class="col-md-3"></div>
<div class="col-md-9">
    <div class="fl-wrap policy-box">
        <p> &copy; Balkon 2017. All rights reserved.</p>
    </div>
</div>',
            ), 

            array(
                'id' => 'to_top_icon',
                'type' => 'text',
                'title' => esc_html__('ToTop Icon', 'balkon'),
                'default' => '<i class="fa fa-long-arrow-up"></i>',
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('MailChimp Subscribe', 'balkon'),
        'id'         => 'mailchimp-subscribe',
        'subsection' => false,
        
        'icon'       => 'fa fa-mail-forward',
        'fields' => array(
            array(
                'id' => 'mailchimp_api',
                'type' => 'text',
                'title' => esc_html__('Mailchimp API key', 'balkon'),
                'desc' => '<a href="'.esc_url('http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key').'" target="_blank">Find your API key</a>',
                'default' => '',
            ),
            array(
                'id' => 'mailchimp_list_id',
                'type' => 'text',
                'title' => esc_html__('Mailchimp List ID', 'balkon'),
                'desc' => '<a href="'.esc_url('http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id').'" target="_blank">Find your list ID</a>',
                'default' => '',
            ),

            array(
                'id'    => 'mailchimp_shortcode',
                'type'  => 'info',
                'title' => esc_html__('Subscribe Shortcode', 'balkon'),
                'style' => 'info',
                'icon'  => 'fa fa-info',
                'notice'=> true,
                'desc'  => wp_kses_post( __('Use the <code><strong>[balkon_mailchimp]</strong></code> shortcode  to display subscribe form inside a post, page or text widget.
<br>Available Variables:<br>
<strong>list_id</strong> - Optional. Use this option for multiple subscribe list or leave empty to use global option. <br>
<strong>title</strong>="Subscribe"<br>
<strong>subtitle</strong>="Get the lastest news and updates from Balkon"<br>
<strong>placeholder</strong>="email address"<br>
<strong>button</strong>="Submit"<br>
<strong>class</strong>="your_extra_class_to_style_the_form"', 'balkon') )
            ),

            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Media', 'balkon'),
        'id'         => 'thumbnail_images',
        'subsection' => false,
        'desc'       => wp_kses(__( '<p>These settings affect the display and dimensions of images in your pages.</p>
            <p><em> Enter 9999 as Width value and uncheck Hard Crop to make your thumbnail dynamic width.</em></p>
            <p><em> Enter 9999 as Height value and uncheck Hard Crop to make your thumbnail dynamic height.</em></p>
            <p><em> Enter 9999 as Width and Height values to use full size image.</em></p>
After changing these settings you may need to ', 'balkon' ), array('p'=>array(),'a'=>array('class'=>array(),'href'=>array(),'target'=>array(),),'strong'=>array(),'em'=>array(),) ) .'<a href="'.esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/' ).'" target="_blank">regenerate your thumbnails</a>',
        'icon'       => 'el-icon-picture',
        'fields' => array(
            array(
                'id' => 'enable_custom_sizes',
                'type' => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title' => esc_html__('Enable Custom Image Sizes', 'balkon'),
                'default' => false
            ), 

            array(
                'id'       => 'fullscreen_thumb',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Home Thumbnail Size', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 1840, Height - 864, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '9999', 
                    'height'  => '9999',
                    'hard_crop'  => 1
                ),
            ),

            


            
            array(
                'id'       => 'horizontal_slider_thumb',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Carousel Slider Thumbnail Size', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 1058, Height - 794, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '9999', 
                    'height'  => '9999',
                    'hard_crop'  => 1
                ),
            ),

            array(
                'id'       => 'folio_grid_thumbnail_size',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Portfolio Parallax', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 700, Height - 464, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '700', 
                    'height'  => '464',
                    'hard_crop'  => 1
                ),
            ),
            

            array(
                'id'       => 'galmasonry_thumbnail_size_one',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Portfolio Masonry Size One', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 460, Height - 305, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '460', 
                    'height'  => '305',
                    'hard_crop'  => 1
                ),
            ),
            array(
                'id'       => 'galmasonry_thumbnail_size_two',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Portfolio Masonry Size Two', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 920, Height - 610, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '920', 
                    'height'  => '610',
                    'hard_crop'  => 1
                ),
            ),

            array(
                'id'       => 'galmasonry_thumbnail_size_three',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Portfolio Masonry Size Three', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 1380, Height - 915, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '1380', 
                    'height'  => '915',
                    'hard_crop'  => 1
                ),
            ),

            array(
                'id'       => 'galgrid_thumbnail_size',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Gallery Thumbnail size', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 460, Height - 305, Hard crop - check', 'balkon'),
                'default'  => array(
                    'width'   => '460', 
                    'height'  => '305',
                    'hard_crop'  => 0
                ),
            ),

            

            
            array(
                'id'       => 'team_member_thumb',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Member Thumbnail Size', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 388, Height - 388, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '388', 
                    'height'  => '388',
                    'hard_crop'  => 1
                ),
            ),



            array(
                'id'       => 'blog_image_thumb',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Blog Thumbnail Size', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 800, Height - 530, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '800', 
                    'height'  => '530',
                    'hard_crop'  => 1
                ),
            ),

            array(
                'id'       => 'blog_image_large_thumb',
                'type'     => 'thumbnail_size',
                'title' => esc_html__('Blog Single Size', 'balkon'),
                'subtitle' => esc_html__('Demo: Width - 800, Height - 530, Hard crop - checked', 'balkon'),
                'default'  => array(
                    'width'   => '800', 
                    'height'  => '530',
                    'hard_crop'  => 1
                ),
            ),

            

            

        ),
    ) );

    
    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Colors', 'balkon'),
        'id'         => 'styling-settings',
        'subsection' => false,
        
        'icon'       => 'el-icon-magic',
        'fields' => array(
            array(
                'id'       => 'color-preset',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Theme Color', 'balkon' ),
                'options'  => array(
                    'default' => array(
                        'alt' => 'Default - Light',
                        'img' => get_template_directory_uri(). '/functions/assets/default.png'
                    ),
                    'dark' => array(
                        'alt' => 'Dark',
                        'img' => get_template_directory_uri(). '/functions/assets/skin1.png'
                    ),
                ),
                'default'  => 'default'
            ),

            array(
                'id' => 'override-preset',
                'type' => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title' => esc_html__('Use Custom Color', 'balkon'),
                'subtitle' => wp_kses(__('Set this option to <b>Yes</b> if you want to use color variants bellow.', 'balkon'), array('b'=>array(),'strong'=>array(),'p'=>array()) ),
                'default' => false
            ),
            array(         
                'id'       => 'main-bg-color',
                'type'     => 'color',
                'title'    => esc_html__('Theme Background Color', 'balkon'),
                'subtitle' => esc_html__('Default: #f4f4f4', 'balkon'),
                'default'  => '#f4f4f4',
                'transparent' => true
            ),

            array(         
                'id'       => 'theme-bg-color-2',
                'type'     => 'color',
                'title'    => esc_html__('Theme Background Color 2', 'balkon'),
                'subtitle' => esc_html__('Default: #ffffff', 'balkon'),
                'default'  => '#ffffff',
                'transparent' => true
            ),
            array(         
                'id'       => 'theme-bg-color-3',
                'type'     => 'color',
                'title'    => esc_html__('Theme Background Color 3', 'balkon'),
                'subtitle' => esc_html__('Default: #ffffff', 'balkon'),
                'default'  => '#ffffff',
                'transparent' => true
            ),

            array(
                'id' => 'theme-bd-color',
                'type' => 'color_rgba',
                'title' => esc_html__('Theme Border Color', 'balkon'),
                'subtitle' => esc_html__('Default: #eeeeee - 1', 'balkon'),
                'default'   => array(
                    'color'     => '#eeeeee',
                    'alpha'     => 1
                ),
            ),



            array(
                'id' => 'theme-color',
                'type' => 'color',
                'title' => esc_html__('Theme Color', 'balkon'),
                'transparent'      => false,
                'subtitle' => esc_html__('Default: #000000', 'balkon'),
                'default' => '#000000',
                'validate' => 'color',
            ),

            

            

            
            array(
                'id' => 'body-text-color',
                'type' => 'color',
                'title' => esc_html__('Body Text Color', 'balkon'),
                'subtitle' => esc_html__('Default: #000000', 'balkon'),
                'default' => '#000000',
                'validate' => 'color',
                'transparent' => false
            ),

            //https://docs.reduxframework.com/core/fields/link-color/
            array(
                'id'       => 'hyperlink-text-color',
                'type'     => 'link_color',
                'title'    => esc_html__('Hyperlink Text Color', 'balkon'),
                'default'  => array(
                    'regular'  => '#000000', 
                    'hover'    => '#000000', 
                    'active'   => '#000000',  
                      
                ),
                'visited' => false
            ),


            array(
                'id' => 'paragraph-color',
                'type' => 'color',
                'title' => esc_html__('Paragraph Color', 'balkon'),
                'subtitle' => esc_html__('Paragraph (default: #000000).', 'balkon'),
                'default' => '#000000',
                'validate' => 'color',
                'transparent' => false
            ),

            
            array(
                'id' => 'header-color',
                'type' => 'color_rgba',
                'title' => esc_html__('Header Bg Color', 'balkon'),
                'subtitle' => esc_html__('Header Background Color (default: #ffffff - 1).', 'balkon'),
                'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => 1
                ),
            ),
            
            array(
                'id' => 'submenu-bg-color',
                'type' => 'color_rgba',
                'title' => esc_html__('Submenu Background Color', 'balkon'),
                'subtitle' => esc_html__('Submenu Background Color (default: #000000 - 0.71).', 'balkon'),
                'default'   => array(
                    'color'     => '#000000',
                    'alpha'     => 0.71
                ),
            ),

            

            array(
                'id'       => 'main-nav-menu-color',
                'type'     => 'link_color',
                'title'    => esc_html__('Main Menu Color', 'balkon'),
                'default'  => array(
                    'regular'  => '#999999', 
                    'hover'    => '#000000', 
                    'active'   => '#000000',   
                ),
                'visited' => false
            ),

            array(
                'id'       => 'submenu-color',
                'type'     => 'link_color',
                'title'    => esc_html__('SubMenu Color', 'balkon'),
                'default'  => array(
                    'regular'  => '#ffffff', 
                    'hover'    => '#f5f5f5', 
                    'active'   => '#f5f5f5',   
                ),
                'visited' => false
            ),

            array(         
                'id'       => 'left-sidebar-bg-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Left Sidebar Background', 'balkon'),
                'subtitle' => esc_html__('Default: #ffffff - 1', 'balkon'),
                'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => 1
                ),
            ),



            array(
                'id' => 'footer-bg-color',
                'type' => 'color_rgba',
                'title' => esc_html__('Footer Background Color', 'balkon'),
                'subtitle' => esc_html__('Footer Background Color (default: #ffffff - 1).', 'balkon'),
                'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => 1
                ),
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Fonts', 'balkon'),
        'id'         => 'font-settings',
        'subsection' => false,
        'icon'       => 'el-icon-font',
        'fields' => array(
            
            array(
                'id' => 'body-font',
                'type' => 'typography',
                'output' => array('body'),
                'title' => esc_html__('Body Font', 'balkon'),
                'subtitle' => wp_kses(__('<p>Specify the body font properties.</br> Default </br>font-family: Questrial </br>font-size: 12px </br>font-weight: 400</p>', 'balkon'), array( 'br'=>array(),'p'=>array(), ) ),
                'google' => true,
                'subsets'=> true,
                'color'=> false,

                'font-size' => false,
                'font-weight'=>true,
                'font-style'=>false,
                'line-height'=>true,
                'text-align'=>true,
            ),
            array(
                'id' => 'hyperlink-font',
                'type' => 'typography',
                'output' => array('a'),
                'title' => esc_html__('Hyperlink Font', 'balkon'),
                'subtitle' => wp_kses(__('<p>Hyperlink font properties.</br> Default </br>font-family: Questrial </br>font-size: 12px </br>font-weight: 400</p>', 'balkon'), array( 'br'=>array(),'p'=>array(), ) ),
                'google' => true,
                'subsets'=> true,
                'color'=> false,

                'font-size' => true,
                'font-weight'=>true,
                'font-style'=>false,
                'line-height'=>true,
                'text-align'=>true,
                
            ),
            array(
                'id' => 'hyperlink-hover-font',
                'type' => 'typography',
                'output' => array('a:hover'),
                'title' => esc_html__('Hyperlink Hover Font', 'balkon'),
                'subtitle' => wp_kses(__('<p>Hyperlink hover font properties.</br> Default </br>font-family: Questrial </br>font-size: 12px </br>font-weight: 700</p>', 'balkon'),array( 'br'=>array(),'p'=>array(), ) ),
                'google' => true,
                'subsets'=> true,
                'color'=> false,

                'font-size' => true,
                'font-weight'=>true,
                'font-style'=>false,
                'line-height'=>true,
                'text-align'=>true,
               
            ),
            array(
                'id' => 'paragraph-font',
                'type' => 'typography',
                'output' => array('p'),
                'title' => esc_html__('Paragraph Font', 'balkon'),
                'subtitle' => wp_kses(__('<p>Specify paragraph font properties. Default </br>font-family: Questrial </br>font-size: 13px </br>line-height: 24px</br>font-weight: 400</p>', 'balkon'), array( 'br'=>array(),'p'=>array(), ) ),
                'google' => true,
                'subsets'=> true,
                'color'=> false,

                'font-size' => true,
                'font-weight'=>true,
                'font-style'=>false,
                'line-height'=>true,
                'text-align'=>true,
            ),

            array(
                'id' => 'header-font',
                'type' => 'typography',
                'output' => array('h1, h2, h3, h4, h5, h6'),
                'title' => esc_html__('Title-Header Font', 'balkon'),
                'subtitle' => wp_kses(__('<p>Specify the title and heading font properties.</br> Default </br>font-family: Questrial</p>', 'balkon'), array( 'br'=>array(),'p'=>array(), ) ),
                'google' => true,
                'subsets'=> true,
                'color'=> false,

                'font-size' => true,
                'font-weight'=>true,
                'font-style'=>false,
                'line-height'=>true,
                'text-align'=>true,
            ),
            array(
                'id' => 'balkon-second-font',
                'type' => 'typography',
                'output' => array('.bold-title,.nav-holder nav li a,.header-info ul li,.sb-menu-footer,.fixed-search form input,.dublicated-text,.policy-box  p,.footer-header  span,.subcribe-form  .subscribe-title,.balkon_mailchimp-form button,.balkon_mailchimp-form button,.hero-item h3,.head-sec-title,
.section-title h2,.sroll-nav-wrap .scroll-nav li a span,.creat-list li span ,.num,.inline-fact h6 ,
.inline-facts h6 ,.team-info h3,.resume-item .resume-title,
.custom-inner h4,.resume-item ul li,
.custom-inner ul li ,.serv-item .bold-title,.serv-price-wrap  span ,.serv-wrap ul  li a,.skills-description,.order-item h3,.grid-item h3,.bold-filter .filter-button,
.round-counter div,.fixed-filter-wrap h3 ,.pr-title,.pr-subtitle,.pr-subtitle span.let-num,.content-nav li span,
.content-nav li a,.pagination-blog span,
.pagination-blog a,.cur-page,.fs-gallery-wrap .swiper-pagination-bullet,.show-info span,.tooltip-info h5,.pr-tags span,.parallax-text h3,.parallax-header span,.promo-video-text,.small-sec-title h3,.contact-details h4  span,.wpcf7-submit,
#submit , .form-submit button,.error_message,#success_page h3,.testilider .swiper-pagination,.testi-item h3,.widget-title  span,.search-submit,.notfound-title,.error-wrap .error-text,
.error-wrap h2,.landing-wrapper .logo-text h2,.landing-wrapper .demo-links-wrap a,.landing-wrapper .demo-list h3,.landing-wrapper .demo-links-header'),
                'title' => esc_html__('Balkon Bolder Font', 'balkon'),
                'subtitle' => wp_kses(__('<p>This is bolder font used in the theme. Default </br>font-family: Montserrat</p>', 'balkon'), array( 'br'=>array(),'p'=>array(), ) ),
                'google' => true,
                'subsets'=> true,
                'font-weight'=> false,
                'font-size'=> false,
                'line-height'=> false,
                'color'=> false,
                'text-align'=> false,

            ),
            array(
                'id' => 'balkon-third-font',
                'type' => 'typography',
                'output' => array('blockquote p,.comment-meta, .comment-meta a,.cat-list li'),
                'title' => esc_html__('Balkon Theme Italic Font', 'balkon'),
                'subtitle' => wp_kses(__('<p>Theme italic font. Default </br>font-family: Georgia </br>font-style: italic</p>', 'balkon'), array( 'br'=>array(),'p'=>array(), ) ),
                'google' => true,
                'subsets'=> true,
                'color'=> false,
            ),
            
            
        ),
    ) );

    
    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Portfolio', 'balkon'),
        'desc' => esc_html__('Config Header, Footer and Layout for portfolio archive page. Effected pages are: ', 'balkon').'<br>'.esc_html__('Portfolio List page: ', 'balkon').'<a href="'.esc_url(home_url('/?post_type=portfolio' )).'" target="_blank">'.esc_url(home_url('/?post_type=portfolio' )).'</a><br>'.esc_html__('Portfolio List page: ', 'balkon').'<a href="'.esc_url(home_url('/portfolio/' )).'" target="_blank">'.esc_url(home_url('/portfolio/' )).'</a><br>'.esc_html__('Portfolio Category page: ', 'balkon').'<a href="'.esc_url(home_url('/portfolio_cat/nature/' )).'" target="_blank">'.esc_url(home_url('/portfolio_cat/nature/' )).'</a>',
        'id'         => 'portfolio-settings',
        'subsection' => false,
        'icon'       => 'el-icon-briefcase',
        'fields' => array(

            

            array(
                'id'       => 'show_folio_header',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Portfolio Header', 'balkon' ),
                'default'  => true,
            ),
            array(
                    'id' => 'folio_head_title',
                    'type' => 'text',
                    'title' => esc_html__('Header Title', 'balkon'),
                    'default' => 'Our Portfolios'
            ),
            array(
                    'id' => 'folio_head_subtitle',
                    'type' => 'text',
                    'title' => esc_html__('Header SubTitle', 'balkon'),
                    'default' => 'Our Works'
            ),
            array(
                    'id' => 'folio_head_desc',
                    'type' => 'textarea',
                    'title' => esc_html__('Header Intro Text', 'balkon'),
                    'default' => '<p>Curabitur bibendum mi sed rhoncus aliquet. Nulla blandit porttitor justo, at posuere sem accumsan nec.</p>'
                ),
            
            array(
                'id' => 'folio_header_image',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Portfolio Header Image', 'balkon'),
                'default' => array('url' => get_template_directory_uri().'/images/bg/2.jpg'),

            ),

            array(
                'id' => 'folio_layout',
                'type' => 'select',
                'title' => esc_html__('Portfolio Layout', 'balkon'),

                'options' => array(
                                'masonry' => esc_html__('Masonry','balkon'),
                                'masonry_sidebar' => esc_html__('Masonry Sidebar Filter','balkon'),
                                'parallax' => esc_html__('Parallax','balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => 'masonry'
            ),
            

            array(
                'id' => 'folio_style',
                'type' => 'select',
                'title' => esc_html__('Layout Style', 'balkon'),

                'options' => array(
                                'style1' => esc_html__('Style 1','balkon'),
                                'style2' => esc_html__('Style 2','balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => 'style1'
            ),

            array(
                'id' => 'folio_grid_content_width',
                'type' => 'select',
                'title' => esc_html__('Content Width', 'balkon'),
                'options' => array(
                                'boxed-container' => esc_html__( 'Fixed', 'balkon' ), 
                                'wide-container' => esc_html__( 'Wide', 'balkon' ),
                                'full-container' => esc_html__( 'Fullwidth', 'balkon' ), 
                            ), //Must provide key => value pairs for select options
                'default' => 'boxed-container',
                
            ),

            array(
                'id' => 'folio_column',
                'type' => 'select',
                'title' => esc_html__('Portfolio Columns', 'balkon'),
                'desc' => esc_html__('Vertical columns for Horizontal layout', 'balkon'),
                'options' => array('five' => 'Five Columns','four' => 'Four Columns', 'three' => 'Three Columns','two' => 'Two Columns', 'one' => 'One Column'), //Must provide key => value pairs for select options
                'default' => 'three'
            ),
            
            array(
                'id'       => 'folio_posts_per_page',
                'type'     => 'text',
                'title'    => esc_html__( 'Posts per page', 'balkon' ),
                'subtitle' => esc_html__( 'Number of post to show per page, -1 to show all posts.', 'balkon' ),
                'desc' => esc_html__( 'To use Loadmore or Infinit scroll to load features you have set this value less than total portfolio items number.', 'balkon' ),
                'default'  => 12,
            ),
            
            array(
                'id' => 'folio_archive_orderby',
                'type' => 'select',
                'title' => esc_html__('Order Portfolio By', 'balkon'),
                'options' => array(
                                'none' => esc_html__( 'None', 'balkon' ), 
                                'ID' => esc_html__( 'Post ID', 'balkon' ), 
                                'author' => esc_html__( 'Post Author', 'balkon' ),
                                'title' => esc_html__( 'Post title', 'balkon' ), 
                                'name' => esc_html__( 'Post name (post slug)', 'balkon' ),
                                'date' => esc_html__( 'Created Date', 'balkon' ),
                                'modified' => esc_html__( 'Last modified date', 'balkon' ),
                                'parent' => esc_html__( 'Post Parent id', 'balkon' ),
                                'rand' => esc_html__( 'Random', 'balkon' ),
                            ), //Must provide key => value pairs for select options
                'default' => 'date'
            ),
            array(
                'id' => 'folio_archive_order',
                'type' => 'select',
                'title' => esc_html__('Order Portfolio', 'balkon'),
                'options' => array(
                                'DESC' => esc_html__( 'Descending', 'balkon' ),
                                'ASC' => esc_html__( 'Ascending', 'balkon' ), 
                                
                            ), //Must provide key => value pairs for select options
                'default' => 'DESC'
            ),
            
            array(
                'id' => 'folio_pad',
                'type' => 'select',
                'title' => esc_html__('Spacing', 'balkon'),
                'subtitle' => esc_html__('The space between portfolio grid items.', 'balkon'),
                'desc' => '',
                'options' => array(
                                'extrasmall' => esc_html__('Extra Small','balkon'), 
                                'small' => esc_html__('Small','balkon'), 
                                'medium' =>  esc_html__('Medium','balkon'),
                                'big' =>  esc_html__('Big','balkon'),
                                'no' =>  esc_html__('None','balkon'),
                            ), //Must provide key => value pairs for select options
                'default' => 'no'
            ),
            
            array(
                'id'       => 'folio_show_excerpt',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Post Excerpt', 'balkon' ),
                'default'  => false,
            ),

            array(
                'id'       => 'folio_show_cat_grid',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Categories', 'balkon' ),
                'default'  => true,
            ),


            array(
                'id'       => 'folio_show_readmore',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Read More', 'balkon' ),
                'default'  => true,
            ),

            array(
                'id'       => 'folio_enable_gallery',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Enable Gallery', 'balkon' ),
                'default'  => true,
            ),

            array(
                'id' => 'folio_after_grid_content',
                'type' => 'ace_editor',
                'title' => esc_html__('After Grid Content', 'balkon'),
                'mode'=>'html',
                'full_width'=>false,
                'default' => '<div class="order-item fl-wrap margin-content">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h3>Ready to order your project ? </h3>
        </div>
        <div class="col-md-4"><a href="'.esc_url(home_url('/contact/' ) ).'" class="btn float-btn flat-btn">Get in Touch</a></div>
    </div>
</div>',
            ), 

            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Parallax Layout', 'balkon'),
        'id'         => 'folio-parallax-settings',
        'subsection' => true,
        'fields' => array(

            array(
                'id' => 'folio_parallax_first',
                'type' => 'select',
                'title' => esc_html__('First Content Side for Parallax layout', 'balkon'),
                'options' => array(
                    'left'     => esc_html__( 'Left', 'balkon' ),
                    'right'     => esc_html__( 'Right', 'balkon' ),
                    'center'     => esc_html__( 'Center', 'balkon' ),
                ), 
                'default' => 'right'
            ),

            array(
                "id"    => "folio_parallax_colwidth",
                "type"          => "text",
                "title"       => esc_html__("Columns Width", 'balkon'),
                "desc"   => esc_html__("Number of columns for portfolio item width. Based on Bootstrap 12 columns. Ex: 7", 'balkon'),
                'default'         => '7'
            ),


            array(
                'id'        => 'folio_parallax_value',
                'type'      => 'text',
                'title'     => esc_html__( 'Parallax Dimension', 'balkon' ),
                'desc'      => esc_html__("Parallax CSS style values, separated by comma. Ex: translateY: '-250px' ", 'balkon').'<a href="'.esc_url('https://github.com/iprodev/Scrollax.js/blob/master/docs/Markup.md' ).'" target="_blank">'.esc_html__('Scrollax Documentation','balkon' ).'</a>',
                'default'   => "translateY: '-250px'",
            ),
            array(
                'id'       => 'folio_parallax_number',
                'type'     => 'switch',
                'on'     => esc_html__( 'Yes', 'balkon' ),
                'off'     => esc_html__( 'No', 'balkon' ),
                'title'    => esc_html__( 'Show Number', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id'       => 'folio_parallax_date',
                'type'     => 'switch',
                'on'     => esc_html__( 'Yes', 'balkon' ),
                'off'     => esc_html__( 'No', 'balkon' ),
                'title'    => esc_html__( 'Show Date', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id'       => 'folio_parallax_cats',
                'type'     => 'switch',
                'on'     => esc_html__( 'Yes', 'balkon' ),
                'off'     => esc_html__( 'No', 'balkon' ),
                'title'    => esc_html__( 'Show Categories', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id'       => 'folio_parallax_excerpt',
                'type'     => 'switch',
                'on'     => esc_html__( 'Yes', 'balkon' ),
                'off'     => esc_html__( 'No', 'balkon' ),
                'title'    => esc_html__( 'Show Excerpt', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id'       => 'folio_parallax_tosingle',
                'type'     => 'switch',
                'on'     => esc_html__( 'Yes', 'balkon' ),
                'off'     => esc_html__( 'No', 'balkon' ),
                'title'    => esc_html__( 'Show View Project', 'balkon' ),
                'default'  => true,
            ),



        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Filter / Counter Options', 'balkon'),
        'id'         => 'folio-filter-optons',
        'subsection' => true,
        'fields' => array(

            
            array(
                'id'       => 'folio_show_filter',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Filter', 'balkon' ),
                'default'  => true,
            ),

            array(
                'id' => 'folio_grid_filter_width',
                'type' => 'select',
                'title' => esc_html__('Filter Width', 'balkon'),
                'options' => array(
                                'nor-container' => esc_html__( 'Normal', 'balkon' ), 
                                'big-container' => esc_html__( 'Wide', 'balkon' ),
                                'full-container' => esc_html__( 'Fullwidth', 'balkon' ), 
                            ), //Must provide key => value pairs for select options
                'default' => 'big-container',
                'subtitle' => esc_html__( 'Use for Masonry and Grid layouts.', 'balkon' ),
            ),

            array(
                'id' => 'folio_filter_orderby',
                'type' => 'select',
                'title' => esc_html__('Order Filter By', 'balkon'),
                'options' => array(
                                'id' => esc_html__( 'ID', 'balkon' ), 
                                'count' => esc_html__( 'Count', 'balkon' ),
                                'name' => esc_html__( 'Name', 'balkon' ), 
                                'slug' => esc_html__( 'Slug', 'balkon' ),
                                'none' => esc_html__( 'None', 'balkon' )
                            ), //Must provide key => value pairs for select options
                'default' => 'name'
            ),
            array(
                'id' => 'folio_filter_order',
                'type' => 'select',
                'title' => esc_html__('Order Filter', 'balkon'),
                'options' => array(
                                'ASC' => esc_html__( 'Ascending', 'balkon' ), 
                                'DESC' => esc_html__( 'Descending', 'balkon' ),
                            ), //Must provide key => value pairs for select options
                'default' => 'ASC'
            ),

            array(
                'id'       => 'folio_show_counter',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Counter', 'balkon' ),
                'default'  => true,
            ),

            array(
                'id'       => 'folio_filter_all',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show All in filter', 'balkon' ),
                'default'  => true,
            ),

        ),
    ));

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Pagination / Loadmore Options', 'balkon'),
        'id'         => 'folio-pagination-lmore-optons',
        'subsection' => true,
        'fields' => array(

            
            
            

            array(
                'id'       => 'folio_use_pagi_infinite',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Use Infinite scroll?', 'balkon' ),
                'subtitle' => esc_html__( 'Items will be added automatically when scroll down to the page bottom. For Grid and Masonry layouts.', 'balkon' ),
                'default'  => true,
            ),

            array(
                'id'       => 'folio_loadmore_items',
                'type'     => 'text',
                'title'    => esc_html__( 'Load more items', 'balkon' ),
                'subtitle' => esc_html__( 'Number of posts to get on each additional load (Load more and infinite scroll).', 'balkon' ),
                'default'  => 3,
            ),

            array(
                'id'       => 'folio_show_pagination',
                'type'     => 'switch',
                'on'=> esc_html__('Yes','balkon'),
                'off'=> esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Pagination - For Grid and Masonry layouts', 'balkon' ),
                'default'  => false,
            ),

              
        ),
    ));


    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Blog', 'balkon'),
        'id'         => 'blog-settings',
        'subsection' => false,
        
        'icon'       => 'fa fa-newspaper-o',
        'fields' => array(
            
            array(
                'id'       => 'show_blog_header',
                'type'     => 'switch',
                'on'=> esc_html__('Yes', 'balkon'),
                'off'=> esc_html__('No', 'balkon'),
                'title'    => esc_html__( 'Show Header', 'balkon' ),
                'default'  => false,
            ),

            array(
                    'id' => 'blog_head_title',
                    'type' => 'text',
                    'title' => esc_html__('Header Title', 'balkon'),
                    'default' => 'Our Journal'
                ),

            array(
                    'id' => 'blog_head_title_sub',
                    'type' => 'text',
                    'title' => esc_html__('Header Subtitle', 'balkon'),
                    'default' => 'Our Blog'
                ),
            array(
                    'id' => 'blog_head_title_desc',
                    'type' => 'textarea',
                    'title' => esc_html__('Blog Intro Text', 'balkon'),
                    'default' => '<p>Curabitur bibendum mi sed rhoncus aliquet. Nulla blandit porttitor justo, at posuere sem accumsan nec.</p>'
                ),

            
            array(
                'id' => 'blog_header_image',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Blog Header Image', 'balkon'),
                'default' => array('url' => get_template_directory_uri().'/images/bg/23.jpg'),
            ),

            array(
                'id' => 'blog-grid-width',
                'type' => 'select',
                'title' => esc_html__('Blog Width', 'balkon'),
                'options' => array(
                                'blog-normal' => esc_html__('Boxed', 'balkon'),
                                'blog-wide' => esc_html__('Wide', 'balkon'),
                                'blog-fullwidth' => esc_html__('Fullwidth', 'balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => 'blog-wide'
            ),
            
            array(
                    'id'       => 'blog_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Blog Sidebar Layout', 'balkon' ),
                    'subtitle' => esc_html__( 'Select main content and sidebar layout. The option 4 is default layout with right parallax image for Balkon theme.', 'balkon' ),
                    'options'  => array(
                        'fullwidth' => array(
                            'alt' => 'Fullwidth',
                            'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                        ),
                        'left_sidebar' => array(
                            'alt' => 'Left Sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                        ),
                        'right_sidebar' => array(
                            'alt' => 'Right Sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        ),
                        
                    ),
                    'default'  => 'right_sidebar'
                ),

            array(
                'id' => 'blog-sidebar-width',
                'type' => 'select',
                'title' => esc_html__('Blog Sidebar Width', 'balkon'),
                'subtitle' => esc_html__( 'Based on Bootstrap 12 columns.', 'balkon' ),
                'options' => array(
                                '2' => esc_html__('2 Columns', 'balkon'),
                                '3' => esc_html__('3 Columns', 'balkon'),
                                '4' => esc_html__('4 Columns', 'balkon'),
                                '5' => esc_html__('5 Columns', 'balkon'),
                                '6' => esc_html__('6 Columns', 'balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => '4'
            ),

            

            array(
                'id' => 'blog-grid-style',
                'type' => 'select',
                'title' => esc_html__('Blog Style', 'balkon'),
                'options' => array(
                                'masonry' => esc_html__('Masonry', 'balkon'),
                                'list' => esc_html__('List', 'balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => 'list'
            ),

            array(
                'id' => 'blog-grid-columns',
                'type' => 'select',
                'title' => esc_html__('Blog Columns', 'balkon'),
                'subtitle' => esc_html__('For Blog Masonry style only.', 'balkon'),
                'options' => array(
                                'one' => esc_html__('One Column', 'balkon'),
                                'two' => esc_html__('Two Columns', 'balkon'),
                                'three' => esc_html__('Three Columns', 'balkon'),
                                'four' => esc_html__('Four Columns', 'balkon'),
                                'five' => esc_html__('Five Columns', 'balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => 'two'
            ),

            array(
                'id'       => 'blog_list_show_format',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Post Format on blog grid', 'balkon' ),
                'default'  => false,
            ),

            array(
                'id'       => 'blog_author',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Author', 'balkon' ),
                'default'  => true,
            ),
            
            array(
                'id'       => 'blog_date',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Date', 'balkon' ),
                'default'  => true,
            ),
            
            array(
                'id'       => 'blog_cats',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Categories', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_tags',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Tags', 'balkon' ),
                'default'  => true,
            ),
            
            array(
                'id'       => 'blog_comments',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Comments', 'balkon' ),
                'default'  => true,
            ),

            array(
                'id'        => 'blog_show_views',
                'type'      => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'     => esc_html__( 'Show post Views', 'balkon' ),
                'default'  => true,
            ),

        ),
    ) );


    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Blog Single', 'balkon'),
        'id'         => 'blog-single-optons',
        'subsection' => true,
        'fields' => array(

            array(
                'id' => 'blog-single-width',
                'type' => 'select',
                'title' => esc_html__('Blog Single Width', 'balkon'),
                'options' => array(
                                'blog-normal' => esc_html__('Boxed', 'balkon'),
                                'blog-wide' => esc_html__('Wide', 'balkon'),
                                'blog-fullwidth' => esc_html__('Fullwidth', 'balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => 'blog-wide'
            ),
            
            array(
                'id' => 'blog-single-sidebar-width',
                'type' => 'select',
                'title' => esc_html__('Single Sidebar Width', 'balkon'),
                'subtitle' => esc_html__( 'Based on Bootstrap 12 columns.', 'balkon' ),
                'options' => array(
                                '2' => esc_html__('2 Columns', 'balkon'),
                                '3' => esc_html__('3 Columns', 'balkon'),
                                '4' => esc_html__('4 Columns', 'balkon'),
                                '5' => esc_html__('5 Columns', 'balkon'),
                                '6' => esc_html__('6 Columns', 'balkon'),
                 ), //Must provide key => value pairs for select options
                'default' => '4'
            ),

            array(
                'id'       => 'blog_single_title',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Title', 'balkon' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_featured_single',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Featured image', 'balkon' ),
                'default'  => true,
            ),
            
            array(
                'id'       => 'blog_date_single',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Date', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_cats_single',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Categories', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_tags_single',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Tags', 'balkon' ),
                'default'  => true,
            ),

            array(
                'id'       => 'blog_author_single',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show Author Block', 'balkon' ),
                'default'  => true,
            ),
            
            array(
                'id'       => 'blog_single_navigation',
                'type'     => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'    => esc_html__( 'Show posts navigation', 'balkon' ),
                'default'  => true,
            ),
            array(
                'id'        => 'blog_single_nav_same_term',
                'type'      => 'switch',
                'on'        => esc_html__('Yes','balkon'),
                'off'       => esc_html__('No','balkon'),
                'title'     => esc_html__( 'Next/Prev posts should be in same category', 'balkon' ),
                'default'  => false,
            ),
            array(
                'id' => 'blog_list_link',
                'type' => 'text',
                'title' => esc_html__('Blog List Link', 'balkon'),
                'desc' => esc_html__('Link for blog list icon on single blog post page.', 'balkon'),
                'default' => esc_url( home_url('/?post_type=post' ) )
            ),


              
        ),
    ));


    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Protected Post Page Options', 'balkon'),
        'id'         => 'protected_post_page_options',
        'subsection' => false,
        'icon'       => 'fa fa-lock',
        'fields' => array(
            array(
                'id' => 'password_page_intro',
                'type' => 'textarea',
                'title' => esc_html__('Additional Message', 'balkon'),
                'default' => ''
            ),
            
            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('404 Page', 'balkon'),
        'id'         => '404-intro-text-settings',
        'subsection' => false,
        'icon'       => 'fa fa-info-circle',
        'fields' => array(
            
           
            array(
                'id' => '404_intro',
                'type' => 'textarea',
                'title' => esc_html__('404 Page Message', 'balkon'),
                
                'default' => '<p> The Page you were looking for, couldn\'t be found.</p>'
            ),
            array(
                'id' => 'back_home_link',
                'type' => 'text',
                'title' => esc_html__('Back Home Link', 'balkon'),
                'default' => esc_url( home_url('/' ) )
            ),
            
            
        ),
    ) );

    

    /*
     * <--- END SECTIONS
     */

    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    // add_action( 'redux/loaded', 'remove_demo' );


    add_filter( "redux/" . $opt_name . "/field/class/thumbnail_size", "overload_thumbnail_size_field_path" ); // Adds the local field

    function overload_thumbnail_size_field_path($field) {

        return get_template_directory().'/includes/redux_add_fields/field_thumbnail_size.php';
    }

    function newPanelIconFont() {
        // Uncomment this to remove elusive icon from the panel completely
     
        wp_register_style(
            'redux-font-awesome',
            get_template_directory_uri().'/css/font-awesome-redux-panel.min.css',
            array(),
            time(),
            'all'
        );  
        wp_enqueue_style( 'redux-font-awesome' );
    }
    // This example assumes the opt_name is set to redux_demo.  Please replace it with your opt_name value.
    add_action( "redux/page/" . $opt_name . "/enqueue", 'newPanelIconFont' );


    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'balkon' ),
                'desc'   => wp_kses(__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'balkon' ),array('p'=>array('class'=>array())) ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

   
