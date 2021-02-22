<?php

add_action( 'wp_ajax_loop_events_settings', 'loop_events_settings' );

function loop_events_settings() {

	check_ajax_referer( 'loop_events_settings', 'nonce' );

	$post_type = sanitize_text_field( $_POST['option'] );
	$value     = sanitize_text_field( $_POST['value'] );


}
