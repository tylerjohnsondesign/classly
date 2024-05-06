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

    }

    /**
     * Shortcode.
     * 
     * @since   1.0.0
     */
    public function shortcode( $atts ) {

        // Start output buffering.
        ob_start();

        // Include template.
        include CLASSLY_PATH . 'views/schedule.php';

        // Return buffer.
        return ob_get_clean();

    }

    /**
     * Query.
     * 
     * @since   1.0.0
     */
    public function query() {

        // Set args.
        $args = [
            'post_type'         => 'class',
            'posts_per_page'    => -1,
            'post_status'       => 'publish',
        ];

        // Query.
        $query = new WP_Query( $args );

        // Set classes.
        $classes = [];

        // Loop.
        if( $query->have_posts() ) {
            while( $query->have_posts() ) {
                $query->the_post();

                // Add class.
                $classes[get_the_ID()] = [
                    'title'         => get_the_title(),
                    'description'   => get_the_content(),
                    'schedule'      => json_decode( get_post_meta( get_the_ID(), 'classly_schedule', true ), true ),
                    'type'          => get_the_terms( get_the_ID(), 'class_type' ),
                    'instructor'    => get_the_terms( get_the_ID(), 'instructor' ),
                ];

            }
        }

        // Reset.
        wp_reset_postdata();

        // Return.
        return $classes;

    }

    /**
     * Get schedule.
     * 
     * @since   1.0.0
     */
    public function get_schedule() {

        

    }

    /**
     * Get days.
     * 
     * @since   1.0.0
     */
    public function get_days( $classes ) {

        

    }

}