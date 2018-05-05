<?php
/*
Plugin Name: Visual Composer - Mailchimp
Plugin URI: http://webholics.in
Description: Extend Visual Composer options to insert your Mailchimp signup forms
Version: 1.2.6
Author: Aman Saini
Author URI:  http://webholics.in
 */

// don't load directly
if ( !defined( 'ABSPATH' ) ) die( '-1' );

define( "VC_MAILCHIMP_DIR", WP_PLUGIN_DIR . "/" . basename( dirname( __FILE__ ) ) );
define( "VC_MAILCHIMP_URL", plugins_url() . "/" . basename( dirname( __FILE__ ) ) );

//Add Admin class
require_once (VC_MAILCHIMP_DIR.'/lib/class-vc-mailchimp-init.php');
require_once (VC_MAILCHIMP_DIR.'/lib/class-vc-mailchimp-admin.php');
add_action( 'plugins_loaded', array( 'VC_Mailchimp_Admin', 'setup' ) );

//Add Shortcode class
require_once (VC_MAILCHIMP_DIR.'/lib/class-vc-mailchimp-shortcode.php');
add_action( 'plugins_loaded', array( 'VC_Mailchimp_Shortcode', 'setup' ) );