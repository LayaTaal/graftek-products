<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Graftek_Products
 * @subpackage Graftek_Products/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Graftek_Products
 * @subpackage Graftek_Products/admin
 * @author     Your Name <email@example.com>
 */
class Graftek_Products_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $graftek_products    The ID of this plugin.
	 */
	private $graftek_products;

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
	 * @param      string    $graftek_products       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $graftek_products, $version ) {

		$this->graftek_products = $graftek_products;
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
		 * defined in Graftek_Products_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Graftek_Products_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->graftek_products, plugin_dir_url( __FILE__ ) . 'css/graftek-products-admin.css', array(), $this->version, 'all' );

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
		 * defined in Graftek_Products_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Graftek_Products_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->graftek_products, plugin_dir_url( __FILE__ ) . 'js/graftek-products-admin.js', array( 'jquery' ), $this->version, false );

	}

}
