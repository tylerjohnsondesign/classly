<?php
/**
 * Shortcode.
 * 
 * @since   1.0.0
 * @author  Built Mighty
 */
class classlyShortcode {

    /**
     * Construct.
     * 
     * @since   1.0.0
     */
    public function __construct() {

        // Actions.
        add_shortcode( 'classly', [ $this, 'shortcode' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );

    }

    /**
     * Shortcode.
     * 
     * @since   1.0.0
     */
    public function shortcode( $atts ) {

        // Process.
        $process = new classlyProcess();

        // Start output buffering.
        ob_start();

        // Include template.
        include CLASSLY_PATH . 'views/schedule.php';

        // Return buffer.
        return ob_get_clean();

    }

    /**
     * Enqueue.
     * 
     * @since   1.0.0
     */
    public function enqueue() {

        // CSS.
        wp_enqueue_style( 'classly-calendar', CLASSLY_URI . 'assets/css/calendar.css', [], CLASSLY_VERSION );

        // JS.
        wp_enqueue_script( 'classly-calendar', CLASSLY_URI . 'assets/js/calendar.js', [ 'jquery' ], CLASSLY_VERSION, true );

    }

}