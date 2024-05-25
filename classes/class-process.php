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

        // Get grid.
        $grid = $this->grid( $this->days( $classes ), $this->times( $classes ), $classes );

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

                // Get time range.
                $range = $this->time_range( $data['start'], $data['end'] );

                // Loop through range.
                foreach( $range as $time ) {

                    // Check if time has 4 digits.
                    if( strlen( $time ) === 1 ) $time = '0' . $time;

                    // Check if time exists.
                    if( in_array( $time . ':00', (array)$times ) ) continue;

                    // Add to time.
                    $times[] = $time . ':00';

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
    public function grid( $days, $times, $classes ) {
        
        // Grid.
        $grid = [];

        // Loop through days.
        foreach( $days as $day ) {

            // Loop through times.
            foreach( $times as $time ) {

                // Set cell.
                $cell = [];

                // Loop through classes.
                foreach( $classes as $class ) {

                    // Get schedule.
                    $schedule = json_decode( get_post_meta( $class, 'classly_schedule', true ), true );

                    // Loop through schedule.
                    foreach( (array)$schedule as $data ) {

                        // Check day.
                        if( $data['day'] !== $day ) continue;

                        // Check start.
                        if( $data['start'] ) {

                            // Explode.
                            $hour = explode( ':', $data['start'] );

                            // Set start.
                            $start = $hour[0] . ':00';

                            // Check if time matches.
                            if( $start == $time ) {

                                // Set start and end.
                                $start = ( $hour[1] / 60 ) * 100;

                                // Add start.
                                $cell['start'] = $class . ',' . $start . ',' . $data['start'] . ',' . $data['end'];

                            }

                        }

                        // Check end.
                        if( $data['end'] ) {

                            // Explode.
                            $hour = explode( ':', $data['end'] );

                            // Set end.
                            $end = $hour[0] . ':00';

                            // Check if time matches.
                            if( $end == $time ) {

                                // Set end.
                                $end = ( $hour[1] / 60 ) * 100;

                                // Set class.
                                $cell['end'] = $class . ',' . $end;

                            }

                        }

                    }

                }

                // Add cell.
                $grid[$day][$time] = $cell;

                // Sort cell so end is first.
                ksort( $grid[$day][$time] );

            }

        }

        // Return.
        return $grid;

    }

    /**
     * Time range.
     * 
     * @since   1.0.0
     */
    public function time_range( $start, $end ) {

        // Set range.
        $range = [];

        // Explode start.
        $start = explode( ':', $start );

        // Explode end.
        $end = explode( ':', $end );

        // Set start.
        $range = range( $start[0], $end[0] );

        // Return.
        return $range;

    }

}