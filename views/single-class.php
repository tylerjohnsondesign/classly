<?php
/**
 * Class.
 * 
 * @since   1.0.0
 * @package Theme Boilerplate
 * @author  Built Mighty
 */
get_header(); ?>

	<main id="primary" class="site-main"><?php

        // Check for post(s).
		while( have_posts() ) {
			the_post();

			// Title.
			the_title( '<h1>', '</h1>' );

            // The content.
            the_content();

		} ?>

	</main><?php

get_footer();
