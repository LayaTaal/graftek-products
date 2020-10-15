<?php

/**
 * Woocommerce functions specific to Graftek
 */

class Graftek_Accessories {

	const GROUP_PREFIX = 'group_';
	const FIELD_PREFIX = 'field_';
	const VIEWS_DIR = 'inc/views';

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
		add_action( 'woocommerce_after_single_product_summary', [ &$this, 'show_product_accessories' ] );
	}

	/**
	 * Get the product category by product id
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

		$acf_groups = $this->get_acf_groups();
		$product_cat = $this->get_product_category( wc_get_product()->get_id() );

		foreach ( $acf_groups as $acf_group ) {
			if ( $acf_group['name'] === $product_cat->name ) {
				$group_id = $acf_group['id'];
			}
		}

		return $group_id;

	}

	/**
	 * Pass data to view
	 */
	function show_product_accessories() {

		$product_cat = $this->get_product_category( wc_get_product()->get_id() );

		/*
		$args = self::get_data();

		get_template_part( self::VIEWS_DIR . '/single/product-accessories', null, $args );
		*/
		echo 'Plugin Accessories';

		// Check for accessories in matching group and loop through them.
		if( have_rows( $product_cat->slug, 'option' ) ):
			while( have_rows( $product_cat->slug, 'option' ) ) : the_row();

				// Loop over sub repeater rows.
				if( have_rows('accessories') ):
					while( have_rows('accessories') ) : the_row();

						// Get sub value.
						$child_title = get_sub_field('accessory_type');

						echo '<pre>';
						var_dump( $child_title );
						echo '</pre>';

					endwhile;
				endif;

			endwhile;
		endif;
	}

}
