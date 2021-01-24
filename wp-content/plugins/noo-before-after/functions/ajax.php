<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (!function_exists('ajax_nba_get_shortcode_list_html'))
{
    add_action('wp_ajax_nba_get_shortcode_list_html', 'ajax_nba_get_shortcode_list_html');
    function ajax_nba_get_shortcode_list_html()
    {
        noo_before_after_load_template('shortcode-list', array());
        wp_die();
    }
}

if (!function_exists('ajax_nba_get_builder_html'))
{
    add_action('wp_ajax_nba_get_builder_html', 'ajax_nba_get_builder_html');
    function ajax_nba_get_builder_html()
    {
        $template_vars = array(
			'titles' => array(),
			'body'   => '',
		);

        $elements = noo_before_after_get_elements();

        // Loading all the forms HTML
		foreach ( $elements as $name => $el ) {
			$template_vars['titles'][ $name ] = isset( $el['name'] ) ? $el['name'] : $name;
			$template_vars['body']            .= noo_before_after_get_template( 'form', array(
				'name'             => $name,
				'params'           => $el['params'],
				'field_id_pattern' => 'nba_builder_form_' . $name . '_%s',
			) );
		}
        noo_before_after_load_template('builder', $template_vars);
        wp_die();
    }
}
