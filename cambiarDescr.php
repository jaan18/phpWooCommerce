// Move Variation Description to Product Description Tab or WooCommerce short description 
// in $entry_summary you can customize your code
add_action( 'wp_footer', 'ec_child_modify_wc_variation_desc_position' );
function ec_child_modify_wc_variation_desc_position() { ?>
    <script>
    (function($) {
        $(document).on( 'found_variation', function() {
            var desc = $( '.woocommerce-variation.single_variation' ).find( '.woocommerce-variation-description' ).html();

            var $entry_summary = $( '.woocommerce-product-details__short-description' ), $wc_var_desc = $entry_summary.find( '.woocommerce-variation-description' );

            if ( $wc_var_desc.length == 0 ) {
                $entry_summary.append( '<div class="woocommerce-variation-description"></div>' );
            }

            $entry_summary.find( '.woocommerce-variation-description' ).html( desc );
        });
    })( jQuery );

    </script>

    <style>
        form.variations_form .woocommerce-variation-description {
            display: none;
        }
    </style>

<?php }
