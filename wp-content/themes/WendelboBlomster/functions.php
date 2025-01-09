<?php
function wendelbo_files(){
    wp_enqueue_style('main_styles', get_theme_file_uri('assets/css/mainstyle.css'));
    wp_enqueue_script('main_script', get_theme_file_uri('assets/js/scripts.js'));
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


//---------------- Woocommerce default filtrerings systems
add_action('woocommerce_product_query', 'custom_product_filter');

function custom_product_filter($query) {
    if (is_admin() || !$query->is_main_query() || (!is_shop() && !is_product_taxonomy())) {
        return;
    }

    $tax_query = $query->get('tax_query') ? $query->get('tax_query') : [];

    // Hent alle produktattributter fra WooCommerce
    $attributes = wc_get_attribute_taxonomies();

    foreach ($attributes as $attribute) {
        $taxonomy = wc_attribute_taxonomy_name($attribute->attribute_name); // F.eks. 'pa_farve'

        // Spring over farve-taksonomien
        if ($taxonomy === 'pa_farve') {
            continue; // Ignorer farver og gå videre til næste taksonomi
        }

        // Kontroller om $_GET indeholder værdier for denne taksonomi
        if (isset($_GET[$taxonomy]) && !empty($_GET[$taxonomy])) {
            $selected_terms = $_GET[$taxonomy];

            // Sørg for, at værdierne altid er arrays
            if (!is_array($selected_terms)) {
                $selected_terms = [sanitize_text_field($selected_terms)];
            } else {
                $selected_terms = array_map('sanitize_text_field', $selected_terms);
            }

            // Tilføj til tax_query
            $tax_query[] = [
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $selected_terms,
                'operator' => 'AND', // Kun produkter, der matcher alle valgte værdier
            ];
        }
    }

    // Debugging: Log tax_query for at kontrollere strukturen
    error_log(print_r($tax_query, true));

    // Tilføj tax_query til WooCommerce-forespørgslen
    if (!empty($tax_query)) {
        $query->set('tax_query', $tax_query);
    }
}
add_action('woocommerce_product_query', 'custom_product_filter_farve');

function custom_product_filter_farve($query) {
    if (is_admin() || ! $query->is_main_query() || (!is_shop() && !is_product_taxonomy())) {
        return;
    }

    $tax_query = $query->get('tax_query') ? $query->get('tax_query') : [];

    // Filtrer baseret på Farve
    if (isset($_GET['farve']) && !empty($_GET['farve'])) {
        $tax_query[] = [
            'taxonomy' => 'pa_farve', // Slug for Farve-attributten
            'field'    => 'slug',
            'terms'    => $_GET['farve'],
            'operator' => 'IN',
        ];
    }

    if (!empty($tax_query)) {
        $query->set('tax_query', $tax_query);
    }
}