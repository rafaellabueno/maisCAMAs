@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row align-content-center">
            <div class="col-md-12 ">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Aprovar reserva de {{$reserva->first()->nome}}</h4>
                    </div>

                    <div class="card-body align-content-center">
                        <form class="form" method="post" action="{{route('reservas.aprova')}}">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                        <input type="hidden" name="id_reserva" value="{{ $reserva->first()->id }}">
                        <input type="hidden" name="id_pessoa" value="{{ $reserva->first()->pessoa_id }}">

                        <div class="row ">
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1">Data de entrada</label>
                                <div class="input-group @error('data_entrada') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">calendar_today</i>
                                                    </span>
                                    <input type="date" class="form-control" placeholder="Data de entrada..." name="data_entrada" value="{{isset($reserva->first()->data_entrada) ? $reserva->first()->data_entrada : ''}}" required>

                                    <div class="col-md-12">
                                        @error('data_entrada')
                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="exampleFormControlInput1">Data de saída</label>
                                <div class="input-group @error('data_saida') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">calendar_today</i>
                                                    </span>
                                    <input type="date" class="form-control" placeholder="Data de Nascimento..." name="data_saida" value="{{isset($reserva->first()->data_saida) ? $reserva->first()->data_saida : ''}}" required>

                                    <div class="col-md-12">
                                        @error('data_saida')
                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h6 class=" text-info" >
                            Escolha um quarto...
                        </h6>
                            <div class="text-right">
                                Filtrar por andar:
                                @foreach($andares as $andar)
                                    <a type="buttton" href="{{ route('reservas.filtrar', array($reserva->first()->id, $andar->andar)) }}" class="btn btn-round btn-info btn-fab">
                                        {{$andar->andar}}
                                    </a>
                                @endforeach
                                <a type="buttton" href="{{ route('reservas.aprovar', $reserva->first()->id )}}" class="btn btn-round btn-info btn-fab">
                                    -
                                </a>
                            </div>
                        @foreach($andares as $andar)
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <div class="card">
                                    <div class="card-header card-header-text card-header-info text-left">
                                        <div class="card-text">
                                            <h4 class="card-title">Andar {{$andar->andar}}</h4>
                                        </div>
                                    </div>
                                    <div class="card-body align-content-center">
                                        <div class="row align-content-center">
                                        @foreach($quartos as $quarto)
                                            @if($quarto->status == "Livre" && $quarto->andar == $andar->andar)
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header text-white" style="background-color:#009933">
                                                        {{$quarto->numero}}
                                                    </div>
                                                    <div class="card-body">
                                                                <div class="form-check form-check-radio">
                                                                    <label class="form-check-label">
                                                                        <input class="form-check-input" type="radio" name="radio" id="exampleRadios2" value="{{$quarto->id}}" checked required>
                                                                        Selecionar quarto
                                                                        <span class="circle">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                                <br>
                                                                @foreach($camas as $cama)
                                                                    @if($cama->quarto_id == $quarto->id)
                                                                        @if($cama->cama == "Berço")
                                                                            <span class="badge text-white" style="background-color:#ff9966">{{$cama->quantidade}} Berço, vagas ocupadas: {{$cama->ocupadas}}</span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Bicama")
                                                                            <span class="badge text-white" style="background-color:#e3b7d2">{{$cama->quantidade}} Bicama, vagas ocupadas: {{$cama->ocupadas}} </span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Cama Casal")
                                                                            <span class="badge text-white" style="background-color:#98e5e7">{{$cama->quantidade}} Cama de Casal, vagas ocupadas: {{$cama->ocupadas}} </span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Cama Solteiro")
                                                                            <span class="badge text-white" style="background-color:#ffc5c5">{{$cama->quantidade}} Cama de Solteiro, vagas ocupadas: {{$cama->ocupadas}} </span><br>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                @if($quarto->acessibilidade == 1)
                                                                    <span class="badge badge-info" >Acessibilidade</span>
                                                                @endif
                                                                @if($quarto->banheiro == 1)
                                                                    <span class="badge badge-info" >Banheiro</span>
                                                                @endif
                                                                <br><br>
                                                                @foreach($hospedes as $hospede)
                                                                    @if($hospede->quarto_id != null)
                                                                        @if($hospede->quarto_id == $quarto->id)
                                                                            {{$hospede->nome}},
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                                @if($quarto->status == "Ocupado" && $quarto->andar == $andar->andar)
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <div class="card-header text-white" style="background-color:#ff3333">
                                                                {{$quarto->numero}}
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="form-check form-check-radio">
                                                                    <label class="form-check-label">
                                                                        <input class="form-check-input" type="radio" disabled name="radio" id="exampleRadios2" value="{{$quarto->id}}" required>
                                                                        Selecionar quarto
                                                                        <span class="circle">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                                <br>
                                                                @foreach($camas as $cama)
                                                                    @if($cama->quarto_id == $quarto->id)
                                                                        @if($cama->cama == "Berço")
                                                                            <span class="badge text-white" style="background-color:#ff9966">{{$cama->quantidade}} Berço, {{$cama->ocupadas}} vaga ocupada</span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Bicama")
                                                                            <span class="badge text-white" style="background-color:#e3b7d2">{{$cama->quantidade}} Bicama, {{$cama->ocupadas}} vaga ocupada</span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Cama Casal")
                                                                            <span class="badge text-white" style="background-color:#98e5e7">{{$cama->quantidade}} Cama de Casal, {{$cama->ocupadas}} vaga ocupada</span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Cama Solteiro")
                                                                            <span class="badge text-white" style="background-color:#ffc5c5">{{$cama->quantidade}} Cama de Solteiro, {{$cama->ocupadas}} vaga ocupada</span><br>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                @if($quarto->acessibilidade == 1)
                                                                    <span class="badge badge-info" >Acessibilidade</span>
                                                                @endif
                                                                @if($quarto->banheiro == 1)
                                                                    <span class="badge badge-info" >Banheiro</span>
                                                                @endif
                                                                <br><br>
                                                                @foreach($hospedes as $hospede)
                                                                    @if($hospede->quarto_id != null)
                                                                        @if($hospede->quarto_id == $quarto->id)
                                                                            {{$hospede->nome}},
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($quarto->status == "Inativo" && $quarto->andar == $andar->andar)
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <div class="card-header text-white" style="background-color:#d6d8d9">
                                                                {{$quarto->numero}}
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="form-check form-check-radio">
                                                                    <label class="form-check-label">
                                                                        <input class="form-check-input" type="radio" disabled name="radio" id="exampleRadios2" value="{{$quarto->id}}" required>
                                                                        Selecionar quarto
                                                                        <span class="circle">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                                <br>
                                                                @foreach($camas as $cama)
                                                                    @if($cama->quarto_id == $quarto->id)
                                                                        @if($cama->cama == "Berço")
                                                                            <span class="badge text-white" style="background-color:#ff9966">{{$cama->quantidade}} Berço, {{$cama->ocupadas}} vaga ocupada</span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Bicama")
                                                                            <span class="badge text-white" style="background-color:#e3b7d2">{{$cama->quantidade}} Bicama, {{$cama->ocupadas}} vaga ocupada</span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Cama Casal")
                                                                            <span class="badge text-white" style="background-color:#98e5e7">{{$cama->quantidade}} Cama de Casal, {{$cama->ocupadas}} vaga ocupada</span><br>
                                                                        @endif
                                                                        @if($cama->cama == "Cama Solteiro")
                                                                            <span class="badge text-white" style="background-color:#ffc5c5">{{$cama->quantidade}} Cama de Solteiro, {{$cama->ocupadas}} vaga ocupada</span><br>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                @if($quarto->acessibilidade == 1)
                                                                    <span class="badge badge-info" >Acessibilidade</span>
                                                                @endif
                                                                @if($quarto->banheiro == 1)
                                                                    <span class="badge badge-info" >Banheiro</span>
                                                                @endif
                                                                <br><br>
                                                                @foreach($hospedes as $hospede)
                                                                    @if($hospede->quarto_id != null)
                                                                        @if($hospede->quarto_id == $quarto->id)
                                                                            {{$hospede->nome}},
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        @endforeach
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-info">
                                    Próxima etapa
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
