<?php

function loop_events_get_option( string $option, $default = null ) {
	$options = get_option( 'loop_events_config', array() );
	return $options[ $option ] ?? $default;
}

function loop_events_update_option( $option, $new_value ) {
	$config            = get_option( 'loop_events_config', array() );
	$config[ $option ] = $new_value;
	return update_option( 'loop_events_config', $config );
}

// Wrap ACF Related functions to avoid multiple checks for ACF existence.
function loop_events_get_field( $field, $default ) {
	// Check for ACF, return default if ACF is not exists or field has no value yet.
	// Get field from ACF functions.
	// Return Field or default.
}
