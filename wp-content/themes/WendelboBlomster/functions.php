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

