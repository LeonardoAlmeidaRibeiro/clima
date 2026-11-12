@extends('layouts.metronic')

@section('content')
<svg class="icon-library" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><defs>
    <symbol id="i-home" viewBox="0 0 24 24"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1Z"/></symbol>
    <symbol id="i-pin" viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="3"/></symbol>
    <symbol id="i-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 1v3m0 16v3M1 12h3m16 0h3M4.2 4.2l2.1 2.1m11.4 11.4 2.1 2.1m0-15.6-2.1 2.1M6.3 17.7l-2.1 2.1"/></symbol>
    <symbol id="i-rain" viewBox="0 0 24 24"><path d="M6 15a5 5 0 0 1 0-10 6 6 0 0 1 11 1 4.5 4.5 0 1 1 1 9Z"/><path d="m7 18-2 3m7-3-2 3m7-3-2 3"/></symbol>
    <symbol id="i-trophy" viewBox="0 0 24 24"><path d="M8 3h8v7a4 4 0 0 1-8 0ZM8 5H3v3a5 5 0 0 0 5 5m8-8h5v3a5 5 0 0 1-5 5M12 14v6m-5 1h10"/></symbol>
    <symbol id="i-file" viewBox="0 0 24 24"><path d="M14 2H5v20h14V7Zm0 0v6h5M8 12h8m-8 4h8"/></symbol>
    <symbol id="i-chart" viewBox="0 0 24 24"><path d="M4 21v-5h3v5m4 0V11h3v10m4 0V6h3v15M3 10l7-5 5 2 6-5"/></symbol>
    <symbol id="i-bell" viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 9-3 9-3 11h18c0-2-3-2-3-11M10 22h4"/></symbol>
    <symbol id="i-chevron" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></symbol>
    <symbol id="i-filter" viewBox="0 0 24 24"><path d="M3 4h18l-7 8v8l-4-2v-6Z"/></symbol>
    <symbol id="i-target" viewBox="0 0 24 24"><circle cx="12" cy="12" r="7"/><circle cx="12" cy="12" r="2"/><path d="M12 1v4m0 14v4M1 12h4m14 0h4"/></symbol>
    <symbol id="i-drop" viewBox="0 0 24 24"><path d="M12 2S4 11 4 16a8 8 0 0 0 16 0C20 11 12 2 12 2Z"/><path d="M8 15c-1 3 1 4 2 4"/></symbol>
    <symbol id="i-fire" viewBox="0 0 24 24"><path d="M13 2c4 6-2 7 2 11l3-5c8 13-2 16-6 16C2 23 0 15 7 8c-1 5 2 6 3 6-1-5 4-6 3-12Z"/></symbol>
    <symbol id="i-tree" viewBox="0 0 24 24"><path d="M12 3a4 4 0 0 0-4 4 5 5 0 1 0 1 10h6a5 5 0 1 0 1-10 4 4 0 0 0-4-4Z"/><path d="M12 11v11m-4 0h8m-8-8 4 3 4-3"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24"><path d="m5 12 4 4L19 6"/></symbol>
    <symbol id="i-folder" viewBox="0 0 24 24"><path d="M2 6h8l2 3h10v12H2Zm0 0V3h7l3 3h8v3"/><circle cx="14" cy="15" r="4"/><path d="m12 15 1 1 2-2"/></symbol>
    <symbol id="i-thumb" viewBox="0 0 24 24"><path d="M7 10h-4v12h4Zm0 1 5-9c3 0 3 4 1 7h7c3 0 1 5 0 7l-2 6H7Z"/></symbol>
    <symbol id="i-users" viewBox="0 0 24 24"><circle cx="12" cy="5" r="3"/><circle cx="4" cy="8" r="2"/><circle cx="20" cy="8" r="2"/><path d="M8 22V12a4 4 0 0 1 8 0v10M1 21v-7a3 3 0 0 1 5-2m12 0a3 3 0 0 1 5 2v7"/></symbol>
    <symbol id="i-info" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 11v6m0-11v1"/></symbol>
    <symbol id="i-menu" viewBox="0 0 24 24"><path d="M3 6h18M3 12h18M3 18h18"/></symbol>
    <symbol id="i-close" viewBox="0 0 24 24"><path d="m6 6 12 12M6 18 18 6"/></symbol>
    <symbol id="i-arrow" viewBox="0 0 24 24"><path d="M5 12h14m-6-6 6 6-6 6"/></symbol>
    <symbol id="i-help" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9 8a3 3 0 0 1 6 1c0 2-3 2-3 5m0 3v1"/></symbol>
</defs></svg>
@php
    $navigation = [
        ['home', 'Dashboard', 'dashboard'], ['pin', 'Mapa de ocorrências', 'mapa'],
        ['sun', 'Prioridades', 'prioridades'], ['rain', 'Ações públicas', 'acoes'],
        ['trophy', 'Missões', 'missoes'], ['file', 'Relatórios', 'relatorios'],
        ['chart', 'Indicadores', 'indicadores'], ['bell', 'Alertas', 'alertas'],
    ];
@endphp

<aside class="sidebar" id="sidebar" aria-label="Menu principal"
    data-kt-drawer="true" data-kt-drawer-name="clima-sidebar"
    data-kt-drawer-activate="{default: true, 'lg': false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="258px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#menu-toggle">
    <a class="brand" href="{{ route('dashboard') }}" aria-label="Clima na Pele — início"><img src="{{ asset('images/brand.svg') }}" alt="" width="64" height="80"><span>Clima<br>na Pele</span></a>
    <nav class="navigation menu menu-column menu-rounded" data-kt-menu="true">
        @foreach ($navigation as [$icon, $label, $target])
            <div class="menu-item"><a href="#{{ $target }}" class="menu-link nav-item {{ $loop->first ? 'active' : '' }}" data-nav="{{ $target }}" @if($loop->first) aria-current="page" @endif><svg class="icon"><use href="#i-{{ $icon }}"/></svg><span>{{ $label }}</span>@if($target === 'alertas')<span class="nav-count">3</span>@endif</a></div>
        @endforeach
    </nav>
    <div class="participation-card">
        <img src="{{ asset('images/community.svg') }}" alt="Ilustração de um bairro verde e arborizado" width="224" height="136">
        <h3>Participação que<br>transforma</h3>
        <p>Envolva a população e tome decisões baseadas em dados e evidências.</p>
        <button class="btn btn-sm btn-outline btn-outline-success button button-outline" data-dialog="participacao">Saiba mais <svg class="icon"><use href="#i-arrow"/></svg></button>
    </div>
    <button class="help-link" data-dialog="ajuda"><svg class="icon"><use href="#i-help"/></svg><span>Precisa de ajuda?<small>Conheça a plataforma</small></span><svg class="icon small"><use href="#i-arrow"/></svg></button>
    <div class="sidebar-footer"><span class="status-dot"></span> Por cidades mais resilientes</div>
</aside>
<main id="dashboard" class="main">
    <header class="page-header">
        <div class="heading"><button class="icon-button mobile-menu" id="menu-toggle" aria-label="Abrir menu" aria-expanded="false"><svg class="icon"><use href="#i-menu"/></svg></button><div><div class="eyebrow">CLIMA NA PELE <span>GESTÃO PÚBLICA</span></div><h1>Painel do gestor</h1><p>Dados climáticos e ocorrências transformados em prioridades de ação</p></div></div>
        <div class="header-tools">
            <div class="city-picker"><svg class="icon"><use href="#i-pin"/></svg><label class="sr-only" for="city">Território</label><select class="form-select form-select-solid" id="city"><option value="brasilia">Brasília, DF</option><option value="goiania" disabled>Goiânia, GO · em breve</option><option value="saopaulo" disabled>São Paulo, SP · em breve</option></select><svg class="icon small"><use href="#i-chevron"/></svg></div>
            <div class="notification-wrap dropdown"><button class="notification-button icon-button" id="notification-toggle" data-bs-toggle="dropdown" data-bs-display="static" data-bs-auto-close="outside" aria-controls="notification-panel" aria-label="Notificações: 3 não lidas" aria-expanded="false"><svg class="icon"><use href="#i-bell"/></svg><span class="notification-count">3</span></button><div class="dropdown-menu dropdown-menu-end notification-panel" id="notification-panel" aria-labelledby="notification-toggle"><div class="popover-title">Central de alertas <span class="badge badge-light-danger">3 novos</span></div><button data-alert="Alagamento na Asa Norte" class="notification-item"><span class="status-dot red-dot"></span><span><strong>Alagamento na Asa Norte</strong><small>Prioridade alta · há 12 min</small></span></button><button data-alert="Temperatura acima de 35 °C" class="notification-item"><span class="status-dot amber-dot"></span><span><strong>Temperatura acima de 35 °C</strong><small>Plano Piloto · há 35 min</small></span></button><button data-alert="Nova atualização de ação" class="notification-item"><span class="status-dot"></span><span><strong>Nova atualização de ação</strong><small>Rede de drenagem · há 1 h</small></span></button><button class="text-button mark-read" id="mark-read">Marcar todas como lidas</button></div></div>
            <button class="profile" data-dialog="perfil"><span class="avatar"><svg viewBox="0 0 48 48" aria-hidden="true"><circle cx="24" cy="24" r="23" fill="#e9f2f5"/><path d="M7 48c0-18 34-18 34 0" fill="#254b63"/><path d="m17 32 7 8 7-8" fill="#fff"/><path d="M19 27h10v9H19" fill="#dfab86"/><ellipse cx="24" cy="19" rx="9" ry="12" fill="#efc29c"/><path d="M15 20C9 2 37 0 33 21l-4-10-12 3Z" fill="#183948"/></svg></span><span class="profile-text"><strong>Gestor Municipal</strong><small>Administração</small></span><svg class="icon small"><use href="#i-chevron"/></svg></button>
        </div>
    </header>
    <div class="context-bar"><span><span class="status-dot"></span> Visão geral do território <span class="context-divider">/</span> <strong id="territory-label">Brasília, DF</strong></span><span class="demo-label"><span></span> Ambiente demonstrativo</span></div>
    <section class="stats-grid" aria-label="Indicadores do território">
        <article class="card stat-card"><div><h2>Ocorrências hoje</h2><strong class="stat-value" data-stat="reports">128</strong><p><span class="trend">+18%</span> em relação a ontem</p></div><span class="stat-art rain"><svg class="icon"><use href="#i-rain"/></svg></span></article>
        <article class="card stat-card"><div><h2>Prioridades críticas</h2><strong class="stat-value" data-stat="critical">7</strong><p>Requerem atenção imediata</p></div><span class="warning-art">!</span></article>
        <article class="card stat-card"><div><h2>Ações em andamento</h2><strong class="stat-value" data-stat="actions">23</strong><p><span class="trend">12%</span> concluídas esta semana</p></div><span class="stat-art folder"><svg class="icon"><use href="#i-folder"/></svg></span></article>
        <article class="card stat-card"><div><h2>Avaliação positiva</h2><strong class="stat-value" data-stat="positive">78<small>%</small></strong><p><span class="trend">+6 p.p.</span> na última semana</p></div><span class="stat-art thumb"><svg class="icon"><use href="#i-thumb"/></svg></span></article>
        <article class="card stat-card population"><div><h2>População impactada <small>(estimada)</small></h2><strong class="stat-value" data-stat="population">356 <small>mil</small></strong><p><span class="trend">+9%</span> na última semana</p></div><span class="stat-art people"><svg class="icon"><use href="#i-users"/></svg></span></article>
    </section>
    <div class="dashboard-grid">
        <div class="primary-column">
            <section class="card panel map-panel" id="mapa" aria-labelledby="map-heading">
                <div class="card-header panel-heading"><h2 id="map-heading">Mapa de ocorrências</h2><span class="live-label"><span class="status-dot"></span><span id="map-result-count">12 pontos no mapa</span></span></div>
                <div class="map-container" id="map-container">
                    <div class="map-scene" id="map-scene"><img class="map-image" src="{{ asset('images/brasilia-map.svg') }}" alt="Mapa ilustrativo do território de Brasília"><div id="map-markers"></div></div>
                    <div class="map-location"><span class="status-dot"></span><span id="map-city-label">Distrito Federal</span></div>
                    <div class="legend-wrap"><button class="map-legend-button" id="legend-toggle" aria-expanded="false"><svg class="icon small"><use href="#i-pin"/></svg> Legenda <svg class="icon small"><use href="#i-chevron"/></svg></button><div class="map-legend" id="map-legend" hidden><span><i class="legend-dot blue"></i> Até 3 ocorrências</span><span><i class="legend-dot orange"></i> De 4 a 9 ocorrências</span><span><i class="legend-dot red"></i> 10 ou mais ocorrências</span><span><i class="legend-dot green"></i> Ocorrência pontual</span></div></div>
                    <div class="map-controls"><div><button id="zoom-in" aria-label="Aproximar mapa">+</button><button id="zoom-out" aria-label="Afastar mapa">−</button></div><button id="map-reset" aria-label="Centralizar mapa"><svg class="icon"><use href="#i-target"/></svg></button></div>
                    <div class="map-filters"><span class="filter-title"><svg class="icon small"><use href="#i-filter"/></svg> Filtros</span><label><span class="sr-only">Tipo de ocorrência</span><select class="form-select form-select-sm" id="category-filter"><option value="all">Tipo de ocorrência</option><option value="rain">Alagamento</option><option value="sun">Calor excessivo</option><option value="drop">Falta de água</option><option value="fire">Queimada</option><option value="tree">Queda de árvore</option></select></label><label><span class="sr-only">Período</span><select class="form-select form-select-sm" id="period-filter"><option value="all">Período</option><option value="today">Hoje</option><option value="week">Esta semana</option></select></label><label><span class="sr-only">Região</span><select class="form-select form-select-sm" id="region-filter"><option value="all">Regiões</option><option value="Asa Norte">Asa Norte</option><option value="Ceilândia">Ceilândia</option><option value="Águas Claras">Águas Claras</option><option value="Plano Piloto">Plano Piloto</option><option value="Paranoá">Paranoá</option></select></label><button id="clear-filters" aria-label="Limpar filtros" title="Limpar filtros"><svg class="icon small"><use href="#i-close"/></svg></button></div>
                    <span class="map-attribution">Mapa ilustrativo · Dados de demonstração</span>
                    <div class="map-empty" id="map-empty" hidden>Nenhuma ocorrência para esses filtros.</div>
                </div>
            </section>
            <section class="card panel actions-panel" id="acoes" aria-labelledby="actions-heading"><div class="card-header panel-heading"><h2 id="actions-heading">Ações públicas</h2><button class="text-button" id="all-actions">Ver todas <svg class="icon small"><use href="#i-arrow"/></svg></button></div><div class="table-responsive table-scroll"><table class="table table-row-bordered align-middle gs-2 gy-4"><thead><tr><th>Ação</th><th>Tipo</th><th>Região</th><th>Status</th><th>Progresso</th><th>Previsão</th></tr></thead><tbody id="actions-body"></tbody></table></div><div class="panel-footer"><span><span class="status-dot"></span> <span id="action-count">3 de 5 ações</span></span><button class="text-button" id="download-report"><svg class="icon small"><use href="#i-file"/></svg> Exportar relatório</button></div></section>
            <section class="card panel missions-panel" id="missoes"><div class="card-header panel-heading"><h2>Missões para uma cidade melhor</h2><span class="badge badge-light-success">Participação cidadã</span></div><div class="mission-content"><span class="mission-icon"><svg class="icon"><use href="#i-tree"/></svg></span><div><h3>Um bairro mais verde começa com você</h3><p>Mobilize moradores para identificar pontos que precisam de arborização.</p><div class="mission-progress"><div><span style="width:68%"></span></div><small>68 de 100 participações</small></div></div><button class="btn btn-sm btn-outline btn-outline-success button button-outline" data-dialog="missao">Ver missão <svg class="icon small"><use href="#i-arrow"/></svg></button></div></section>
        </div>
        <div class="secondary-column">
            <section class="card panel priorities-panel" id="prioridades" aria-labelledby="priorities-heading"><div class="card-header panel-heading"><h2 id="priorities-heading">Prioridades da semana</h2><button class="text-button" id="all-priorities">Ver todas</button></div><div id="priority-list"></div><div class="priority-footnote">Priorização por gravidade e volume de relatos</div></section>
            <section class="card panel climate-panel" id="indicadores" aria-labelledby="climate-heading"><div class="card-header panel-heading"><div><h2 id="climate-heading">Fragilidade climática</h2><p>Índice ClimaBrasil × Percepção da população</p></div><button class="icon-button info-button" data-dialog="indicadores" aria-label="Sobre os indicadores"><svg class="icon"><use href="#i-info"/></svg></button></div><div class="chart-legend"><button class="chart-toggle active" data-series="fragility" aria-pressed="true"><i class="line-key green-line"></i>Fragilidade (ClimaBrasil)</button><button class="chart-toggle active" data-series="perception" aria-pressed="true"><i class="line-key blue-line"></i>Percepção negativa</button></div><div class="chart-wrap"><div id="climate-chart" role="img" aria-label="Gráfico demonstrativo de fragilidade climática e percepção negativa entre dezembro e junho"></div></div><div class="chart-insights"><div><strong>↓ 18%</strong><span>Redução na fragilidade</span></div><div><strong>↑ 14%</strong><span>Redução na percepção negativa</span></div></div></section>
            <section class="card panel updates-panel" id="alertas"><div class="card-header panel-heading"><h2>Atualizações recentes</h2><button class="text-button" id="all-updates">Ver todas</button></div><div class="timeline"><div class="timeline-item"><span class="timeline-dot green-dot"></span><div><h3>Limpeza de drenagem em andamento</h3><p>Equipe mobilizada na Asa Norte.</p><small>Há 25 minutos <span>·</span> Ação pública</small></div></div><div class="timeline-item"><span class="timeline-dot blue-dot"></span><div><h3>12 novos relatos recebidos</h3><p>Moradores de Ceilândia registraram ocorrências.</p><small>Há 48 minutos <span>·</span> Participação</small></div></div><div class="timeline-item"><span class="timeline-dot amber-dot"></span><div><h3>Alerta de calor excessivo</h3><p>Atenção aos pontos de maior vulnerabilidade.</p><small>Há 1 hora <span>·</span> Alerta climático</small></div></div></div></section>
        </div>
    </div>
    <footer class="page-footer"><span><strong>Clima na Pele</strong> · Dados, participação e ação.</span><span>Uma visão integrada para cuidar da sua cidade.</span></footer>
</main>
<div class="modal fade" id="detail-dialog" tabindex="-1" aria-labelledby="detail-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"><div class="modal-content">
        <div class="modal-header dialog-header"><span class="eyebrow">CLIMA NA PELE</span><button class="btn btn-icon btn-sm btn-light-success icon-button" data-bs-dismiss="modal" aria-label="Fechar janela"><svg class="icon"><use href="#i-close"/></svg></button></div>
        <div class="modal-body" id="dialog-content"></div>
        <div class="modal-footer dialog-footer"><span class="demo-label"><span></span> Dados demonstrativos</span><button class="btn btn-success button button-primary" data-bs-dismiss="modal">Entendi</button></div>
    </div></div>
</div>
<div class="toast dashboard-toast border-0" id="toast" role="status" aria-live="polite" aria-atomic="true"><div class="d-flex align-items-center"><div class="toast-body"></div><button type="button" class="btn-close btn-close-white me-3" data-bs-dismiss="toast" aria-label="Fechar aviso"></button></div></div>
@endsection
