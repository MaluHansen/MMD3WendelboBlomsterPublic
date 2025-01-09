<?php get_header(); ?>
<main class="checkout-main">
<a class="tilbage-link" href="<?php echo site_url('/afsender-detaljer') ?>">Tilbage til afsender</a>
    <div class="progress-bar">
        <div class="step completed">
        <div class="cirkel">1</div>
        <p>Levering</p>
    </div>
    <div class="step completed">
        <div class="cirkel">2</div>
        <p>Afsender information</p>
    </div>
    <div class="step completed">
        <div class="cirkel">3</div>
        <p>Bekræft bestilling</p>
    </div>
    <div class="step">
        <div class="cirkel">4</div>
        <p>Betaling</p>
    </div>
    </div>
    <h1 class="center-header"><?php the_title()?></h1>

    <a class="tilBetaling-btn transition-link" href="<?php echo site_url('/betaling') ?>">Fortsæt til betaling ></a>
    <div class="transition-overlay"></div>
</main>
<?php get_footer(); ?>