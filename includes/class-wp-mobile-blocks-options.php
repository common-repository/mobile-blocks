<?php

if ( ! class_exists( 'WP_Mobile_Blocks' ) ) {
	die;
}
class WP_Mobile_Blocks_options {
	public function __construct() {
		$this->init_options();
	}

	/**
	 * Init Options
	 */
	public function init_options() {
		add_action( 'admin_menu', array( $this, 'mob_blocks_admin_menu' ) );
	}

	/**
	 * Mobile Blocks Admin Menu.
	 */
	public function mob_blocks_admin_menu() {
		add_menu_page('Page title', 'Mobile Blocks', 'manage_options', 'mobile-blocks', array( $this, 'mob_blocks_options_page' ), 'dashicons-smartphone');
	}

	/**
	 * Mobile Blocks Admin Panel Content.
	 */
	public function mob_blocks_options_page() { 
		// Generate the redirect url.
		$url = add_query_arg( array( 'autofocus[section]' => 'mobile_blocks_section' ), admin_url( 'customize.php' ) );
		?>
		<h1>WP Mobile Blocks</h1><p class="admin-tagline"><?php printf( __( 'Welcome to WP Mobile Blocks. You\'re moments away to  start improving the mobile user engagment of your website! If this is your first time using the plugin, simply go to the WordPress Customizer (or click the button below) and adjust the settings in the <b>Mobile Blocks</b> section.', 'mobile-blocks' ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
		<p><a class="button button-primary" href="<?php echo $url; ?>" target="_self">Customize Mobile Blocks</a></p>
		<?php
	}
}
