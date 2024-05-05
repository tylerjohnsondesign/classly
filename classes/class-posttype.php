<?php
/**
 * Custom Post Types.
 * 
 * @since   1.0.0
 * @author  Built Mighty
 */
class classlyPostType {

    /**
     * Construct.
     * 
     * @since   1.0.0
     */
    public function __construct() {

        // Actions.
        add_action( 'init', [ $this, 'register' ], 0 );

    }

    /**
     * Define.
     * 
     * @since   1.0.0
     */
    public function define() {

        // Set post types.
        $post_types = [
            'class'   => [
                'singular'  => 'class',
                'plural'    => 'classes',
                'args'      => [
                    'label'                 => __( 'Classes', CLASSLY_DOMAIN ),
                    'description'           => __( 'Classes Description', CLASSLY_DOMAIN ),
                    'supports'              => [ 'title', 'editor', 'thumbnail' ],
                    'taxonomies'            => [ 'class-type', 'instructor' ],
                    'hierarchical'          => false,
                    'public'                => true,
                    'show_ui'               => true,
                    'show_in_menu'          => true,
                    'menu_icon'             => 'dashicons-calendar-alt',
                    'menu_position'         => 20,
                    'show_in_admin_bar'     => false,
                    'show_in_nav_menus'     => false,
                    'can_export'            => true,
                    'has_archive'           => false,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'capability_type'       => 'page',
                ],
            ],
        ];

        // Return.
        return $post_types;

    }

    /**
     * Taxonomy.
     * 
     * @since   1.0.0
     */
    public function taxonomy() {

        // Set taxonomies.
        $taxonomies = [
            'class_type'   => [
                'singular'      => 'class type',
                'plural'        => 'class types',
                'post_types'    => [ 'class' ],
                'args'          => [
                    'label'                 => __( 'Class Type', CLASSLY_DOMAIN ),
                    'description'           => __( 'Class Type Description', CLASSLY_DOMAIN ),
                    'public'                => true,
                    'hierarchical'          => true,
                    'show_ui'               => true,
                    'show_in_menu'          => true,
                    'show_in_nav_menus'     => true,
                    'show_tagcloud'         => true,
                    'show_in_quick_edit'    => true,
                    'show_admin_column'     => true,
                    'rewrite'               => [
                        'slug'              => 'class-type',
                        'with_front'        => true,
                        'hierarchical'      => true,
                    ],
                ],
            ],
            'instructor'   => [
                'singular'      => 'instructor',
                'plural'        => 'instructors',
                'post_types'    => [ 'class' ],
                'args'          => [
                    'label'                 => __( 'Instructor', CLASSLY_DOMAIN ),
                    'description'           => __( 'Instructor Description', CLASSLY_DOMAIN ),
                    'public'                => true,
                    'hierarchical'          => true,
                    'show_ui'               => true,
                    'show_in_menu'          => true,
                    'show_in_nav_menus'     => true,
                    'show_tagcloud'         => true,
                    'show_in_quick_edit'    => true,
                    'show_admin_column'     => true,
                    'rewrite'               => [
                        'slug'              => 'instructor',
                        'with_front'        => true,
                        'hierarchical'      => true,
                    ],
                ],
            ],
        ];

        // Return.
        return $taxonomies;

    }

    /**
     * Register.
     * 
     * @since   1.0.0
     */
    public function register() {

        // Loop through post types.
        foreach( $this->define() as $post_type => $type ) {

            // Set labels.
            $labels = [
                'name'                  => _x( ucwords( $type['singular'] ), 'Post Type General Name', CLASSLY_DOMAIN ),
                'singular_name'         => _x( ucwords( $type['singular'] ), 'Post Type Singular Name', CLASSLY_DOMAIN ),
                'menu_name'             => __( ucwords( $type['plural'] ), CLASSLY_DOMAIN ),
                'name_admin_bar'        => __( ucwords( $type['singular'] ), CLASSLY_DOMAIN ),
                'archives'              => __( ucwords( $type['singular'] ) . ' Archives', CLASSLY_DOMAIN ),
                'attributes'            => __( ucwords( $type['singular'] ) . ' Attributes', CLASSLY_DOMAIN ),
                'parent_item_colon'     => __( 'Parent ' . ucwords( $type['singular'] ) . ':', CLASSLY_DOMAIN ),
                'all_items'             => __( 'All ' . ucwords( $type['plural'] ), CLASSLY_DOMAIN ),
                'add_new_item'          => __( 'Add New ' . ucwords( $type['singular'] ), CLASSLY_DOMAIN ),
                'add_new'               => __( 'Add New', CLASSLY_DOMAIN ),
                'new_item'              => __( 'New ' . ucwords( $type['singular'] ), CLASSLY_DOMAIN ),
                'edit_item'             => __( 'Edit ' . ucwords( $type['singular'] ), CLASSLY_DOMAIN ),
                'update_item'           => __( 'Update ' . ucwords( $type['singular'] ), CLASSLY_DOMAIN ),
                'view_item'             => __( 'View ' . ucwords( $type['singular'] ), CLASSLY_DOMAIN ),
                'view_items'            => __( 'View ' . ucwords( $type['plural'] ), CLASSLY_DOMAIN ),
                'search_items'          => __( 'Search ' . ucwords( $type['singular'] ), CLASSLY_DOMAIN ),
                'not_found'             => __( 'Not found', CLASSLY_DOMAIN ),
                'not_found_in_trash'    => __( 'Not found in Trash', CLASSLY_DOMAIN ),
                'featured_image'        => __( 'Featured Image', CLASSLY_DOMAIN ),
                'set_featured_image'    => __( 'Set featured image', CLASSLY_DOMAIN ),
                'remove_featured_image' => __( 'Remove featured image', CLASSLY_DOMAIN ),
                'use_featured_image'    => __( 'Use as featured image', CLASSLY_DOMAIN ),
                'insert_into_item'      => __( 'Insert into ' . $type['singular'], CLASSLY_DOMAIN ),
                'uploaded_to_this_item' => __( 'Uploaded to this ' . $type['singular'], CLASSLY_DOMAIN ),
                'items_list'            => __( ucwords( $type['singular'] ) . ' list', CLASSLY_DOMAIN ),
                'items_list_navigation' => __( ucwords( $type['singular'] ) . ' list navigation', CLASSLY_DOMAIN ),
                'filter_items_list'     => __( 'Filter ' . $type['plural'] . ' list', CLASSLY_DOMAIN ),
            ];

            // Add labels. 
            $type['args']['labels'] = $labels;

            // Register post type.
            register_post_type( $post_type, $type['args'] );

        }

        // Loop through taxonomies.
        foreach( $this->taxonomy() as $taxonomy => $tax ) {

            // Set labels.
            $labels = [
                'name'                       => _x( ucwords( $tax['singular'] ), 'Taxonomy General Name', 'text_domain' ),
                'singular_name'              => _x( ucwords( $tax['singular'] ), 'Taxonomy Singular Name', 'text_domain' ),
                'menu_name'                  => __( ucwords( $tax['singular'] ), 'text_domain' ),
                'all_items'                  => __( 'All ' . ucwords( $tax['plural'] ), 'text_domain' ),
                'parent_item'                => __( 'Parent ' . ucwords( $tax['singular'] ), 'text_domain' ),
                'parent_item_colon'          => __( 'Parent ' . ucwords( $tax['singular'] ) . ':', 'text_domain' ),
                'new_item_name'              => __( 'New ' . ucwords( $tax['singular'] ) . ' Name', 'text_domain' ),
                'add_new_item'               => __( 'Add New ' . ucwords( $tax['singular'] ), 'text_domain' ),
                'edit_item'                  => __( 'Edit ' . ucwords( $tax['singular'] ), 'text_domain' ),
                'update_item'                => __( 'Update ' . ucwords( $tax['singular'] ), 'text_domain' ),
                'view_item'                  => __( 'View ' . ucwords( $tax['singular'] ), 'text_domain' ),
                'separate_items_with_commas' => __( 'Separate ' . $tax['singular'] . ' with commas', 'text_domain' ),
                'add_or_remove_items'        => __( 'Add or remove ' . $tax['plural'], 'text_domain' ),
                'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
                'popular_items'              => __( 'Popular ' . ucwords( $tax['plural'] ), 'text_domain' ),
                'search_items'               => __( 'Search ' . ucwords( $tax['plural'] ), 'text_domain' ),
                'not_found'                  => __( 'Not Found', 'text_domain' ),
                'no_terms'                   => __( 'No ' . $tax['plural'], 'text_domain' ),
                'items_list'                 => __( ucwords( $tax['plural'] ) . ' list', 'text_domain' ),
                'items_list_navigation'      => __( ucwords( $tax['plural'] ) . ' list navigation', 'text_domain' ),
            ];

            // Add labels to args.
            $tax['args']['labels'] = $labels;
            
            // Register taxonomy.
            register_taxonomy( $taxonomy, $tax['post_types'], $tax['args'] );

        }

    }

}