document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const nameError = document.getElementById('name-error');
    const emailError = document.getElementById('email-error');
    const resultBox = document.querySelector('.result');
    const navLinks = document.querySelectorAll('.nav-links a');

    const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    const updateActiveLink = () => {
        const params = new URLSearchParams(window.location.search);
        const section = params.get('section');

        navLinks.forEach((link) => {
            const linkSection = link.getAttribute('href').split('section=')[1];
            link.classList.toggle('active', section === linkSection);
        });
    };

    if (form) {
        form.addEventListener('submit', function (event) {
            let isValid = true;

            nameError.textContent = '';
            emailError.textContent = '';

            if (!nameInput.value.trim()) {
                nameError.textContent = 'El nombre es obligatorio.';
                isValid = false;
            }

            if (!emailInput.value.trim()) {
                emailError.textContent = 'El correo es obligatorio.';
                isValid = false;
            } else if (!isValidEmail(emailInput.value.trim())) {
                emailError.textContent = 'Ingresa un correo válido.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    }

    if (resultBox) {
        resultBox.classList.add('is-visible');
    }

    updateActiveLink();
});
