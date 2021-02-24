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

function loop_events_is_acf_active() {
	return function_exists( 'get_field' );
}

// Wrap ACF Related functions to avoid multiple checks for ACF existence and possible fatal errors in front-end.
function loop_events_get_field( $field, $default ) {
	if ( ! loop_events_is_acf_active() ) {
		return $default;
	}

	return get_field( $field );
}
