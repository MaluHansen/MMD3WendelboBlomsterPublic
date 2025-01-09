
//-------------------page transition script-------------------------------
document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.transition-link');
    
    links.forEach(link => {
        link.addEventListener('click', event => {
        event.preventDefault(); // Forhindre standard navigation
        const target = link.href;

        // Start slide transition
        document.body.classList.add('slide-out');
        
        setTimeout(() => {
            window.location.href = target; // Skift side efter animation
        }, 600); // Matcher transition-tiden i CSS
        });
    });
    });
//----------------------------------------------------------------
//-----------------Håndtere tilføj af vare til kurven--------------
document.addEventListener('DOMContentLoaded', function () {
    const variationButtons = document.querySelectorAll('.storrelse-btn');
    const variationInput = document.getElementById('variation_id');
    const addToCartButtons = document.querySelectorAll('.kurv-btn');

    // Håndter klik på størrelsesknapperne for variable produkter
    variationButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Fjern 'active' fra alle knapper og tilføj til den valgte
            variationButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Sæt variation ID i det skjulte inputfelt
            variationInput.value = this.dataset.variationId;
        });
    });

    // Håndter 'Læg i kurv'-knappen for både simple og variable produkter
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Forhindrer sideopdatering

            const form = this.closest('form');
            const formData = new FormData(form);

            // Tjek om det er et variabelt produkt og om en variation er valgt
            if (variationInput && variationInput.value === '' && form.classList.contains('variations_form')) {
                 // Hent alle knapper med klassen .storrelse-btn
					const sizeButtons = document.querySelectorAll('.storrelse-btn');

				// Tilføj rysteklasse og rød kant
				sizeButtons.forEach(button => {
					button.classList.add('shake');
				});

				// Fjern rysteklasse efter animationen er færdig
				setTimeout(() => {
					sizeButtons.forEach(button => {
						button.classList.remove('shake');
					});
				}, 500); // 500ms svarer til animationens varighed

				// Stop formularindsendelsen
				return;
            }

            // Send AJAX-request til WooCommerce for at tilføje produkt til kurven
            fetch('/?wc-ajax=add_to_cart', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Der opstod en fejl: ' + data.message);
                } else {
                    jQuery(document.body).trigger('wc_fragment_refresh');
                }
            })
            .catch(error => console.error('Fejl:', error));
        });
    });
});

//-------------------------------------------------------
//--------------------Script til visning af burgermenu--------------------------
document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.querySelector('.burgerMenu');
    const navMobil = document.querySelector('.nav-mobil');
    const closeMenu = document.querySelector('.fa-xmark');

    // Funktion til at vise menuen
    burgerMenu.addEventListener('click', function() {
        navMobil.style.display = 'flex';
        navMobil.classList.add('active');
    });

    // Funktion til at skjule menuen
    closeMenu.addEventListener('click', function() {
        navMobil.style.display = 'none';
        navMobil.classList.remove('active');
    });
});

//--------------------inde i kurv----------------
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