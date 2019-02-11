<?php
/*
Plugin Name: Twilio 2FA for WordPress
Description: 2 Factor Authentication for WordPress with Twilio
Author:      Aaron Brazell
Version:     1.0
Author URI:  http://github.com/technosailor
*/
use Technosailor\Twilio\Init;

define( 'BASE_PATH', plugin_dir_path( __FILE__ ) );
require_once BASE_PATH . 'vendor/autoload.php';

add_action( 'plugins_loaded', function () {
	Init::instance()->init();
} );