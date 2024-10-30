<?php

if ( ! class_exists( 'WP_Mobile_Blocks' ) ) {
	die;
}
class WP_Mobile_Blocks_Core {
	public function __construct() {
	}

	/***
	 * Frontend Scripts.
	 */
	public function frontend_enqueue_scripts() {
			wp_enqueue_style( 'mobileblockscss', plugins_url( 'css/mobile-blocks.css', __FILE__ ) );

			// Filters.
			add_filter( 'wp_head', array( $this, 'load_dynamic_css_style' ) );

	}

	/***
	 * Load dynamic css
	 */
	public function load_dynamic_css_style() {
		echo '<style type="text/css" id="mobile-blocks-css">';
		echo '.mblocks-corner-button {background-color: ' . get_option( 'mb_button_bg_color', '#222' ) . ';width: ' . get_option( 'mb_button_height', '40' ) . 'px; height: ' . get_option( 'mb_button_height', '40' ) . 'px; }';
		echo '.mblocks-corner-button a {color: ' . get_option( 'mb_button_text_color', '#FFF' ) . '; line-height: ' . get_option( 'mb_button_height', '40' )/2 . 'px;}';
		echo '</style>';
	}

	/***
	 * Build the WP Mobile Blocks Html Markup.
	 */
	public function load_mobile_blocks_html_markup() {

		$output = '<div class="mblocks-corner-button"> <a href="' . esc_url( get_option( 'mb_button_target', '#' ) ) . '">' . get_option( 'mb_corner_button_text' ) . '</a></div>';
		echo $output;

	}
	/***
	 * Build the Mobile Blocks Customizer settings.
	 */
	public function mobile_blocks_customizer_settings( $wp_customize ) {

		// Adding Mobile Blocks section in WordPress customizer.
		$wp_customize->add_section('mobile_blocks_section', array(
			'title' => __( 'Mobile Blocks', 'mobile-blocks' ),
		));

		// Adding setting for the mobile buy now text.
		$wp_customize->add_setting('mb_enable_corner_button', array(
			'default' => __( 'off', 'mobile-blocks' ),
			'type'    => 'option',
		));

		// Adding control for the mobile buy now text.
		$wp_customize->add_control('mb_enable_corner_button', array(
			'label'   => 'Enable Button Corner Block',
			'section' => 'mobile_blocks_section',
			'type'    => 'radio',
			'choices' => array(
				'on' => __( 'On' ),
				'off' => __( 'Off' ),
				),
		));

		// Adding setting for the mobile button text.
		$wp_customize->add_setting('mb_corner_button_text', array(
			'default' => __( 'Go', 'mobile-blocks' ),
			'type'    => 'option',
		));

		// Adding control for the mobile button text.
		$wp_customize->add_control('mb_corner_button_text', array(
			'label'   => 'Button Block Text',
			'section' => 'mobile_blocks_section',
			'type'    => 'text',
		));

		// Adding setting for the mobile button target.
		$wp_customize->add_setting('mb_button_target', array(
			'default' => '#',
			'type'    => 'option',
		));

		// Adding control for the mobile button target.
		$wp_customize->add_control('mb_button_target', array(
			'label'   => 'Button URL',
			'section' => 'mobile_blocks_section',
			'type'    => 'text',
		));

		// Adding setting for the mobile button height.
		$wp_customize->add_setting('mb_button_height', array(
			'default' => 40,
			'type'    => 'option',
		));

		// Adding control for the mobile button height.
		$wp_customize->add_control( 'mb_button_height', array(
			'label'   => 'Button Size (pixels)',
			'section' => 'mobile_blocks_section',
			'type'    => 'number',
		));

		// Adding setting for the mobile button background color.
		$wp_customize->add_setting('mb_button_bg_color', array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'option',
		));

		// Adding control for the mobile button background color.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'mb_button_bg_color',
				array(
					'label'    => __( 'Button Background Color', 'mobile-blocks' ),
					'section'  => 'mobile_blocks_section',
					'priority' => 10,
				)
			)
		);

		// Adding setting for the mobile button text color.
		$wp_customize->add_setting('mb_button_text_color', array(
			'default'           => '#fffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'option',
		));

		// Adding control for the mobile button text color.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'mb_button_text_color',
				array(
					'label'    => __( 'Button Text Color', 'mobile-blocks' ),
					'section'  => 'mobile_blocks_section',
					'priority' => 10,
				)
			)
		);
	}
}
