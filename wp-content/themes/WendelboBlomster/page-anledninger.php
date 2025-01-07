<?php get_header(); ?>
<main>
    <?php $feature_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
    <div class="page-hero" style="background-image: url('<?php echo esc_url($feature_image_url); ?>');">
        <p>Gør hver anledning særlig med blomster</p>
    </div>
    <h1 class="page-hero-h1"><?php the_title();?></h1>
    <h4 class="page-hero-p"><?php the_content(); ?></h4>
    <?php
    $categories = get_terms( array(
        'taxonomy'   => 'product_cat',
        'parent'     => 23 //der skal kun vises kategorier som er en subkategori til alle produkter(id=23)
    ) );

    echo '<div class="produkt-kategori-wrapper">';
    foreach ( $categories as $category ) {
        $category_link = get_term_link( $category );
        $thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
        $thumbnail_url = wp_get_attachment_url( $thumbnail_id );

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
    
    ?>

</main>
<?php get_footer();
