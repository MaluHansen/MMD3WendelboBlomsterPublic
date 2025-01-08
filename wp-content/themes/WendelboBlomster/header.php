<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <?php wp_head();?>
</head>
<body>
    <header> 
        <a href="<?php echo site_url('/index') ?>" class="logo">Wendelbo Blomster</a>
        <div>
        <nav>
            <a href="<?php echo site_url('/index') ?>">Forside</a>
            <a href="<?php echo site_url('/voresudvalg') ?>">Vores Udvalg</a>
            <a href="<?php echo site_url('/anledninger') ?>">Anledninger</a>
            <a href="#">Inspiration</a>
            <a href="#">Om Butikken</a>
        </nav>
        <div class="header-cart">
        <a href="<?php echo site_url('/cart') ?>"><i class="fa-solid fa-basket-shopping"></i> </a>
        </div>
        
        </div>
    </header>