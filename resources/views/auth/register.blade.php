@extends('layouts.auth')
@section('title', 'Cadastro do cidadão')
@section('theme', 'citizen-theme registration-theme')
@section('citizen-active', 'active')
@section('access-icon', 'bi-person-plus')
@section('eyebrow', 'FAÇA PARTE DA MUDANÇA')
@section('heading', 'Sua participação começa aqui.')
@section('intro', 'Crie sua conta para registrar ocorrências ambientais e acompanhar as ações na sua cidade.')
@section('story')
    @include('auth.partials.citizen-story')
@endsection
@section('form')
    <form id="registration-form" method="post" action="#" aria-describedby="registration-status">
        @csrf
        <div class="auth-field"><label class="form-label" for="name">Nome completo</label><div class="input-wrap"><i class="bi bi-person" aria-hidden="true"></i><input class="form-control form-control-solid" id="name" name="nome" type="text" autocomplete="name" placeholder="Como você se chama?" minlength="2" maxlength="255" required></div></div>
        <div class="auth-field"><label class="form-label" for="social-name">Nome social <span class="optional-label">(opcional)</span></label><div class="input-wrap"><i class="bi bi-person-badge" aria-hidden="true"></i><input class="form-control form-control-solid" id="social-name" name="nome_social" type="text" autocomplete="nickname" placeholder="Como prefere ser chamado(a)?" maxlength="255"></div></div>
        <div class="auth-field"><label class="form-label" for="email">E-mail</label><div class="input-wrap"><i class="bi bi-envelope" aria-hidden="true"></i><input class="form-control form-control-solid" id="email" name="email" type="email" autocomplete="email" placeholder="seuemail@exemplo.com" maxlength="254" required></div></div>
        <div class="registration-passwords">
            <div class="auth-field"><label class="form-label" for="password">Senha</label><div class="input-wrap"><i class="bi bi-lock" aria-hidden="true"></i><input class="form-control form-control-solid" id="password" name="password" type="password" autocomplete="new-password" placeholder="Crie uma senha" minlength="8" aria-describedby="password-hint" required><button class="password-toggle" type="button" id="password-toggle" aria-label="Mostrar senha" aria-controls="password" aria-pressed="false"><i class="bi bi-eye" aria-hidden="true"></i></button></div></div>
            <div class="auth-field"><label class="form-label" for="password-confirmation">Confirmar senha</label><div class="input-wrap"><i class="bi bi-lock" aria-hidden="true"></i><input class="form-control form-control-solid" id="password-confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Repita a senha" minlength="8" required><button class="password-toggle" type="button" data-password-toggle aria-label="Mostrar confirmação de senha" aria-controls="password-confirmation" aria-pressed="false"><i class="bi bi-eye" aria-hidden="true"></i></button></div></div>
        </div>
        <p class="session-note" id="password-hint"><i class="bi bi-info-circle" aria-hidden="true"></i> Use pelo menos 8 caracteres. Prefira uma combinação de letras, números e símbolos.</p>
        <div class="registration-purpose"><i class="bi bi-geo-alt" aria-hidden="true"></i><p><strong>Um cadastro, muitas formas de participar.</strong> Registre o que acontece no seu bairro e acompanhe as providências da gestão.</p></div>
        <button class="btn btn-success auth-submit" id="registration-submit" type="submit" disabled>Criar minha conta <i class="bi bi-arrow-right" aria-hidden="true"></i></button>
        <div class="alert alert-light-warning auth-status" id="registration-status" role="status" hidden></div>
        <noscript><p class="alert alert-light-warning">Ative o JavaScript para interagir com esta prévia.</p></noscript>
    </form>
@endsection
@section('form-footer')
    <div class="account-invite"><span>Já tem uma conta?</span><a class="auth-text-button" href="{{ route('login') }}">Entrar <i class="bi bi-arrow-right" aria-hidden="true"></i></a></div>
@endsection
