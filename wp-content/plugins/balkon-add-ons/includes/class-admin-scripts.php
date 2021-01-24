<?php 
/* add_ons_php */

defined( 'ABSPATH' ) || exit;

class CTH_Class_Admin_Scripts {  

    private static $plugin_url;

    public static function init(){
        self::$plugin_url = CTH_DIR_URL; 

        add_action( 'admin_enqueue_scripts', array(get_called_class(), 'enqueue_scripts') );    
    }

    public static function enqueue_scripts($hook){
        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
        // wp_enqueue_editor();
        

        wp_enqueue_style( 'balkon-add-ons', self::$plugin_url .'assets/css/admin.min.css' ); 

        

        wp_enqueue_script('balkon-addons-admin', self::$plugin_url . 'assets/js/addons-admin.min.js', array('jquery','jquery-ui-sortable'), null, true);
        
        if($hook != 'settings_page_balkon-addons') {
            return;
        }
        
        // wp_enqueue_script('balkon_addons_image', self::$plugin_url . 'inc/assets/upload_file.js', array('jquery'), null, true);

        // wp_enqueue_script('balkon-add-ons-options', self::$plugin_url . 'assets/js/addons-options.js', array('select2'), null, true);
    }

}

CTH_Class_Admin_Scripts::init();