<?php
if ( ! class_exists( 'ProductFilter_Settings' ) ) {
    class ProductFilter_Settings {

        const SLUG = "graftek-product-options";

        /**
         * Construct the plugin object
         */
        public function __construct( $plugin ) {
            // register actions
            acf_add_options_page( [
                'page_title' => __( 'Product Accessory Filters', 'custom' ),
                'menu_title' => __( 'Product Filters', 'custom' ),
                'menu_slug'  => self::SLUG,
                'capability' => 'manage_options',
                'redirect'   => false,
                'position'   => '55.5',
            ] );

            add_action( 'init', [ &$this, "init" ] );
            add_action( 'admin_menu', [ &$this, 'admin_menu' ], 20 );
            add_filter( "plugin_action_links_$plugin", [ &$this, 'plugin_settings_link' ] );
        }

        /**
         * Add options page
         */
        public function admin_menu() {
            // Duplicate link into properties mgmt
            add_submenu_page(
                self::SLUG,
                __( 'Settings', 'custom' ),
                __( 'Settings', 'custom' ),
                'manage_options',
                self::SLUG,
                1
            );
        }

        /**
         * Add settings fields via ACF
         */
        function init() {
            if ( function_exists( 'register_field_group' ) ) {
	            if( function_exists('acf_add_local_field_group') ):

		            // TODO: Add additional groups
		            acf_add_local_field_group(array(
			            'key' => 'group_5f88a07c7a8f4',
			            'title' => 'Product Accessories',
			            'fields' => array(
				            array(
					            'key' => 'field_5f88a09cb2cda',
					            'label' => 'Monochrome Cameras',
					            'name' => 'monochrome-cameras',
					            'type' => 'group',
					            'instructions' => 'Monochrome camera accessories',
					            'required' => 0,
					            'conditional_logic' => 0,
					            'wrapper' => array(
						            'width' => '',
						            'class' => '',
						            'id' => '',
					            ),
					            'layout' => 'block',
					            'sub_fields' => array(
						            array(
							            'key' => 'field_5f88a137b2cdb',
							            'label' => 'Accessories',
							            'name' => 'accessories',
							            'type' => 'repeater',
							            'instructions' => 'Add accessories for this product',
							            'required' => 0,
							            'conditional_logic' => 0,
							            'wrapper' => array(
								            'width' => '',
								            'class' => '',
								            'id' => '',
							            ),
							            'collapsed' => '',
							            'min' => 0,
							            'max' => 0,
							            'layout' => 'row',
							            'button_label' => '',
							            'sub_fields' => array(
								            array(
									            'key' => 'field_5f88a166b2cdc',
									            'label' => 'Accessory Type',
									            'name' => 'accessory_type',
									            'type' => 'taxonomy',
									            'instructions' => '',
									            'required' => 0,
									            'conditional_logic' => 0,
									            'wrapper' => array(
										            'width' => '',
										            'class' => '',
										            'id' => '',
									            ),
									            'taxonomy' => 'product_cat',
									            'field_type' => 'select',
									            'allow_null' => 0,
									            'add_term' => 0,
									            'save_terms' => 0,
									            'load_terms' => 0,
									            'return_format' => 'object',
									            'multiple' => 0,
								            ),
								            array(
									            'key' => 'field_5f88a1afb2cdd',
									            'label' => 'Filter',
									            'name' => 'filter',
									            'type' => 'repeater',
									            'instructions' => '',
									            'required' => 0,
									            'conditional_logic' => 0,
									            'wrapper' => array(
										            'width' => '',
										            'class' => '',
										            'id' => '',
									            ),
									            'collapsed' => '',
									            'min' => 0,
									            'max' => 0,
									            'layout' => 'table',
									            'button_label' => '',
									            'sub_fields' => array(
										            array(
											            'key' => 'field_5f88a251b2cde',
											            'label' => 'Product Attribute',
											            'name' => 'product_attribute',
											            'type' => 'select',
											            'instructions' => '',
											            'required' => 0,
											            'conditional_logic' => 0,
											            'wrapper' => array(
												            'width' => '',
												            'class' => '',
												            'id' => '',
											            ),
											            'choices' => array(
												            'none' => 'None',
												            'family' => 'Family',
												            'format' => 'Format',
											            ),
											            'default_value' => 'none',
											            'allow_null' => 1,
											            'multiple' => 0,
											            'ui' => 0,
											            'return_format' => 'array',
											            'ajax' => 0,
											            'placeholder' => '',
										            ),
										            array(
											            'key' => 'field_5f88a274b2cdf',
											            'label' => 'Accessory Attribute',
											            'name' => 'accessory_attribute',
											            'type' => 'select',
											            'instructions' => '',
											            'required' => 0,
											            'conditional_logic' => 0,
											            'wrapper' => array(
												            'width' => '',
												            'class' => '',
												            'id' => '',
											            ),
											            'choices' => array(
												            'none' => 'None',
												            'family' => 'Family',
												            'format' => 'Format',
											            ),
											            'default_value' => 'none: None',
											            'allow_null' => 1,
											            'multiple' => 0,
											            'ui' => 0,
											            'return_format' => 'array',
											            'ajax' => 0,
											            'placeholder' => '',
										            ),
										            array(
											            'key' => 'field_5f88a280b2ce0',
											            'label' => 'Operator',
											            'name' => 'operator',
											            'type' => 'select',
											            'instructions' => '',
											            'required' => 0,
											            'conditional_logic' => 0,
											            'wrapper' => array(
												            'width' => '',
												            'class' => '',
												            'id' => '',
											            ),
											            'choices' => array(
												            'equal' => 'Equal',
												            'greater-than' => 'Greater Than',
												            'less-than' => 'Less Than',
											            ),
											            'default_value' => 'equal',
											            'allow_null' => 0,
											            'multiple' => 0,
											            'ui' => 0,
											            'return_format' => 'value',
											            'ajax' => 0,
											            'placeholder' => '',
										            ),
									            ),
								            ),
							            ),
						            ),
					            ),
				            ),
				            array(
					            'key' => 'field_5f88a3b74ab83',
					            'label' => 'Linescan Cameras',
					            'name' => 'linescan-cameras',
					            'type' => 'group',
					            'instructions' => 'Linescan camera accessories',
					            'required' => 0,
					            'conditional_logic' => 0,
					            'wrapper' => array(
						            'width' => '',
						            'class' => '',
						            'id' => '',
					            ),
					            'layout' => 'block',
					            'sub_fields' => array(
						            array(
							            'key' => 'field_5f88a3b74ab84',
							            'label' => 'Accessories',
							            'name' => 'accessories',
							            'type' => 'repeater',
							            'instructions' => 'Add accessories for this product',
							            'required' => 0,
							            'conditional_logic' => 0,
							            'wrapper' => array(
								            'width' => '',
								            'class' => '',
								            'id' => '',
							            ),
							            'collapsed' => '',
							            'min' => 0,
							            'max' => 0,
							            'layout' => 'row',
							            'button_label' => '',
							            'sub_fields' => array(
								            array(
									            'key' => 'field_5f88a3b74ab85',
									            'label' => 'Accessory Type',
									            'name' => 'accessory_type',
									            'type' => 'taxonomy',
									            'instructions' => '',
									            'required' => 0,
									            'conditional_logic' => 0,
									            'wrapper' => array(
										            'width' => '',
										            'class' => '',
										            'id' => '',
									            ),
									            'taxonomy' => 'product_cat',
									            'field_type' => 'select',
									            'allow_null' => 0,
									            'add_term' => 0,
									            'save_terms' => 0,
									            'load_terms' => 0,
									            'return_format' => 'object',
									            'multiple' => 0,
								            ),
								            array(
									            'key' => 'field_5f88a3b74ab86',
									            'label' => 'Filter',
									            'name' => 'filter',
									            'type' => 'repeater',
									            'instructions' => '',
									            'required' => 0,
									            'conditional_logic' => 0,
									            'wrapper' => array(
										            'width' => '',
										            'class' => '',
										            'id' => '',
									            ),
									            'collapsed' => '',
									            'min' => 0,
									            'max' => 0,
									            'layout' => 'table',
									            'button_label' => '',
									            'sub_fields' => array(
										            array(
											            'key' => 'field_5f88a3b74ab87',
											            'label' => 'Product Attribute',
											            'name' => 'product_attribute',
											            'type' => 'select',
											            'instructions' => '',
											            'required' => 0,
											            'conditional_logic' => 0,
											            'wrapper' => array(
												            'width' => '',
												            'class' => '',
												            'id' => '',
											            ),
											            'choices' => array(
												            'none' => 'None',
												            'family' => 'Family',
												            'format' => 'Format',
											            ),
											            'default_value' => 'none',
											            'allow_null' => 1,
											            'multiple' => 0,
											            'ui' => 0,
											            'return_format' => 'array',
											            'ajax' => 0,
											            'placeholder' => '',
										            ),
										            array(
											            'key' => 'field_5f88a3b74ab88',
											            'label' => 'Accessory Attribute',
											            'name' => 'accessory_attribute',
											            'type' => 'select',
											            'instructions' => '',
											            'required' => 0,
											            'conditional_logic' => 0,
											            'wrapper' => array(
												            'width' => '',
												            'class' => '',
												            'id' => '',
											            ),
											            'choices' => array(
												            'none' => 'None',
												            'family' => 'Family',
												            'format' => 'Format',
											            ),
											            'default_value' => 'none: None',
											            'allow_null' => 1,
											            'multiple' => 0,
											            'ui' => 0,
											            'return_format' => 'array',
											            'ajax' => 0,
											            'placeholder' => '',
										            ),
										            array(
											            'key' => 'field_5f88a3b74ab89',
											            'label' => 'Operator',
											            'name' => 'operator',
											            'type' => 'select',
											            'instructions' => '',
											            'required' => 0,
											            'conditional_logic' => 0,
											            'wrapper' => array(
												            'width' => '',
												            'class' => '',
												            'id' => '',
											            ),
											            'choices' => array(
												            'equal' => 'Equal',
												            'greater-than' => 'Greater Than',
												            'less-than' => 'Less Than',
											            ),
											            'default_value' => 'equal',
											            'allow_null' => 0,
											            'multiple' => 0,
											            'ui' => 0,
											            'ajax' => 0,
											            'return_format' => 'value',
											            'placeholder' => '',
										            ),
									            ),
								            ),
							            ),
						            ),
					            ),
				            ),
			            ),
			            'location' => array(
				            array(
					            array(
						            'param' => 'options_page',
						            'operator' => '==',
						            'value' => 'graftek-product-options',
					            ),
				            ),
			            ),
			            'menu_order' => 0,
			            'position' => 'normal',
			            'style' => 'seamless',
			            'label_placement' => 'top',
			            'instruction_placement' => 'label',
			            'hide_on_screen' => '',
			            'active' => true,
			            'description' => '',
		            ));

	            endif;
            }
        }

        /**
         * Add the settings link to the plugins page
         */
        public function plugin_settings_link( $links ) {
            $settings_link = sprintf( '<a href="admin.php?page=%s">Settings</a>', self::SLUG );
            array_unshift( $links, $settings_link );

            return $links;
        }

    }
}
