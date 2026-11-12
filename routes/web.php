<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'dashboard')->name('dashboard');
Route::view('/painel', 'dashboard')->name('painel');

Route::view('/login', 'auth.citizen')->name('login');
Route::redirect('/usuario/login', '/login');
Route::view('/gestor/login', 'auth.manager')->name('gestor.login');

Route::view('/cadastro', 'auth.register')->name('register');

Route::view('/recuperar-senha', 'auth.forgot-password', ['managerAccess' => false])->name('password.request');
Route::view('/gestor/recuperar-senha', 'auth.forgot-password', ['managerAccess' => true])->name('gestor.password.request');
