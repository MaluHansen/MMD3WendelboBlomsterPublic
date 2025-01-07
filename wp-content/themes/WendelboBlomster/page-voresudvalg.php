<?php

defined( 'ABSPATH' ) || exit;

get_header(); ?>

<!-- <div class="shop-hero" style="background-image: url('<?php echo get_template_directory_uri(''); ?>/assets/img/Vores udvalg/vores_udvalg_hero.jpg');">
    <h1>Smukke blomster til enhver begivenhed</h1>
</div> -->

    <div class="shop-intro">
        <h1><?php 
            if ( is_product_category() ) {
                single_term_title(); // Display the current category name
            } else {
                echo 'Vores udvalg'; // Default title for the main shop page
            }
            ?></h1>
        <p>Find inspiration i vores udvalg af produkter. Der er noget for enhver smag og anledning.</p>
    </div>
    <?php

    // Check if this is a product category archive
    if ( is_product_category() || is_product_taxonomy() ) {
        // Display the category products
        woocommerce_product_loop_start();

        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                wc_get_template_part( 'content', 'product' );
            }
        } else {
            echo '<p>No products found in this category.</p>';
        }

        woocommerce_product_loop_end();
    } else {



    // Display categories (your custom code from earlier)
    $categories = get_terms( array(
        'taxonomy'   => 'product_cat',
        'parent'     => 0 //viser kun de kategorier som ikke har en parent
    ) );

    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
        echo '<div class="produkt-kategori-wrapper">';
        foreach ( $categories as $category ) {
            $category_link = get_term_link( $category );
            $thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
            $thumbnail_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : wc_placeholder_img_src();

            echo '<div class="produkt-kategori-entry">';
                echo '<a class="kategori-entry-link" href="' . esc_url( $category_link ) . '">';
                    echo '<div class="kategori-content">';
                        echo '<img class="kategori-billede" src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( $category->name ) . '">';
                        echo '<h3 class="produkt-kategori-navn">' . esc_html( $category->name ) . '</h3>';
                        // Få antallet af produkter i kategorien
                        $product_count = $category->count;
                        echo '<p class="produkt-antal">' . esc_html($product_count) . ' produkter</p>'; 
                    echo '</div>';
                echo '</a>';
            echo '</div>';
            
        }
        echo '</div>';
    } 
    }?>


    <?php get_footer();
