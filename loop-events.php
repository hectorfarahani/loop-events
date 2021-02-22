<?php

/**
 * Plugin Name: Loop - Events
 * Description: A plugin to import and show events using a JSON file. Events are also exportable.
 * Version:     1.0.0
 * Author:      Hossein Farahani
 * Text Domain: loop-events
 * Domain Path: /languages
 */

namespace Loop_Events;

use Loop_Events\Front\Init as Front;
use Loop_Events\Admin\Init as Admin;
use Loop_Events\Init as Loader;
use Loop_Events\Assets;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once 'vendor/autoload.php';

register_activation_hook( __FILE__, '\Loop_Events\loop_events_activation_hook_callback' );

function loop_events_activation_hook_callback() {
	\Loop_Events\Init::activate();
}

register_deactivation_hook( __FILE__, '\Loop_Events\loop_events_deactivation_hook_callback' );

function loop_events_deactivation_hook_callback() {
	\Loop_Events\Init::deactivate();
}

Loader::instance();
Admin::instance();
Assets::instance();
Front::instance();
