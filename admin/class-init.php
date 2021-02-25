<?php

namespace Loop_Events\Admin;

use Loop_Events\Functions;

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
		add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );
		new Exporter();
	}

	public function assets( $hook ) {
		if ( 'settings_page_loop-events-settings' === $hook ) {
			wp_enqueue_style( 'loop-events-admin' );
			wp_enqueue_script( 'loop-events-admin' );
		}
	}

	public function add_submenu_page() {
		add_submenu_page(
			'options-general.php',
			__( 'Loop Events Settings', 'loop-events' ),
			__( 'Loop Events Settings', 'loop-events' ),
			'manage_options',
			'loop-events-settings',
			array( $this, 'renbder_settings_page' ),
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
					<label for="loop-events-json-import">
						<?php esc_html_e( 'Select a json file to import events.', 'loop-events' ); ?>
					</label>
						<input type="file" name="loop-events-json" id="loop-events-json" accept=".json">
						<button type="button" id="loop-events-json-import" class="button button-primary"><?php esc_html_e( 'Import', 'loop-events' ); ?></button>
				<?php wp_nonce_field( 'loop_events_settings' ); ?>
				</section>
				<section class="loop-events-settings">
					<h2><?php esc_html_e( 'Export:', 'loop-events' ); ?></h2>
					<button type="button" id="loop-events-json-export" class="button button-primary"><?php esc_html_e( 'Export existing data', 'loop-events' ); ?></button>
				</section>
			</div>
		</div>
		<?php
	}


}
