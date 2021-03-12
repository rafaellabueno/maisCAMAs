@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Minhas solicitações de reserva</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <div class="col-md-12 text-left">
                                    @if (Auth::user()->temFuncao('Assistente Social Santa Casa'))
                                    <a type="buttton" href="{{ route('reservas.cadastro') }}" class="btn btn-info">
                                        <i class="material-icons">add</i>
                                        Solicitar reserva
                                    </a>
                                    @else
                                        <a type="buttton" href="{{ route('reservas.cadastro') }}" class="btn btn-info">
                                            <i class="material-icons">add</i>
                                            Solicitar primeira reserva
                                        </a>
                                        <a type="buttton" href="{{ route('reservasFunc.cadastro') }}" class="btn btn-info">
                                            <i class="material-icons">add</i>
                                            Solicitar reserva recorrente
                                        </a>
                                    @endif
                                </div>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Data da solicitação</th>
                                <th>Nome do hóspede</th>
                                <th>Cidade do hóspede</th>
                                <th>Status</th>
                                <th class="text-right">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservas as $i => $reserva)
                                <tr>
                                    <td class="text-center">{{ $cont+=1 }}</td>
                                    <td>{{date('d/m/Y', strtotime($reserva->created_at))}}</td>
                                    <td>{{ $reserva->nome }}</td>
                                    <td>{{ $reserva->cidade }}</td>
                                    <td>
                                        @if($reserva->status == "Solicitada")
                                        <span class="badge badge-primary">{{ $reserva->status }}</span>
                                        @endif
                                        @if($reserva->status == "Aprovada")
                                                <span class="badge badge-success">{{ $reserva->status }}</span>
                                            @endif
                                            @if($reserva->status == "Recusada")
                                                <span class="badge badge-danger">{{ $reserva->status }}</span>
                                            @endif
                                    </td>
                                    <td class="td-actions text-right">
                                        @if($reserva->status == "Solicitada")
                                        <a  href="{{ route('solicitacoes.edita', $reserva->id) }}"  type="button" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        @endif
                                        <a  href="{{ route('solicitacoes.show', $reserva->id) }}" type="button" rel="tooltip" class="btn btn-info">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


