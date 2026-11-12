@extends('layouts.auth')
@section('title', 'Acesso do cidadão')
@section('theme', 'citizen-theme')
@section('citizen-active', 'active')
@section('access-icon', 'bi-person')
@section('eyebrow', 'ESPAÇO DO CIDADÃO')
@section('heading', 'Bom ter você por aqui.')
@section('intro', 'Entre na sua conta e faça parte da transformação da sua cidade.')
@section('session-note', 'Em um dispositivo compartilhado, saia da conta ao terminar.')
@section('submit-label', 'Entrar na minha conta')
@section('story')
    @include('auth.partials.citizen-story')
@endsection
@section('form-footer')
    <div class="account-invite"><span>Ainda não tem uma conta?</span><a class="auth-text-button" href="{{ route('register') }}">Quero fazer parte <i class="bi bi-arrow-right" aria-hidden="true"></i></a></div>
@endsection
