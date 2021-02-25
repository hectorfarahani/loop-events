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

add_action( 'pre_get_posts', 'loop_events_reorder_archive' );

function loop_events_reorder_archive( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return $query;
	}

	if ( isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] === LOOP_EVENTS_CPT_SLUG ) {
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'meta_key', 'loop_events_date_and_time' );
		$query->set( 'meta_type', 'numeric' );
		$query->set( 'order', 'DESC' );
	}

	return $query;

}

add_filter( 'acf/update_value/name=loop_events_date_and_time', 'loop_events_acf_save_as_timestamp');
add_filter( 'acf/load_value/name=loop_events_date_and_time', 'loop_events_acf_save_as_timestamp' );

function loop_events_acf_save_as_timestamp( $value ) {
	if ( $value &&  $value != (int) $value ) {
		return strtotime( $value );
	}

	return $value;
}
