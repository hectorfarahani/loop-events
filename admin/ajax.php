<?php

add_action( 'wp_ajax_loop_events_settings', 'loop_events_settings' );

function loop_events_settings() {

	check_ajax_referer( 'loop_events_settings', 'nonce' );

	if ( ! isset( $_FILES['events'] ) || empty( $_FILES['events'] ) ) {
		wp_send_json_error( array( 'message' => __( 'Please select a file!' ) ) );
	}

	$file = file_get_contents( $_FILES['events']['tmp_name'] );

	$contents = json_decode( $file, true );

	if ( ! is_array( $contents ) || ! count( $contents ) ) {
		wp_send_json_error( array( 'message' => __( 'Invalid File!' ) ) );
	}

	if ( ! loop_events_is_acf_active() ) {
		wp_send_json_error( array( 'message' => __( 'Please activate ACF before importing events data!' ) ) );
	}

	$result = new \Loop_Events\Admin\Importer( $contents );

	if ( $result ) {
		wp_send_json_success( $result );
	}

}
