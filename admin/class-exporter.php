<?php

namespace Loop_Events\Admin;

class Exporter {

	public static function download() {
		$post_data = array();

		$posts = get_posts(
			array(
				'post_type'      => LOOP_EVENTS_CPT_SLUG,
				'orderby'        => 'meta_value_num',
				'order'          => 'DESC',
				'posts_per_page' => -1,
				'status'         => 'any',
			)
		);

		foreach ( $posts as $post ) {
			$post_data[] = self::parse_data( $post );
		}

		return wp_json_encode( $post_data );
	}

	private static function parse_data( $post_data ) {
		$parsed_data = array(
			'id'        => $post_data->ID,
			'title'     => $post_data->post_title,
			'about'     => $post_data->post_content,
			'organizer' => loop_events_get_field( 'loop_events_organizer_name' ),
			'timestamp' => loop_events_get_field( 'loop_events_date_and_time' ),
			'isActive'  => $post_data->post_status,
			'email'     => loop_events_get_field( 'loop_events_organizer_email' ),
			'address'   => loop_events_get_field( 'loop_events_address' ),
			'latitude'  => loop_events_get_field( 'loop_events_map_location' ),
			'longitude' => loop_events_get_field( 'loop_events_map_location' ),
			'tags'      => array(),
		);

		return $parsed_data;
	}

}
