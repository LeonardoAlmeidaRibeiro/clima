@extends('layouts.auth')
@section('title', 'Acesso do gestor')
@section('theme', 'manager-theme')
@section('manager-active', 'active')
@section('access-icon', 'bi-building')
@section('eyebrow', 'ACESSO INSTITUCIONAL')
@section('heading', 'Gestão que faz a diferença.')
@section('intro', 'Acesse seu espaço de gestão e transforme informações em ações para o território.')
@section('email-label', 'E-mail institucional')
@section('email-placeholder', 'seunome@orgao.gov.br')
@section('session-note', 'Acesso destinado às equipes de gestão e moderação autorizadas.')
@section('submit-label', 'Entrar no painel de gestão')
@section('story')
    <div class="story-content"><span class="story-tag"><span></span> INTELIGÊNCIA PARA CUIDAR</span><h2>Mais informação.<br>Melhores decisões.<br><em>Impacto real.</em></h2><p>Uma visão integrada do território para identificar prioridades, coordenar respostas e acompanhar o que muda na vida das pessoas.</p>
        <div class="management-scene"><div class="mini-dashboard"><div class="mini-heading"><span><span></span> Visão do território</span><i class="bi bi-grid" aria-hidden="true"></i></div><div class="mini-stats"><div><i class="bi bi-geo-alt" aria-hidden="true"></i><strong>Identificar</strong><small>Ocorrências</small></div><div><i class="bi bi-lightning-charge" aria-hidden="true"></i><strong>Priorizar</strong><small>Respostas</small></div><div><i class="bi bi-graph-up" aria-hidden="true"></i><strong>Transformar</strong><small>Resultados</small></div></div><div class="mini-map"><img src="{{ asset('images/brasilia-map.svg') }}" alt="Ilustração de mapa territorial" width="400" height="140"><span class="mini-pin pin-one"><i class="bi bi-geo-alt-fill" aria-hidden="true"></i></span><span class="mini-pin pin-two"><i class="bi bi-geo-alt-fill" aria-hidden="true"></i></span><span class="mini-pin pin-three"><i class="bi bi-check-lg" aria-hidden="true"></i></span><div class="mini-map-label"><span></span> Do relato à ação</div></div></div></div>
        <div class="story-features"><span><i class="bi bi-shield-check" aria-hidden="true"></i> Gestão territorial</span><span><i class="bi bi-people" aria-hidden="true"></i> Participação cidadã</span></div>
    </div>
@endsection
@section('form-footer')
    <div class="institutional-note"><span class="institution-icon"><i class="bi bi-person-check" aria-hidden="true"></i></span><div><strong>Faz parte de uma equipe de gestão?</strong><p>O acesso é vinculado à sua organização e ao seu território.</p><button class="auth-text-button" type="button" data-auth-help="institution">Como solicitar acesso <i class="bi bi-arrow-right" aria-hidden="true"></i></button></div></div>
@endsection
