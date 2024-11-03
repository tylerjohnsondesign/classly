<?php
/*
Plugin Name: Classly | Class Calendar
Plugin URI: https://tylerjohnsondesign.com
Description: A class calendar and schedule for repetitive classes.
Version: 1.0.0
Author: Tyler Johnson
Author URI: https://tylerjohnsondesign.com
Copyright: Tyler Johnson
Text Domain: classly
Copyright © 2024 Built Mighty. All Rights Reserved.
*/

/**
 * Disallow direct access.
 */
if( ! defined( 'WPINC' ) ) { die; }

/**
 * Constants.
 * 
 * @since   1.0.0
 */
define( 'CLASSLY_VERSION', date( 'YmdHis' ) );
define( 'CLASSLY_NAME', 'classly' );
define( 'CLASSLY_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'CLASSLY_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'CLASSLY_DOMAIN', 'classly' );

/** 
 * On activation.
 * 
 * @since   1.0.0
 */
register_activation_hook( __FILE__, 'classlyactivation' );
function classlyactivation() {

    // Flush rewrite rules.
    flush_rewrite_rules();

}

/**
 * On deactivation.
 * 
 * @since   1.0.0
 */
register_deactivation_hook( __FILE__, 'classlydeactivation' );
function classlydeactivation() {

    // Flush rewrite rules.
    flush_rewrite_rules();

}

/**
 * Load classes.
 * 
 * @since   1.0.0
 */
require_once CLASSLY_PATH . 'classes/class-posttype.php';
require_once CLASSLY_PATH . 'classes/class-fields.php';
require_once CLASSLY_PATH . 'classes/class-admin.php';
require_once CLASSLY_PATH . 'classes/class-shortcode.php';
require_once CLASSLY_PATH . 'classes/class-process.php';
require_once CLASSLY_PATH . 'classes/class-frontend.php';

/**
 * Initiate classes.
 * 
 * @since   1.0.0
 */
new classlyPostType();
new classlyFields();
new classlyAdmin();
new classlyShortcode();
new classlyFrontend();