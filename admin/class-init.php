<?php

namespace Loop_Events\Admin;

use Loop_Events\Includes\Functions;

class Init {

	private static $instance = null;

	private function __construct() {
		$this->init();
	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new Init();
		}

		return self::$instance;
	}

	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );
		add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
	}

	public function assets( $hook ) {
		if ( 'toplevel_page_loop-events' === $hook ) {
			wp_enqueue_style( 'loop-events-admin' );
			wp_enqueue_script( 'loop-events-admin' );
		}
	}

	public function add_menu_page() {
		add_menu_page(
			__( 'Loop Events', 'loop-events' ),
			__( 'Loop Events', 'loop-events' ),
			'manage_options',
			'loop-events',
			array( $this, 'renbder_settings_page' ),
			'dashicons-calendar',
			23 // Between Pages and Comments.
		);
	}

	public function renbder_settings_page() {
		?>
		<div class="loop-events-admin-wrapper">
			<div class="loop-events-admin-header">
				<div class="loop-events-admin-title">
					<h1><?php esc_html_e( 'Loop Events', 'loop-events' ); ?></h1>
				</div>
			</div>
			<div class="loop-events-admin-main">
				<section class="loop-events-settings">
					<h2><?php esc_html_e( 'Import:', 'loop-events' ); ?></h2>

				<?php wp_nonce_field('loop_events_save_settings'); ?>
				</section>
			</div>
		</div>
		<?php
	}


}
