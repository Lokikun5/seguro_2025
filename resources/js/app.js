import * as bootstrap from 'bootstrap';
import '@popperjs/core';
import './verif-contact';

window.addEventListener('load', function () {
    console.log("JS chargé et exécuté");

    // Récupération des éléments modale et carrousel
    const imageModal = document.getElementById('imageModal');
    const imageCarousel = document.getElementById('imageCarousel');

    if (imageModal && imageCarousel) {
        const modalInstance = new bootstrap.Modal(imageModal); // Initialiser la modale

        // Délégation d'événements sur le body pour capturer les clics sur .open-modal
        document.body.addEventListener('click', function (event) {
            console.log("Click détecté sur le body");

            // Vérifier si l'élément cliqué est ou contient la classe .open-modal
            const target = event.target.closest('.open-modal');
            if (target) {
                console.log("Clic sur .open-modal détecté");

                event.preventDefault(); // Empêcher l'action par défaut
                event.stopPropagation(); // Empêcher la propagation de l'événement

                const slideIndex = target.getAttribute('data-slide-index');
                console.log("Image clicked, slide index: ", slideIndex);

                const carouselInstance = bootstrap.Carousel.getOrCreateInstance(imageCarousel);

                // Ouvrir la modale
                modalInstance.show();
                console.log("Modale ouverte");

                // Aller à la diapositive correspondante
                carouselInstance.to(slideIndex);
            } else {
                console.log("Clic hors de .open-modal");
            }
        });
    } else {
        console.log("Modale ou carrousel non trouvés");
    }
});

