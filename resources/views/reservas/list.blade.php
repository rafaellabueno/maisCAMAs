@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose text-center">
                        <h4 class="card-title">Solicitações de reserva</h4>
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs text-center" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pendentes-1" role="tab" data-toggle="tab">
                                            <i class="material-icons">schedule</i>
                                            Pendentes
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#aceitas-1" role="tab" data-toggle="tab">
                                            <i class="material-icons">check</i>
                                            Aceitas
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#recusadas-1" role="tab" data-toggle="tab">
                                            <i class="material-icons">close</i>
                                            Recusadas
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#liberadas-1" role="tab" data-toggle="tab">
                                            <i class="material-icons">star</i>
                                            Liberadas
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                                <div class="tab-content tab-space">
                                    <div class="tab-pane active" id="pendentes-1">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Data solicitação</th>
                                                <th>Nome do hóspede</th>
                                                <th>Assistente Social</th>
                                                <th>Data da reserva</th>
                                                <th class="text-right">Ações</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reservasP as $i => $rP)
                                                <tr>
                                                    <td class="text-center">{{ $i + 1}}</td>
                                                    <td>{{ $rP->created_at }}</td>
                                                    <td>{{ $rP->nome }}</td>
                                                    <td>{{ $rP->name }}</td>
                                                    <td>{{ $rP->data_entrada }} - {{ $rP->data_saida }}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('solicitacoes.showPend', $rP->id) }}" type="button" rel="tooltip" class="btn btn-info">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="aceitas-1">

                                    </div>
                                    <div class="tab-pane" id="recusadas-1">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Data solicitação</th>
                                                <th>Nome do hóspede</th>
                                                <th>Assistente Social</th>
                                                <th>Data da reserva</th>
                                                <th class="text-right">Ações</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reservasR as $i => $rR)
                                                <tr>
                                                    <td class="text-center">{{ $i + 1}}</td>
                                                    <td>{{ $rR->created_at }}</td>
                                                    <td>{{ $rR->nome }}</td>
                                                    <td>{{ $rR->name }}</td>
                                                    <td>{{ $rR->data_entrada }} - {{ $rR->data_saida }}</td>
                                                    <td class="td-actions text-right">
                                                        <a href="" type="button" rel="tooltip" class="btn btn-info">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="liberadas-1">

                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
