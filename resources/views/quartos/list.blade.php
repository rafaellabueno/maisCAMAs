@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Quartos</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <div class="col-md-12 text-left">
                                    <a type="buttton" href="{{ route('quartos.cadastro') }}" class="btn btn-info">
                                        <i class="material-icons">add</i>
                                        Adicionar quarto
                                    </a>
                                    <div class="text-right">
                                        Filtrar por andar:
                                        @foreach($andares as $andar)
                                        <a type="buttton" href="{{ route('quartos.filtrar', $andar->andar) }}" class="btn btn-round btn-info btn-fab">
                                            {{$andar->andar}}
                                        </a>
                                        @endforeach
                                        <a type="buttton" href="{{ route('quartos.lista') }}" class="btn btn-round btn-info btn-fab">
                                            -
                                        </a>
                                    </div>
                                </div>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Número</th>
                                <th>Andar</th>
                                <th>Status</th>
                                <th>Info</th>
                                <th>Camas</th>
                                <th class="text-right">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quartos as $i => $quarto)
                                <tr>
                                    <td class="text-center">{{ $cont+=1 }}</td>
                                    <td>{{ $quarto->numero }}</td>
                                    <td>{{ $quarto->andar }}</td>
                                    <td>{{ $quarto->status }}</td>
                                    <td>@if($quarto->acessibilidade == 1) Acessibilidade @endif
                                        @if($quarto->acessibilidade == 1 && $quarto->banheiro == 1) <br> @endif
                                        @if($quarto->banheiro == 1) Banheiro @endif
                                    </td>
                                    <td>
                                        @foreach($camas as $cama)
                                            @if($cama->quarto_id == $quarto->id)
                                                    @if($cama->cama == "Berço")
                                                        <span class="badge text-white" style="background-color:#ff9966">Berço</span>
                                                    @endif
                                                    @if($cama->cama == "Bicama")
                                                        <span class="badge text-white" style="background-color:#e3b7d2">Bicama</span>
                                                    @endif
                                                    @if($cama->cama == "Cama Casal")
                                                        <span class="badge text-white" style="background-color:#98e5e7">Cama de Casal</span>
                                                    @endif
                                                    @if($cama->cama == "Cama Solteiro")
                                                        <span class="badge text-white" style="background-color:#ffc5c5">Cama de Solteiro</span>
                                                    @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('quartos.edita', $quarto->id) }}" type="button" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ route('quartos.show', $quarto->id) }}" type="button" rel="tooltip" class="btn btn-info">
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

