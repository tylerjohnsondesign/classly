<?php
/**
 * Process.
 * 
 * @since   1.0.0
 * @author  Built Mighty
 */
class classlyProcess {

    /** 
     * Get classes.
     * 
     * @since   1.0.0
     */
    public function get_classes() {

        // Query.
        $classes = $this->query();

        // Get days.
        $days = $this->days( $classes );

        // Get times.
        $times = $this->times( $classes );

        // Get grid.
        $grid = $this->grid( $classes, $days, $times );

        // Return.
        return $grid;

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
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                // Add class.
                $classes[] = get_the_ID();

            }

        }

        // Reset.
        wp_reset_postdata();

        // Return.
        return $classes;

    }

    /** 
     * Process days.
     * 
     * @since   1.0.0
     */
    public function days( $classes ) {

        // Days.
        $days = [];

        // Loop through classes.
        foreach( $classes as $class ) {

            // Get schedule.
            $schedule = json_decode( get_post_meta( $class, 'classly_schedule', true ), true );

            // Loop through schedule.
            foreach( (array)$schedule as $data ) {

                // Check if day exists.
                if( in_array( $data['day'], (array)$days ) ) continue;

                // Get day number.
                $num = date( 'N', strtotime( $data['day'] ) );

                // Add day.
                $days[$num] = $data['day'];

            }

        }

        // Sort days.
        ksort( $days );

        // Return.
        return $days;

    }

    /**
     * Get times.
     * 
     * @since   1.0.0
     */
    public function times( $classes ) {

        // Times.
        $times = [];

        // Loop through classes.
        foreach( $classes as $class ) {

            // Get schedule.
            $schedule = json_decode( get_post_meta( $class, 'classly_schedule', true ), true );

            // Loop through schedule.
            foreach( (array)$schedule as $data ) {

                // Check start.
                if( $data['start'] ) {

                    // Explode.
                    $hour = explode( ':', $data['start'] );

                    // Set hour.
                    $time = $hour[0] . ':00';

                    // Check if time exists.
                    if( in_array( $time, (array)$times ) ) continue;

                    // Add to time.
                    $times[] = $time;

                }

                // Check end.
                if( $data['end'] ) {

                    // Explode.
                    $hour = explode( ':', $data['end'] );

                    // Set time.
                    $time = $hour[0] . ':00';

                    // Check minutes.
                    if( $hour[1] !== '00' ) {

                        // Add hour.
                        $time = ( $hour[0] + 1 ) . ':00';

                    }

                    // Check if missing leading zero.
                    if( strlen( $time ) == 4 ) {

                        // Add zero.
                        $time = ( ( $hour[0] + 1 ) > 9 ) ? $time : '0' . $time;

                    }

                    // Check if time exists.
                    if( in_array( $time, (array)$times ) ) continue;

                    // Add to time.
                    $times[] = $time;

                }

            }

        }

        // Sort times.
        sort( $times );

        // Return.
        return $times;

    }

    /**
     * Grid.
     * 
     * @since   1.0.0
     */
    public function grid( $classes, $days, $times ) {
        
        // Grid.
        $grid = [];

        // Loop through days.
        

        // Return.
        return $grid;

    }

}