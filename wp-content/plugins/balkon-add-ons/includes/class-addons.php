<?php 
/* add_ons_php */

defined( 'ABSPATH' ) || exit;
// set global options value
if(!isset($balkon_addons_options)) 
    $balkon_addons_options = get_option( 'balkon-addons-options', array() ); 

final class Balkon_Addons { 
    public $cthversion = '1.3.1';
    public $cart = null;
    private static $_instance;

    public $options = null;
    private $plugin_url;
    private $plugin_path;

    private function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function init_hooks() {
        add_action('plugins_loaded', array( $this, 'load_plugin_textdomain' ));
        

        add_action( 'init', array( $this, 'init' ), 0 );
    
        add_action( 'widgets_init', array( $this, 'register_widgets' ) );
    }

    public function load_plugin_textdomain(){
        load_plugin_textdomain( 'balkon-add-ons', false, plugin_basename(dirname(CTH_PLUGIN_FILE)) . '/languages' );
    }


    public function register_widgets() {
        register_widget( 'Balkon_About_Author' );
        register_widget( 'Balkon_Recent_Posts' );
        register_widget( 'Balkon_Instagram_Feed' );
        register_widget( 'Balkon_Banner' );
    }

    public static function getInstance() {
        if ( ! ( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __clone() {
    }

    private function __wakeup() {
    }

    private function define_constants() {
        $upload_dir = wp_upload_dir( null, false );

        $this->define( 'CTH_ABSPATH', plugin_dir_path( CTH_PLUGIN_FILE ) );
        $this->define( 'CTH_DIR_URL', plugin_dir_url( CTH_PLUGIN_FILE ) );
        $this->define( 'CTH_VERSION', $this->cthversion );
        $this->define( 'CTH_META_PREFIX', '_cth_' );
        $this->define( 'CTH_DEBUG', true );
        $this->define( 'CTH_LOG_FILE', $upload_dir['basedir'] .'/cthdev.log' );


        $this->plugin_url = plugin_dir_url(CTH_PLUGIN_FILE);
        $this->plugin_path = plugin_dir_path(CTH_PLUGIN_FILE);
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    public function is_request( $type ) {
        switch ( $type ) {
            case 'admin':
                return is_admin();
            case 'ajax':
                return defined( 'DOING_AJAX' );
            case 'frontend':
                return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
        }
    }

    private function includes() {
        require_once CTH_ABSPATH . 'includes/core-functions.php';

        // for listing post type
        require_once CTH_ABSPATH .'includes/class-cpt.php';

        if($this->is_request('admin')){

            // plugin option values
            require_once CTH_ABSPATH . 'includes/option_values.php';
            /* plugin options */
            require_once CTH_ABSPATH . 'includes/class-options.php';

            require_once CTH_ABSPATH . 'includes/class-admin-scripts.php';
            
            require_once CTH_ABSPATH . 'inc/cmb2/functions.php';
        }

        if($this->is_request('frontend')){
            require_once CTH_ABSPATH . 'includes/class-frontend-scripts.php';
            // require_once CTH_ABSPATH . 'includes/class-form-handler.php';
            // require_once CTH_ABSPATH . 'includes/class-ajax-handler.php';
            
            
        }

        require_once CTH_ABSPATH . 'includes/class-ajax-handler.php';

        /**
         * Implement Post views
         *
         * @since Balkon 1.0
         */
        require_once CTH_ABSPATH . '/inc/post_views.php';
        require_once CTH_ABSPATH . '/inc/cth_for_vc.php';
        // require_once CTH_ABSPATH . '/inc/vc_shortcodes.php';
        
        /**
         * Implement Like Post
         *
         * @since Balkon 1.0
         */
        // require_once CTH_ABSPATH . 'inc/post_like.php';
        //widgets
        require_once CTH_ABSPATH .'widgets/shortcodes.php';
        require_once CTH_ABSPATH .'widgets/balkon_recent_posts.php';
        require_once CTH_ABSPATH .'widgets/balkon_about_author.php';
        require_once CTH_ABSPATH .'widgets/balkon_banner.php';
        require_once CTH_ABSPATH .'widgets/balkon_instagram_feed.php';

    }

    public function init() {

    }
}