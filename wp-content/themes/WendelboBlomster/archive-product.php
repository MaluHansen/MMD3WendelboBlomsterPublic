<?php

get_header(); ?>

<main>
<h1 class="shop-header"><?php woocommerce_page_title(); ?></h1>
<div class="shop-container">
<aside class="shop-sidebar">
    <h2>Filtre</h2>
    <form method="GET" action="">
    <div class="filter-section">
            <h3>Farve</h3>
            <ul>
                <li>
                    <input type="checkbox" id="bla" name="farve[]" value="bla" <?php echo (isset($_GET['farve']) && in_array('bla', $_GET['farve'])) ? 'checked' : ''; ?>> 
                    <label for="bla">Blå</label>
                </li>
                <li>
                    <input type="checkbox" id="gron" name="farve[]" value="gron" <?php echo (isset($_GET['farve']) && in_array('gron', $_GET['farve'])) ? 'checked' : ''; ?>> 
                    <label for="gron">Grøn</label>
                </li>
                <li>
                    <input type="checkbox" id="gul" name="farve[]" value="gul" <?php echo (isset($_GET['farve']) && in_array('gul', $_GET['farve'])) ? 'checked' : ''; ?>> 
                    <label for="gul">Gul</label>
                </li>
                <li>
                    <input type="checkbox" id="hvid" name="farve[]" value="hvid" <?php echo (isset($_GET['farve']) && in_array('hvid', $_GET['farve'])) ? 'checked' : ''; ?>> 
                    <label for="hvid">Hvid</label>
                </li>
                <!-- Tilføj flere farver her -->
            </ul>
        </div>
        <?php
        // Hent alle produktattributter fra WooCommerce
        $attributes = wc_get_attribute_taxonomies();

        foreach ($attributes as $attribute) {
            $taxonomy = wc_attribute_taxonomy_name($attribute->attribute_name); // Slug for attributten (f.eks. 'pa_farve')

            // Ignorer farve-taksonomien
            if ($taxonomy === 'pa_farve' || $taxonomy === 'pa_storrelse') {
                continue; // Spring over farve
            }

            // Hent termer for den aktuelle taksonomi
            $terms = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ]);

            if (!empty($terms)) {
                echo '<div class="filter-section">';
                echo '<h3>' . esc_html($attribute->attribute_label) . '</h3>';
                echo '<ul>';

                foreach ($terms as $term) {
                    $term_slug = $term->slug; // Termens slug
                    $term_name = $term->name; // Termens navn

                    // Marker checkboxen som valgt, hvis slug findes i $_GET
                    $checked = (isset($_GET[$taxonomy]) && in_array($term_slug, $_GET[$taxonomy])) ? 'checked' : '';

                    // Output af HTML for hver term
                    echo '<li>';
                    echo '<input type="checkbox" id="' . esc_attr($term_slug) . '" 
                           name="' . esc_attr($taxonomy) . '[]" 
                           value="' . esc_attr($term_slug) . '" ' . $checked . '> ';
                    echo '<label for="' . esc_attr($term_slug) . '">' . esc_html($term_name) . '</label>';
                    echo '</li>';
                }

                echo '</ul>';
                echo '</div>';
            }
        }
        ?>
        <button type="submit" class="filter-button">Filtrer</button>
    </form>
</aside>










    <div class="shop-main">
        <?php while ( have_posts() ) :
        the_post();
        global $product; // woocommerce standart var til de produkter der oprettes i wp backend 
        ?>
        <div class="shop-produkt-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo woocommerce_get_product_thumbnail(); ?>
                    </a>
                    <p class="produkt-navn"><?php the_title(); ?></p>
                    <p class="produkt-pris"><?php echo $product->get_price_html(); ?></p>
                </div>
       <?php endwhile; ?>
    </div>

</div>
</main>

<?php get_footer(); ?>
