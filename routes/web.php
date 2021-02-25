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

//Quartos
Route::get('/quartos/dashboard', 'QuartoController@index')->name('quartos.lista');
Route::get('/quartos/cadastrar', 'QuartoController@cadastro')->name('quartos.cadastro');
Route::post('/quartos/cadastra', 'QuartoController@cadastrar')->name('quartos.cadastrar');
Route::get('/quartos/editar/{id}', 'QuartoController@edita')->name('quartos.edita');
Route::post('/quartos/edita', 'QuartoController@editar')->name('quartos.editar');

//Reservas
Route::get('/reservas/cadastrarA', 'ReservaController@cadastro')->name('reservas.cadastro');
Route::post('/reservas/cadastraA', 'ReservaController@cadastrar')->name('reservas.cadastrar');
Route::get('/reservas/cadastrar', 'ReservaController@cadastroFunc')->name('reservasFunc.cadastro');
Route::post('/reservas/cadastra', 'ReservaController@cadastrarFunc')->name('reservasFunc.cadastrar');
Route::get('/reservas/solicitacoes', 'ReservaController@solicitacoes')->name('reservas.solicitacoes');
Route::get('/reservas/solicitacoes/{id}', 'ReservaController@show')->name('solicitacoes.show');
Route::get('/reservas/solicitacoes/editar/{id}', 'ReservaController@edita')->name('solicitacoes.edita');
Route::post('/reservas/solicitacoes/edita', 'ReservaController@editar')->name('solicitacoes.editar');
Route::get('reservas/dados-pessoa/{rg}', 'ReservaController@dadosPessoa'); //Ajax

Route::get('/reservas/lista', 'ReservaController@lista')->name('reservas.lista');
Route::get('/reservas/pendentes/{id}', 'ReservaController@showPendente')->name('solicitacoes.showPend');
Route::get('/reservas/recusar/{id}/{s}', 'ReservaController@recusar'); //Ajax

Auth::routes();

Route::post('/recuperar/senha/', 'Auth\ForgotPasswordController@emailSenha')->name('recuperar.senha');
