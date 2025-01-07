<?php

defined( 'ABSPATH' ) || exit;

get_header(); ?>
    <h1><?php the_title(); ?></h1> 
    
    <?php
    // Check if this is a product category archive
    if ( is_product_taxonomy() ) {
        // Display the category products
        woocommerce_product_loop_start();
            while ( have_posts() ) {
                the_post();
                wc_get_template_part( 'content', 'product' );//premade templates der kommer fra woocommerce, indeholder data om produkter og hvad der skal vises 
            }
        woocommerce_product_loop_end();
    } else {



    $categories = get_terms( array(
        'taxonomy'   => 'product_cat',
        'parent'     => 0 //viser kun de kategorier som ikke har en parent
    ) );

    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
        echo '<div class="produkt-kategori-wrapper">';
        foreach ( $categories as $category ) {
            $category_link = get_term_link( $category );
            $thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
            $thumbnail_url = wp_get_attachment_url( $thumbnail_id );
            $product_count = $category->count; // Få antallet af produkter i kategorien
            ?>
            <div class="produkt-kategori-entry">
                <a class="kategori-entry-link" href="<?php echo esc_url( $category_link ); ?>">
                    <div class="kategori-content">
                        <img class="kategori-billede" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
                        <h3 class="produkt-kategori-navn"><?php echo esc_html( $category->name ); ?></h3>
                        <p class="produkt-antal"><?php echo esc_html($product_count); ?> produkter</p>
                    </div>
                </a>
            </div>
            <?php
            
        }
        echo '</div>';
    } 
    }
    get_footer();
