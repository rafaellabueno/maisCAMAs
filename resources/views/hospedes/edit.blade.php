@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row align-content-center">
            <div class="col-md-12 ">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Editar hóspede</h4>
                    </div>

                    <div class="card-body align-content-center">
                        <form class="form" method="post" action="{{route('hospedes.editar')}}">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                            <input type="hidden" name="id_hospede" value="{{ $hospede->first()->id }}">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" >
                                            Dados dos hóspedes
                                        </h6>
                                        <div class="col-md-12">
                                            <div class="input-group @error('nome') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Nome do Hóspede..." name="nome" value="{{isset($hospede->first()->nome) ? $hospede->first()->nome : ''}}" required disabled>
                                                <div class="col-md-12">
                                                    @error('nome')
                                                    <span class="help-block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group @error('cidade') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">location_one</i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Cidade..." name="cidade" value="{{isset($hospede->first()->cidade) ? $hospede->first()->cidade : ''}}" required>

                                                    <div class="col-md-12">
                                                        @error('cidade')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group @error('telefone') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">call</i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Telefone..." name="telefone" value="{{isset($hospede->first()->telefone) ? $hospede->first()->telefone : ''}}" required>

                                                    <div class="col-md-12">
                                                        @error('telefone')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group @error('email') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">alternate_email</i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="E-mail..." name="email" value="{{isset($hospede->first()->email) ? $hospede->first()->email : ''}}" required>

                                                    <div class="col-md-12">
                                                        @error('email')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group @error('rg') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">assignment_ind</i>
                                                    </span>
                                                    <input type="number" class="form-control" placeholder="RG do hóspede..." name="rg" value="{{isset($hospede->first()->rg) ? $hospede->first()->rg : ''}}" required disabled>
                                                    <div class="col-md-12">
                                                        @error('rg')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1">Data de nascimento</label>
                                                <div class="input-group @error('data') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">calendar_today</i>
                                                    </span>
                                                    <input type="date" class="form-control" placeholder="Data de Nascimento..." name="data" value="{{isset($hospede->first()->data_nascimento) ? $hospede->first()->data_nascimento : ''}}" required>

                                                    <div class="col-md-12">
                                                        @error('data')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" >
                                            Reservas do hóspede
                                        </h6>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Data solicitação</th>
                                                <th>Status</th>
                                                <th>Número do quarto</th>
                                                <th>Assistente Social</th>
                                                <th>Data da reserva</th>
                                                <th class="text-right">Ações</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reservas as $i => $rA)
                                                <tr>
                                                    <td class="text-center">{{ $i + 1}}</td>
                                                    <td>{{ $rA->created_at }}</td>
                                                    <td> {{ $rA->status  }}</td>
                                                    <td>{{ $rA->numero }}</td>
                                                    <td>{{ $rA->name }}</td>
                                                    <td>{{ $rA->data_entrada }} - {{ $rA->data_saida }}</td>
                                                    <td class="td-actions text-right">
                                                        @if($rA->status == "Aprovada")
                                                        <a href="{{ route('hospedes.editaQuarto', $rA->id) }}" type="button" rel="tooltip" class="btn btn-success">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                            <a href="{{ route('hospedes.checkout', $rA->id) }}" type="button" rel="tooltip" class="btn btn-danger">
                                                                <i class="material-icons">exit_to_app</i>
                                                            </a>
                                                            @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-info">
                                    Editar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
