@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Usuários</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <div class="col-md-12 text-left">
                                    <a type="buttton" href="{{ route('usuarios.cadastro') }}" class="btn btn-info">
                                        <i class="material-icons">add</i>
                                        Adicionar usuário
                                    </a>
                                </div>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Função</th>
                                <th class="text-right">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $i => $user)
                            <tr>
                                <td class="text-center">{{ $cont+=1 }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user->funcoes->nome }}</td>
                                <td class="td-actions text-right">
                                    <a href="{{ route('usuarios.edita', $user['id']) }}" type="button" rel="tooltip" class="btn btn-success">
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
