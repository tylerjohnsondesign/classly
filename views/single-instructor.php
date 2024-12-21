<?php
/**
 * Instructor.
 * 
 * @since   1.0.0
 * @package Theme Boilerplate
 * @author  Built Mighty
 */
get_header(); ?>

	<main id="primary" class="site-main"><?php

        // Get term object.
        $term = get_queried_object();

        // Get term meta.
        $meta = get_term_meta( $term->term_id );

        // Term title. ?>
        <h1><?php echo $term->name; ?></h1><?php

        // Check for position.
        if( ! empty( get_term_meta( $term->term_id, 'position', true ) ) ) { 
            
            // Position. ?>
            <h5><?php echo get_term_meta( $term->term_id, 'position', true ); ?></h5><?php

        } ?>
        <div class="classly-instructor-content">
            <div class="classly-instructor-main"><?php

                // Content.
                echo  wpautop( $term->description ); ?>

            </div>
            <div class="classly-instructor-side"><?php

                // Check for image.
                if( ! empty( get_term_meta( $term->term_id, 'image', true ) ) ) {

                    // Image. ?>
                    <div class="classly-instructor-image">
                        <img src="<?php echo get_term_meta( $term->term_id, 'image', true ); ?>" alt="<?php echo $term->name; ?>">
                    </div><?php

                }
                
                // Check for email, Facebook, or Instagram. 
                if( ! empty( get_term_meta( $term->term_id, 'email', true ) ) || ! empty( get_term_meta( $term->term_id, 'facebook', true ) ) || ! empty( get_term_meta( $term->term_id, 'instagram', true ) ) ) {
                    
                    // Social. ?>
                    <div class="classly-instructor-social"><?php

                        // Set networks.
                        $networks = [ 'facebook', 'instagram', 'email' ];

                        // Loop.
                        foreach( $networks as $network ) {

                            // Check for network.
                            if( ! empty( get_term_meta( $term->term_id, $network, true ) ) ) {
                                
                                // Set link.
                                $link = ( $network !== 'email' ) ? get_term_meta( $term->term_id, $network, true ) : 'mailto:' . get_term_meta( $term->term_id, $network, true ); ?>

                                <a href="<?php echo  $link; ?>" class="classly-instructor-network class-instructor-<?php echo $network; ?>" target="_blank"><?php include CLASSLY_PATH . 'assets/images/' . $network . '.svg'; ?></a><?php

                            }

                        } ?>

                    </div><?php

                } ?>

            </div>
        </div>
	</main><?php

get_footer();
