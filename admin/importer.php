<?php

namespace Loop_Events\Admin;

class Importer {
	private $count = 0;

	public function __construct( $raw_data ) {

		$this->count = count( $raw_data );
		foreach ( $raw_data as $event_data ) {
			$data        = $this->parse_data( $event_data );
			$post_args   = $this->prepare_post_data( $data );
			$post_fields = $this->prepare_post_fields( $data );
			$this->import_post( $post_args, $post_fields );
		}

		return true;
	}

	public function get_count() {
		return $this->count;
	}

	private function import_post( $post_args, $post_fields ) {
		$post_id = wp_insert_post( $post_args, true );
		$this->insert_post_fields( $post_id, $post_fields );
	}

	private function insert_post_fields( $post_id, $post_fields ) {
		foreach ( $post_fields as $key => $value ) {
			update_field( $key, $value, $post_id );
		}
	}

	private function parse_data( $raw_data ) {
		$defaults = array(
			'id'        => '0',
			'title'     => '',
			'about'     => '',
			'organizer' => '',
			'timestamp' => '',
			'isActive'  => false,
			'email'     => '',
			'address'   => '',
			'latitude'  => 0,
			'longitude' => 0,
			'tags'      => array(),
		);

		return wp_parse_args( $raw_data, $defaults );

	}

	private function prepare_post_data( $data ) {

		$post_data = array(
			'post_content' => $data['about'],
			'post_title'   => wp_strip_all_tags( $data['title'] ),
			'post_status'  => $data['isActive'] ? 'publish' : 'draft',
			'post_type'    => LOOP_EVENTS_CPT_SLUG,
			'tax_input'    => array(
				LOOP_EVENTS_CPT_SLUG . '-tags' => $data['tags'],
			),
		);

		if ( get_post( $data['id'] ) ) {
			$post_data['ID'] = $data['id'];
		}

		return $post_data;
	}

	private function prepare_post_fields( $data ) {
		return array(
			'organizer_name'  => $data['organizer'],
			'organizer_email' => $data['email'],
			'date_and_time'   => $data['timestamp'],
			'address'         => $data['address'],
			'map_location'    => array(
				'center_lat' => $data['latitude'],
				'center_lng' => $data['longitude'],
			),
		);
	}


}
