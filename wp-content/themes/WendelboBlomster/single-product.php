<?php
get_header();
// Sikrer, at det globale produktobjekt er korrekt initialiseret
global $product;
if ( ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_ID() );
}
?>

<main>
    <?php do_action( 'woocommerce_before_main_content' ); ?>
	<div class="produkt-billede">
		<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="Billede af<?php the_title(); ?>">
	</div>
	<h1><?php the_title(); ?></h1>
	<p><?php the_content(); ?></p>
	<div class="produkt-atributter">
		<div class="farver">
			<p>Farve</p>
			<?php
			$farver = $product->get_attribute('farve'); // Hent farve-attributten
			$farve_terms = explode(', ', $farver); // Håndter flere farver, hvis de er angivet

			foreach ($farve_terms as $farve_slug) {
				$term = get_term_by('name', $farve_slug, 'pa_farve'); // Hent term baseret på navn
				$image_url = get_field('farvebillede', $term); // Hent billed-URL fra ACF

				if ($image_url) {
					echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($farve_slug) . '" class="farve-billede" style="width: 50px; height: 50px;">';
				} else {
					echo '<p>' . esc_html($farve_slug) . '</p>'; // Fallback til tekst, hvis der ikke er billede
				}
			}
			?>
		</div>
		<div class="duft">
			<p>Duft</p>
			<p><?php echo esc_html( $product->get_attribute( 'duft' ) ); ?></p>
		</div>
		<div class="stil">
			<p>stil</p>
			<p><?php echo esc_html( $product->get_attribute( 'stil' ) ); ?></p>
		</div>

		<div class="storrelse">
			
		</div>
	</div>
    
</main>

<?php get_footer(); ?>
