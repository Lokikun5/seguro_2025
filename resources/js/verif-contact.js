document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.login-form');
    const errorsContainer = document.getElementById('form-errors');

    if (!form || !errorsContainer) return;

    form.addEventListener('submit', function (e) {
        const errors = [];

        const firstName = form.first_name.value.trim();
        const lastName  = form.last_name.value.trim();
        const email     = form.email.value.trim();
        const phone     = form.phone.value.trim();
        const message   = form.message.value.trim();

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneDigits = phone.replace(/\D/g, '');

        // Règles de validation
        if (!firstName) errors.push('Le prénom est requis.');
        if (!lastName)  errors.push('Le nom est requis.');
        if (!emailRegex.test(email)) errors.push('Adresse email invalide.');
        if (phoneDigits.length < 10) errors.push('Le numéro de téléphone doit contenir au moins 10 chiffres.');
        if (message.length < 150) errors.push('Le message doit contenir au moins 30 mots (~150 caractères).');

        if (errors.length > 0) {
            e.preventDefault();

            // Affichage animé des erreurs
            errorsContainer.innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
            errorsContainer.style.display = 'block';
            errorsContainer.style.opacity = 0;

            setTimeout(() => {
                errorsContainer.style.transition = 'opacity 0.4s ease-in';
                errorsContainer.style.opacity = 1;
            }, 50);

            // Scroll automatique vers la section
            window.location.hash = 'contact';
        }
    });
});