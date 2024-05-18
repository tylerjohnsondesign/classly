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

/**
 * Initiate classes.
 * 
 * @since   1.0.0
 */
new classlyPostType();
new classlyFields();
new classlyAdmin();
new classlyShortcode();

add_action( 'wp_head', 'classly_process' );
function classly_process() {

    // Process.
    $process = new classlyProcess(); ?>

    <div class="classly-schedule">
        <div class="classly-time"><?php

            // Set count.
            $count = 0;

            // Loop.
            foreach( $process->get_classes() as $day => $times ) {

                // Add to count.
                $count++;

                // If count is greater than 1, break.
                if( $count > 1 ) break;

                // Loop through times.
                foreach( $times as $time => $class ) {

                    // Output columns. ?>
                    <div class="classly-time-header">
                        <?php echo $time; ?>
                    </div><?php

                }

            } ?>

        </div>
        <div class="classly-days">
            <div class="classly-days-header"><?php

                // Loop.
                foreach( $process->get_classes() as $day => $times ) {

                    // Output columns. ?>
                    <div class="classly-day-header">
                        <?php echo $day; ?>
                    </div><?php

                } ?>

            </div>
            <div class="classly-days-body"><?php

                // Loop.
                foreach( $process->get_classes() as $day => $times ) {

                    // Output column. ?>
                    <div class="classly-day-body"><?php

                        // Loop through times.
                        foreach( $times as $time => $class ) {

                            // Check if class is set.
                            if( empty( $class ) ) continue;

                            // Output. ?>
                            <div class="classly-day-time">
                                <?php echo $time; ?>
                                <div class="classly-day-class">
                                    <?php echo get_the_title( $class['start'] ); ?>
                                </div>
                            </div><?php

                        } ?>
                        
                    </div><?php

                } ?>

            </div>
        </div>
    </div><?php

}