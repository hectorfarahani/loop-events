<?php

namespace Loop_Events;

class Post_Type {
	public function __construct() {
		 add_action( 'init', array( $this, 'register_post_type' ) );
		 add_action( 'init', array( $this, 'register_taxonomies' ) );
	}

	public function register_post_type() {

		$labels = array(
			'name'                  => _x( 'Events', 'Post type general name', 'loop-events' ),
			'singular_name'         => _x( 'Event', 'Post type singular name', 'loop-events' ),
			'menu_name'             => _x( 'Events', 'Admin Menu text', 'loop-events' ),
			'name_admin_bar'        => _x( 'Event', 'Add New on Toolbar', 'loop-events' ),
			'add_new'               => __( 'Add New', 'loop-events' ),
			'add_new_item'          => __( 'Add New Event', 'loop-events' ),
			'new_item'              => __( 'New Event', 'loop-events' ),
			'edit_item'             => __( 'Edit Event', 'loop-events' ),
			'view_item'             => __( 'View Event', 'loop-events' ),
			'all_items'             => __( 'All Events', 'loop-events' ),
			'search_items'          => __( 'Search Events', 'loop-events' ),
			'parent_item_colon'     => __( 'Parent Events:', 'loop-events' ),
			'not_found'             => __( 'No events found.', 'loop-events' ),
			'not_found_in_trash'    => __( 'No events found in Trash.', 'loop-events' ),
			'insert_into_item'      => _x( 'Insert into event', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'loop-events' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this event', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'loop-events' ),
			'filter_items_list'     => _x( 'Filter events list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'loop-events' ),
			'items_list_navigation' => _x( 'Events list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'loop-events' ),
			'items_list'            => _x( 'Events list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'loop-events' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_in_rest'       => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'menu_icon'          => 'dashicons-calendar',
			'supports'           => array( 'title', 'editor', 'author' ),
			'taxonomies'         => array( 'loop-event-tags' ),
		);

		register_post_type( LOOP_EVENTS_CPT_SLUG, $args );
	}

	public function register_taxonomies() {
		register_taxonomy( LOOP_EVENTS_CPT_SLUG . '-tags', LOOP_EVENTS_CPT_SLUG, array() );
	}
}
