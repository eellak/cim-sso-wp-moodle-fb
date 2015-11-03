<?php
/**
 * @package WP-FB-AutoConnect-Button
 * @version 1.0
 */
/*
Plugin Name: WP-FB-AutoConnect Button
Plugin URI: 
Description: This is a simple plugin which adds a facebook login button in every login form, provided that WP-FB-AutoConnect plugin is installed and activated.
Author: Angela Dimitriou
Version: 1.0
Author URI: http://www.dbnet.ntua.gr/~angela/
*/
add_filter( 'allowed_redirect_hosts' , 'my_allowed_redirect_hosts' , 10 );
function my_allowed_redirect_hosts($content){
	$content[] = 'moodledev.ellak.gr';
	return $content;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'wp-fb-autoconnect/Main.php' ) ) {
	add_filter( 'login_message', 'wpfbbtn_append_button' );
} 


function wpfbbtn_append_button() {
	if(isset($_GET['redirect_to'])) $redirectTo = $_GET['redirect_to'];
    else $redirectTo = htmlspecialchars($_SERVER['REQUEST_URI']);
	if(strpos($redirectTo,'login'))  $redirectTo = '/';
	jfb_output_facebook_btn();
	jfb_output_facebook_init();
	jfb_output_facebook_callback($redirectTo);
}
?>
