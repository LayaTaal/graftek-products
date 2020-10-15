<?php

/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://zinnfinity.com.com
 * @since             1.0.0
 * @package           Graftek_Products
 *
 * @wordpress-plugin
 * Plugin Name:       Graftek Products
 * Plugin URI:        http://example.com/graftek-products-uri/
 * Description:       Extends Woocommerce for Graftek products
 * Version:           1.0.0
 * Author:            Zinnfinity Web Services
 * Author URI:        https://zinnfinity.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       graftek-products
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GRAFTEK_PRODUCTS_VERSION', '1.0.0' );

if ( ! class_exists( 'GraftekProducts' ) ) {
    /**
     * class: GraftekProducts
     * desc: plugin to control Graftek custom product requirements
     */
    class GraftekProducts {

        /**
         * GraftekProducts constructor.
         *
         * Setup ACF and base plugin settings
         */
        public function __construct() {

            // Define path and URL to the ACF plugin.
            define( 'MY_ACF_PATH', plugin_dir_path( __FILE__ ) . '/includes/acf/' );
            define( 'MY_ACF_URL', plugin_dir_url( __FILE__ ) . '/includes/acf/' );

            // Include the ACF plugin.
            include_once( MY_ACF_PATH . 'acf.php' );

            // Customize the url setting to fix incorrect asset URLs.
            add_filter( 'acf/settings/url', 'my_acf_settings_url' );
            function my_acf_settings_url( $url ) {
                return MY_ACF_URL;
            }

            // (Optional) Hide the ACF admin menu item.
            /*
            add_filter( 'acf/settings/show_admin', 'my_acf_settings_show_admin' );
            function my_acf_settings_show_admin( $show_admin ) {
                return false;
            }
            */

            // Settings managed via ACF
            require_once( sprintf( "%s/includes/settings.php", dirname( __FILE__ ) ) );
            $settings = new ProductFilter_Settings( plugin_basename( __FILE__ ) );

	        require_once( sprintf( "%s/includes/GraftekAccessories.php", dirname( __FILE__ ) ) );
	        $accessories = new Graftek_Accessories();
        }

        /**
         * Hook into the WordPress activate hook
         */
        public static function activate() {
            // Do something
        }

        /**
         * Hook into the WordPress deactivate hook
         */
        public static function deactivate() {
            // Do something
        }

    }
}


if ( class_exists( 'GraftekProducts' ) ) {

    // Installation and uninstallation hooks
    register_activation_hook( __FILE__, [ 'GraftekProducts', 'activate' ] );
    register_deactivation_hook( __FILE__, [ 'GraftekProducts', 'deactivate' ] );

    // instantiate the plugin class
    $plugin = new GraftekProducts();
}
