<?php
get_header();
?>

<main>
    <div class="hero-kurv">
        <a href="<?php echo site_url('/voresudvalg') ?>" class="breadcrumbs"><i class="fa-solid fa-circle-chevron-left"></i> Tilbage til udvalg</a>
        <h2 class="center-header">Din kurv</h2>
    </div>
    

    <div class="dinBestilling">
        <h3>Din bestilling</h3>
        <?php if ( WC()->cart->get_cart_contents_count() > 0 ) { ?>
            <div class="kurv-form">
                <div class="kurv-produkt-wrapper">
                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                        $_product   = $cart_item['data'];
                        $product_id = $cart_item['product_id'];
                        $quantity   = $cart_item['quantity'];
                        $price      = $_product->get_price();
                        $subtotal   = $cart_item['line_total'];

                        $storrelse = isset( $cart_item['variation']['attribute_pa_storrelse'] ) ? $cart_item['variation']['attribute_pa_storrelse'] : '';
                        ?>
                            <div class="produkt-item-card">
                                <div class="produkt-item-detaljer">
                                    <div class="produkt-item-billede">
                                        <?php echo $_product->get_image('thumbnail'); ?>
                                    </div>
                                    <h4 class="produkt-item-navn"><?php echo $_product->get_title(); ?></h4>

                                </div>

                                <div class="produkt-kurv-data">
                                    <div class="produkt-pris">
                                    <?php if ( $storrelse ) : ?>
                                            <p class="produkt-item-lilleSkrift"><?php echo ucfirst( $storrelse ); ?></p>
                                        <?php endif; ?>
                                        <p><?php echo wc_price( $subtotal ); ?></p>
                                        <p class="produkt-item-lilleSkrift"><?php echo $quantity; ?> stk.</p>

                                        
                                    </div>
                                    <div class="produkt-mængde">
                                        <button class="mængde-minus" data-cart-item-key="<?php echo $cart_item_key; ?>">-</button>
                                        <span class="mængde-antal"><?php echo $quantity; ?></span>
                                        <button class="mængde-plus" data-cart-item-key="<?php echo $cart_item_key; ?>">+</button>
                                    </div>
                                    <div class="produkt-fjern">
                                        <a href="<?php echo wc_get_cart_remove_url( $cart_item_key ); ?>" class="remove" aria-label="Fjern produkt">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>

                <div class="kurv-detaljer-wrapper">
                    <div class="iAltPris">
                        <p>I alt</p>
                    <!-- returnere beløbet i rigtig valutakurv, 'edit' sørger for at det er en sting -->
                    <p class="kurv-samlet-pris"><?php echo wc_price( WC()->cart->get_total( 'edit' ) ); ?></p>
                    </div>
                    <hr class="kurv-hr">
                    <div class="rabatkode-wrapper">
                        <i class="fa-solid fa-ticket"></i>
                        <input type="text" class="rabatkode" name="rabatkodefelt" placeholder="Tilføj rabatkode">
                    </div>
                    <a class="tilBetaling-btn" href="<?php echo site_url('/levering') ?>">Fortsæt til betaling ></a>

                </div>
            </div>
        <?php } else { ?>
            <p>Din kurv er tom.</p>
            <a href="<?php echo site_url('/voresudvalg') ?>" class="btn-fill-gron tilShop-btn">Gå til shoppen</a>
        <?php }; ?>
    </div>
        
   
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.mængde-minus').forEach(function (button) {
        button.addEventListener('click', function () {
            const cartItemKey = this.getAttribute('data-cart-item-key');
            updateCartQuantity(cartItemKey, -1);
        });
    });

    document.querySelectorAll('.mængde-plus').forEach(function (button) {
        button.addEventListener('click', function () {
            const cartItemKey = this.getAttribute('data-cart-item-key');
            updateCartQuantity(cartItemKey, 1);
        });
    });

    function updateCartQuantity(cartItemKey, change) {
        const formData = new FormData();
        formData.append('cart_item_key', cartItemKey);
        formData.append('quantity_change', change);

        fetch('/wp-admin/admin-ajax.php?action=update_cart_quantity', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Opdater siden for at vise den nye mængde
            } else {
                alert('Kunne ikke opdatere mængden.');
            }
        })
        .catch(error => console.error('Fejl:', error));
    }
});
</script>

<?php
get_footer();
?>
