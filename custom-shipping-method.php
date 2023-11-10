<?php

/**
 * Plugin Name: Custom Shipping Method
 * Description: Custom shipping method for WooCommerce.
 * Version: 1.0
 * Author: Shajid Hassan
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    function custom_shipping_method()
    {
        if (!class_exists('Custom_Shipping_Method')) {

            class Custom_Shipping_Method extends WC_Shipping_Method
            {

                public function __construct($instance_id = 0)
                {
                    $this->id = 'custom_shipping';
                    $this->instance_id          = absint($instance_id);
                    $this->method_title         = __('Custom Shipping', 'custom_shipping');
                    $this->method_description   = __('Custom Shipping Method', 'custom_shipping');
                    $this->supports             = array(
                        'shipping-zones',
                        'instance-settings',
                        'instance-settings-modal',
                    );

                    $this->init();
                }

                /**
                 * Initialize Custom Shipping.
                 */
                public function init()
                {
                    // Load the settings.
                    $this->init_form_fields();
                    $this->init_settings();

                    // Define user set variables.
                    $this->title    = isset($this->settings['title']) ? $this->settings['title'] : __('Custom Shipping', 'custom_shipping');

                    add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
                }

                /**
                 * Init form fields.
                 */
                public function init_form_fields()
                {
                    $this->form_fields = array(
                        'title'      => array(
                            'title'         => __('Title', 'custom_shipping'),
                            'type'          => 'text',
                            'description'   => __('This controls the title which the user sees during checkout.', 'custom_shipping'),
                            'default'       => $this->method_title,
                            'desc_tip'      => true,
                        )
                    );
                }

                /**
                 * Get setting form fields for instances of this shipping method within zones.
                 *
                 * @return array
                 */
                public function get_instance_form_fields()
                {
                    return parent::get_instance_form_fields();
                }

                /**
                 * Always return shipping method is available
                 *
                 * @param array $package Shipping package.
                 * @return bool
                 */
                public function is_available($package)
                {
                    $is_available = true;
                    return apply_filters('woocommerce_shipping_' . $this->id . '_is_available', $is_available, $package, $this);
                }

                /**
                 * Free shipping rate applied for this method.
                 *
                 * @uses WC_Shipping_Method::add_rate()
                 *
                 * @param array $package Shipping package.
                 */
                public function calculate_shipping($package = array())
                {
                    $total_weight = 0;

                    // Calculate total order weight
                    foreach ($package['contents'] as $item) {
                        $product      = $item['data'];
                        $total_weight += $product->get_weight() * $item['quantity'];
                    }

                    // Determine shipping cost based on total weight
                    if ($total_weight <= 10) {
                        $shipping_cost = 10;
                    } elseif ($total_weight <= 20) {
                        $shipping_cost = 20;
                    } elseif ($total_weight <= 30) {
                        $shipping_cost = 30;
                    } else {
                        $shipping_cost = 40;
                    }

                    $this->add_rate(
                        array(
                            'label'   => $this->title,
                            'cost'    => $shipping_cost,
                            'taxes'   => false,
                            'package' => $package,
                        )
                    );
                }
            }
        }
    }
    add_action('woocommerce_shipping_init', 'Custom_Shipping_Method');

    function add_custom_shipping_method($methods)
    {
        $methods['custom_shipping'] = 'custom_shipping_method';
        return $methods;
    }
    add_filter('woocommerce_shipping_methods', 'add_custom_shipping_method');
}
