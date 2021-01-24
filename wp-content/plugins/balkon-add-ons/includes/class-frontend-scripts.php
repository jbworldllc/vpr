<?php 
/* add_ons_php */

defined( 'ABSPATH' ) || exit;

class CTH_Class_Frontend_Scripts {

    private static $plugin_url;

    public static function init(){
        self::$plugin_url = CTH_DIR_URL;    
        add_action( 'wp_enqueue_scripts', array(get_called_class(), 'enqueue_scripts') );       
    }


    public static function enqueue_scripts(){

        wp_enqueue_style( 'balkon-add-ons', self::$plugin_url .'assets/css/balkon-add-ons.min.css' ); 

        wp_enqueue_script( 'balkon-addons', self::$plugin_url ."assets/js/balkon-add-ons.min.js" , array('jquery'), null , true );

        $_balkon_add_ons = array(
            'url'           => esc_url(admin_url( 'admin-ajax.php' ) ),
            'nonce'         => wp_create_nonce( 'balkon-add-ons' ),
            'pl_w' => __('Please wait...','balkon-add-ons'),
            
            // 'gcaptcha'          => ( balkon_addons_get_option('enable_g_recaptcah') == 'yes' && balkon_addons_get_option('g_recaptcha_site_key') != '' )? true: false,
            // 'gcaptcha_key'      => balkon_addons_get_option('g_recaptcha_site_key'),
        );

        wp_localize_script( 'balkon-addons', '_balkon_add_ons', $_balkon_add_ons );

        // google reCAPTCHA - v2
        // if( balkon_addons_get_option('enable_g_recaptcah') == 'yes' && balkon_addons_get_option('g_recaptcha_site_key') != '' )
        //     wp_enqueue_script( 'g-recaptcha', "https://www.google.com/recaptcha/api.js?onload=cthCaptchaCallback&render=explicit#cthasync#cthdefer" , array('balkon-addons'), null , true );
    }
}

CTH_Class_Frontend_Scripts::init();