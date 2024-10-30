<?php

/**
 * Plugin Name: Mobile Blocks
 * Plugin URI: https://www.wpmobilemenu.com/mobile-blocks/
 * Description: Boost the user experience with dedicate mobile blocks. Keep your mobile visitors engaged.
 * Author: Takanakui
 * Version: 1.2.1
 * Author URI: https://www.wpmobilemenu.com/
 * Tested up to: 5.9
 * Text Domain: mobile-blocks
 * License: GPLv3
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'WP_Mobile_Blocks' ) ) {
	/**
	 * Main Mobile Blocks class
	 */
	class WP_Mobile_Blocks {
		public $mblocks_fs;
		public $mob_blocks_core;
		/**
		 * Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->init_mobile_blocks();
		}

		/**
		 * Init Mobile Blocks
		 *
		 * @since 1.0
		 */
		public function init_mobile_blocks() {

			// Init Freemius.
			$this->mblocks_fs = $this->mblocks_fs();
			// Uninstall Action.
			$this->mblocks_fs->add_action( 'after_uninstall', array( $this, 'mblocks_fs_uninstall_cleanup' ) );
			// Include Required files.
			$this->include_required_files();
			// Instanciate the Mobile Blocks Options.
			new WP_Mobile_Blocks_options();
			// Instanciate the Mobile Blocks Core Functions.
			$this->mob_blocks_core = new WP_Mobile_Blocks_Core();
			// Add the Mobile Blocks customizer settings.
			add_action( 'customize_register', array( $this->mob_blocks_core, 'mobile_blocks_customizer_settings' ) );

			// Load frontend assets.
			if ( ! is_admin() ) {
				$this->load_frontend_assets();
			}

		}

		/**
		 * Init Freemius Settings
		 *
		 * @since 1.0
		 */
		public function mblocks_fs() {
			global  $mblocks_fs ;

			if ( ! isset( $this->mblocks_fs ) ) {
				// Include Freemius SDK.
				require_once dirname( __FILE__ ) . '/freemius/start.php';
				$mblocks_fs = fs_dynamic_init( array(
					'id'                  => '2919',
					'slug'                => 'mobile-blocks',
					'type'                => 'plugin',
					'public_key'          => 'pk_7d5752b45f82d66e2b0fc939c8356',
					'is_premium'          => false,
					'has_addons'          => false,
					'has_paid_plans'      => false,
					'menu'                => array(
						'slug'           => 'mobile-blocks',
					),
				) );
			}

			return $mblocks_fs;
		}

		/**
		 * Include required files
		 *
		 * @since 1.0
		 */
		private function include_required_files() {
			require_once dirname( __FILE__ ) . '/includes/class-wp-mobile-blocks-core.php';
			require_once dirname( __FILE__ ) . '/includes/class-wp-mobile-blocks-options.php';
		}

		/**
		 * Load Frontend Assets
		 *
		 * @since 1.0
		 */
		private function load_frontend_assets() {

			if ( wp_is_mobile() && get_option( 'mb_enable_corner_button' ) ) {
				// Enqueue Html to the Footer.
				add_action( 'wp_footer', array( $this->mob_blocks_core, 'load_mobile_blocks_html_markup' ) );
				// Frontend Scripts.
				add_action( 'wp_enqueue_scripts', array( $this->mob_blocks_core, 'frontend_enqueue_scripts' ), 100 );
			}

		}
	}
}

// Instanciate the WP_Mobile_Blocks.
new WP_Mobile_Blocks();
