<?php 
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features. 
 *
 */
function balkon_get_option( $setting, $default = null ) {
    global $balkon_options;

    $default_options = array(
        // header
        // thumbnail sizes

        'author_checkbox'   => 1,
        'date_checkbox'   => 1,
        'cats_checkbox'   => 1,
        'tag_checkbox'   => 1,
        'comment_checkbox'   => 1,
        
        'user_login_type'          => 'ajax',
        'user_singup_type'      => 'ajax',


        'show_mini_cart'            => 1,

        'folio_sidebar'             => 'none',

        'folio_date_checkbox'           => 1,
        'folio_show_title'           => 1,
        'folio_author_checkbox'           => 1,
        'folio_cats_checkbox'           => 1,
        'folio_comment_checkbox'           => 1,

        // shop
        'shop_sidebar'                  => 'right',

        
    );

    if( is_customize_preview() ) $balkon_options = get_option( 'balkon_options', array() );

    $value = false;
    if ( isset( $balkon_options[ $setting ] ) ) {
        $value = $balkon_options[ $setting ];
    }else {
        if(isset($default)){
            $value = $default;
        }else if( isset( $default_options[ $setting ] ) ){
            $value = $default_options[ $setting ];
        }
    }
    return $value;
}

function balkon_relative_protocol_url(){
    return is_ssl() ? 'https' : 'http';
}

if ( ! function_exists( 'balkon_is_woocommerce_activated' ) ) {
    function balkon_is_woocommerce_activated() {
        if ( class_exists( 'WooCommerce' ) ) { return true; } else { return false; }
    }
}

function balkon_get_header_cart_link(){
    if(balkon_is_woocommerce_activated() && balkon_get_option('show_mini_cart') ){
        global $woocommerce;
        $my_cart_count = $woocommerce->cart->cart_contents_count;
        if($my_cart_count > 0){
            $url = wc_get_page_permalink( 'cart' );
        }else{
            $url = wc_get_page_permalink( 'shop' );
        }
        return array('url'=>$url,'count'=>$my_cart_count);
    }else{
        return false;
    }
}

function balkon_body_classes( $classes ) {
    // Add class for globally reset
    $classes[] = 'body-balkon balkon-body-classes';
    // $classes[] = 'folio-archive-'.balkon_get_option('folio_layout');


    if(post_password_required()) $classes[] = 'is-protected-page';

    // Add class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Add class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Add class if we're viewing the Customizer for easier styling of theme options.
    if ( is_customize_preview() ) {
        $classes[] = 'balkon-customizer';
    }

    // Add class on front page.
    if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
        $classes[] = 'balkon-front-page';
    }
    $show_left = balkon_get_option('show_left_bar');
    if(is_singular( )){
        $hide_left_post = get_post_meta(get_the_ID(),'_balkon_hide_left',true ) ;
        if($show_left && $hide_left_post != 'yes' || $hide_left_post == 'no' ) $show_left = true;
        if($hide_left_post == 'yes' || get_query_var('hide_left','no' ) == 'yes' ) $show_left = false;
    } 

    if( !$show_left ) $classes[] = 'hide-left-footer';
    if (!balkon_global_var('override-preset') && balkon_global_var('color-preset') == 'dark' ||  get_query_var('dark_skin','no' ) == 'yes' ) $classes[] = 'balkon-dark';

    return $classes;
}
add_filter( 'body_class', 'balkon_body_classes' );