<?php get_header(); ?>
<main>
        <section class="hero" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/heroForside.jpg') ?>);">
            <h1 class="header-forside">Sæt farve på livet med Wendelbo blomster</h1>
            <p class="body-tekst">Bestil smukke buketter, personligt begravelsesbinderi, gaveartikler og meget mere – med mulighed for både udbringning og afhentning</p>
            <a class="btn-hvid" href="#">Udfork vores udvalg</a>
        </section>

        <section class="udvalgte">
            <div class="udvalgte-tekst">
                <h2>Sæsonens udvalgte</h2>
                <p>For dig, der gerne vil finde blomster, der passer til den aktuelle sæson, så har vi udvalgt blomster, der matcher årets store begivenheder, så du kan nyde de bedste farver og dufte året rundt.</p>
                <a class="btn-gron" href="#">Se sæsonens blomster</a>
            </div>
            <div>
                <img src="<?php echo get_theme_file_uri('assets/img/Seasonsbillede.jpg'); ?>" alt="Billede af forårsblomster" class="entryPoint-img">
            </div>
        </section>
        <section class="verdier">
            <div class="levering">
                <i class="fa-solid fa-truck-fast verdier-i"></i>
                <p class="verdier-header">Omhyggelig levering</p>
                <p class="body-tekst">Vi leverer blomster i hele Aalborg, hvor hver buket tilpasses omhyggeligt og leveres personligt</p>
            </div>
            <div class="friskeblomster">
                <i class="fa-solid fa-seedling verdier-i"></i>
                <p class="verdier-header">Friske blomster</p>
                <p class="body-tekst">Hos os finder du friske blomster af høj kvalitet, der er klar til at bringe glæde til enhver anledning</p>
            </div>
            <div class="personligBindning">
                <i class="fa-regular fa-comments verdier-i"></i>
                <p class="verdier-header">Personlig blomsterbinding</p>
                <p class="body-tekst">Mulighed for at komme ind og få en personlig samtale samt få skræddersyet din blomsterbinding</p>
            </div>
        </section>
        <section class="populare">
    <h2>Sæsonens mest populære buketter</h2>
    <p class="body-tekst">De mest købte buketter lige nu</p>
    <div class="cards">
        <?php
        // Hent 3 produkter fra kategorien "Buketter"
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 3,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug', // Brug slug for at matche kategorien "Buketter"
                    'terms'    => 'buketter',
                ),
            ),
        );
        $buketter_query = new WP_Query( $args );

        // Loop gennem produkterne
        if ( $buketter_query->have_posts() ) {
            while ( $buketter_query->have_posts() ) {
                $buketter_query->the_post();
                global $product; // WooCommerce produkt objekt
                ?>
                <div class="produkt-card">
                    <div class="produktbillede">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo woocommerce_get_product_thumbnail(); ?>
                        </a>
                    </div>
                    <p class="produkt-navn"><?php the_title(); ?></p>
                    <p class="produkt-pris"><?php echo $product->get_price_html(); ?></p>
                </div>
                <?php
            }
        } else {
            echo '<p>Ingen buketter fundet.</p>';
        }
        wp_reset_postdata(); // Nulstil forespørgslen
        ?>
    </div>
    <a href="<?php echo get_term_link( 'buketter', 'product_cat' ); ?>" class="btn-gron">Se alle buketter</a>
</section>

        <section class="interflora" style="background-image: url(<?php echo get_theme_file_uri('assets/img/samarbejde.jpg') ?>);">
            <h3>Samarbejde med Interflora</h3>
            <img class="interfloraLogo" src="<?php echo get_theme_file_uri('assets/img/interflora-logo.png'); ?>" alt="Interfloras logo">
            <p>Med vores samarbejde med Interflora kan vi sende blomster til næsten hele verden. Nogle af de smukkeste buketter i vores butik kommer direkte fra Interfloras netværk, hvilket giver os et bredere udvalg af friske blomster.</p>
        </section>
        <section class="serligDag">
            <h2>Til en særlig dag</h2>
            <div class="cards">
    <?php
    $categories = [
        'jul' => 'jul.jpg',
        'nytar' => 'nytaar.jpg',
        'bryllup' => 'bryllup.jpg',
    ];

    foreach ( $categories as $slug => $image ) :
        $link = get_term_link( $slug, 'product_cat' );
        if ( ! is_wp_error( $link ) ) : ?>
            <a class="<?php echo esc_attr( $slug ); ?>-entry entry" href="<?php echo esc_url( $link ); ?>" style="background-image: url(<?php echo esc_url( get_theme_file_uri( 'assets/img/' . $image ) ); ?>);">
                <?php echo esc_html( ucfirst( $slug ) ); ?>
            </a>
        <?php endif;
    endforeach; ?>
</div>

        </section>
        <section class="kundeAnmeldelser">
            <div class="anmeldelse-card">
                <i class="fa-solid fa-quote-left kunde-i"></i>
                <p class="citat">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam vitae in pariatur tempora a itaque atque illum, architecto qui.</p>
                <hr class="kundeCard-hr">
                <img class="kundeBillede" src="<?php echo get_theme_file_uri('assets/img/kundeanmeldelseRike.png'); ?>" alt="kundebillede">
                <p class="kundenavn">Rikke Marie Andersen</p>
            </div>
            <div class="anmeldelse-card">
                <i class="fa-solid fa-quote-left kunde-i"></i>
                <p class="citat">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora delectus, mollitia quod in optio sed nihil similique quam architecto enim.</p>
                <hr class="kundeCard-hr">
                <img class="kundeBillede" src="<?php echo get_theme_file_uri('assets/img/kundeanmeldelseEskilde.png'); ?>" alt="kundebillede">
                <p class="kundenavn">Eskild Christensen</p>
            </div>
            <div class="anmeldelse-card">
                <i class="fa-solid fa-quote-left kunde-i"></i>
                <p class="citat">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore impedit fugiat quaerat omnis, cupiditate iusto nulla deleniti inventore magnam dolorem?</p>
                <hr class="kundeCard-hr">
                <img class="kundeBillede" src="<?php echo get_theme_file_uri('assets/img/kundeanmeldelseKaroline.png'); ?>" alt="kundebillede">
                <p class="kundenavn">Karoline Hansen</p>
            </div>
        </section>
    </main>
<?php get_footer(); ?>