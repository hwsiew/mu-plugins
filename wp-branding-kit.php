<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.actiweb.co
 * @since             1.0.0
 * @package           Actiweb
 *
 * @wordpress-plugin
 * Plugin Name:       WP Branding Kit by Actiweb
 * Plugin URI:        https://www.actiweb.co
 * Description:       This plugin is WordPress site branding kit developed by Actiweb Technology
 * Version:           1.0.0
 * Author:            HW,Siew
 * Author URI:        https://www.actiweb.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	 die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME', 'wp_branding_kit' );
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/*
 *	login page style sheet
 *	@since 1.0.0
 */

add_action( 'login_enqueue_scripts', 'login_enqueue_styles' );

function login_enqueue_styles(){

	wp_enqueue_style(
		 PLUGIN_NAME . '_login_style' ,
		 WPMU_PLUGIN_URL . '/assets/css/login.css',
		 array() , # dependencies
		 PLUGIN_NAME_VERSION # version
	);

}

/*
 * 	Change logo link click url to others
 * 	@since 1.0.0
 */

add_filter( 'login_headerurl', function(){ return 'https://www.actiweb.co'; }, 10, 1 );

/*
 * 	set rememberme to checked by default in login page
 * 	@since 1.0.0
 */

add_action( 'init', 'login_checked_remember_me' );

function login_checked_remember_me() {
	add_filter( 'login_footer', 'rememberme_checked' );
}

function rememberme_checked() {
	echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

/*
 *	remove dashboard WP dashicon
 *	@since 1.0.0
 */

add_action( 'wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0 );

function example_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}