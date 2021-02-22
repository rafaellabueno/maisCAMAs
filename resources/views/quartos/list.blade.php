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
                                </div>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Número</th>
                                <th>Andar</th>
                                <th>Status</th>
                                <th class="text-right">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quartos as $i => $quarto)
                                <tr>
                                    <td class="text-center">{{ $cont+=1 }}</td>
                                    <td>{{ $quarto['numero'] }}</td>
                                    <td>{{ $quarto['andar'] }}</td>
                                    <td>{{ $quarto['status'] }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('quartos.edita', $quarto['id']) }}" type="button" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">edit</i>
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
