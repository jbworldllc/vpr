<?php
/* banner-php */
if ( file_exists(get_template_directory() . '/functions/admin-config.php')) {
    require_once get_template_directory() . '/functions/admin-config.php';
}


if(!isset($balkon_options)) $balkon_options = get_option( 'balkon_options', array() );  

require get_parent_theme_file_path( '/includes/core-functions.php' );
require get_parent_theme_file_path( '/includes/template-tags.php' );


if (!function_exists('balkon_setup_theme')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Balkon 1.0
     */

    function balkon_setup_theme() {
        load_theme_textdomain('balkon', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        balkon_get_thumbnail_sizes();

        // Set the default content width.
        $GLOBALS['content_width'] = 800;

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu('primary', esc_html__('Primary Menu', 'balkon'));
        register_nav_menu('onepage', esc_html__('One-Page Menu', 'balkon'));
        
        if (!empty(balkon_get_option('dynamic_menus'))) {
            foreach (balkon_get_option('dynamic_menus') as $key => $location) {
                register_nav_menu(sanitize_title_with_dashes($location), $location);
            }
        }

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        ) );

        // Add theme support for Custom Logo.
        add_theme_support( 'custom-logo', array(
            'width'       => 143,
            'height'      => 40,
            'flex-width'  => true,
            'flex-height' => true,
            'header-text' => array( 'site-title', 'site-description' ),

        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
        
        add_filter('use_default_gallery_style', '__return_false');

        add_editor_style(get_template_directory_uri().'/inc/assets/custom-editor-style.css');

      
    }
}
add_action('after_setup_theme', 'balkon_setup_theme');

function balkon_get_thumbnail_sizes(){
    // options default must have these values
    if(!balkon_get_option('enable_custom_sizes')) return;
    $option_sizes = array(
        'balkon_fuls_thumb'=>'fullscreen_thumb',
        'balkon_hoz_thumb'=>'horizontal_slider_thumb',
        'balkon_folio_thumb'=>'folio_grid_thumbnail_size',
        'balkon_masonry_one'=>'galmasonry_thumbnail_size_one',
        'balkon_masonry_second'=>'galmasonry_thumbnail_size_two',
        'balkon_masonry_three'=>'galmasonry_thumbnail_size_three',
        'balkon_gallery_thumb'=>'galgrid_thumbnail_size',
        'balkon_blog_thumb'=>'blog_image_thumb',
        'balkon_single_thumb'=>'blog_image_large_thumb',
        'balkon_member_thumb'=>'team_member_thumb',
    );

    foreach ($option_sizes as $name => $opt) {
        $option_size = balkon_get_option($opt);
        if($option_size !== false && is_array($option_size)){
            $size_val = array(
                'width' => (isset($option_size['width']) && !empty($option_size['width']) )? (int)$option_size['width'] : (int)'9999',
                'height' => (isset($option_size['height']) && !empty($option_size['height']) )? (int)$option_size['height'] : (int)'9999',
                'hard_crop' => (isset($option_size['hard_crop']) && !empty($option_size['hard_crop']) )? (bool)$option_size['hard_crop'] : (bool)'0',
            );

            add_image_size( $name, $size_val['width'], $size_val['height'], $size_val['hard_crop'] );
        }
    }
}

/**
 * Register widget area.
 *
 * @since Balkon 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function balkon_register_sidebars() {
    
    register_sidebar(
        array(
            'name' => esc_html__('Main Sidebar', 'balkon'), 
            'id' => 'sidebar-1', 
            'description' => esc_html__('Appears in the sidebar section of the site.', 'balkon'), 
            'before_widget' => '<div id="%1$s" class="widget-wrap fl-wrap balkon-mainsidebar-widget main-sidebar-widget %2$s">', 
            'before_title' => '<h4 class="widget-title"><span class="wid-tit">', 
            'after_title' => '</span></h4>',
            'after_widget' => '</div>',
        )
    );
    
    register_sidebar(
        array(
            'name' => esc_html__('Page Sidebar', 'balkon'), 
            'id' => 'sidebar-2', 
            'description' => esc_html__('Appears in the sidebar section of the page template.', 'balkon'), 
            'before_widget' => '<div id="%1$s" class="widget-wrap fl-wrap balkon-pagesidebar-widget page-sidebar-widget %2$s">', 
            'before_title' => '<h4 class="widget-title"><span class="wid-tit">', 
            'after_title' => '</span></h4>',
            'after_widget' => '</div>',
        )
    );

    if (balkon_global_var('footer_widgets')) {
        foreach (balkon_global_var('footer_widgets') as $key => $widget) {
            if($widget != ''){
                $widget = explode("|", $widget);
                register_sidebar(
                    array(
                        'name' => $widget[0], 
                        'id' => sanitize_title_with_dashes($widget[0]), 
                        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<div class="footer-header fl-wrap"><span class="wid-tit">', 
                        'after_title' => '</span></div>',
                    )
                );
            }
        }
    }
    
}

add_action('widgets_init', 'balkon_register_sidebars');

function balkon_style_widget_title($title){
    return preg_replace('/-span-(.*)-span-/', '<span>$1</span>', $title);
}
add_filter( 'widget_title', 'balkon_style_widget_title' );


if ( ! function_exists( 'balkon_google_fonts_url' ) ) {
    /**
     * Register Google fonts.
     *
     * @return string Google fonts URL for the theme.
     */
    function balkon_google_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'devanagari,latin-ext,vietnamese';

        
        if ( 'off' !== esc_html_x( 'on', 'Montserrat font: on or off', 'balkon' ) ) {
            $fonts[] = 'Montserrat:400,400i,500,500i,600,700,800,900';
        }

        
        if ( 'off' !== esc_html_x( 'on', 'Poppins font: on or off', 'balkon' ) ) {
            $fonts[] = 'Poppins:400,600,700';
        }

        if ( 'off' !== esc_html_x( 'on', 'Questrial font: on or off', 'balkon' ) ) {
            $fonts[] = 'Questrial';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;

    }

}


/**
 * Enqueue scripts and styles.
 *
 * @since Balkon 1.0
 */

if (!function_exists('balkon_scripts_styles')) {
    function balkon_scripts_styles() {
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        wp_enqueue_script("balkon-plugins", get_template_directory_uri() . "/js/plugins.js", array('jquery'), '1.4.0', true);



        wp_enqueue_script("balkon_scripts", get_stylesheet_directory_uri() . "/js/scripts.js", array('balkon-plugins','imagesloaded'), null, true);
        
        $balkon_datas = array();
        if( null !== balkon_get_option('ajax_active_menus') ){
            $balkon_datas['ac_mns'] = balkon_get_option('ajax_active_menus');
        }else{
            $balkon_datas['ac_mns'] = array();
        }

        $balkon_datas['parallax_off'] = balkon_get_option('disable_parallax_effect');
        
        wp_localize_script( 'balkon_scripts', '_balkon', $balkon_datas );

        if( null !== balkon_get_option('gmap_api_key') && balkon_get_option('gmap_api_key') != ''){
            wp_enqueue_script("google-maps", "https://maps.google.com/maps/api/js?key=".balkon_get_option('gmap_api_key'),array(),null,true);
            wp_enqueue_script("balkon_gmap", get_template_directory_uri() . "/js/map.js", array(), null, true);
        }


        
        wp_enqueue_style('google-fonts', balkon_google_fonts_url(), array(), null);

        
        wp_enqueue_style('balkon-plugins', get_template_directory_uri() . '/css/plugins.css', array(), null); 

        wp_enqueue_style('balkon-style', get_stylesheet_uri(), array(), null);

        if (!balkon_global_var('override-preset') && balkon_global_var('color-preset') == 'dark' || get_query_var('dark_skin','no' ) == 'yes') {
            
            wp_enqueue_style('balkon-dark', get_stylesheet_directory_uri() . '/skins/color_dark.css', array(), null);
        }

        wp_enqueue_style('balkon-custom', get_stylesheet_directory_uri() . '/css/custom.css', array(), null);
        
        if (balkon_get_option('override-preset')) {
            $inline_style = balkon_overridestyle();
            if (!empty($inline_style)) {
                wp_add_inline_style('balkon-custom', $inline_style);
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'balkon_scripts_styles');



/**
 * Modify menu link class attribute
 *
 * @since Balkon 1.0
 */
$balkon_menu_link_class = array();

add_filter('nav_menu_css_class', 'balkon_nav_menu_css_class_func', 10, 2);

function balkon_nav_menu_css_class_func($classes, $item) {
    global $balkon_menu_link_class;
    $balkon_menu_link_class = array();
    $ajax_menu = array_search("ajax", $classes);
    if ($ajax_menu !== false) {
        $balkon_menu_link_class[] = 'ajax';
        unset($classes['ajax']);
    }
    $external_menu = array_search("external", $classes);
    if ($external_menu !== false) {
        $balkon_menu_link_class[] = 'external';
    }
    //scroll menu for multipage menu
    $menu_scroll_link_menu = array_search("menu-scroll-link", $classes);
    if ($menu_scroll_link_menu !== false) {
        $balkon_menu_link_class[] = 'menu-scroll-link';
    }
    $current_menu = array_search("current-menu-item", $classes);
    if ($current_menu !== false) {
        $balkon_menu_link_class[] = 'act-link';
    }
    $current_menu_ancestor = array_search("current-menu-ancestor", $classes);
    if ($current_menu_ancestor !== false) {
        $balkon_menu_link_class[] = 'ancestor-act-link';
    }
    $current_menu_parent = array_search("current-menu-parent", $classes);
    if ($current_menu_parent !== false) {
        $balkon_menu_link_class[] = 'parent-act-link';
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'balkon_nav_menu_link_attributes_func', 10, 3);

function balkon_nav_menu_link_attributes_func($atts, $item, $args) {
    global $balkon_menu_link_class;
    if (!empty($balkon_menu_link_class)) {
        $atts['class'] = implode(" ", $balkon_menu_link_class);
    }
    
    return $atts;
}

/**
 * Left page fixed title
 *
 * @since Balkon 1.0
 */
if (!function_exists('balkon_dynamic_title')) {
    function balkon_dynamic_title() {
        
        if (!is_home()) {
            if(is_author()){
                echo sprintf( __( 'Author: %s','balkon' ), get_the_author() );
            }else
            if (is_archive() && !is_tax()) {
                if (is_post_type_archive('portfolio')) {
                    esc_html_e('Our Portfolio', 'balkon');
                } 
                else 
                {
                    
                        echo get_the_archive_title();
                
                    
                }
            } 
            else if (is_archive() && is_tax()) {
                
                // If post is a custom post type
                $post_type = get_post_type();
                
                // If it is a custom post type display name and link
                if ($post_type && $post_type == 'portfolio') {
                    $term = get_queried_object();
                    echo esc_attr($term->name);
                } 
                elseif ($post_type && $post_type != 'post') {
                    
                    $post_type_object = get_post_type_object($post_type);
                    
                    echo esc_attr($post_type_object->labels->name);
                }
            } 
            else if (is_single()) {
                echo get_the_title();
            } 
            else if (is_category()) {
            } 
            else if (is_page()) {
                echo get_the_title();
            } 
            else if (is_search()) {
                echo esc_html__('Search Blog', 'balkon');
            } 
            elseif (is_404()) {
                echo esc_html__('Page not found', 'balkon');
            }
        } 
        else {
            echo esc_attr(balkon_get_option('blog_head_title'));
        }
    }
}

/**
 * Theme pagination
 *
 * @since Balkon 1.0
 */

if (!function_exists('balkon_pagination')) {
    function balkon_pagination($pages = '', $sec_wrap = false) {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if ($pages == '') {
            // global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }
        $args = array(
            'base'               => str_replace(999999999, '%#%', get_pagenum_link(999999999)),
            'format'             => '',
            'total'              => $pages,
            'current'            => max(1, get_query_var('paged')),
            'show_all'           => false,
            'end_size'           => 3,
            'mid_size'           => 3,
            'prev_next'          => true,
            'prev_text'          => wp_kses(__('<i class="fa fa fa-angle-left"></i>','balkon'),array('i'=>array('class'=>array(),),) ) ,
            'next_text'          => wp_kses(__('<i class="fa fa fa-angle-right"></i>','balkon'),array('i'=>array('class'=>array(),),) ) ,
            'type'               => 'plain',//list array plain
            'add_args'           => false,
            'add_fragment'       => '',
            'before_page_number' => '',
            'after_page_number'  => ''
        );


        $return = paginate_links($args);
        if (!empty($return)) {
            if ($sec_wrap) echo '<div class="clearfix"></div><section class="custom_folio_pagi">';
            echo '<div class="pagination-blog">' . $return . '</div>';
            if ($sec_wrap) echo '</section>';
        }
    }
}

/**
 * Pagination for Portfolio page templates
 *
 * @since Balkon 1.0
 */
if (!function_exists('balkon_custom_pagination')) {
    function balkon_custom_pagination($pages = '', $range = 2, $current_query = '', $sec_wrap = false) {
        // var_dump($pages);die;
        $showitems = ($range * 2) + 1;
        
        if ($current_query == '') {
            global $paged;
            if (empty($paged)) $paged = 1;
        } 
        else {
            $paged = $current_query->query_vars['paged'];
        }
        
        if ($pages == '') {
            if ($current_query == '') {
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if (!$pages) {
                    $pages = 1;
                }
            } 
            else {
                $pages = $current_query->max_num_pages;
            }
        }
        
        if (1 < $pages) {
            if ($sec_wrap) echo '<section class="custom_folio_pagi">';

            if(balkon_global_var('pagination_type') == 'custom') {
                echo '<div class="content-nav">';
                    echo '<ul class="clearfix">';
                    if ($paged > 1) echo '<li><a href="' . get_pagenum_link($paged - 1) . '" class="prevposts-link transition ln">'.wp_kses(__('<i class="fa fa fa-angle-left"></i>','balkon'),array('i'=>array('class'=>array(),),) ).'<span class="tooltip">'.esc_html__('Prev - Page ','balkon' ).esc_html( $paged - 1 ).'</span></a></li>';
                    else echo '<li><a href="javascript:void(0)" class="prevposts-link transition ln">'.wp_kses(__('<i class="fa fa fa-angle-left"></i>','balkon'),array('i'=>array('class'=>array(),),) ).'<span class="tooltip">'.esc_html__('Prev - Page 1','balkon' ).'</span></a></li>';
                    for ($i = 1; $i <= $pages; $i++) {
                        if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                            if($paged == $i)
                                echo "<li><a class='cur-page blog-page current-page' href='javascript:void(0);'><span>" .esc_html__('Page ','balkon' ) . $i . "</span></a></li>";
                            // echo ($paged == $i) ? '<li><a href="javascript:void(0)" class="cur-page blog-page current-page"><span>' .esc_html__('Page ','balkon' ) . $i . "</span></a></li>" : '' ;
                        }
                    }    
                    if ($paged < $pages) echo '<li><a href="' . get_pagenum_link($paged + 1) . '" class="nextposts-link transition rn">'.wp_kses(__('<i class="fa fa fa-angle-right"></i>','balkon'),array('i'=>array('class'=>array(),),) ).'<span class="tooltip">'.esc_html__('Next - Page ','balkon' ).esc_html( $paged + 1 ).'</span></a></li>';
                    else echo '<li><a href="javascript:void(0)" class="nextposts-link transition rn">'.wp_kses(__('<i class="fa fa fa-angle-right"></i>','balkon'),array('i'=>array('class'=>array(),),) ).'<span class="tooltip">'.esc_html__('Next - Page ','balkon' ).esc_html( $paged ).'</span></a></li>';
                    echo '</ul>';
                echo '</div>';
            }else{
                echo '<div class="pagination-blog">';
                
                if ($paged > 1) echo '<a href="' . get_pagenum_link($paged - 1) . '" class="prevposts-link transition">'.wp_kses(__('<i class="fa fa fa-angle-left"></i>','balkon'),array('i'=>array('class'=>array(),),) ).'</a>';
                
                for ($i = 1; $i <= $pages; $i++) {
                    if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                        if($paged == $i)
                            echo "<span class='blog-page current-page transition'>" . $i . "</span>";
                        else
                            echo "<a href='" . get_pagenum_link($i) . "' class='blog-page transition' >" . $i . "</a>";

                        // echo ($paged == $i) ? "<span class='blog-page current-page transition'>" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class='blog-page transition' >" . $i . "</a>";
                    }
                }
                
                if ($paged < $pages) echo '<a href="' . get_pagenum_link($paged + 1) . '" class="nextposts-link transition">'.wp_kses(__('<i class="fa fa fa-angle-right"></i>','balkon'),array('i'=>array('class'=>array(),),) ).'</a>';
                
                echo "</div>";
            }
            
            if ($sec_wrap) echo "</section>";
        }

    }
}

/**
 * Blog post nav
 *
 * @since Balkon 1.0
 */
if (!function_exists('balkon_post_nav')) {
    function balkon_post_nav() {
        if(!balkon_get_option('blog_single_navigation'))
            return ;
?>
<div class="content-nav blog-nav">
    <ul>
        <li>
        <?php
        $prev_post = get_adjacent_post( balkon_global_var('blog_single_nav_same_term'), '', true );
        if ( is_a( $prev_post, 'WP_Post' ) ) :
        ?>
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="ln" title="<?php echo get_the_title($prev_post->ID ); ?>"><i class="fa fa fa-angle-left"></i><span class="tooltip"><?php echo get_the_title($prev_post->ID ); ?></span></a>
        <?php else : ?>
        <a href="javascript:void(0)">&nbsp;</a>
        <?php endif ?>
        </li>
        <li>
            <?php if( balkon_global_var('blog_list_link') ) :?>
            <div class="list">
                <a href="<?php echo esc_url( balkon_global_var('blog_list_link') ); ?>">
                <span>
                <i class="b1 c1"></i><i class="b1 c2"></i><i class="b1 c3"></i>
                <i class="b2 c1"></i><i class="b2 c2"></i><i class="b2 c3"></i>
                <i class="b3 c1"></i><i class="b3 c2"></i><i class="b3 c3"></i>
                </span></a>
            </div>
            <?php else : ?>
            <div class="list">
                <a href="javascript:void(0)">
                <span>
                <i class="b1 c1"></i><i class="b1 c2"></i><i class="b1 c3"></i>
                <i class="b2 c1"></i><i class="b2 c2"></i><i class="b2 c3"></i>
                <i class="b3 c1"></i><i class="b3 c2"></i><i class="b3 c3"></i>
                </span></a>
            </div>
            <?php endif ?>
        </li>
        <li>
        <?php
        $next_post = get_adjacent_post( balkon_global_var('blog_single_nav_same_term'), '', false );
        if ( is_a( $next_post, 'WP_Post' ) ) :
        ?>
        <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="rn" title="<?php echo get_the_title($next_post->ID ); ?>"><i class="fa fa fa-angle-right"></i><span class="tooltip"><?php echo get_the_title($next_post->ID ); ?></span></a>
        <?php else : ?>
        <a href="javascript:void(0)">&nbsp;</a>
        <?php endif ?>
        </li>
    </ul>
</div>
    <?php
    }
}



/**
 * Custom comments list
 *
 * @since Balkon 1.0
 */
if (!function_exists('balkon_comments')) {
    function balkon_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);
        
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        } 
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
?>
        <<?php
        echo esc_attr($tag); ?> <?php
        comment_class(empty($args['has_children']) ? 'comment-nochild' : 'comment-haschild') ?> id="comment-<?php
        comment_ID() ?>">
        <?php
        if ('div' != $args['style']): ?>
        <div id="div-comment-<?php
            comment_ID() ?>" class="comment-body thecomment">
        <?php
        endif; ?>

            <div class="comment-author">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
            </div>
            <cite class="fn"><?php echo get_comment_author_link($comment->comment_ID); ?></cite>
            <div class="comment-meta">
                <h6><?php echo get_comment_date(esc_html__('F j, Y g:i a', 'balkon')); ?> / <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></h6>
            </div>
            <?php comment_text(); ?>
            <?php
            if ($comment->comment_approved == '0'): ?>
                    <em class="comment-awaiting-moderation aligncenter"><?php
                esc_html_e('Your comment is awaiting moderation.', 'balkon'); ?></em>
                    <br />
                <?php
            endif; ?> 
        
        <?php
        if ('div' != $args['style']): ?>
        </div> 


        <?php
        endif; ?>

    <?php
    }
}

/**
 * Modify tag cloud format
 *
 * @since Balkon 1.0
 */
function balkon_custom_tag_cloud_widget($args) {
    $args['format']     = 'list'; //flat,list,array
    $args['smallest']   = 1;
    $args['largest']    = 1;
    $args['unit']       = 'em';
     //ul with a class of wp-tag-cloud
    return $args;
}
add_filter('widget_tag_cloud_args', 'balkon_custom_tag_cloud_widget');

/**
 * Modify category count format
 *
 * @since Balkon 1.0
 */
function balkon_custom_category_count_widget($output) {
    return preg_replace("/<\/a>\s*([\s(\d)]*)\s*</", '</a><span>$1</span><', $output);
}
add_filter('wp_list_categories', 'balkon_custom_category_count_widget');

/**
 * Modify archive count format
 *
 * @since Balkon 1.0
 */
function balkon_custom_archives_count_widget($link_html) {
    return preg_replace("/&nbsp;([\s(\d)]*)/", '<span>$1</span>', $link_html);
}
add_filter('get_archives_link', 'balkon_custom_archives_count_widget');



/**
 * Return attachment image link by using wp_get_attachment_image_src function
 *
 * @since Balkon 2.4
 */
function balkon_get_attachment_thumb_link( $id, $size = 'thumbnail', $icon = false ){
    $image_attributes = wp_get_attachment_image_src( $id, $size, $icon );
    if ( $image_attributes ) {
        return $image_attributes[0];
    }
    return '';
}



/** 
 * Global variables fix
 * https://forums.envato.com/t/redux-framework-global-variable-issue/36739
 * @since Balkon 1.0
 */ 
if ( !function_exists('balkon_global_var') ) {
    function balkon_global_var($opt_1 = '', $opt_2 = '', $opt_check = false){
        global $balkon_options;
        if( $opt_check ) {
            if(isset($balkon_options[$opt_1][$opt_2])) {
                return $balkon_options[$opt_1][$opt_2];
            }
        } else {
            if(isset($balkon_options[$opt_1])) {
                return $balkon_options[$opt_1];
            }
        }

        return false;
        
    }
}

function balkon_get_current_url(){
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));

    return $current_url;
}


/**
* Add custom query vars for demo
*
* @since Balkon 1.0
*/
function balkon_query_vars_filter( $vars ){
  $vars[] = "dark_skin";
  $vars[] = "hide_left";
  return $vars;
}
add_filter( 'query_vars', 'balkon_query_vars_filter', 20 );



/**
* Remove default Recent Comments widget style
*
* @since Balkon 1.0
*/

function balkon_remove_recent_comments_widget_style(){
    return;
}
add_filter('show_recent_comments_widget_style','balkon_remove_recent_comments_widget_style' , 0 );

if(!function_exists('balkon_password_form')){
    function balkon_password_form() {
        global $post;
        $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
        $o = '<div class="balkon-password-form-holder"><form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="balkon-password-form"><p>' . esc_html__( "To view this protected post, enter the password below:" ,'balkon') . '</p><label for="' . $label . '">' . esc_html__( "Password:" ,'balkon') . ' </label><div class="password-input-wrap"><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="password-input" /><button class="password-submit" type="submit"><i class="fa fa-eye"></i></button></div></form></div>';
        return $o;
    }
}

add_filter( 'the_password_form', 'balkon_password_form' );

/**
 * Theme custom style
 *
 * @since Balkon 1.0
 */
require_once get_template_directory() . '/inc/overridestyle.php';

// /**
//  * Implement Ajax requests
//  *
//  * @since Balkon 1.0
//  */
require_once get_template_directory() . '/inc/ajax.php';

/**
 * Implement the One Click Demo Import plugin
 *
 * @since Balkon 1.0
 */
require_once get_template_directory() . '/includes/one-click-import-data.php';


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_parent_theme_file_path( '/lib/class-tgm-plugin-activation.php' );

add_action('tgmpa_register', 'balkon_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function balkon_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array('name' => esc_html__('WPBakery Page Builder','balkon'),
             // The plugin name.
            'slug' => 'js_composer',
             // The plugin slug (typically the folder name).
            'source' => 'http://assets.cththemes.com/plugins/js_composer.zip',
             // The plugin source.
            'required' => true,
            'external_url' => esc_url(balkon_relative_protocol_url().'://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431' ),
             // If set, overrides default API URL and points to an external URL.
            'function_to_check'         => '',
            'class_to_check'            => 'Vc_Manager'
        ), 

        array('name' => esc_html__('Redux Framework','balkon'),
             // The plugin name.
            'slug' => 'redux-framework',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(balkon_relative_protocol_url().'://wordpress.org/plugins/redux-framework/'),
             // If set, overrides default API URL and points to an external URL.
            'function_to_check'         => '',
            'class_to_check'            => 'ReduxFramework'
        ), 

        array(
            'name' => esc_html__('Contact Form 7','balkon'),
             // The plugin name.
            'slug' => 'contact-form-7',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(balkon_relative_protocol_url().'://wordpress.org/plugins/contact-form-7/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'wpcf7',
            'class_to_check'            => 'WPCF7'
        ), 

        array(
            'name' => esc_html__('CMB2','balkon'),
             // The plugin name.
            'slug' => 'cmb2',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(balkon_relative_protocol_url().'://wordpress.org/support/plugin/cmb2'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'cmb2_bootstrap',
            'class_to_check'            => 'CMB2_Base'
        ),
        
        array(
            'name' => esc_html__('Balkon Add-ons','balkon' ),
             // The plugin name.
            'slug' => 'balkon-add-ons',
             // The plugin slug (typically the folder name).
            'source' => 'balkon-add-ons.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.

            'force_deactivation'            => true,

            'function_to_check'         => '',
            'class_to_check'            => 'Balkon_Addons'
        ), 

        

        
        array(
            'name' => esc_html__('Envato Market','balkon' ),
             // The plugin name.
            'slug' => 'envato-market',
             // The plugin slug (typically the folder name).
            'source' => esc_url(balkon_relative_protocol_url().'://envato.github.io/wp-envato-market/dist/envato-market.zip' ),
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url('//envato.github.io/wp-envato-market/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'envato_market',
            'class_to_check'            => 'Envato_Market'
        ),

        array('name' => esc_html__('One Click Demo Import','balkon'),
             // The plugin name.
            'slug' => 'one-click-demo-import',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(balkon_relative_protocol_url().'://wordpress.org/plugins/one-click-demo-import/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'OCDI_Plugin'
        ),

        array('name' => esc_html__('Regenerate Thumbnails','balkon'),
             // The plugin name.
            'slug' => 'regenerate-thumbnails',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(balkon_relative_protocol_url().'://wordpress.org/plugins/regenerate-thumbnails/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'RegenerateThumbnails',
            'class_to_check'            => 'RegenerateThumbnails'
        ),

        




    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'balkon',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => get_template_directory() . '/lib/plugins/',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        
    );

    tgmpa( $plugins, $config );
}


