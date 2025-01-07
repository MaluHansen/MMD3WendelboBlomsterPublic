<?php
get_header();
// Sikrer, at det globale produktobjekt er initialiseret så data kan hentes gennem hele koden under
//
global $product;
if ( ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_ID() );
}
?>

<main>
	<section class="produkt-display">
		<div class="produkt-col-1">
			<div class="produkt-billeder">
				<div class="zoom-wrapper woocommerce-product-gallery__image">
				<img class="produkt-main-billede" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="Billede af<?php the_title(); ?>">
				<script>
				jQuery(document).ready(function($) {
					if ($('.woocommerce-product-gallery__image').length) {
						$('.woocommerce-product-gallery__image').trigger('zoom.destroy');
						$('.woocommerce-product-gallery__image').zoom();
					}
				});
				</script>
				</div>
				<div class="produkt-galleri">
					<?php
					$galleriBilleder = $product->get_gallery_image_ids(); // Hent galleri-billeder

					foreach ( $galleriBilleder as $galleriBillede ) {
						$galleri_url = wp_get_attachment_url( $galleriBillede ); // galleribilledernes url
						echo '
						<div class="galleri-billede-wrapper"> 
						<img src="' . esc_url( $galleri_url ) . '" class="galleri-billeder" alt="Galleri billede">
						</div>
						';
					}
					?>
    			</div>
				
			</div>
		</div>
		<div class="produkt-col-2">
			<div class="produkt-tekst">
				<h1><?php the_title(); ?></h1>
				<p><?php the_content(); ?></p>
			</div>
			
			<div class="produkt-atributter">
				<div class="farver">
					<p class="attribut-header">Farve</p>
					<?php
					$farver = $product->get_attribute('farve'); // Hent farve-attributten
					$farve_terms = explode(', ', $farver); // Håndter flere farver, hvis de er angivet

					foreach ($farve_terms as $farve_slug) {
						$term = get_term_by('name', $farve_slug, 'pa_farve'); // Hent term baseret på navn
						$image_url = get_field('farvebillede', $term); // Hent billed-URL fra ACF

						if ($image_url) {
							echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($farve_slug) . '" class="farve-billede">';
						} else {
							echo '<p>' . esc_html($farve_slug) . '</p>'; // Fallback til tekst, hvis der ikke er billede
						}
					}
					?>
				</div>
				<div class="duft">
					<p class="attribut-header">Duft</p>
					<p><?php echo esc_html( $product->get_attribute( 'duft' ) ); ?></p>
				</div>
				<div class="stil">
					<p class="attribut-header">stil</p>
					<p><?php echo esc_html( $product->get_attribute( 'stil' ) ); ?></p>
				</div>

			
			</div>
			<div class="storrelse">
					<form class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="<?php echo absint( $product->get_id() ); ?>">
						<div class="storrelse-btn-container">
							<?php
							// Hent variationerne for det aktuelle produkt
							$available_variations = $product->get_available_variations();
							$attributes = $product->get_variation_attributes();

							foreach ( $available_variations as $variation ) {
								$variation_id = $variation['variation_id']; // Hent variationens ID
								$storrelse = $variation['attributes']['attribute_pa_storrelse']; // Hent størrelse
								$pris = wc_price( $variation['display_price'] ); // Hent prisen
								?>
								<button type="button" class="storrelse-btn" data-variation-id="<?php echo esc_attr( $variation_id ); ?>"onclick="selectVariation('<?php echo esc_attr( $variation_id ); ?>')">
									<p class="storrelse-label"><?php echo ucfirst( $storrelse ); ?></p>
									<p class="storrelse-pris"><?php echo $pris; ?></p>
								</button>
			
								<?php
							}
							?>
						</div>
						<input type="hidden" name="variation_id" id="variation_id" value="">
						<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>">
						<button type="submit" class="kurv-btn">Læg i kurv <i class="fa-solid fa-basket-shopping"></i></button>
					</form>
				</div>

				<div class="tilvalg">
					<div class="kort">
						<img src="<?php echo get_theme_file_uri('assets/img/kort.jpg') ?>" alt="Kort" class="tilvalg-image">
						<div class="tilvalg-content">
							<p class="tilvalg-title">Kort</p>
							<p class="tilvalg-price">5 kr.</p>
							<a href="#" class="tilvalg-link">Læs mere</a>
						</div>
					</div>
					<div class="vase">
						<img src="<?php echo get_theme_file_uri('assets/img/vase.jpg') ?>" alt="Kort" class="tilvalg-image">
						<div class="tilvalg-content">
							<p class="tilvalg-title">Vase</p>
							<p class="tilvalg-price">49 kr.</p>
							<a href="#" class="tilvalg-link">Læs mere</a>
						</div>
					</div>
				</div>

				
		</div>
	</section>
    
</main>

<?php get_footer(); ?>
<script>
function selectVariation(variationId) {
	// Sæt den valgte variation i det skjulte input-felt
	document.getElementById('variation_id').value = variationId;

	// Fjern aktiv-klasse fra alle knapper og tilføj til den valgte
	document.querySelectorAll('.storrelse-button').forEach(function(button) {
		button.classList.remove('active');
	});
	document.querySelector('button[data-variation-id="' + variationId + '"]').classList.add('active');
}
</script>
