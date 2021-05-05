
// Filtros de precio por usuario y categoria
add_filter( 'woocommerce_get_price_html', function( $price ) {
	$current_user = wp_get_current_user();
	$allowed_roles = array( 'customer','suscriber'); // el rol a esconder el precio, en ingles
	// Categorias a esconder
	$hide_for_categories = array( 'categoria', 'categoria' );
	// Si el rol de usuario esta en el array y tiene esta categoria -> esconde el agregar el carrito y el precio, devuelveme este mensaje
	if (array_intersect( $current_user->roles, $allowed_roles ) && has_term( $hide_for_categories, 'product_cat' ) ) {
		add_filter( 'woocommerce_is_purchasable', '__return_false');
		return 'MENSAJE DESEADO';
		
	} 
	return $price; //Regresa al precio original
}, 10, 2 ); 


// Mensaje de zona de envios sin costo
add_filter( 'woocommerce_cart_needs_shipping', '__return_true' );
add_filter( 'woocommerce_cart_no_shipping_available_html', 'change_noship_message' );
add_filter( 'woocommerce_no_shipping_available_html', 'change_noship_message' );
function change_noship_message() {
    print "Costo de envío NO incluido, el producto se entrega en puerta. Dudas o aclaraciones favor de contactarnos <a href='tel:3333333333'>3333333333</a>.";
}

// Esconder precios a usuarios NO LOGUEADOS 
add_filter( 'woocommerce_get_price_html', function( $price ) {
	if ( ! is_user_logged_in() ) {
		add_filter( 'woocommerce_is_purchasable', '__return_false');
		return 'MENSAJE DESEADO';
	}

	return $price; // Regresa al precio original
} );

