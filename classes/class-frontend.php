<?php
/**
 * Frontend.
 * 
 * @since   1.0.0
 * @author  Built Mighty
 */
class classlyFrontend {

    /**
     * Construct.
     * 
     * @since   1.0.0
     */
    public function __construct() {

        // Filters.
        add_filter( 'template_include', [ $this, 'template' ] );

    }

    /**
     * Template.
     * 
     * @param  string  $template
     * 
     * @since   1.0.0
     */
    public function template( $template ) {

        // Check post type.
        if( ! is_singular( 'class' ) ) return $template;

        // Check if template exists within theme.
        if( file_exists( get_stylesheet_directory() . '/classly/single-class.php' ) ) return get_stylesheet_directory() . '/classly/single-class.php';

        // Check if template exists.
        if( file_exists( CLASSLY_PATH . 'views/single-class.php' ) ) return CLASSLY_PATH . 'views/single-class.php';

    }

}