@extends('layouts.welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-nav-tabs ">
                <div class="card-header card-header-danger">
                    <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs text-center" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#reservas" data-toggle="tab">
                                        <i class="material-icons text-center">room_service</i> <br> </br> Reservas</a>
                                </li>
                                @if (Auth::user()->temFuncao('Master') || Auth::user()->temFuncao('Assistente Social Casa de Apoio')
                                    || Auth::user()->temFuncao('Funcionario Casa de Apoio'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#hospedes" data-toggle="tab">
                                        <i class="material-icons text-center">family_restroom</i> <br> </br>Hóspedes</a>
                                </li>
                                @endif
                                @if (Auth::user()->temFuncao('Master') || Auth::user()->temFuncao('Assistente Social Casa de Apoio')
                                    || Auth::user()->temFuncao('Funcionario Casa de Apoio'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#quartos" data-toggle="tab">
                                        <i class="material-icons text-center">hotel</i> <br> </br> Quartos</a>
                                </li>
                                @endif
                                @if (Auth::user()->temFuncao('Master'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#usuarios" data-toggle="tab">
                                        <i class="material-icons text-center">admin_panel_settings</i> <br> </br> Usuários do Sistema</a>
                                </li>
                                @endif
                                @if (Auth::user()->temFuncao('Master'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#relatorios" data-toggle="tab">
                                        <i class="material-icons text-center">content_paste</i> <br> </br> Relatórios</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div><div class="card-body ">
                    <div class="tab-content text-center">
                        <div class="tab-pane" id="hospedes">
                            <p><h6>Gerenciar informações sobre os hóspedes</h6><br><br>
                                Lista de hóspedes da Casa de Apoio Madre Ana com informações pessoais e de sua hospedagem </p>
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-rose">
                                        Lista de hóspedes
                                    </button>
                                </div>
                        </div>
                        <div class="tab-pane" id="quartos">
                            <p><h6>Gerenciar informações dos quartos</h6><br><br>Podemos adicionar novos quartos, assim como editar informações sobre os mesmos</p>
                            <div class="col-md-12 ">
                                <a type="button" href="{{ route('quartos.lista') }}" class="btn btn-rose">
                                    Lista de quartos
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane active" id="reservas">
                            <p><h6>Gerenciar informações das reservas</h6><br><br>
                            As reservas são divididas em três status: aceitas, em espera e recusadas. Nesta aba, podemos
                            visualizar todas as informações referentes as mesmas</p>
                            <div class="col-md-12 ">
                                @if (! Auth::user()->temFuncao('Assistente Social Santa Casa'))
                                    <a type="button" href=""  class="btn btn-rose">
                                        Lista de reservas
                                    </a>
                                @endif
                                <a type="button" href="{{ route('reservas.solicitacoes') }}" class="btn btn-rose">
                                    Minhas solicitações
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane" id="usuarios">
                            <p><h6>Gerenciar informações dos usuários</h6><br><br>
                            O sistema permite o cadastro de novos usuários, os cadastre aqui e gerencie suas funções</p>
                            <div class="col-md-12 ">
                                <a type="button" href="{{ route('usuarios.lista') }}" class="btn btn-rose">
                                    Lista de usuários
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane" id="relatorios">
                            <p><h6>Relatórios do Sistema</h6><br><br>
                            São disponibilizados em formato csv alguns relatórios que são de suma importância para a administração da Casa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
