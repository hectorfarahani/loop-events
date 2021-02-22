<?php

namespace Loop_Events;

class Init {

	public static $instance = null;

	private function __construct() {
		new \Loop_Events\Post_Type();
		new \Loop_Events\Fields();
	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new Init();
		}

		return self::$instance;
	}

	// Create database and things.
	public static function activate() {
		flush_rewrite_rules();
	}

	public static function deactivate() {
		flush_rewrite_rules();
	}
}
