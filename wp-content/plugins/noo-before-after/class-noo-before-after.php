<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !class_exists('Noo_Before_After') )
{
    class Noo_Before_After
    {
        function __construct()
        {
            global $noo_ba_dir;

            require_once $noo_ba_dir . 'functions/shortcode_map.php';
            require_once $noo_ba_dir . 'functions/shortcode_params.php';
            if ( is_admin() )
            {
                add_action( 'init', array(  $this, 'setup_noo_before_after_plugin' ) );
            }
	        add_action( 'plugins_loaded', [$this, 'noobeforeafter_load_plugin_textdomain'] );
            add_action( 'admin_enqueue_scripts', array($this, 'noo_before_after_admin_enqueue_scripts') );
			add_action('wp_enqueue_scripts', array($this, 'noo_before_after_enqueue_scripts'));
            add_shortcode( 'noo_beforeafter', array($this, 'noo_before_after_shortcode') );
        }

	    public function noobeforeafter_load_plugin_textdomain() {
		    load_plugin_textdomain( 'noo-before-after', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	    }

        /**
        * Check if the current user can edit Posts or Pages, and is using the Visual Editor
        * If so, add some filters so we can register our plugin
        */
        public function setup_noo_before_after_plugin()
        {
            if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
            {
                return;
            }

            if ( get_user_option( 'rich_editing' ) !== 'true' )
            {
                return;
            }
            // Setup some filters
            add_filter( 'mce_external_plugins', array( &$this, 'add_tinymce_plugin' ) );
            add_filter( 'mce_buttons', array( &$this, 'add_tinymce_toolbar_button' ) );
        }

        public function add_tinymce_plugin( $plugin_array )
        {
            $plugin_array['noo_before_after_button'] = plugin_dir_url( __FILE__ ) . '/noo_before_after_button.js';
            return $plugin_array;
        }

        public function add_tinymce_toolbar_button( $buttons )
        {
            array_push( $buttons, '', 'noo_before_after_button' );
            return $buttons;
        }

        public function noo_before_after_shortcode($atts)
        {
            global $noo_ba_dir;
            require $noo_ba_dir . 'templates/shortcode.php';
            return shortcode_noo_before_after($atts);
        }

        public function noo_before_after_admin_enqueue_scripts()
        {
            global $noo_ba_uri, $post_type, $wp_scripts;

            wp_register_script( 'wpb_php_js', $noo_ba_uri . '/assets/vendor/php.default/php.default.min.js', array( 'jquery' ), null, true );
            wp_enqueue_script( 'wpb_php_js' );
            
            wp_register_script( 'noo-before-after-editor', $noo_ba_uri . '/assets/js/editor.js', array('wp-color-picker', 'wpb_php_js'), null, true );
            wp_register_style( 'noo-before-after-editor', $noo_ba_uri . '/assets/css/editor-style.css', array(), null );
			wp_register_style( 'noo-admin-css', $noo_ba_uri . '/assets/css/noo-before-after-admin.css', array(), null );
            wp_register_style( 'noo-fontawesome-css', $noo_ba_uri . '/assets/vendor/fontawesome/css/font-awesome.min.css', array(), null );


            $is_content_editor = ( isset( $post_type ) AND post_type_supports( $post_type, 'editor' ) );
            $extra_js_data = 'if (window.$nba === undefined) window.$nba = {}; $nba.ajaxUrl = ' . wp_json_encode( admin_url( 'admin-ajax.php' ) ) . ";";
            if ( $is_content_editor ) {
    			$extra_js_data .= '$nba.elements = ' . wp_json_encode( noo_before_after_get_elements() ) . ";\n";
    		}
    		$wp_scripts->add_data( 'noo-before-after-editor', 'data', $extra_js_data );

            if ( $is_content_editor ) {
    			!$this->noo_before_after_enqueue_forms_assets();
    		}
        }

		public function noo_before_after_enqueue_scripts()
		{
			global $noo_ba_uri;
			wp_register_style( 'noo-before-after', $noo_ba_uri . '/assets/css/noo-before-after.css', array(), null );
			wp_register_script( 'noo-before-after', $noo_ba_uri . '/assets/js/jquery.noo-before-after.js', array('jquery'), null, true );
			wp_register_script( 'noo-ba-event-move-jquery', $noo_ba_uri . '/assets/js/jquery.event.move.js', array('jquery'), null, true );

			//slick
            wp_register_style( 'noo-before-after-slick-css', $noo_ba_uri . '/assets/css/slick.css', array(), null );
            wp_register_style( 'noo-before-after-slick-theme-css', $noo_ba_uri . '/assets/css/slick-theme.css', array(), null );
            wp_register_script( 'noo-before-after-slick-js', $noo_ba_uri . '/assets/js/slick.js', array('jquery'), null, true );
           
			wp_enqueue_script( 'noo-ba-event-move-jquery' );
			wp_enqueue_script( 'noo-before-after' );
			wp_enqueue_style( 'noo-before-after' );
            wp_enqueue_style( 'noo-before-after-slick-css' );
            wp_enqueue_style( 'noo-before-after-slick-theme-css' );
            wp_enqueue_script( 'noo-before-after-slick-js' );

			do_action( 'noo_before_after_enqueue_scripts' );
		}

        public function noo_before_after_enqueue_forms_assets()
        {
    		wp_enqueue_style( 'noo-before-after-editor' );
            wp_enqueue_style( 'noo-admin-css' );
            wp_enqueue_style( 'noo-fontawesome-css' );
    		wp_enqueue_script( 'noo-before-after-editor' );
			wp_enqueue_script( 'jquery-ui-slider' );
            //wp_enqueue_script( 'jquery-ui-sortable' );

    		if ( !did_action( 'wp_enqueue_media' ) ) {
    			wp_enqueue_media();
    		}

    		//ns_maybe_load_wysiwyg();

    		do_action( 'noo_before_after_enqueue_forms_assets' );
    	}
    }
}
