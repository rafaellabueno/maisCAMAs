@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Hóspedes</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nome</th>
                                <th>Cidade</th>
                                <th>E-mail</th>
                                <th>RG</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hospedes as $i => $hospede)
                                <tr>
                                    <td class="text-center">{{ $cont+=1 }}</td>
                                    <td>{{ $hospede->nome }}</td>
                                    <td>{{ $hospede->cidade }}</td>
                                    <td>{{ $hospede->email }}</td>
                                    <td>{{ $hospede->rg }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('hospedes.edita', $hospede->id) }}" type="button" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ route('hospedes.show', $hospede->id) }}" type="button" rel="tooltip" class="btn btn-info">
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

