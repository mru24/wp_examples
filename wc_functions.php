<?php
/**
 *  Switch ONSALE BADGE off
 */

add_filter('woocommerce_sale_flash','ww_hide_sale_flash');
function ww_hide_sale_flash() {
	return false;
}

/**
 * Remove related products output
 */

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * Show variation price even if prices are same
 */
add_filter('woocommerce_show_variation_price', function() { return true; });

/**
 * To change add to cart text on single product page
 */
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' );
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to basket', 'woocommerce' );
}

/**
 * To change add to cart text on product archives(Collection) page
 */
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Add to basket', 'woocommerce' );
}

add_filter( 'gettext', 'my_text_strings', 20, 3 );
add_filter( 'woocommerce_add_to_cart_fragments', 'cart_count_fragments', 10, 1 );
function my_text_strings( $translated_text, $text, $domain ) {
  switch ( strtolower( $translated_text ) ) {
    case 'View Cart' :
      $translated_text = __( 'View Shopping Basket', 'woocommerce' );
      break;
    }
    return $translated_text;
}

/**
 * UPDATE CART ITEMS IN HEADER
 */

// V1
function cart_count_fragments( $fragments ) {
	// ITEM COUNT
	$itemsInCart = WC()->cart->get_cart_contents_count();
	$noun = " items";
	if($itemsInCart==1) $noun = " item";
	$fragments['p.cart-count'] = '<p class="text-right cart-count">'.$itemsInCart.$noun.'</p>';

	// ITEM TOTAL
	$cartTotal = WC()->cart->get_cart_contents_total();
	$fragments['p.cart-total'] = '<p class="text-right cart-total color-primary 222"><strong>£'.number_format($cartTotal,2).'</strong></p>';

	return $fragments;
}

// V2
add_filter( 'woocommerce_add_to_cart_fragments', 'ww_cart_count_fragments', 10, 1 );

function ww_cart_count_fragments( $fragments ) {
    $fragments['footer .items-count'] = '<div class="items-count">'.WC()->cart->get_cart_contents_count() . ' item(s) in your basket</div>';
		$fragments['header .items-count'] = '<div class="items-count">'.WC()->cart->get_cart_contents_count() . '</div>';
    return $fragments;
}

/**
 *  Change "Your cart is currently empty." message
 */
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
add_action( 'woocommerce_cart_is_empty', 'custom_empty_cart_message', 10 );

function custom_empty_cart_message() {
    $html  = '<p class="cart-empty woocommerce-info">';
    $html .= wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your basket is currently empty.', 'woocommerce' ) ) );
    echo $html . '</p>';
}

/**
 *  Change "... has been added by to your cart." message and View cart button
 */
add_filter( 'wc_add_to_cart_message', 'my_add_to_cart_function', 10, 2 );

function my_add_to_cart_function( $message, $product_id ) {
    $html  = '<a href="/basket/" tabindex="1" class="button wc-forward">View basket</a>';
	$html .=  sprintf(esc_html__('"%s" has been added by to your basket.','woocommerce'), get_the_title( $product_id ) );
    return $html;
}

/**
 *  Change "Cart updated" message
 */
add_filter('woocommerce_add_message', 'se53209949_woocommerce_add_message', 10, 0);
function se53209949_woocommerce_add_message() {
    return __('Basket updated', 'woocommerce');
}

/**
 *	Change SHIPPING to eg. DELIVERY
 */
add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
return 'Delivery';
}

function fix_woocommerce_strings( $translated, $text) {
// STRING 1
$translated = str_ireplace( 'Shipping', 'Delivery charge', $translated );

return $translated;
}
add_filter( 'gettext', 'fix_woocommerce_strings', 999, 3 );


/**
 * 	Change CART to BASKET
 */
add_filter( 'gettext', 'ww_change_cart_to_basket' );
add_filter( 'ngettext', 'ww_change_cart_to_basket' );

function ww_change_cart_to_basket( $string ) {
  $string = str_ireplace( 'cart', 'basket', $string );
  return $string;
}