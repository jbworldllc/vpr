<?php 

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', function(){
    // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        remove_filter( 'plugin_row_meta', array(
            ReduxFrameworkPlugin::instance(),
            'plugin_metalinks'
        ), null, 2 );

        // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
        remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
    }
} );

function balkon_addons_get_option( $setting, $default = null ) {
    global $balkon_addons_options; 

    $default_options = array(
        
    );
    $value = false;
    if ( isset( $balkon_addons_options[ $setting ] ) ) {
        $value = $balkon_addons_options[ $setting ];
    }else {
        if(isset($default)){
            $value = $default;
        }else if( isset( $default_options[ $setting ] ) ){
            $value = $default_options[ $setting ];
        }
    }

    
    return apply_filters( 'cth_addons_option_value', $value, $setting );
}
