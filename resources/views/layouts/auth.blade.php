<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#087f53">
    <meta name="description" content="Acesse o Clima na Pele e participe de uma cidade mais resiliente.">
    <title>@yield('title') · Clima na Pele</title>
    <link rel="icon" href="{{ asset('images/brand.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('vendor/metronic/plugins/global/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/metronic/css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}?v=3">
</head>
<body class="auth-page @yield('theme')">
    <main class="auth-shell">
        <section class="auth-story" aria-label="Sobre o Clima na Pele">
            <a class="auth-brand" href="{{ route('dashboard') }}" aria-label="Clima na Pele — início"><img src="{{ asset('images/brand.svg') }}" alt="" width="48" height="60"><span>Clima<br>na Pele</span></a>
            @yield('story')
            <div class="story-footer"><span class="story-dot"></span> Dados. Participação. Ação. Resultado.</div>
        </section>
        <section class="auth-main" aria-labelledby="login-title">
            <header class="auth-topbar"><a href="{{ route('dashboard') }}"><i class="bi bi-arrow-left" aria-hidden="true"></i> Voltar ao início</a><span><i class="bi bi-shield-check" aria-hidden="true"></i> Clima na Pele</span></header>
            <div class="auth-form-wrapper">
                <div class="access-tabs" aria-label="Tipo de acesso">
                    <a href="{{ route('login') }}" class="@yield('citizen-active')" @if(request()->routeIs('login', 'register', 'password.request')) aria-current="page" @endif><i class="bi bi-person" aria-hidden="true"></i> Sou cidadão</a>
                    <a href="{{ route('gestor.login') }}" class="@yield('manager-active')" @if(request()->routeIs('gestor.login', 'gestor.password.request')) aria-current="page" @endif><i class="bi bi-building" aria-hidden="true"></i> Sou gestor</a>
                </div>
                <div class="access-symbol"><i class="bi @yield('access-icon')" aria-hidden="true"></i></div>
                <span class="form-eyebrow">@yield('eyebrow')</span>
                <h1 id="login-title">@yield('heading')</h1>
                <p class="form-intro">@yield('intro')</p>
                @section('form')
                <form id="login-form" method="post" action="#" aria-describedby="login-status">
                    @csrf
                    <div class="auth-field"><label class="form-label" for="email">@yield('email-label', 'E-mail')</label><div class="input-wrap"><i class="bi bi-envelope" aria-hidden="true"></i><input class="form-control form-control-solid" id="email" name="email" type="email" placeholder="@yield('email-placeholder', 'seuemail@exemplo.com')" autocomplete="username" maxlength="254" required></div></div>
                    <div class="auth-field"><div class="field-label"><label class="form-label" for="password">Senha</label><a class="auth-text-button" href="{{ request()->routeIs('gestor.*') ? route('gestor.password.request') : route('password.request') }}">Esqueci minha senha</a></div><div class="input-wrap"><i class="bi bi-lock" aria-hidden="true"></i><input class="form-control form-control-solid" id="password" name="password" type="password" placeholder="Digite sua senha" autocomplete="current-password" required><button class="password-toggle" type="button" id="password-toggle" aria-label="Mostrar senha" aria-controls="password" aria-pressed="false"><i class="bi bi-eye" aria-hidden="true"></i></button></div></div>
                    <p class="session-note"><i class="bi bi-info-circle" aria-hidden="true"></i> @yield('session-note')</p>
                    <button class="btn btn-success auth-submit" id="login-submit" type="submit" disabled>@yield('submit-label') <i class="bi bi-arrow-right" aria-hidden="true"></i></button>
                    <div class="alert alert-light-warning auth-status" id="login-status" role="status" hidden></div>
                    <noscript><p class="alert alert-light-warning">Ative o JavaScript para interagir com esta prévia.</p></noscript>
                </form>
                @show
                @yield('form-footer')
                <div class="auth-security"><span><i class="bi bi-shield-check" aria-hidden="true"></i> Seus dados merecem cuidado</span><button type="button" data-auth-help="privacy">Privacidade <i class="bi bi-arrow-up-right" aria-hidden="true"></i></button></div>
            </div>
            <footer class="auth-footer"><span>© {{ date('Y') }} Clima na Pele</span><span class="preview-badge"><span></span> Prévia de interface</span><button type="button" data-auth-help="support">Precisa de ajuda?</button></footer>
        </section>
    </main>
    <div class="modal fade" id="auth-help" tabindex="-1" aria-labelledby="help-title" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h2 class="modal-title fs-4" id="help-title"></h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button></div><div class="modal-body" id="help-body"></div><div class="modal-footer"><button class="btn btn-success" type="button" data-bs-dismiss="modal">Entendi</button></div></div></div></div>
    <script src="{{ asset('vendor/metronic/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('vendor/metronic/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('js/auth-help.js') }}?v=1"></script>
    @section('auth-scripts')
    <script src="{{ asset('js/auth.js') }}?v=3"></script>
    @show
</body>
</html>
