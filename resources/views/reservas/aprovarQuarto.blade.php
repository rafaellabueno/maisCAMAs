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
                        <form class="form" method="post" action="{{route('reservas.aprovaQuarto')}}">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                            <input type="hidden" name="id_reserva" value="{{ $reserva->first()->id }}">
                            <input type="hidden" name="id_pessoa" value="{{ $pessoa }}">
                            <input type="hidden" name="id_pessoa" value="{{ $quarto->first()->id }}">

                            <br><br>
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <div class="card">
                                    <div class="card-header card-header-text card-header-info text-left">
                                        <div class="card-text">
                                            <h4 class="card-title">Andar {{$quarto->first()->andar}}</h4>
                                        </div>
                                    </div>
                                    <div class="card-body align-content-center">
                                        <div class="row align-content-center">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-header card-header-success">
                                                                {{$quarto->first()->numero}}
                                                            </div>
                                                            <div class="card-body">
                                                                @foreach($camas as $cama)
                                                                    @if($cama->quarto_id == $quarto->first()->id)
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
                                                                @if($quarto->first()->acessibilidade == 1)
                                                                    <span class="badge badge-info" >Acessibilidade</span>
                                                                @endif
                                                                @if($quarto->first()->banheiro == 1)
                                                                    <span class="badge badge-info" >Banheiro</span>
                                                                @endif
                                                                <br><br>
                                                                @foreach($hospedes as $hospedes)
                                                                    @if($hospede->quarto_id == $quarto_id)
                                                                        {{$hospede->nome}},
                                                                    @endif
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach($camas as $cama)
                                                        @if($cama->quarto_id == $quarto->first()->id && $cama->cama == 'Berço')
                                                            <div class="col-md-6">
                                                                <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                                    <span class="input-group-text">
                                                                        <i class="material-icons">looks_one</i>
                                                                    </span>
                                                                                        <input type="number" class="form-control" placeholder="Quantidade de berços ocupados..." name="numero" value="{{ old('numero') }}" required>

                                                                                        <div class="col-md-12">
                                                                                            @error('numero')
                                                                                            <span class="help-block">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                            @if($cama->quarto_id == $quarto->first()->id && $cama->cama == 'Bicama')
                                                                <div class="col-md-6">
                                                                    <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                                    <span class="input-group-text">
                                                                        <i class="material-icons">looks_one</i>
                                                                    </span>
                                                                        <input type="number" class="form-control" placeholder="Quantidade de bicamas ocupadas..." name="numero" value="{{ old('numero') }}" required>

                                                                        <div class="col-md-12">
                                                                            @error('numero')
                                                                            <span class="help-block">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($cama->quarto_id == $quarto->first()->id && $cama->cama == 'Cama Solteiro')
                                                                <div class="col-md-6">
                                                                    <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                                    <span class="input-group-text">
                                                                        <i class="material-icons">looks_one</i>
                                                                    </span>
                                                                        <input type="number" class="form-control" placeholder="Quantidade de camas de solteiro ocupadas..." name="numero" value="{{ old('numero') }}" required>

                                                                        <div class="col-md-12">
                                                                            @error('numero')
                                                                            <span class="help-block">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($cama->quarto_id == $quarto->first()->id && $cama->cama == 'Cama Casal')
                                                                <div class="col-md-6">
                                                                    <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                                    <span class="input-group-text">
                                                                        <i class="material-icons">looks_one</i>
                                                                    </span>
                                                                        <input type="number" class="form-control" placeholder="Quantidade de camas de casal ocupadas..." name="numero" value="{{ old('numero') }}" required>

                                                                        <div class="col-md-12">
                                                                            @error('numero')
                                                                            <span class="help-block">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                    @endforeach

                                                <div class="row justify-content-center">
                                                    <div class="col-md-7">
                                                        <div class="input-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">done</i>
                                                            <div class="selectize">
                                                                <label class="control-label"></label>
                                                                <select id="status-select" name="status" value="{{isset($quarto->first()->status) ? $quarto->first()->status : ''}}" required>
                                                                    <option></option>

                                                                    <option value="Livre">Livre</option>
                                                                    <option value="Ocupado">Ocupado</option>
                                                                    <option value="Inativo">Inativo</option>
                                                                </select>
                                                                @if ($errors->has('status'))
                                                                    <span class="help-block">
                                                                    <strong>{{ $errors->first('status') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-info">
                                    Aprovar reserva
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/selectize.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            var oldStatus = $('#status-select').attr("value");
            $('#status-select').selectize({
                placeholder: 'Status do quarto...',
                onInitialize: function () {
                    this.setValue(oldStatus, true);
                    //$('.selectize-control').addClass('form-group');
                    $('.selectize-input').addClass('form-control');
                },
            });
        });

    </script>
@endsection
