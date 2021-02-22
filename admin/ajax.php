<?php

add_action( 'wp_ajax_loop_events_settings', 'loop_events_settings' );

function loop_events_settings() {

	check_ajax_referer( 'loop_events_settings', 'nonce' );

	if ( ! isset( $_POST['events'] ) || empty( $_POST['events'] ) ) {
		wp_send_json_error();
	}

	json_decode( $_POST['events'], true );

}
