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
                // public function calculate_shipping($package = array())
                // {
                //     $total_weight = 0;

                //     // Calculate total order weight
                //     foreach ($package['contents'] as $item) {
                //         $product      = $item['data'];
                //         $total_weight += $product->get_weight() * $item['quantity'];
                //     }

                //     // Determine shipping cost based on total weight
                //     if ($total_weight <= 10) {
                //         $shipping_cost = 10;
                //     } elseif ($total_weight <= 20) {
                //         $shipping_cost = 20;
                //     } elseif ($total_weight <= 30) {
                //         $shipping_cost = 30;
                //     } else {
                //         $shipping_cost = 40;
                //     }

                //     $this->add_rate(
                //         array(
                //             'label'   => $this->title,
                //             'cost'    => $shipping_cost,
                //             'taxes'   => false,
                //             'package' => $package,
                //         )
                //     );
                // }

                public function calculate_shipping($package = array())
                {

                    // Define the state code to name mapping
                    $state_names = array(
                        'JP01' => 'Hokkaido',
                        'JP02' => 'Aomori',
                        'JP03' => 'Iwate',
                        'JP04' => 'Miyagi',
                        'JP05' => 'Akita',
                        'JP06' => 'Yamagata',
                        'JP07' => 'Fukushima',
                        'JP08' => 'Ibaraki',
                        'JP09' => 'Tochigi',
                        'JP10' => 'Gunma',
                        'JP11' => 'Saitama',
                        'JP12' => 'Chiba',
                        'JP13' => 'Tokyo',
                        'JP14' => 'Kanagawa',
                        'JP15' => 'Niigata',
                        'JP16' => 'Toyama',
                        'JP17' => 'Ishikawa',
                        'JP18' => 'Fukui',
                        'JP19' => 'Yamanashi',
                        'JP20' => 'Nagano',
                        'JP21' => 'Gifu',
                        'JP22' => 'Shizuoka',
                        'JP23' => 'Aichi',
                        'JP24' => 'Mie',
                        'JP25' => 'Shiga',
                        'JP26' => 'Kyoto',
                        'JP27' => 'Osaka',
                        'JP28' => 'Hyogo',
                        'JP29' => 'Nara',
                        'JP30' => 'Wakayama',
                        'JP31' => 'Tottori',
                        'JP32' => 'Shimane',
                        'JP33' => 'Okayama',
                        'JP34' => 'Hiroshima',
                        'JP35' => 'Yamaguchi',
                        'JP36' => 'Tokushima',
                        'JP37' => 'Kagawa',
                        'JP38' => 'Ehime',
                        'JP39' => 'Kochi',
                        'JP40' => 'Fukuoka',
                        'JP41' => 'Saga',
                        'JP42' => 'Nagasaki',
                        'JP43' => 'Kumamoto',
                        'JP44' => 'Oita',
                        'JP45' => 'Miyazaki',
                        'JP46' => 'Kagoshima',
                        'JP47' => 'Okinawa',
                    );


                    // Define shipping rates

                    // Define base and additional rates for each region
                    $dry_base_r1 = 1200;
                    $dry_additional_r1 = 1200; // Region 1: Tokyo
                    $dry_base_r2 = 1300;
                    $dry_additional_r2 = 1300; // Region 2: Kantou, Tyubu, Hokuriku, Shinetsu, Touhoku
                    $dry_base_r3 = 1400;
                    $dry_additional_r3 = 1400; // Region 3: Kansai
                    $dry_base_r4 = 1450;
                    $dry_additional_r4 = 1450; // Region 4: Tyugoku, Shikoku
                    $dry_base_r5 = 1600;
                    $dry_additional_r5 = 1600; // Region 5: Kyusyu, Hokkaido
                    $dry_base_r6 = 1800;
                    $dry_additional_r6 = 1800; // Region 6: Okinawa

                    // Chilled base and addition +1000
                    $chilled_base_r1 = 2200;
                    $chilled_additional_r1 = 2200; // Region 1: Tokyo
                    $chilled_base_r2 = 2300;
                    $chilled_additional_r2 = 2300; // Region 2: Kantou, Tyubu, Hokuriku, Shinetsu, Touhoku
                    $chilled_base_r3 = 2400;
                    $chilled_additional_r3 = 2400; // Region 3: Kansai
                    $chilled_base_r4 = 2450;
                    $chilled_additional_r4 = 2450; // Region 4: Tyugoku, Shikoku
                    $chilled_base_r5 = 2600;
                    $chilled_additional_r5 = 2600; // Region 5: Kyusyu, Hokkaido
                    $chilled_base_r6 = 2800;
                    $chilled_additional_r6 = 2800; // Region 6: Okinawa


                    $shipping_rates = array(

                        // ================ Region 1 Tokyo ==================
                        // Tokyo
                        'JP13' => array('base' => $dry_base_r1, 'additional' => $dry_additional_r1, 'chilled_base' => $chilled_base_r1, 'chilled_additional' => $chilled_additional_r1),
                        // ================ Region 1 Tokyo ==================X


                        //================= Region 2 Kantou =================
                        // Ibaraki, Tochigi, Gunma, Saitama, Chiba, Kanagawa	
                        'JP08' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP09' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP10' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP11' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP12' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP14' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        // Tyubu
                        //  Yamanashi,  Gifu, Shizuoka, Aichi	
                        'JP19' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP21' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP22' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP23' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),

                        // Hokuriku
                        // Toyama, Ishikawa, Fukui	
                        'JP16' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP17' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP18' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),

                        // Shinetsu
                        // Niigata, Nagano
                        'JP15' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP20' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),

                        // touhoku
                        // Aomori, Iwate, Miyagi, Akita, Yamagata, Fukushima
                        'JP02' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP03' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP04' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP05' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP06' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),
                        'JP07' => array('base' => $dry_base_r2, 'additional' => $dry_additional_r2),

                        //================= Region 2 Kantou =================X


                        //================= Region 3 Kansai =================
                        // Osaka, Kyoto, Hyogo, Nara, Mie, Shiga, Wakayama	
                        'JP26' => array('base' => $dry_base_r3, 'additional' => $dry_additional_r3),
                        'JP27' => array('base' => $dry_base_r3, 'additional' => $dry_additional_r3),
                        'JP28' => array('base' => $dry_base_r3, 'additional' => $dry_additional_r3),
                        'JP29' => array('base' => $dry_base_r3, 'additional' => $dry_additional_r3),
                        'JP30' => array('base' => $dry_base_r3, 'additional' => $dry_additional_r3),
                        'JP25' => array('base' => $dry_base_r3, 'additional' => $dry_additional_r3),
                        'JP24' => array('base' => $dry_base_r3, 'additional' => $dry_additional_r3),

                        //================= Region 3 Kansai =================X

                        //================= Region 4 ========================
                        // Tyugoku
                        // Okayama, Hiroshima, Tottori, Shimane, Yamaguchi	
                        'JP33' => array('base' => $dry_base_r4, 'additional' => $dry_additional_r4),
                        'JP34' => array('base' => $dry_base_r4, 'additional' => $dry_additional_r4),
                        'JP31' => array('base' => $dry_base_r4, 'additional' => $dry_additional_r4),
                        'JP32' => array('base' => $dry_base_r4, 'additional' => $dry_additional_r4),

                        // Shikoku
                        // Kagawa, Tokushima, Ehime, Kochi	
                        'JP37' => array('base' => $dry_base_r4, 'additional' => $dry_additional_r4),
                        'JP36' => array('base' => $dry_base_r4, 'additional' => $dry_additional_r4),
                        'JP38' => array('base' => $dry_base_r4, 'additional' => $dry_additional_r4),
                        'JP39' => array('base' => $dry_base_r4, 'additional' => $dry_additional_r4),

                        //================= Region 4 ========================X

                        //================= Region 5 ========================
                        // Kyusyu
                        // Fukuoka, Saga, Nagasaki, Kumamoto, Oita, Miyazaki, Kagoshima	
                        'JP40' => array('base' => $dry_base_r5, 'additional' => $dry_additional_r5),
                        'JP41' => array('base' => $dry_base_r5, 'additional' => $dry_additional_r5),
                        'JP42' => array('base' => $dry_base_r5, 'additional' => $dry_additional_r5),
                        'JP43' => array('base' => $dry_base_r5, 'additional' => $dry_additional_r5),
                        'JP44' => array('base' => $dry_base_r5, 'additional' => $dry_additional_r5),
                        'JP45' => array('base' => $dry_base_r5, 'additional' => $dry_additional_r5),
                        'JP46' => array('base' => $dry_base_r5, 'additional' => $dry_additional_r5),
                        // Hokkaido
                        'JP01' => array('base' => $dry_base_r5, 'additional' => $dry_additional_r5),

                        //================= Region 5 ========================X

                        //================= Region 6 ========================
                        // Okinawa
                        'JP47' => array('base' => $dry_base_r6, 'additional' => $dry_additional_r6),
                        //================= Region 6 ========================X

                    );

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
                    // Get the state name using the state code
                    $state_name = isset($state_names[$destination]) ? $state_names[$destination] : 'Unknown';

                    // Region Rate array
                    $region_rate = isset($shipping_rates[$destination]) ? $shipping_rates[$destination] : null;

                    if ($region_rate) {
                        if ($chilled_weight > 0) {
                            // ========== Chilled Shipping ==========
                            // Calculate shipping cost
                            $additional_weight = max($total_weight - 24, 0); // Weight above the base 24kg
                            $additional_units = ceil($additional_weight / 24);
                            $shipping_cost = $region_rate['chilled_base'] + ($additional_units * $region_rate['chilled_additional']);


                            // Modify the title to include the state name
                            $shipping_title = 'Chilled/24Kg Shipping' . ' (' . $state_name . ')';
                        } else {
                            // ========== Dry Shipping ==========
                            // Calculate shipping cost
                            $additional_weight = max($total_weight - 25, 0); // Weight above the base 25kg
                            $additional_units = ceil($additional_weight / 25);
                            $shipping_cost = $region_rate['base'] + ($additional_units * $region_rate['additional']);



                            // Modify the title to include the state name
                            $shipping_title = 'Dry/25Kg Shipping' . ' (' . $state_name . ')';
                        }


                    } else {
                        // Default or fallback shipping cost if region is not in the list (If Outside Japan or Error)
                        $shipping_cost = 10000;
                    }



                    // Add the rate
                    $this->add_rate(
                        array(
                            'label' => $shipping_title,
                            'cost' => $shipping_cost,
                            'taxes' => false,
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
