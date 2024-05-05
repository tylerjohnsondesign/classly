<?php
/**
 * Fields.
 * 
 * @since   1.0.0
 * @author  Built Mighty
 */
class classlyFields {

    /**
     * Construct.
     * 
     * @since   1.0.0
     */
    public function __construct() {

        // Actions.
        add_action( 'instructor_add_form_fields', [ $this, 'add_instructor_fields' ] );
        add_action( 'instructor_edit_form_fields', [ $this, 'edit_instructor_fields' ] );
        add_action( 'created_instructor', [ $this, 'save_instructor_fields' ] );
        add_action( 'edited_instructor', [ $this, 'save_instructor_fields' ] );

    }

    /**
     * Set instructor fields.
     * 
     * @since   1.0.0
     */
    public function instructor_fields() {

        // Define.
        $fields = [
            'position' => [
                'label'         => 'Position',
                'type'          => 'text',
                'description'   => 'Enter the instructor\'s position.'
            ],
            'image' => [
                'label'         => 'Image',
                'type'          => 'hidden',
                'description'   => 'Upload the instructor\'s image.'
            ],
            'email' => [
                'label'         => 'Email',
                'type'          => 'email',
                'description'   => 'Enter the instructor\'s email.'
            ],
            'facebook' => [
                'label'         => 'Facebook',
                'type'          => 'url',
                'description'   => 'Enter the instructor\'s Facebook URL.'
            ],
            'instagram' => [
                'label'         => 'Instagram',
                'type'          => 'url',
                'description'   => 'Enter the instructor\'s Instagram URL.'
            ],
        ];

        // Return.
        return $fields;

    }

    /**
     * Add instructor fields.
     * 
     * @since   1.0.0
     */
    public function add_instructor_fields() {

        // Get fields.
        $fields = $this->instructor_fields();

        // Loop through fields.
        foreach( $fields as $key => $field ) {

            // Value.
            $value = '';

            // Field. ?>
            <div class="form-field">
                <label for="<?php echo $key; ?>"><?php echo $field['label']; ?></label><?php

                // Check.
                if( $field['type'] == 'email' ) {

                    // Email. ?>
                    <input type="email" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php
                    
                } elseif( $field['type'] == 'url' ) {

                    // URL. ?>
                    <input type="url" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php

                } elseif( $field['type'] == 'text' ) {

                    // Text. ?>
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php

                } elseif( $field['type'] == 'hidden' ) {

                    // Text. ?>
                    <input type="hidden" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php

                    // Check if image.
                    if( $key == 'image' ) { ?>

                        <button class="upload_image_button button">Upload Image</button>
                        <button class="remove_image_button button" style="display:none;border-color:#d63638;color:#d63638;">Remove Image</button>
                        <img src="<?php echo $value; ?>" style="max-width:250px;display:block;margin:15px 0 0;"><?php

                    }

                } elseif( $field['type'] == 'select' ) {

                    // Select. ?>
                    <select name="<?php echo $key; ?>" id="<?php echo $key; ?>">
                        <option value=""><?php _e( 'Select...', 'classly' ); ?></option><?php

                        // Loop through options.
                        foreach( $field['options'] as $option ) { ?>

                            <option value="<?php echo $option; ?>" <?php selected( $value, $option ); ?>><?php echo $option; ?></option><?php

                        } ?>
                    </select><?php

                } else {

                    // Default. ?>
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php

                } ?>
                <p class="description"><?php echo $field['description']; ?></p>
            </div><?php

        }

    }

    /**
     * Edit instructor fields.
     * 
     * @since   1.0.0
     */
    public function edit_instructor_fields( $term ) {

        // Get fields.
        $fields = $this->instructor_fields();

        // Loop through fields.
        foreach( $fields as $key => $field ) {

            // Value.
            $value = get_term_meta( $term->term_id, $key, true ); ?>

            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="<?php echo $key; ?>"><?php echo $field['label']; ?></label>
                </th>
                <td><?php

                    // Check.
                    if( $field['type'] == 'email' ) {

                        // Email. ?>
                        <input type="email" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php
                        
                    } elseif( $field['type'] == 'url' ) {

                        // URL. ?>
                        <input type="url" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php

                    } elseif( $field['type'] == 'text' ) {

                        // Text. ?>
                        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php

                    } elseif( $field['type'] == 'hidden' ) {

                        // Text. ?>
                        <input type="hidden" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php

                        // Check if image.
                        if( $key == 'image' ) { ?>

                            <button class="upload_image_button button">Upload Image</button><?php

                            // Set style.
                            $style = ( $value ) ? 'display:inline-block;' : 'display:none;'; ?>

                            <button class="remove_image_button button" style="border-color:#d63638;color:#d63638;<?php echo $style; ?>">Remove Image</button>
                            <img src="<?php echo $value; ?>" style="max-width:250px;display:block;margin:15px 0 0;"><?php

                        }

                    } elseif( $field['type'] == 'select' ) {

                        // Select. ?>
                        <select name="<?php echo $key; ?>" id="<?php echo $key; ?>">
                            <option value=""><?php _e( 'Select...', 'classly' ); ?></option><?php

                            // Loop through options.
                            foreach( $field['options'] as $option ) { ?>

                                <option value="<?php echo $option; ?>" <?php selected( $value, $option ); ?>><?php echo $option; ?></option><?php

                            } ?>
                        </select><?php

                    } else {

                        // Default. ?>
                        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>"><?php

                    } ?>
                    <p class="description"><?php echo $field['description']; ?></p>
                </td>
            </tr><?php

        }

    }

    /**
     * Save instructor fields.
     * 
     * @since   1.0.0
     */
    public function save_instructor_fields( $term_id ) {

        // Get fields.
        $fields = $this->instructor_fields();

        // Loop through fields.
        foreach( $fields as $key => $field ) {

            // Check.
            if( isset( $_POST[$key] ) ) {

                // Update.
                update_term_meta( $term_id, $key, sanitize_text_field( $_POST[$key] ) );

            } else {

                // Delete.
                delete_term_meta( $term_id, $key );

            }

        }

    }

}