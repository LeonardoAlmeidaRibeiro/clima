# Telas de acesso

- Cidadão: `/login` (nome da rota: `login`). `/usuario/login` redireciona para essa página.
- Gestor: `/gestor/login` (nome da rota: `gestor.login`).

As duas páginas compartilham `resources/views/layouts/auth.blade.php`, os bundles locais do Metronic, `public/css/auth.css` e `public/js/auth.js`. Os conteúdos específicos ficam em `resources/views/auth/citizen.blade.php` e `resources/views/auth/manager.blade.php`.

Esta entrega implementa as telas. Não implementa login, cadastro, autorização por papel ou território, recuperação de senha nem bloqueio do painel. Ao enviar o formulário, a prévia informa que a autenticação não está habilitada, não envia as credenciais e limpa a senha. Sem JavaScript, o botão de envio permanece desabilitado. Os links de ajuda abrem modais informativos e as abas navegam entre as duas rotas.

Validação: templates Blade compilados, JavaScript verificado com `node --check`, suíte existente com 9 testes e 323 verificações aprovada. As duas páginas foram conferidas no Microsoft Edge headless em 1440 × 1000 e 390 × 844. Foram verificados: renderização sem rolagem horizontal, aba ativa, visibilidade da senha, envio da prévia, limpeza da senha e modal de recuperação. Nenhum erro de JavaScript nem falha HTTP dos assets foi observado.

## Cadastro do cidadão

A rota `/cadastro` (nome `register`) apresenta a tela para usuários que registram ocorrências. O link “Quero fazer parte” do login do cidadão leva até ela. A tela inclui nome completo, nome social opcional, e-mail, senha e confirmação. A prévia valida campos obrigatórios, formato do e-mail, senha mínima de 8 caracteres e confirmação igual; não cria contas nem envia dados. A validação e persistência no servidor continuam pendentes.

O formulário foi conferido em desktop e celular no Edge headless, incluindo confirmação divergente, envio da prévia, limpeza das senhas e navegação de volta ao login. A história lateral é compartilhada por `auth/partials/citizen-story.blade.php`.

## Recuperação de senha

As rotas `/recuperar-senha` e `/gestor/recuperar-senha` usam `auth/forgot-password.blade.php`, com o visual e o retorno ao login de cada perfil. O link “Esqueci minha senha” dos dois logins aponta para a respectiva página. A tela valida o formato do e-mail e apresenta uma mensagem de prévia; não consulta contas, não gera tokens, não envia e-mails e não altera senhas.

O comportamento está em `public/js/password-recovery.js`. Os modais de ajuda compartilhados foram separados em `public/js/auth-help.js`. As duas páginas foram validadas no Edge headless em desktop e celular, incluindo e-mail inválido, envio demonstrativo, ajuda e links de retorno. Login e cadastro também foram conferidos após a alteração dos scripts compartilhados.
