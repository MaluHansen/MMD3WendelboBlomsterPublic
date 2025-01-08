<?php
function wendelbo_files(){
    wp_enqueue_style('main_styles', get_theme_file_uri('assets/css/mainstyle.css'));
}
add_action('wp_enqueue_scripts', 'wendelbo_files');

add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
});
//woocommerce zoom funktion der kører scriptet zoom.min.js, se mere i single-product.php
add_theme_support( 'wc-product-gallery-zoom' );

//woocommerce cart functions
add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity');

//generere dynamisk title 
add_theme_support('title-tag');

function update_cart_quantity() {
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity_change = intval($_POST['quantity_change']);

    $cart = WC()->cart->get_cart();
    if (isset($cart[$cart_item_key])) {
        $current_quantity = $cart[$cart_item_key]['quantity'];
        $new_quantity = max(1, $current_quantity + $quantity_change); // Minimum 1
        WC()->cart->set_quantity($cart_item_key, $new_quantity, true);
        wp_send_json_success();
    } else {
        wp_send_json_error('Produkt ikke fundet i kurven.');
    }

    wp_die();
}
