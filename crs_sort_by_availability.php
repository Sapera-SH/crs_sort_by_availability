<?php
	/*
	Plugin Name: Cloud Retail Systems A/S - Sort by availability
	Plugin URI: http://cloudretailsystems.dk
	Description: Sort by availability in categories and make the default sort order availability
	Author: Cloud Retail Systems A/S - Søren Højby
	Version: 1.0
	Author URI: http://cloudretailsystems.dk
	*/



	// Ordering products based on the selected values
	function filter_woocommerce_get_catalog_ordering_args( $args, $orderby, $order ) {
		switch( $orderby ) {
			case 'availability':
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				$args['meta_key'] = '_stock';
				break;
		}
		return $args;
	}
	add_filter( 'woocommerce_get_catalog_ordering_args', 'filter_woocommerce_get_catalog_ordering_args', 10, 3 );

	// Orderby setting
	function filter_orderby( $orderby ) {
		$orderby['availability'] = __( 'Availability', 'woocommerce' );
		return $orderby;
	}
	add_filter( 'woocommerce_default_catalog_orderby_options', 'filter_orderby', 10, 1 );
	add_filter( 'woocommerce_catalog_orderby', 'filter_orderby', 10, 1 );

	// Optional: use for debug purposes (display stock quantity)
	// function action_woocommerce_after_shop_loop_item() {
	// global $product;
	// echo '<div style="color: red !important; font-size: 20px !important;">' . wc_get_stock_html( $product ) . '</div>';
	// }
	// add_action( 'woocommerce_after_shop_loop_item', 'action_woocommerce_after_shop_loop_item', 9, 0 );



