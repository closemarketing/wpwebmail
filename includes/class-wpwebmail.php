<?php
/**
 * Class for plugin
 *
 * Functions to show Admin
 *
 * @package    WordPress
 * @author     David Perez <david@closemarketing.es>
 * @copyright  2020 Closemarketing
 * @version    1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class.
 *
 * Functions.
 *
 * @since 1.0
 */
class WPWebmail {

	/**
	 * Construct of Class
	 */
	public function __construct() {
		// Options to save.
		add_action( 'admin_init', array( $this, 'wpw_general_section' ) );

		// Create custom plugin settings menu.
		add_action( 'admin_menu', array( $this, 'plugin_create_menu' ) );
	}

	/**
	 * # Functions
	 * ---------------------------------------------------------------------------------------------------- */


	/**
	 * Opciones generales
	 *
	 * @return void
	 */
	public function wpw_general_section() {
		add_settings_section(
			'wpw_options',
			esc_html__( 'Webmail Integration options' , 'wpwebmail' ),
			array( $this, 'wpw_section_options_callback' ),
			'general'
		);

		// Option Webmail URL.
		add_settings_field(
			'wpw_webmail_url',
			esc_html__( 'URL from webmail', 'wpwebmail' ),
			array( $this, 'wpw_textbox_callback' ),
			'general',
			'wpw_options',
			array(
				'wpw_webmail_url',
			)
		);

		register_setting( 'general', 'wpw_webmail_url', 'esc_attr' );
	}

	/**
	 * Descripción de la sección
	 *
	 * @return void
	 */
	public function wpw_section_options_callback() {
		echo '<p>' . esc_html__( 'Write the url from your Webmail.', 'wpwebmail' ) . '</p>';
	}

	/**
	 * Input options for the field
	 *
	 * @param array $args Arguments of field.
	 * @return void
	 */
	public function wpw_textbox_callback( $args ) {
		$option = get_option( $args[0] );

		echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '"  style="min-width: 500px;"/>';
	}

	/**
	 * Creates menu for Webmail
	 *
	 * @return void
	 */
	public function plugin_create_menu() {
		$wpw_webmail_url = get_option( 'wpw_webmail_url' );

		if ( $wpw_webmail_url ) {
			// Create new top-level menu.
			add_menu_page(
				esc_html__( 'Options' , 'wpwebmail' ),
				esc_html__( 'Webmail' , 'wpwebmail' ),
				'edit_pages',
				__FILE__,
				array( $this, 'plugin_settings_page' ),
				'dashicons-email-alt',
				50
			);
		}
	}

	/**
	 * Adds HTML page
	 *
	 * @return void
	 */
	public function plugin_settings_page() {
		$wpw_webmail_url = get_option( 'wpw_webmail_url' );
		echo '<iframe src="' . esc_url( $wpw_webmail_url ) . '" style="width: 1000px; height: 640px;"></iframe>';

	}

}

new WPWebmail;
