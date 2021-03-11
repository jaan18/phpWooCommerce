// Remove Additional Information tab
add_filter( 'woocommerce_product_tabs', 'yikes_remove_additional_information_tab', 20, 1 );

function yikes_remove_additional_information_tab( $tabs ) {

	// Remove the Additional Info tab
	if ( isset( $tabs['additional_information'] ) ) {
		unset( $tabs['additional_information'] );
	} 
	return $tabs;
  
}