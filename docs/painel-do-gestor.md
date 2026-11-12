# Painel do gestor

A página inicial (`/`) e `/painel` usam `resources/views/dashboard.blade.php`, com o layout compartilhado `resources/views/layouts/metronic.blade.php`. Os estilos, comportamentos e ilustrações estão em `public/css/dashboard.css`, `public/js/dashboard.js` e `public/images/`.

A interface segue a referência visual fornecida: navegação lateral, cinco indicadores, mapa, prioridades, ações públicas, gráfico, missões e atualizações. O layout se adapta a desktop, tablet e celular. Não precisa de build npm nem de serviços externos. Os bundles do Metronic e suas fontes foram copiados de `C:\laragon\www\eventos_v2\public\assets` para `public/vendor/metronic`, sem alterar o projeto de origem. Os avisos de licença dos bundles foram preservados. O layout carrega os scripts na ordem e posição previstas por essa distribuição, antes do fechamento do body.

## Interações

- Filtros por categoria, período e região no mapa ilustrativo de Brasília.
- Zoom, centralização, legenda e detalhes dos agrupamentos.
- Priorização por categoria: clicar em uma prioridade filtra o mapa.
- Detalhes das ações, expansão da tabela e exportação CSV com BOM UTF-8.
- Notificações, leitura durante a sessão, detalhes de missões e ajuda.
- Séries do gráfico podem ser mostradas ou ocultadas pelas legendas.
- Menu lateral recolhível no celular; diálogos acessíveis pelo teclado.

## Dados

O painel é demonstrativo, com essa indicação na interface. Os dados estão no JavaScript, não vêm do banco nem de fontes climáticas oficiais. As regiões e o mapa de Brasília são ilustrativos. Outros territórios ficam desabilitados até a integração de seus dados. O perfil também é ilustrativo; não representa uma sessão autenticada.

A integração com os models existentes deve agregar ocorrências, ações e avaliações por território no servidor e aplicar as permissões de acesso antes de expor os dados. Ações, arquivos e contatos privados não são consultados nesta implementação da interface.

## Verificação

As duas rotas foram verificadas por teste HTTP do Laravel, incluindo a presença dos assets e componentes Metronic. A suíte completa passou com 9 testes e 323 verificações; o JavaScript passou por `node --check`. O smoke test `tests/Browser/MetronicSmoke.mjs` foi executado no Microsoft Edge headless via CDP, com desktop de 1600 px e celular de 390 px. Foram validados: gráfico ApexCharts, carregamento dos marcadores, sobreposição correta das notificações, filtro de alagamentos, expansão da tabela, modal Bootstrap, drawer Metronic e ausência de rolagem horizontal no celular. Não houve exceções de JavaScript. As capturas ficam em `storage/app/metronic-desktop.png` e `storage/app/metronic-mobile.png`.


## Componentes Metronic

- Cards, tabela, badges, botões e selects usam o CSS do Metronic.
- O menu lateral responsivo usa `KTDrawer` e o menu usa `KTMenu`.
- Notificações usam Bootstrap Dropdown; detalhes usam Bootstrap Modal; avisos usam Bootstrap Toast, todos incluídos na distribuição local.
- O gráfico usa ApexCharts incluído no bundle de plugins.
- `dashboard.css` mantém a identidade visual e os ajustes responsivos do Clima na Pele. O cabeçalho possui uma camada acima do conteúdo para evitar que os cards cubram o dropdown de alertas.
