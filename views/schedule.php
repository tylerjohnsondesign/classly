<?php
/**
 * Schedule.
 * 
 * @since   1.0.0
 */ 

// Get classes.
$classes = $process->get_classes();
$types   = $process->get_types(); ?>
<div class="classly-filtering">
    <div class="classly-filter">
        <button class="classly-filter-button classly-filter-active" data-id="all">All</button>
    </div><?php

    // Loop through types.
    foreach( $types as $type ) {

        // Output. ?>
        <div class="classly-filter">
            <button class="classly-filter-button" data-id="<?php echo $type->slug; ?>"><?php echo $type->name; ?></button>
        </div><?php

    } ?>

</div>
<div class="classly-schedule">
    <div class="classly-modules">
        <div class="classly-times"><?php

            // Get the times.
            $times = array_slice( $classes, 0, 1, true );
            $times = reset( $times );

            // Add empty block. ?>
            <div class="classly-time classly-empty"></div><?php

            // Loop through times.
            foreach( $times as $time => $values ) {

                // Convert time to 12 hour format.
                $time = date( 'g:iA', strtotime( $time ) );

                // Output. ?>
                <div class="classly-time">
                    <div class="classly-time__label"><?php echo $time; ?></div>
                </div><?php

            } ?>

        </div>
        <div class="classly-grid classly-grid-<?php echo count( $classes ); ?>"><?php

            // Loop through days.
            foreach( $classes as $day => $slots ) {

                // Output. ?>
                <div class="classly-column">
                    <div class="classly-cell classly-day">
                        <div class="classly-day__label"><?php echo ucwords( $day ); ?></div>
                    </div><?php

                    // Loop through slots.
                    foreach( $slots as $slot ) {

                        // Check if empty.
                        if( empty( $slot ) ) {

                            // Output empty. ?>
                            <div class="classly-cell classly-empty"></div><?php

                        } else {

                            // Explode.
                            if( ! empty( $slot['start'] ) ) {

                                // Set start.
                                $start = explode( ',', $slot['start'] );

                                // Get terms.
                                $terms = $process->get_types( $start[0] );

                                // Get slugs.
                                $slugs = wp_list_pluck( $terms, 'slug' );

                                // Set classes.
                                $classes = 'classly-' . implode( ' classly-', $slugs );

                            }

                            // Output class. ?>
                            <div class="classly-cell classly-class"><?php

                                // Check end.
                                if( ! empty( $slot['end'] ) ) {

                                    // Set end.
                                    $end = explode( ',', $slot['end'] );

                                    // Output. ?>
                                    <div class="classly-single classly-single-end" style="display:none !important;">
                                        <a href="<?php echo get_permalink( $end[0] ); ?>">
                                            <p style="display:none"><?php echo get_the_title( $end[0] ); ?></p>
                                        </a>
                                    </div><?php
                                    
                                }

                                // Check for start.
                                if( ! empty( $slot['start'] ) ) {

                                    // Set start.
                                    $start = explode( ',', $slot['start'] );

                                    // Set start and end times.
                                    $start_time = date( 'g:iA', strtotime( $start[2] ) );
                                    $end_time = date( 'g:iA', strtotime( $start[3] ) );

                                    // Output. ?>
                                    <div class="classly-single classly-single-start<?php echo ' ' . $classes; ?>" style="top:<?php echo $start[1]; ?>%;height:<?php echo $start[4];?>%;">
                                        <a href="<?php echo get_permalink( $start[0] ); ?>">
                                            <p class="classly-class-title"><?php echo get_the_title( $start[0] ); ?></p>
                                            <p class="classly-class-time"><?php echo $start_time . '-' . $end_time; ?></p>
                                        </a>
                                    </div><?php

                                } ?>

                            </div><?php

                        }

                    } ?>

                </div><?php

            } ?>

        </div>
    </div>
</div>