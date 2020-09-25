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

/**
 * Create settings section in Woocommerce > Products
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/settings/wc-product-settings.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-graftek-products-activator.php
 */
function activate_graftek_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-graftek-products-activator.php';
	Graftek_Products_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-graftek-products-deactivator.php
 */
function deactivate_graftek_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-graftek-products-deactivator.php';
	Graftek_Products_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_graftek_products' );
register_deactivation_hook( __FILE__, 'deactivate_graftek_products' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-graftek-products.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_graftek_products() {

	$plugin = new Graftek_Products();
	$plugin->run();

}
run_graftek_products();
