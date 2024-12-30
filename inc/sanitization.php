<?php

function sanitize_column_order( $input ) {

    error_log( 'Customizer callback is being called with '.$input );

    // Allow 1 to 4 values between 1 and 4, separated by hyphens (e.g., 1-2-3 or 1-4)
    if ( preg_match( '/^([1-4])(-[1-4])*(?:-[1-4])?$/', $input ) ) {
        return $input; // Return sanitized input if it matches
    } else {
        return '1-2-3-4'; // Default value if invalid
    }
}
  

function sanitize_checkbox( $input ) {
    return ( ( isset( $input ) && true === $input ) ? 1 : 0 );
}
