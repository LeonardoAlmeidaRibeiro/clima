(() => {
    'use strict';
    const registration = Boolean(document.getElementById('registration-form'));
    const form = document.getElementById(registration ? 'registration-form' : 'login-form');
    const password = document.getElementById('password');
    const confirmation = document.getElementById('password-confirmation');
    const submit = document.getElementById(registration ? 'registration-submit' : 'login-submit');
    const toggles = [...document.querySelectorAll('#password-toggle, [data-password-toggle]')];
    function setVisibility(toggle, visible) {
        const input = document.getElementById(toggle.getAttribute('aria-controls'));
        input.type = visible ? 'text' : 'password';
        toggle.setAttribute('aria-pressed', String(visible));
        const suffix = input === confirmation ? ' confirmação de senha' : ' senha';
        toggle.setAttribute('aria-label', (visible ? 'Ocultar' : 'Mostrar') + suffix);
        toggle.querySelector('i').className = visible ? 'bi bi-eye-slash' : 'bi bi-eye';
    }
    toggles.forEach(toggle => toggle.addEventListener('click', () => {
        const input = document.getElementById(toggle.getAttribute('aria-controls'));
        setVisibility(toggle, input.type === 'password');
    }));
    function validateConfirmation() {
        if (confirmation) confirmation.setCustomValidity(confirmation.value && confirmation.value !== password.value ? 'As senhas precisam ser iguais.' : '');
    }
    if (confirmation) {
        password.addEventListener('input', validateConfirmation);
        confirmation.addEventListener('input', validateConfirmation);
        const name = document.getElementById('name');
        name.addEventListener('input', () => name.setCustomValidity(name.value.trim().length < 2 ? 'Informe seu nome com pelo menos dois caracteres.' : ''));
    }
    form.addEventListener('submit', event => {
        event.preventDefault();
        validateConfirmation();
        if (!form.reportValidity()) return;
        const status = document.getElementById(registration ? 'registration-status' : 'login-status');
        status.textContent = registration
            ? 'Esta é uma prévia do cadastro. A criação de contas ainda não está habilitada; seus dados não foram enviados e nenhuma conta foi criada.'
            : 'Esta é uma prévia da tela de login. A autenticação de contas ainda não está habilitada; seus dados não foram enviados.';
        status.hidden = false;
        password.value = '';
        if (confirmation) confirmation.value = '';
        toggles.forEach(toggle => setVisibility(toggle, false));
    });
    submit.disabled = false;
})();
