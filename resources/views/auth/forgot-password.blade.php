@extends('layouts.auth')
@php
    $loginUrl = $managerAccess ? route('gestor.login') : route('login');
@endphp
@section('title', 'Recuperar senha')
@section('theme', $managerAccess ? 'manager-theme recovery-theme' : 'citizen-theme recovery-theme')
@section('citizen-active', $managerAccess ? '' : 'active')
@section('manager-active', $managerAccess ? 'active' : '')
@section('access-icon', 'bi-key')
@section('eyebrow', 'RECUPERE SEU ACESSO')
@section('heading', 'Esqueceu sua senha?')
@section('intro', 'Tudo bem, isso acontece. Informe o e-mail da sua conta para iniciar a recuperação de acesso.')
@section('story')
    <div class="story-content recovery-story">
        <span class="story-tag"><span></span> UM NOVO COMEÇO, A MESMA CONEXÃO</span>
        <h2>Recupere seu acesso.<br><em>Continue fazendo<br>a diferença.</em></h2>
        <p>Seu olhar sobre a cidade continua importante. Volte a acompanhar {{ $managerAccess ? 'as prioridades e as ações do seu território.' : 'seus relatos e as mudanças no seu bairro.' }}</p>
        <div class="recovery-illustration" aria-hidden="true"><span class="recovery-orbit orbit-one"></span><span class="recovery-orbit orbit-two"></span><span class="envelope-circle"><i class="bi bi-envelope"></i></span><span class="recovery-lock"><i class="bi bi-shield-lock"></i></span><span class="recovery-note"><span></span> Uma nova senha. A mesma participação.</span></div>
        <div class="recovery-steps"><div><span>01</span><p>Informe seu e-mail<small>O mesmo utilizado na sua conta.</small></p></div><div><span>02</span><p>Receba as instruções<small>A recuperação será feita pelo seu e-mail.</small></p></div><div><span>03</span><p>Defina uma nova senha<small>E volte a cuidar da sua cidade.</small></p></div></div>
    </div>
@endsection
@section('form')
    <form id="recovery-form" method="post" action="#" aria-describedby="recovery-status">
        @csrf
        <div class="auth-field"><label class="form-label" for="email">{{ $managerAccess ? 'E-mail institucional' : 'E-mail cadastrado' }}</label><div class="input-wrap"><i class="bi bi-envelope" aria-hidden="true"></i><input class="form-control form-control-solid" id="email" name="email" type="email" autocomplete="email" placeholder="{{ $managerAccess ? 'seunome@orgao.gov.br' : 'seuemail@exemplo.com' }}" maxlength="254" required></div></div>
        <p class="session-note"><i class="bi bi-info-circle" aria-hidden="true"></i> Confira se o endereço está correto antes de continuar.</p>
        <button class="btn btn-success auth-submit" id="recovery-submit" type="submit" disabled>Solicitar recuperação <i class="bi bi-arrow-right" aria-hidden="true"></i></button>
        <div class="alert alert-light-warning auth-status" id="recovery-status" role="status" hidden></div>
        <noscript><p class="alert alert-light-warning">Ative o JavaScript para interagir com esta prévia.</p></noscript>
    </form>
    <div class="recovery-help-card"><span><i class="bi bi-question-circle" aria-hidden="true"></i></span><div><strong>Não tem mais acesso ao e-mail?</strong><p>{{ $managerAccess ? 'Consulte a administração da sua organização sobre a atualização dos seus dados de acesso.' : 'A alteração do e-mail precisa de uma verificação de identidade para proteger a sua conta.' }}</p><button class="auth-text-button" type="button" data-auth-help="support">Preciso de orientação <i class="bi bi-arrow-right" aria-hidden="true"></i></button></div></div>
@endsection
@section('form-footer')
    <div class="account-invite recovery-back"><a class="auth-text-button" href="{{ $loginUrl }}"><i class="bi bi-arrow-left" aria-hidden="true"></i> Voltar ao login {{ $managerAccess ? 'do gestor' : 'do cidadão' }}</a></div>
@endsection
@section('auth-scripts')
    <script src="{{ asset('js/password-recovery.js') }}?v=1"></script>
@endsection
