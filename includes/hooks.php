<?php

add_filter( 'mime_types', 'loop_events_mime_types' );

function loop_events_mime_types( $mime_types ) {
	$mime_types['json'] = 'application/json';
	return $mime_types;
}

add_filter( 'template_include', 'loop_events_template_loader' );

function loop_events_template_loader( $template ) {
	if ( is_post_type_archive( 'loop-event' ) ) {
		// We can let user load templates from theme by checking it using locate template function.
		return LOOP_EVENTS_PATH . '/front/templates/archive-loop-event.php';
	}

	if ( is_singular( 'loop-event' ) ) {
		// We can let user load templates from theme by checking it using locate template function.
		return LOOP_EVENTS_PATH . '/front/templates/single-loop-event.php';
	}

	return $template;
}