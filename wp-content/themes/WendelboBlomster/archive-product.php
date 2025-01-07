<?php

get_header(); ?>

<main>
<h1 class="shop-header"><?php woocommerce_page_title(); ?></h1>
<div class="shop-container">
    <!-- Sidebar til filtre -->
    <aside class="shop-sidebar">
        <h2>Filtre</h2>
        <div class="filter-section">
            <h3>Farve</h3>
            <ul>
                <li><input type="checkbox" id="red" name="red"> <label for="red">Rød</label></li>
                <li><input type="checkbox" id="white" name="white"> <label for="white">Hvid</label></li>
            </ul>
        </div>

        <div class="filter-section">
            <h3>Pris</h3>
            <ul>
                <li><input type="radio" id="under-350" name="price"> <label for="under-350">Under 350 kr.</label></li>
                <li><input type="radio" id="over-350" name="price"> <label for="over-350">Over 350 kr.</label></li>
            </ul>
        </div>

        <button class="filter-button">Gem</button>
    </aside>

    <!-- Hovedområde til produkter -->
    <div class="shop-main">
        <?php while ( have_posts() ) :
        the_post();
        wc_get_template_part( 'content', 'product' );
        endwhile; ?>
    </div>

</div>
</main>

<?php get_footer(); ?>
