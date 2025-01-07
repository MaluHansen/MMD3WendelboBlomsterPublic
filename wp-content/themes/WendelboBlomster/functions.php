<?php
function wendelbo_files(){
    wp_enqueue_style('main_styles', get_theme_file_uri('assets/css/mainstyle.css'));
}
add_action('wp_enqueue_scripts', 'wendelbo_files');

add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
});


// AJAX handler to update cart contents
function update_cart_contents() {
    ob_start();

    if ( WC()->cart->is_empty() ) {
        echo '<p>Din kurv er tom.</p>';
    } else {
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $product = $cart_item['data'];
            $product_name = $product->get_name();
            $product_price = wc_price( $product->get_price() );
            $quantity = $cart_item['quantity'];

            echo '<div class="cart-item">';
            echo '<p>' . esc_html( $product_name ) . ' x ' . esc_html( $quantity ) . '</p>';
            echo '<p>' . esc_html( $product_price ) . '</p>';
            echo '</div>';
        }
    }

    $cart_contents = ob_get_clean();
    echo $cart_contents;

    wp_die(); // Required to end the AJAX request
}
add_action( 'wp_ajax_update_cart_contents', 'update_cart_contents' );
add_action( 'wp_ajax_nopriv_update_cart_contents', 'update_cart_contents' );


function enqueue_custom_cart_script() {
    wp_enqueue_script( 'custom-cart-script', get_template_directory_uri() . 'assets/js/scripts.js', array( 'jquery' ), null, true );

    // Pass WooCommerce AJAX URL to the script
    wp_localize_script( 'custom-cart-script', 'woocommerce_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_cart_script' );
