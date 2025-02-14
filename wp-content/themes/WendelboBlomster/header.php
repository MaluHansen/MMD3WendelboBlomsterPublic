<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wendelbo Blomster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <?php wp_head();?>
</head>
<body>
    <header> 
        <a href="<?php echo site_url('/index') ?>" class="logo">Wendelbo Blomster</a>
        <div class="nav-container">
            <i class="fa-solid fa-bars burgerMenu"></i>
            <nav class="nav-main">
                <a href="<?php echo site_url('/index') ?>">Forside</a>
                <a href="<?php echo site_url('/voresudvalg') ?>">Vores Udvalg</a>
                <a href="<?php echo site_url('/anledninger') ?>">Anledninger</a>
                <a href="<?php echo site_url('/inspiration') ?>">Inspiration</a>
                <a href="<?php echo site_url('/om-butikken') ?>">Om Butikken</a>
            </nav>
            <nav class="nav-mobil">
                <i class="fa-solid fa-xmark"></i>
                <a href="<?php echo site_url('/index') ?>">Forside</a>
                <a href="<?php echo site_url('/voresudvalg') ?>">Vores Udvalg</a>
                <a href="<?php echo site_url('/anledninger') ?>">Anledninger</a>
                <a href="<?php echo site_url('/inspiration') ?>">Inspiration</a>
                <a href="<?php echo site_url('/om-butikken') ?>">Om Butikken</a>
            </nav>
            <div class="header-cart">
                <a href="<?php echo site_url('/cart') ?>"><i class="fa-solid fa-basket-shopping"></i></a>
            </div>
        </div>
    </header>