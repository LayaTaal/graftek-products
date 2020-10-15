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

                    acf_add_local_field_group(array(
                        'key' => 'group_monochrome_cameras',
                        'title' => 'Monochrome Cameras',
                        'fields' => array(
                            array(
                                'key' => 'field_accessories',
                                'label' => 'Accessories',
                                'name' => 'accessories',
                                'type' => 'repeater',
                                'instructions' => 'Select accessories to show in this category.',
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
                                'button_label' => 'Add Accessory',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_accessory',
                                        'label' => 'Accessory',
                                        'name' => 'filter_category',
                                        'type' => 'taxonomy',
                                        'instructions' => 'Select an accessory.',
                                        'required' => 1,
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
                                        'return_format' => 'id',
                                        'multiple' => 0,
                                    ),
                                    array(
                                        'key' => 'field_filters',
                                        'label' => 'Filters',
                                        'name' => 'filter_rule',
                                        'type' => 'repeater',
                                        'instructions' => 'Define rules for how to filter accessories.',
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
                                        'button_label' => 'Add Filter',
                                        'sub_fields' => array(
                                            array(
                                                'key' => 'field_product_attr',
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
                                                    'auto-iris' => 'Auto Iris',
                                                    'format' => 'Format',
                                                    'family' => 'Family',
                                                ),
                                                'default_value' => 'None',
                                                'allow_null' => 1,
                                                'multiple' => 0,
                                                'ui' => 0,
                                                'return_format' => 'array',
                                                'ajax' => 0,
                                                'placeholder' => '',
                                            ),
                                            array(
                                                'key' => 'field_accessory_attr',
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
                                                    'auto-iris' => 'Auto Iris',
                                                    'format' => 'Format',
                                                    'family' => 'Family',
                                                ),
                                                'default_value' => 'None',
                                                'allow_null' => 1,
                                                'multiple' => 0,
                                                'ui' => 0,
                                                'return_format' => 'array',
                                                'ajax' => 0,
                                                'placeholder' => '',
                                            ),
                                            array(
                                                'key' => 'field_operator',
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
                                                    'greater-than' => 'Greater than',
                                                    'less-than' => 'Less than',
                                                ),
                                                'default_value' => 'Equal',
                                                'allow_null' => 1,
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
                        'location' => array(
                            array(
                                array(
                                    'param' => 'options_page',
                                    'operator' => '==',
                                    'value' => self::SLUG,
                                ),
                            ),
                        ),
                        'menu_order' => 0,
                        'position' => 'normal',
                        'style' => 'default',
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
