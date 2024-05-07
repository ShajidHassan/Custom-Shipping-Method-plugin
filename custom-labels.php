<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

//  Show Custom Label and Description for Shipping Methods in Cart and Checkout Pages
function shinjuku_custom_cart_totals_shipping_method_label($method)
{
	$label = $method->get_label();
	$has_cost = 0 < $method->cost;
	$hide_cost = !$has_cost && in_array($method->get_method_id(), array('free_shipping', 'local_pickup'), true);

	// Add custom descriotion to shipping method
	$description = shinjuku_get_shipping_method_description($label);

	$label =
		'<b>' . $label . ' </b>
			<br>
			<p style="
			font-size: 11px;
			color: #202020;
			font-weight: 300;
			line-height: 1.3;
			margin-bottom: 7px;
			">' . $description . '</p>';


	if ($has_cost && !$hide_cost) {
		if (WC()->cart->display_prices_including_tax()) {
			$label .= 'Charge: ' . wc_price($method->cost + $method->get_shipping_tax());
			if ($method->get_shipping_tax() > 0 && !wc_prices_include_tax()) {
				$label .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
			}
		} else {
			$label .= 'Charge: ' . wc_price($method->cost);
			if ($method->get_shipping_tax() > 0 && wc_prices_include_tax()) {
				$label .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
			}
		}
	}

	$label .= $method->description . ' (<a href="/shipping-details/">details</a>)';

	return apply_filters('woocommerce_cart_shipping_method_full_label', $label, $method);
}

// A hook to return the function value
add_filter('shinjuku_custom_cart_totals_shipping_method_label_hook', 'shinjuku_custom_cart_totals_shipping_method_label', 10, 2);


// Get Shipping Method description based on the Shipping Method Label
function shinjuku_get_shipping_method_description($label)
{
	$description = '';

	if (strpos($label, 'Chilled') !== false) {
		// $description = 'Will be shipped  in a normal cool box to preserve freshness, with dry and frozen items together.';
		$description = '';
	}
	// TODO: check contains
	else if (strpos($label, 'Only Deep Frozen') !== false) {
		// $description = 'Deep-frozen shipping ensures items stay frozen until delivery. Frozen and dry items are shipped together.';
		$description = '';
	} else if (strpos($label, 'Separate Deep Frozen') !== false) {
		// $description = 'Deep-frozen shipping ensures items stay frozen until delivery. Frozen and dry items are shipped separately.';
		$description = '';
	} else if (strpos($label, 'Dry') !== false) {
		// $description = 'Items will be shipped in Dry Boxes.';
		$description = '';
	} else {
		$description = '';
	}


	return $description;
}
