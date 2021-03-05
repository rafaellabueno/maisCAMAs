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

//Hospedes
Route::get('/hospedes/dashboard', 'HospedeController@index')->name('hospedes.lista');
Route::get('/hospedes/{id}', 'HospedeController@show')->name('hospedes.show');
Route::get('/hospedes/editar/{id}', 'HospedeController@edita')->name('hospedes.edita');
Route::post('/hospedes/edita', 'HospedeController@editar')->name('hospedes.editar');
Route::get('/hospedes/editar/quarto/{id}', 'HospedeController@editaQuarto')->name('hospedes.editaQuarto');
Route::get('/hospedes/editar/quarto/{idP}/{idR}/{idQ}', 'HospedeController@quartos')->name('hospedes.quartos');
Route::post('/hospedes/editar/quarto', 'HospedeController@quarto')->name('hospedes.quarto');
Route::post('/hospedes/edita/quarto', 'HospedeController@editarQuarto')->name('hospedes.editarQuarto');
Route::get('/hospedes/filtrar/{id}/{andar}', 'HospedeController@filtrar')->name('hospedes.filtrar');
Route::get('/hospedes/checkout/{id}', 'HospedeController@checkout')->name('hospedes.checkout');
Route::post('/hospedes/checkout', 'HospedeController@check')->name('hospedes.check');

//Quartos
Route::get('/quartos/dashboard', 'QuartoController@index')->name('quartos.lista');
Route::get('/quartos/cadastrar', 'QuartoController@cadastro')->name('quartos.cadastro');
Route::post('/quartos/cadastra', 'QuartoController@cadastrar')->name('quartos.cadastrar');
Route::get('/quartos/editar/{id}', 'QuartoController@edita')->name('quartos.edita');
Route::post('/quartos/edita', 'QuartoController@editar')->name('quartos.editar');
Route::get('/quartos/{id}', 'QuartoController@show')->name('quartos.show');

Route::get('/quartos/filtrar/{id}', 'QuartoController@filtrar')->name('quartos.filtrar');
Route::get('cama/quant-cama/{cama}/{id}', 'QuartoController@dadosCama'); //Ajax

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
Route::get('/reservas/aprovar/{id}', 'ReservaController@aprovar')->name('reservas.aprovar');
Route::post('/reservas/aprova', 'ReservaController@aprova')->name('reservas.aprova');
Route::get('/reservas/aprovar/quarto/{idP}/{idR}/{idQ}', 'ReservaController@aprovarQuarto')->name('reservas.aprovarQuarto');
Route::post('/reservas/aprova/quarto', 'ReservaController@aprovaQuarto')->name('reservas.aprovaQuarto');
Route::get('/reservas/filtrar/{id}/{andar}', 'ReservaController@filtrar')->name('reservas.filtrar');

Auth::routes();

Route::post('/recuperar/senha/', 'Auth\ForgotPasswordController@emailSenha')->name('recuperar.senha');
