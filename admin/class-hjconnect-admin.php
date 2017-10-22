<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       iamleigh.com
 * @since      1.0.0
 *
 * @package    Hjconnect
 * @subpackage Hjconnect/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hjconnect
 * @subpackage Hjconnect/admin
 * @author     Leighton Sapir <leighton@pandamints.com>
 */
class Hjconnect_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hjconnect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hjconnect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hjconnect-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hjconnect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hjconnect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hjconnect-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into WordPress Dashboard menu.
	 * 
	 * @since 1.0.0
	 */
	public function add_plugin_admin_menu() {
		
		add_menu_page( 'Hotjar Connection', 'Hotjar', 'manage_options', $this->plugin_name, array( $this, 'display_plugin_setup_page' ), 'dashicons-update' );

	}

	/**
	 * Render the settings page for the plugin.
	 * 
	 * @since 1.0.0
	 */
	public function display_plugin_setup_page() {

		include_once( 'partials/hjconnect-admin-display.php' );

	}

	public function validate( $input ) {

		$valid = array();

		$valid['hotjar_on'] = ( isset( $input['hotjar_on'] ) && ! empty( $input['hotjar_on'] ) ) ? 1 : 0;
		$valid['hotjar_id'] = esc_html( $input['hotjar_id'] );

		return $valid;

	}

	public function options_update() {

		register_setting( $this->plugin_name, $this->plugin_name, array( $this, 'validate' ) );

	}

}
