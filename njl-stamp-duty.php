<?php
/*
Plugin Name: NJL Stamp Duty
Text Domain:  njl-sd
Domain Path:  njl-sd
Description: Stamp Duty calculator for England and Northern Ireland. Calculates for new properties second homes and first time buyers.
Author: Nijel Collingham
Author Uri : https://www.linkedin.com/in/nijel-collingham-04601619b/
Version: 1.2
License: GNU General Public License v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/


if(!'ABSPATH'){
	exit();
}

require_once 'includes/stamp-duty-shortcodes.php';
require_once 'includes/stamp-duty-options.php';

function njl_sd_add_scripts(){


	wp_enqueue_style(
		'bootstrapcss',
		"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");

	wp_enqueue_style('njl-sd-main-style', plugins_url('/css/njl-style.css', __FILE__),null,time());
	wp_enqueue_script('njl-sd-main-script', plugins_url('js/njl-main.js', __FILE__), array( 'jquery' ));


		 wp_enqueue_script(
			'bootstrap',
			"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js",
			null,
			false,
			true );
	
}


add_action('wp_enqueue_scripts', 'njl_sd_add_scripts', 100);
add_action( 'admin_menu', 'njl_sd_add_menu' );
add_action('admin_post_njl_sd_save_options', 'njl_sd_save_options' );

