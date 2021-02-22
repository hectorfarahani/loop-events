<?php

namespace Loop_Events\Includes;

class Init {

	public static $instance = null;

	private function __construct() {

	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new Init();
		}

		return self::$instance;
	}

	// Create database and things.
	public static function activate() {
	}

	public static function deactivate() {

	}
}
