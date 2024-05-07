<?php

/**
 * Plugin Name: Custom Shipping Method
 * Description: Custom shipping method for WooCommerce.
 * Version: 1.0.2
 * Author: Mirailit Limited
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

include_once('state-names.php');
include_once('shipping-rates.php');
include_once('custom-labels.php');

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {


    // ========= Dry Chilled Weight Based START =========
    function custom_shipping_method()
    {
        if (!class_exists('Custom_Shipping_Method')) {
            class Custom_Shipping_Method extends WC_Shipping_Method
            {

                public function __construct($instance_id = 0)
                {
                    $this->id = 'custom_shipping';
                    $this->instance_id = absint($instance_id);
                    $this->method_title = __('Custom Shipping', 'custom_shipping');
                    $this->method_description = __('Custom Shipping Method', 'custom_shipping');
                    $this->supports = array(
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
                    $this->title = isset($this->settings['title']) ? $this->settings['title'] : __('Custom Shipping', 'custom_shipping');

                    add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
                }

                /**
                 * Init form fields.
                 */
                public function init_form_fields()
                {
                    $this->form_fields = array(
                        'title' => array(
                            'title' => __('Title', 'custom_shipping'),
                            'type' => 'text',
                            'description' => __('This controls the title which the user sees during checkout.', 'custom_shipping'),
                            'default' => $this->method_title,
                            'desc_tip' => true,
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
                    // Calculate total order weight
                    $total_weight = 0;
                    $dry_weight = 0;
                    $chilled_weight = 0;

                    foreach ($package['contents'] as $item) {
                        $product = $item['data'];
                        $item_weight = $product->get_weight() * $item['quantity'];
                        $total_weight += $item_weight;

                        // If product has category chilled shipping then add to chilled weight or else to dry weight
                        if (has_term('chilled-shipping', 'product_cat', $product->get_id())) {
                            $chilled_weight += $item_weight;
                        } else {
                            $dry_weight += $item_weight;
                        }
                    }

                    // Determine destination region

                    $destination = $package['destination']['state']; // Assuming state contains the prefecture/region

                    global $state_names; // Use the global keyword to access the array
                    global $shipping_rates;

                    // Get the state name using the state code
                    $state_name = isset($state_names[$destination]) ? $state_names[$destination] : 'Unknown';

                    // Region Rate array
                    $region_rate = isset($shipping_rates[$destination]) ? $shipping_rates[$destination] : null;

                    if ($region_rate) {
                        if ($chilled_weight > 0) {

                            // ========== Chilled Shipping ==========

                            if ($dry_weight > 0) {
                                // ========== Mixed Shipping ==========
                                // Calculate shipping cost
                                $additional_weight = max($total_weight - 24, 0); // Weight above the base 24kg
                                $additional_units = ceil($additional_weight / 24);
                                $shipping_cost = $region_rate['chilled_base'] + ($additional_units * $region_rate['chilled_additional']);
                                $shipping_title = 'Normal Frozen Japan Post (Mixed)(Per 24Kg)';
                            } else {
                                // ========== Only Chilled Shipping ==========
                                $additional_weight = max($total_weight - 24, 0); // Weight above the base 24kg
                                $additional_units = ceil($additional_weight / 24);
                                $shipping_cost = $region_rate['chilled_base'] + ($additional_units * $region_rate['chilled_additional']);
                                $shipping_title = 'Normal Frozen Japan Post (Mixed)(Per 24Kg)';
                            }
                        } else {
                            // ========== Only Dry Shipping ==========
                            // Calculate shipping cost
                            $additional_weight = max($total_weight - 25, 0); // Weight above the base 25kg
                            $additional_units = ceil($additional_weight / 25);
                            $shipping_cost = $region_rate['base'] + ($additional_units * $region_rate['additional']);

                            // Modify the title to include the state name
                            // $shipping_title = 'Dry Shipping (Per 25Kg)' . ' (' . $state_name . ')';
                            $shipping_title = 'Dry Shipping (Per 25Kg)';
                        }
                    } else {
                        // Default or fallback shipping cost if region is not in the list (If Outside Japan or Error)
                        return;
                    }

                    // Add the rate
                    $this->add_rate(
                        array(
                            'label' => $shipping_title,
                            'cost' => $shipping_cost,
                            'taxes' => false,
                            // 'package' => $package,
                        )
                    );
                }
            }
        }
    }
    add_action('woocommerce_shipping_init', 'Custom_Shipping_Method');



    // ========= Dry Chilled Weight Based END =========

    //  Frozen Shipping Method Start

    function frozen_sagawa_shipping_method()
    {
        if (!class_exists('Frozen_Sagawa_Shipping_Method')) {
            class Frozen_Sagawa_Shipping_Method extends WC_Shipping_Method
            {

                public function __construct($instance_id = 0)
                {
                    $this->id = 'frozen_sagawa_shipping';
                    $this->instance_id = absint($instance_id);
                    $this->method_title = __('Frozen Sagawa Shipping', 'frozen_sagawa_shipping');
                    $this->method_description = __('Frozen Sagawa Shipping method', 'frozen_sagawa_shipping');
                    $this->supports = array(
                        'shipping-zones',
                        'instance-settings',
                        'instance-settings-modal',
                    );

                    $this->init();
                }

                public function init()
                {
                    // Load the settings.
                    $this->init_form_fields();
                    $this->init_settings();

                    // Define user set variables.
                    $this->title = isset($this->settings['title']) ? $this->settings['title'] : __('Frozen Sagawa Shipping', 'frozen_sagawa_shipping');

                    add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
                }


                public function init_form_fields()
                {
                    $this->form_fields = array(
                        'title' => array(
                            'title' => __('Title', 'frozen_sagawa_shipping'),
                            'type' => 'text',
                            'description' => __('This controls the title which the user sees during checkout.', 'frozen_sagawa_shipping'),
                            'default' => $this->method_title,
                            'desc_tip' => true,
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


                public function calculate_shipping($package = array())
                {
                    // Calculate total order weight
                    $total_weight = 0;
                    $dry_weight = 0;
                    $chilled_weight = 0;

                    foreach ($package['contents'] as $item) {
                        $product = $item['data'];
                        $item_weight = $product->get_weight() * $item['quantity'];
                        $total_weight += $item_weight;

                        // If product has category chilled shipping then add to chilled weight or else to dry weight
                        if (has_term('chilled-shipping', 'product_cat', $product->get_id())) {
                            $chilled_weight += $item_weight;
                        } else {
                            $dry_weight += $item_weight;
                        }
                    }

                    // Determine destination region

                    $destination = $package['destination']['state']; // Assuming state contains the prefecture/region

                    // Skip calculation and rate addition if destination state code JP47
                    if ($destination === 'JP47') {
                        return;
                    }

                    global $state_names; // Use the global keyword to access the array
                    global $shipping_rates;

                    // Get the state name using the state code
                    $state_name = isset($state_names[$destination]) ? $state_names[$destination] : 'Unknown';

                    // Region Rate array
                    $region_rate = isset($shipping_rates[$destination]) ? $shipping_rates[$destination] : null;

                    if ($region_rate) {
                        if ($chilled_weight > 0) {
                            // If dry items in cart show seperate price
                            if ($dry_weight > 0) {

                                // // ========== Seperate Frozen Shipping ==========
                                // // Calculate shipping cost
                                // $additional_weight = max($total_weight - 20, 0); // Weight above the base 20kg
                                // $additional_units = ceil($additional_weight / 20);
                                // $shipping_cost = $region_rate['frozen_seperate_base'] + ($additional_units * $region_rate['frozen_seperate_additional']);

                                // // $shipping_title = 'Separate Deep Frozen Shipping (Per 20Kg)' . ' (' . $state_name . ')';
                                // $shipping_title = 'Separate Deep Frozen Shipping (Per 20Kg)';

                                // ========== Only Frozen Shipping ==========
                                // Calculate shipping cost
                                $additional_weight = max($total_weight - 20, 0); // Weight above the base 20kg
                                $additional_units = ceil($additional_weight / 20);
                                $shipping_cost = $region_rate['frozen_base'] + ($additional_units * $region_rate['frozen_additional']);

                                // $shipping_title = 'Only Deep Frozen Shipping (Per 20Kg)' . ' (' . $state_name . ')';
                                $shipping_title = 'Deep Frozen -18° C Sagawa (Mixed)(Per 20Kg)';
                            } else {
                                return;
                            }
                        } else {
                            return;
                        }
                    } else {
                        return;
                    }

                    // Add the rate
                    $this->add_rate(
                        array(
                            'label' => $shipping_title,
                            'cost' => $shipping_cost,
                            'taxes' => false,
                            // 'package' => $package,
                        )
                    );
                }
            }
        }
    }
    add_action('woocommerce_shipping_init', 'Frozen_Sagawa_Shipping_Method');

    // function add_frozen_sagawa_shipping($methods)
    // {
    //     $methods['frozen_sagawa_shipping'] = 'frozen_sagawa_shipping_method';
    //     return $methods;
    // }
    // add_filter('woocommerce_shipping_methods', 'add_frozen_sagawa_shipping');


    function add_custom_shipping_method($methods)
    {
        $methods['custom_shipping'] = 'custom_shipping_method';
        $methods['frozen_sagawa_shipping'] = 'frozen_sagawa_shipping_method';
        return $methods;
    }
    add_filter('woocommerce_shipping_methods', 'add_custom_shipping_method');
}
