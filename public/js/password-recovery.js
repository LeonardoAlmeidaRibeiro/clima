(() => {
    'use strict';
    const form = document.getElementById('recovery-form');
    const submit = document.getElementById('recovery-submit');
    const status = document.getElementById('recovery-status');
    form.addEventListener('submit', event => {
        event.preventDefault();
        if (!form.reportValidity()) return;
        status.textContent = 'Esta é uma prévia da recuperação de senha. O envio de e-mail ainda não está habilitado: nenhuma mensagem foi enviada e sua senha não foi alterada.';
        status.hidden = false;
    });
    document.getElementById('email').addEventListener('input', () => {
        status.hidden = true;
    });
    submit.disabled = false;
})();
