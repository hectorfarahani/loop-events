<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'WP_CLI' ) ) {
    WP_CLI::add_command( 'loop-events import', array( 'Loop_Events\Admin\Importer', 'import_sample_data') );
}
