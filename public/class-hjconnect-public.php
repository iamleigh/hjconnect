<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       iamleigh.com
 * @since      1.0.0
 *
 * @package    Hjconnect
 * @subpackage Hjconnect/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Hjconnect
 * @subpackage Hjconnect/public
 * @author     Leighton Sapir <leighton@pandamints.com>
 */
class Hjconnect_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->hjconnect_options = get_option( $this->plugin_name );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hjconnect-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hjconnect-public.js', array( 'jquery' ), $this->version, false );

	}

	public function hotjar_connect() {
		
		if ( ! empty( $this->hjconnect_options['hotjar_on'] ) && ! empty( $this->hjconnect_options['hotjar_id'] ) ) {

			if ( ! empty( $this->hjconnect_options['hotjar_id'] ) ) {
				$hjid = $this->hjconnect_options['hotjar_id'];
			}
			
			echo "<script>
				(function(h,o,t,j,a,r){
					h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
					h._hjSettings={hjid:" . $hjid . ",hjsv:6};
					a=o.getElementsByTagName('head')[0];
					r=o.createElement('script');r.async=1;
					r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
					a.appendChild(r);
				})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
			</script>";
			
		}
		
    }

}