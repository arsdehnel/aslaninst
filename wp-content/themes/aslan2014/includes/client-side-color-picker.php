<?php
/**
 * Plugin Name: Client-Side Color Picker
 * Plugin URI: http://www.arsdehnel.net/plugin/client-side-color-picker/
 * Description: Allow your client to adjust their colors real-time
 * Version: 0.1.0
 * Author: Adam Dehnel
 * Requires at least: 3.8
 * Tested up to: 3.9
 *
 */

// define("CSCP_VERSION",'0.1.0');

function cscp_enqueue() {
	if( !is_admin() && is_user_logged_in() ){
		wp_enqueue_style( 'cscp-style', get_template_directory_uri() . '/includes/client-side-color-picker/widget.css' );
		wp_enqueue_script( 'cscp-script', get_template_directory_uri() . '/includes/client-side-color-picker/widget.js', array(), CSCP_VERSION, true );
	}
}

add_action( 'wp_enqueue_scripts', 'cscp_enqueue' );

