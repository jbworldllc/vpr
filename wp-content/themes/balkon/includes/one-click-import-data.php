<?php
//http://proteusthemes.github.io/one-click-demo-import/
//https://wordpress.org/plugins/one-click-demo-import/

function balkon_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__('Balkon theme - Full Demo Content (widgets included)','balkon' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/demo_data_files/all-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'includes/demo_data_files/widgets.wie',
            'local_import_redux'           => array(
										        array(
										          	'file_path'   => trailingslashit( get_template_directory() ) . 'includes/demo_data_files/redux_options_balkon_options.json',
										          	'option_name' => 'balkon_options',
										        ),
		    ),
            'import_notice'                => esc_html__( 'Balkon theme - Full Demo Content (widgets included). After you import this demo, you will have to setup the front-page from Settings -> Reading screen and menu from Appearance -> Menus screen.', 'balkon' ),
        ),

    );
}
add_filter( 'pt-ocdi/import_files', 'balkon_import_files' );