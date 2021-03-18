// Los precios se pueden ver si los añade al carrito 
// Esconder todos los precios por rol de usuario 

add_filter( 'woocommerce_get_price_html', function( $price ) {
	if ( is_admin() ) return $price;

	return '';
} );



// Esconder precios para usuarios no logueados 

add_filter( 'woocommerce_get_price_html', function( $price ) {
	if ( ! is_user_logged_in() ) {
		return '';
	}

	return $price; // Return original price
} );

add_filter( 'woocommerce_cart_item_price', '__return_false' );
add_filter( 'woocommerce_cart_item_subtotal', '__return_false' );

// Esconder precios por productos especificos 

add_filter( 'woocommerce_get_price_html', function( $price, $product ) {

	$hide_for_products = array( id_product );
	if ( in_array( $product->get_id(), $hide_for_products ) ) {
		return '';
	}

	return $price; // Return original price
}, 10, 2 );

add_filter( 'woocommerce_cart_item_price', '__return_false' );
add_filter( 'woocommerce_cart_item_subtotal', '__return_false' );
