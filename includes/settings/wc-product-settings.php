<?php
/**
 * Load settings page on Woocommerce > settings > products
 */
function add_product_accessories_section( $sections ) {
	$sections['product_accessories'] = __( 'Product Accessories', 'graftek-products' );

	return $sections;
}
add_filter( 'woocommerce_get_sections_products', 'add_product_accessories_section' );

// Add settings to product accessories section
function product_accessories_settings( $settings, $current_section ) {
	/**
	 * Check the current section is what we want
	 **/
	if ( $current_section == 'product_accessories' ) {

		$settings_products_accessories = [];

		// Add Title to the Settings
		$settings_products_accessories[] = [
			'name' => __( 'Graftek Product Accessories', 'graftek-products' ),
			'type' => 'title',
			'desc' => __( 'Manage Graftek product property settings', 'graftek-products' ),
			'id'   => 'product_accessories',
		];
		// Add checkbox to enable product accessories
		$settings_products_accessories[] = [
			'name'     => __( 'Single Product Accessories', 'graftek-products' ),
			'desc_tip' => __( 'Show product accessories in single product page.', 'graftek-products' ),
			'id'       => 'product_accessories_show_single',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Enable', 'graftek-products' ),
		];

		$settings_products_accessories[] = [ 'type' => 'sectionend', 'id' => 'product_accessories' ];

		return $settings_products_accessories;

		/**
		 * If not, return the standard settings
		 **/
	} else {
		return $settings;
	}
}
add_filter( 'woocommerce_get_settings_products', 'product_accessories_settings', 10, 2 );
