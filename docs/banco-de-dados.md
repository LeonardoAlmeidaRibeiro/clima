# Banco de dados ? Clima na Pele

Implementa??o das 40 tabelas do ?ltimo desenho em `Dados do projeto.html`, em Laravel 12. O HTML cont?m uma conversa e foi usado como refer?ncia de dados; as solicita??es antigas contidas nele n?o s?o instru??es para esta implementa??o. O conte?do do SQL mencionado na conversa n?o est? dispon?vel nesse HTML.

## Arquivos e execu??o

Cada tabela tem uma migration em `database/migrations/2026_11_11_*` e um model em `app/Models`. As migrations est?o em ordem de depend?ncia e seus m?todos `down()` permitem a revers?o. Os models declaram o nome exato da tabela, campos preench?veis, casts, rela??es diretas e inversas. As associa??es tamb?m t?m models pr?prios e rela??es `belongsToMany` para navega??o.

Use PHP 8.2 ou superior, conforme o composer.json. O PHP padr?o encontrado no terminal ? 7.4; os testes foram executados com o PHP 8.3 do Laragon. Para aplicar ao banco configurado no `.env`:

```powershell
& C:\laragon\bin\php\php-8.3.30-nts-Win32-vs16-x64\php.exe artisan migrate
```

O banco configurado no projeto n?o foi alterado durante esta entrega. As migrations foram executadas e revertidas somente em SQLite em mem?ria pelos testes. A execu??o em MySQL/MariaDB ainda precisa ser validada no servidor de destino.

## Decis?es de implementa??o

- Foram mantidos os 40 nomes de tabelas e os campos do desenho final. Esse desenho cont?m 70 v?nculos marcados como FK; a men??o a 71 v?nculos na resposta anterior do HTML n?o corresponde ao desenho final fornecido.
- IDs s?o inteiros grandes sem sinal. Todas as tabelas possuem `created_at` e `updated_at`, inclusive associa??es, que mant?m o ID pr?prio mostrado no desenho.
- Todas as chaves estrangeiras restringem exclus?es para preservar refer?ncias e hist?rico. Tabelas de associa??o possuem unicidade do par, al?m do ID pr?prio.
- Coordenadas usam sete casas decimais; medi??es usam `decimal(18,6)`. Datas com hor?rio usam `dateTime`; os casts dos models retornam datas Carbon.
- Pessoas podem existir sem conta; cada conta exige uma pessoa, com no m?ximo uma conta por pessoa. Relatos permitem pessoa, usu?rio e local opcionais, mas exigem territ?rio, categoria, coordenadas e data do evento. Contato privado ? opcional e tem no m?ximo um registro por ocorr?ncia.
- Pais territoriais, organiza??es superiores, refer?ncias a duplicatas, revisores, respons?veis ainda n?o atribu?dos, prazos e datas de conclus?o s?o opcionais. C?digos territoriais s?o opcionais e ?nicos quando presentes; use um prefixo de origem, como `IBGE:`.
- Estados iniciais: usu?rio `ativo`, modera??o e revis?o de arquivo `pendente`, atendimento `registrada`, encaminhamento `pendente`, a??o `planejada`, importa??o `pendente`. A visibilidade pretendida da ocorr?ncia ? `publica`; uma consulta p?blica tamb?m precisa exigir aprova??o de modera??o. Os valores s?o strings: o desenho n?o define todos os estados e transi??es.
- Flags booleanas come?am como `false`. Concess?es territoriais precisam definir explicitamente se incluem descendentes. Strings usam at? 255 caracteres; hashes de tokens usam at? 64 caracteres. A gera??o dos tokens e o armazenamento de seu hash SHA-256 ficam a cargo do servi?o de autentica??o/acompanhamento.
- Campos `*_cifrado` usam o cast `encrypted` e ficam ocultos na serializa??o. Dependem da `APP_KEY` est?vel. Passwords usam `hashed`; passwords e hashes de token tamb?m ficam ocultos. Dados escritos diretamente por SQL n?o passam pelos casts.
- Existem ?ndices para hierarquia, consultas por territ?rio e data, fila de modera??o, atendimento, acessos, notifica??es, auditoria e s?ries clim?ticas. Medi??es s?o ?nicas por ponto, indicador e per?odo.

## Integra??o com autentica??o

`Usuario` estende `Authenticatable`, usa a tabela `usuarios` e n?o possui token de lembrar login, ausente no desenho. A estrutura padr?o existente (`User`, `users`, `password_reset_tokens`, `sessions`) foi preservada, inclusive a configura??o padr?o de autentica??o. Para usar as contas do dom?nio no guard, configure `AUTH_MODEL=App\Models\Usuario`.

As tabelas `recuperacoes_senha` e `sessoes_usuario` representam o desenho solicitado e n?o substituem automaticamente o broker e o driver de sess?o do Laravel. Esses componentes usam formatos pr?prios. O projeto ainda precisa de servi?os pr?prios para esses fluxos caso queira usar as tabelas do dom?nio.

## Regras que dependem de servi?os e valida??o

As migrations e os models n?o implementam autoriza??o por papel/territ?rio, transi??es de status, publica??o ap?s modera??o, preven??o de ciclos, sincroniza??o de `territorio_hierarquia`, verifica??o de latitude/longitude, ordem dos per?odos, consist?ncia entre territ?rio do local e da ocorr?ncia ou compatibilidade entre ocorr?ncia e a??o em avalia??es. Essas regras precisam ser implementadas nos servi?os e valida??es das funcionalidades. A hierarquia armazena caminhos e profundidade, incluindo o pr?prio territ?rio na profundidade zero, mas n?o ? preenchida automaticamente.

## Valida??o

```powershell
& C:\laragon\bin\php\php-8.3.30-nts-Win32-vs16-x64\php.exe -d extension=pdo_sqlite vendor/phpunit/phpunit/phpunit --testdox
```

Os testes verificam as 40 tabelas, os 70 v?nculos, consultas das rela??es Eloquent, rollback e nova migra??o, relato sem conta, v?nculos de a??es, contatos cifrados, senha com hash, restri??o de exclus?o, rejei??o de FK inexistente e preven??o de medi??es duplicadas.

## Tabelas e models

| Tabela | Model |
| --- | --- |
| `pessoas` | `Pessoa` |
| `pessoa_contatos` | `PessoaContato` |
| `usuarios` | `Usuario` |
| `recuperacoes_senha` | `RecuperacaoSenha` |
| `sessoes_usuario` | `SessaoUsuario` |
| `territorios` | `Territorio` |
| `territorio_hierarquia` | `TerritorioHierarquia` |
| `tipos_local` | `TipoLocal` |
| `locais` | `Local` |
| `organizacoes` | `Organizacao` |
| `organizacao_territorios` | `OrganizacaoTerritorio` |
| `vinculos_organizacionais` | `VinculoOrganizacional` |
| `papeis` | `Papel` |
| `permissoes` | `Permissao` |
| `papel_permissoes` | `PapelPermissao` |
| `acessos_territoriais` | `AcessoTerritorial` |
| `categorias_ocorrencia` | `CategoriaOcorrencia` |
| `ocorrencias` | `Ocorrencia` |
| `contatos_ocorrencia` | `ContatoOcorrencia` |
| `acessos_acompanhamento` | `AcessoAcompanhamento` |
| `arquivos` | `Arquivo` |
| `ocorrencia_arquivos` | `OcorrenciaArquivo` |
| `historicos_ocorrencia` | `HistoricoOcorrencia` |
| `mensagens_ocorrencia` | `MensagemOcorrencia` |
| `encaminhamentos` | `Encaminhamento` |
| `acoes` | `Acao` |
| `acao_ocorrencias` | `AcaoOcorrencia` |
| `acao_territorios` | `AcaoTerritorio` |
| `atualizacoes_acao` | `AtualizacaoAcao` |
| `acao_arquivos` | `AcaoArquivo` |
| `avaliacoes_acao` | `AvaliacaoAcao` |
| `fontes_climaticas` | `FonteClimatica` |
| `pontos_monitoramento` | `PontoMonitoramento` |
| `indicadores_climaticos` | `IndicadorClimatico` |
| `importacoes_climaticas` | `ImportacaoClimatica` |
| `medicoes_climaticas` | `MedicaoClimatica` |
| `notificacoes` | `Notificacao` |
| `versoes_aviso_privacidade` | `VersaoAvisoPrivacidade` |
| `ciencias_privacidade` | `CienciaPrivacidade` |
| `auditorias` | `Auditoria` |
