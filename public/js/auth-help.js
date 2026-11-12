(() => {
    'use strict';
    const messages = {
        password: ['Recuperação de senha', 'A recuperação de senha estará disponível quando o acesso às contas for habilitado. Esta é uma prévia da interface; nenhum e-mail será enviado.'],
        register: ['Faça parte dessa mudança', 'O cadastro de cidadãos será disponibilizado junto com o acesso às contas. Você poderá registrar ocorrências e acompanhar as ações da sua cidade.'],
        institution: ['Acesso para equipes de gestão', 'O acesso institucional deverá ser concedido pela administração da organização, conforme o papel e o território de atuação. Nesta prévia, não são enviadas solicitações de acesso.'],
        privacy: ['Cuidado com seus dados', 'Nesta prévia, os dados digitados no formulário não são enviados ao servidor nem gravados no navegador. A política de privacidade do serviço será apresentada antes do cadastro de contas reais.'],
        support: ['Como podemos ajudar?', 'Escolha “Sou cidadão” para o acesso da população ou “Sou gestor” para o acesso institucional. Estas telas são uma prévia visual: cadastro, recuperação e autenticação ainda não estão habilitados.'],
    };
    const help = bootstrap.Modal.getOrCreateInstance(document.getElementById('auth-help'));
    document.querySelectorAll('[data-auth-help]').forEach(button => {
        button.addEventListener('click', () => {
            const [title, body] = messages[button.dataset.authHelp];
            document.getElementById('help-title').textContent = title;
            document.getElementById('help-body').textContent = body;
            help.show();
        });
    });
})();
