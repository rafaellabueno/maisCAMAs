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
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#hospedes" data-toggle="tab">Hóspedes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#quartos" data-toggle="tab">Quartos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#reservas" data-toggle="tab">Reservas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#usuarios" data-toggle="tab">Usuários do Sistema</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#relatorios" data-toggle="tab">Relatórios</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><div class="card-body ">
                    <div class="tab-content text-center">
                        <div class="tab-pane active" id="hospedes">
                            <p><h6>Gerenciar informações sobre os hóspedes</h6><br><br>
                                Lista de hóspedes da Casa de Apoio Madre Ana com informações pessoais e de sua hospedagem</p>
                        </div>
                        <div class="tab-pane" id="quartos">
                            <p><h6>Gerenciar informações dos quartos</h6><br><br>Podemos adicionar novos quartos, assim como editar informações sobre os mesmos</p>
                        </div>
                        <div class="tab-pane" id="reservas">
                            <p><h6>Gerenciar informações das reservas</h6><br><br>
                            As reservas são divididas em três status: aceitas, em espera e recusadas. Nesta aba, podemos
                            visualizar todas as informações referentes as mesmas</p>
                        </div>
                        <div class="tab-pane" id="usuarios">
                            <p><h6>Gerenciar informações dos usuários</h6><br><br>
                            O sistema permite o cadastro de novos usuários, os cadastre aqui e gerencie suas funções</p>
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
