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
