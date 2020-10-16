<?php

/**
 * Woocommerce functions specific to Graftek
 */

class Graftek_Accessories {

	const VIEWS_DIR = 'views';

	/**
	 * Construct the plugin object
	 */
	public function __construct() {
		add_action( 'init', [ &$this, "init" ] );
	}

	/**
	 * Initialize Product Archive
	 */
	function init() {
		//add_action( 'woocommerce_after_single_product_summary', [ &$this, 'render' ] );
		add_filter( 'woocommerce_product_tabs', [ &$this, 'graftek_custom_product_tabs' ] );
	}

	function graftek_custom_product_tabs( $tabs ) {

		// 2 Add accessories to tab

		$tabs['product_accessories'] = array(
			'title'    => __('Accessories', 'woocommerce'),
			'priority' => 115,
			'callback' => array( &$this, 'render' ),
		);

		return $tabs;
	}

	/**
	 * Get the product category by product id
	 *
	 * @param $product_id
	 *
	 * @return object
	 */
	function get_product_category( $product_id ): object {
		$categories = get_the_terms( $product_id, 'product_cat' );

		if ( empty( $categories ) ) {
			return false;
		}

		return end( $categories );
	}

	/**
	 * Get the current product category
	 *
	 * @return array
	 */
	function get_product_category_id(): array {
		return get_the_terms( get_the_ID(), 'product_cat' );
	}

	/**
	 * Get product accessories
	 */
	function get_product_attributes(): array {
		$product = wc_get_product( get_the_ID() );

		return $product->get_attributes();
	}

	/**
	 * Get ACF groups from Product Filters options page
	 *
	 * @return array
	 */
	function get_acf_groups(): array {

		$acf_groups = [];

		if ( empty( acf_get_field_groups() ) ) {
			return $acf_groups;
		}

		foreach ( acf_get_field_groups() as $acf_group ) {
			if ( ( $acf_group['location'][0][0]['value'] === 'graftek-product-options' ) && ( $acf_group['location'][0][0]['param'] === 'options_page' ) ) {
				$acf_groups[] = [
					'id'   => $acf_group['key'],
					'name' => $acf_group['title'],
				];
			}
		}

		return $acf_groups;
	}

	/**
	 * Get the ACF group id for the current category's accessories.
	 *
	 * @return string
	 */
	function get_current_group_id(): string {

		$group_id = '';

		$acf_groups  = $this->get_acf_groups();
		$product_cat = $this->get_product_category( wc_get_product()->get_id() );

		foreach ( $acf_groups as $acf_group ) {
			if ( $acf_group['name'] === $product_cat->name ) {
				$group_id = $acf_group['id'];
			}
		}

		return $group_id;

	}

	/**
	 * Get the accessories and filters for a product category
	 *
	 * @return array
	 */
	function get_product_accessories(): array {

		$product_cat = $this->get_product_category( wc_get_product()->get_id() );

		$accessories = [];

		// Check for accessories in matching group and loop through them.
		if ( have_rows( $product_cat->slug, 'option' ) ):
			while ( have_rows( $product_cat->slug, 'option' ) ) : the_row();

				// Loop over each accessory.
				if ( have_rows( 'accessories' ) ):
					while ( have_rows( 'accessories' ) ) : the_row();

						// Get accessory type information.
						$accessory = get_sub_field( 'accessory_type' );
						$filters   = [];

						// Loop over all filter rules in each accessory
						if ( have_rows( 'filter' ) ):
							while ( have_rows( 'filter' ) ) : the_row();

								// Store filter information.
								$filters[] = [
									'product_attribute'   => get_sub_field( 'product_attribute' ),
									'accessory_attribute' => get_sub_field( 'accessory_attribute' ),
									'operator'            => get_sub_field( 'operator' ),
								];

							endwhile;
						endif;

						// Setup our accessory array
						$accessories[] = [
							'name'     => $accessory->name,
							'slug'     => $accessory->slug,
							'taxonomy' => $accessory->taxonomy,
							'filters'  => $filters,
						];

					endwhile;
				endif;

			endwhile;
		endif;

		return $accessories;
	}

	/**
	 * Get compatible camera accessories based on port type for now
	 *
	 * @return array
	 */
	function get_compatible_products( $accessory ) {

		$current_product_attributes = $this->get_product_attributes();

		$products_in_category = wc_get_products( [
			'category' => [ $accessory['slug'] ],
		] );

		$compatible_accessories = [];

		// Loop through products in this category
		foreach ( $products_in_category as $product ) {

			$accessory_attrs = $product->get_attributes();

			// Loop through each filter for this category
			foreach ( $accessory['filters'] as $filter ) {

				// Get value of current product attribute matching filter
				$attr_name = 'pa_' . $filter['product_attribute']['value'];
				$product_attr_id = $current_product_attributes[$attr_name]['options'][0];

				// Get value of current accessory attribute matching filter
				$attr_name = 'pa_' . $filter['accessory_attribute']['value'];
				$accessory_attr_id = $accessory_attrs[$attr_name]['options'][0];

				// TODO: Choose correct operator from filter
				// TODO: Fallbacks in case no filter is chosen, etc.

				// TODO: Add ability to work with multiple filters

				// Compare them
				if ( $accessory_attr_id === $product_attr_id ) {
					$compatible_accessories[] = $product;
				}

			}

		}

		return $compatible_accessories;
	}

	function prepare_accessories( $accessories ) {

		$i = 0;
		foreach ( $accessories as $accessory ) {
			$accessories[ $i ]['products'] = $this->get_compatible_products( $accessory );
			$i ++;
		}

		return $accessories;

	}

	function render() {

		$path        = plugin_dir_path( __FILE__ ) . self::VIEWS_DIR . '/single/product-accessories.php';
		$accessories = $this->prepare_accessories( $this->get_product_accessories() );

		include $path;
	}

}
