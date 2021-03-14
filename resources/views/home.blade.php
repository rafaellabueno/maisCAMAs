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
                                @if (Auth::user()->temFuncao('Master') || Auth::user()->temFuncao('Assistente Social Santa Casa')
                                    || Auth::user()->temFuncao('Funcionario Casa de Apoio'))
                                <li class="nav-item">
                                    <a class="nav-link active" href="#reservas" data-toggle="tab">
                                        <i class="material-icons text-center">room_service</i> <br> </br> Reservas</a>
                                </li>
                                @endif
                                @if (Auth::user()->temFuncao('Master')
                                    || Auth::user()->temFuncao('Funcionario Casa de Apoio'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#hospedes" data-toggle="tab">
                                        <i class="material-icons text-center">family_restroom</i> <br> </br>Hóspedes</a>
                                </li>
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
                                <li class="nav-item">
                                    <a class="nav-link" href="#tutoriais" data-toggle="tab">
                                        <i class="material-icons text-center">screen_search_desktop</i> <br> </br> Tutoriais</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><div class="card-body ">
                    <div class="tab-content text-center">
                        <div class="tab-pane" id="hospedes">
                            <p><h6>Gerenciar informações sobre os hóspedes</h6><br>
                            <img class="card-img-top" src="{{ asset('img/img1.jpg') }}" rel="nofollow" alt="Casa de Apoio Madre Ana">
                            <br><br>
                                Lista de hóspedes da Casa de Apoio Madre Ana com informações pessoais e de sua hospedagem </p>
                                <div class="col-md-12 ">
                                    <a type="button" href="{{ route('hospedes.lista') }}"  class="btn btn-rose">
                                        Lista de hóspedes
                                    </a>
                                </div>
                        </div>
                        <div class="tab-pane" id="quartos">
                            <p><h6>Gerenciar informações dos quartos</h6><br>
                            <img class="card-img-top" src="{{ asset('img/img4.png') }}" rel="nofollow" alt="Casa de Apoio Madre Ana">
                            <br><br>
                            Podemos adicionar novos quartos, assim como editar informações sobre os mesmos</p>
                            <div class="col-md-12 ">
                                <a type="button" href="{{ route('quartos.lista') }}" class="btn btn-rose">
                                    Lista de quartos
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane active" id="reservas">
                            <p><h6>Gerenciar informações das reservas</h6><br>
                            <img class="card-img-top" src="{{ asset('img/img3.png') }}" rel="nofollow" alt="Casa de Apoio Madre Ana">
                            <br><br>
                            As reservas são divididas em três status: aceitas, em espera e recusadas. Nesta aba, podemos
                            visualizar todas as informações referentes as mesmas</p>
                            <div class="col-md-12 ">
                                @if (! Auth::user()->temFuncao('Assistente Social Santa Casa'))
                                    <a type="button" href="{{ route('reservas.lista') }}"  class="btn btn-rose">
                                        Lista de reservas
                                    </a>
                                @endif
                                <a type="button" href="{{ route('reservas.solicitacoes') }}" class="btn btn-rose">
                                    Minhas solicitações
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane" id="usuarios">
                            <p><h6>Gerenciar informações dos usuários</h6><br>
                            <img class="card-img-top" src="{{ asset('img/img2.png') }}" rel="nofollow" alt="Casa de Apoio Madre Ana">
                            <br><br>
                            O sistema permite o cadastro de novos usuários, os cadastre aqui e gerencie suas funções</p>
                            <div class="col-md-12 ">
                                <a type="button" href="{{ route('usuarios.lista') }}" class="btn btn-rose">
                                    Lista de usuários
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane" id="relatorios">
                            <p><h6>Relatórios do Sistema</h6><br><br>
                            <div class="row  ">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header card-chart card-header-info">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">Diárias {{$ano}}</h4>
                                            <p class="card-category"><span class="text-success"><i class="fa fa-bed"></i> {{array_sum($ar)}}:  </span> total de diárias no ano atual.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header card-chart card-header-info">
                                            <canvas id="myChart2"></canvas>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">Hóspedes {{$ano}}</h4>
                                            <p class="card-category"><span class="text-success"><i class="fa fa-bed"></i> {{array_sum($ar2)}}:  </span> total de hóspedes no ano atual.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Relatórios</th>
                                            <th class="text-left">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Relatório de usuários e suas funções</td>
                                            <td class="td-actions text-left">
                                                <a href="{{route('csvUsers')}}" type="button" rel="tooltip" class="btn btn-info"><i class="material-icons">arrow_downward</i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Relatório de quartos e suas camas (ocupação) </td>
                                            <td class="td-actions text-left">
                                                <a href="{{route('csvQuartos')}}" type="button" rel="tooltip" class="btn btn-info"><i class="material-icons">arrow_downward</i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Relatório de hóspedes (e suas reservas) </td>
                                            <td class="td-actions text-left">
                                                <a href="{{route('csvHospedesReservas')}}" type="button" rel="tooltip" class="btn btn-info"><i class="material-icons">arrow_downward</i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Relatório de cidades e hóspedes</td>
                                            <td class="td-actions text-left">
                                                <a href="{{route('csvHospedesCidades')}}" type="button" rel="tooltip" class="btn btn-info"><i class="material-icons">arrow_downward</i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </p>
                        </div>
                        <div class="tab-pane" id="tutoriais">
                            <p><h6>Tutoriais do Sistema</h6><br><br></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/Chart.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Chart.min.js')}}"></script>
    <script type="application/javascript">
        $(document).ready(function(){
            var app = @json($ar);
            var app2 = @json($ar2);
            var ctx = document.getElementById('myChart').getContext('2d');
            var ctx2 = document.getElementById('myChart2').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
                    datasets: [{
                        label: 'Diárias',
                        borderColor: 'rgb(255,255,255)',
                        data: [app['01'], app['02'], app['03'], app['04'], app['05'], app['06'], app['07'], app['08'], app['09'],
                            app['10'], app['11'], app['12']]
                    }]
                },

                // Configuration options go here
                options: {}
            });
            var chart2 = new Chart(ctx2, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
                    datasets: [{
                        label: 'Hóspedes',
                        borderColor: 'rgb(255,255,255)',
                        data: [app2['01'], app2['02'], app2['03'], app2['04'], app2['05'], app2['06'], app2['07'], app2['08'], app2['09'],
                            app2['10'], app2['11'], app2['12']]
                    }]
                },

                // Configuration options go here
                options: {}
            });
        });
    </script>
@endsection
