<?php
/**
 * Admin.
 * 
 * @since   1.0.0
 * @author  Built Mighty
 */
class classlyAdmin {

    /**
     * Construct.
     * 
     * @since   1.0.0
     */
    public function __construct() {

        // Actions.
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );

    }

    /**
     * Enqueue.
     * 
     * @since   1.0.0
     */
    public function enqueue() {

        // Check if taxonomy is instructor.
        if( get_current_screen()->taxonomy == 'instructor' ) {

            // Enqueue media files.
            wp_enqueue_media();

            // Enqueue scripts.
            wp_enqueue_script( 'classly-admin', CLASSLY_URI . 'assets/js/instructor.js', [ 'jquery' ], CLASSLY_VERSION, true );
        
        }

    }

}