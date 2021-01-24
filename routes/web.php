<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/home', 'HomeController@index')->name('home');

//Usuários
Route::get('/usuarios/dashboard', 'UsuarioController@index')->name('usuarios.lista');
Route::get('/usuarios/cadastrar', 'UsuarioController@cadastro')->name('usuarios.cadastro');
Route::post('/usuarios/cadastra', 'UsuarioController@cadastrar')->name('usuarios.cadastrar');
Route::get('/usuarios/editar/{id}', 'UsuarioController@edita')->name('usuarios.edita');
Route::post('/usuarios/edita', 'UsuarioController@editar')->name('usuarios.editar');
Route::get('funcoes/dados-funcao/{id}', 'UsuarioController@dadosFuncao'); //Ajax



Auth::routes();

Route::post('/recuperar/senha/', 'Auth\ForgotPasswordController@emailSenha')->name('recuperar.senha');
