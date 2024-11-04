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
			
			// Main content. ?>
			<div class="classly-single-content">
				<div class="classly-single-main"><?php

					// The content.
					the_content(); ?>

				</div>
				<div class="classly-single-side"><?php

					// Get instructor(s).
					$instructors = get_the_terms( get_the_ID(), 'instructor' );

					// Check for instructor(s).
					if( ! empty( $instructors ) ) { ?>

						<div class="classly-single-instructors">
							<h5>Instructors</h5>
							<ul><?php

								// Loop.
								foreach( $instructors as $instructor ) {

									// Get term link.
									$link = get_term_link( $instructor );

									// Output. ?>
									<li><a href="<?php echo $link; ?>"><?php echo $instructor->name; ?></a></li><?php

								} ?>

							</ul>
						</div><?php

					}
					
					// Get types.
					$types = get_the_terms( get_the_ID(), 'class_type' );
					
					// Check for types.
					if( ! empty( $types ) ) {
						
						// Get names.
						$names = wp_list_pluck( $types, 'name' );?>

						<div class="classly-single-classtypes">
							<h5>Class Type</h5>
							<?php echo ucwords( implode( ', ', $names ) ); ?>
						</div><?php
						
					} ?>
				
				</div><?php

			} ?>

		</div>
	</main><?php

get_footer();
