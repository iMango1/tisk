<?php
/**
 * WooCommerce Cash On Pickup
 * Copyright (C) 2013-2014 Pinch Of Code. All rights reserved.
 * Copyright (C) 2017 Marian Kadanka. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists( 'WC_Gateway_Cash_on_pickup' ) ):

/**
 * Main plugin class
 *
 * Provides a Cash on Pickup Payment Gateway.
 *
 * @class 		WC_Gateway_Cash_on_pickup
 * @extends		WC_Payment_Gateway
 */
class WC_Gateway_Cash_on_pickup extends WC_Payment_Gateway {

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {
		load_plugin_textdomain( 'wc_cop', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/i18n/' );

		// Setup general properties
		$this->setup_properties();

		// Load the settings
		$this->init_form_fields();
		$this->init_settings();

		// Get settings
		$this->title                = $this->get_option( 'title' );
		$this->description          = $this->get_option( 'description' );
		$this->instructions         = $this->get_option( 'instructions' );
		$this->enable_for_methods   = $this->get_option( 'enable_for_methods', array() );
		$this->default_order_status = $this->get_option( 'default_order_status', apply_filters( 'wc_cop_default_order_status', 'on-hold') );

		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_thankyou_' . $this->id, array( $this, 'thankyou_page' ) );

		// Customer Emails
		add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );
	}

	/**
	 * Setup general properties for the gateway.
	 */
	protected function setup_properties() {
		$this->id                 = 'cop';
		$this->icon               = apply_filters( 'woocommerce_cop_icon', '' );
		$this->method_title       = __( 'Cash on pickup', 'wc_cop' );
		$this->method_description = __( 'Have your customers pay with cash (or by other means) on pickup.', 'wc_cop' );
		$this->has_fields         = false;
	}

	/**
	 * Initialise Gateway Settings Form Fields.
	 */
	public function init_form_fields() {
		$shipping_methods = array();
		$order_statuses = array();

		if ( is_admin() ) {
			foreach ( WC()->shipping->load_shipping_methods() as $method ) {
				$shipping_methods[ $method->id ] = $method->get_method_title();
			}

			$statuses = function_exists( 'wc_get_order_statuses' ) ? wc_get_order_statuses() : array();
			foreach ( $statuses as $status => $status_name ) {
				$order_statuses[ substr( $status, 3 ) ] = $status_name;
			}
		}

		$this->form_fields = array(
			'enabled' => array(
				'title'       => __( 'Enable/Disable', 'woocommerce' ),
				'label'       => __( 'Enable cash on pickup', 'wc_cop' ),
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no',
			),
			'title' => array(
				'title'       => __( 'Title', 'woocommerce' ),
				'type'        => 'text',
				'description' => __( 'Payment method description that the customer will see on your checkout.', 'woocommerce' ),
				'default'     => __( 'Cash on pickup', 'wc_cop' ),
				'desc_tip'    => true,
			),
			'description' => array(
				'title'       => __( 'Description', 'woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your website.', 'woocommerce' ),
				'default'     => __( 'Pay with cash on pickup.', 'wc_cop' ),
				'desc_tip'    => true,
			),
			'instructions' => array(
				'title'       => __( 'Instructions', 'woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'Instructions that will be added to the thank you page.', 'woocommerce' ),
				'default'     => __( 'Pay with cash on pickup.', 'wc_cop' ),
				'desc_tip'    => true,
			),
			'enable_for_methods' => array(
				'title'       => __( 'Enable for shipping methods', 'woocommerce' ),
				'type'        => 'multiselect',
				'class'       => 'chosen_select',
				'css'         => 'width: 450px;',
				'default'     => '',
				'description' => __( 'If COP is only available for certain methods, set it up here. Leave blank to enable for all methods.', 'wc_cop' ),
				'options'     => $shipping_methods,
				'desc_tip'    => true,
			),
			'default_order_status' => array(
				'title'       => __( 'Default order status', 'wc_cop' ),
				'type'        => 'select',
				'default'     => apply_filters( 'wc_cop_default_order_status', 'on-hold' ),
				'options'     => $order_statuses,
			),
		);
	}

	/**
	 * Check If The Gateway Is Available For Use.
	 *
	 * @return bool
	 */
	public function is_available() {
		$order          = null;
		$needs_shipping = false;

		// Test if shipping is needed first
		if ( WC()->cart && WC()->cart->needs_shipping() ) {
			$needs_shipping = true;
		} elseif ( is_page( wc_get_page_id( 'checkout' ) ) && 0 < get_query_var( 'order-pay' ) ) {
			$order_id = absint( get_query_var( 'order-pay' ) );
			$order    = wc_get_order( $order_id );

			// Test if order needs shipping.
			if ( 0 < sizeof( $order->get_items() ) ) {
				foreach ( $order->get_items() as $item ) {
					if ( version_compare( WC_VERSION, '3.0', '<' ) ) {
						$_product = $order->get_product_from_item( $item );
					} else {
						$_product = $item->get_product();
					}
					if ( $_product && $_product->needs_shipping() ) {
						$needs_shipping = true;
						break;
					}
				}
			}
		}

		$needs_shipping = apply_filters( 'woocommerce_cart_needs_shipping', $needs_shipping );

		// Virtual order
		if ( ! $needs_shipping ) {
			return false;
		}

		// Check methods
		if ( ! empty( $this->enable_for_methods ) && $needs_shipping ) {

			// Only apply if all packages are being shipped via chosen methods, or order is virtual
			$chosen_shipping_methods_session = WC()->session->get( 'chosen_shipping_methods' );

			if ( isset( $chosen_shipping_methods_session ) ) {
				$chosen_shipping_methods = array_unique( $chosen_shipping_methods_session );
			} else {
				$chosen_shipping_methods = array();
			}

			$check_method = false;

			if ( is_object( $order ) ) {
				if ( $order->shipping_method ) {
					$check_method = $order->shipping_method;
				}
			} elseif ( empty( $chosen_shipping_methods ) || sizeof( $chosen_shipping_methods ) > 1 ) {
				$check_method = false;
			} elseif ( sizeof( $chosen_shipping_methods ) == 1 ) {
				$check_method = $chosen_shipping_methods[0];
			}

			if ( ! $check_method ) {
				return false;
			}

			$found = false;

			foreach ( $this->enable_for_methods as $method_id ) {
				if ( strpos( $check_method, $method_id ) === 0 ) {
					$found = true;
					break;
				}
			}

			if ( ! $found ) {
				return false;
			}
		}

		return parent::is_available();
	}

	/**
	 * Process the payment and return the result.
	 *
	 * @param int $order_id
	 * @return array
	 */
	public function process_payment( $order_id ) {
		$order = wc_get_order( $order_id );

		$order->update_status( apply_filters( 'wc_cop_default_order_status', $this->default_order_status ) );

		// Reduce stock levels
		if ( version_compare( WC_VERSION, '3.0', '<' ) ) {
			$order->reduce_order_stock();
		} else {
			wc_reduce_stock_levels( $order_id );
		}

		// Remove cart
		WC()->cart->empty_cart();

		// Return thankyou redirect
		return array(
			'result' 	=> 'success',
			'redirect'	=> $this->get_return_url( $order ),
		);
	}

	/**
	 * Output for the order received page.
	 */
	public function thankyou_page() {
		if ( $this->instructions ) {
			echo wpautop( wptexturize( $this->instructions ) );
		}
	}

	/**
	 * Add content to the WC emails.
	 *
	 * @access public
	 * @param WC_Order $order
	 * @param bool $sent_to_admin
	 * @param bool $plain_text
	 */
	public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {
//*		if ( $this->instructions && ! $sent_to_admin && $this->id === $order->get_payment_method() && $order->has_status( $this->default_order_status ) )
 {
			echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
		}
	}
}
endif;
