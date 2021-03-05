@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row align-content-center">
            <div class="col-md-12 ">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Checkout de {{$reserva->first()->nome}}</h4>
                    </div>

                    <div class="card-body align-content-center">
                        <form class="form" method="post" action="{{route('hospedes.check')}}">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                            <input type="hidden" name="id_reserva" value="{{ $reserva->first()->id }}">
                            <input type="hidden" name="id_pessoa" value="{{ $reserva->first()->pessoa_id }}">
                            <input type="hidden" name="id_quarto" value="{{ $quartoA->first()->id }}">

                            <br><br>
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <div class="card">
                                    <div class="card-header card-header-text card-header-info text-left">
                                        <div class="card-text">
                                            <h4 class="card-title">Andar {{$quartoA->first()->andar}}</h4>
                                        </div>
                                    </div>
                                    <h6 class="card-category text-info" >
                                        Dados do quarto
                                    </h6>
                                    <div class="card-body align-content-center">
                                        <div class="row align-content-center">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header @if($quartoA->first()->status == "Livre") text-white" style="background-color:#009933 @endif @if($quartoA->first()->status == "Ocupado") text-white" style="background-color:#ff3333 @endif">
                                                        {{$quartoA->first()->numero}}
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach($camasA as $cama)
                                                            @if($cama->quarto_id == $quartoA->first()->id)
                                                                @if($cama->cama == "Berço")
                                                                    <span class="badge text-white" style="background-color:#ff9966">{{$cama->quantidade}} Berço, vagas ocupadas: {{$cama->ocupadas}} </span><br>
                                                                @endif
                                                                @if($cama->cama == "Bicama")
                                                                    <span class="badge text-white" style="background-color:#e3b7d2">{{$cama->quantidade}} Bicama, vagas ocupadas:  {{$cama->ocupadas}} </span><br>
                                                                @endif
                                                                @if($cama->cama == "Cama Casal")
                                                                    <span class="badge text-white" style="background-color:#98e5e7">{{$cama->quantidade}} Cama de Casal, vagas ocupadas: {{$cama->ocupadas}} </span><br>
                                                                @endif
                                                                @if($cama->cama == "Cama Solteiro")
                                                                    <span class="badge text-white" style="background-color:#ffc5c5">{{$cama->quantidade}} Cama de Solteiro, vagas ocupadas: {{$cama->ocupadas}} </span><br>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @if($quartoA->first()->acessibilidade == 1)
                                                            <span class="badge badge-info" >Acessibilidade</span>
                                                        @endif
                                                        @if($quartoA->first()->banheiro == 1)
                                                            <span class="badge badge-info" >Banheiro</span>
                                                        @endif
                                                        <br><br>
                                                        @foreach($hospedesA as $hospede)
                                                            @if($hospede->quarto_id != null)
                                                                @if($hospede->quarto_id == $quartoA->first()->id)
                                                                    {{$hospede->nome}},
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>

                                            @foreach($camasA as $cama)
                                                @if($cama->quarto_id == $quartoA->first()->id && $cama->cama == 'Berço')
                                                    <div class="col-md-6">
                                                        <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                                    <span class="input-group-text">
                                                                        <i class="material-icons">looks_one</i>
                                                                    </span>
                                                            <input type="number" class="form-control" placeholder="Quantidade de berços a serem desocupados..." name="bercoA" value="{{ old('numero') }}" required>

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
                                                @if($cama->quarto_id == $quartoA->first()->id && $cama->cama == 'Bicama')
                                                    <div class="col-md-6">
                                                        <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                                    <span class="input-group-text">
                                                                        <i class="material-icons">looks_one</i>
                                                                    </span>
                                                            <input type="number" class="form-control" placeholder="Quantidade de bicamas a serem desocupadas..." name="bicamaA" value="{{ old('numero') }}" required>

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
                                                @if($cama->quarto_id == $quartoA->first()->id && $cama->cama == 'Cama Solteiro')
                                                    <div class="col-md-6">
                                                        <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                                    <span class="input-group-text">
                                                                        <i class="material-icons">looks_one</i>
                                                                    </span>
                                                            <input type="number" class="form-control" placeholder="Quantidade de camas a serem desocupadas..." name="camasolteiroA" value="{{ old('numero') }}" required>

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
                                                @if($cama->quarto_id == $quartoA->first()->id && $cama->cama == 'Cama Casal')
                                                    <div class="col-md-6">
                                                        <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                                    <span class="input-group-text">
                                                                        <i class="material-icons">looks_one</i>
                                                                    </span>
                                                            <input type="number" class="form-control" placeholder="Quantidade de camas a serem desocupadas..." name="camacasalA" value="{{ old('numero') }}" required>

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
                                            <div class="col-md-12">
                                                @error('quantidadeH')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-md-7">
                                                    <div class="input-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                                        <span class="input-group-text">
                                                            <i class="material-icons">done</i>
                                                            <div class="selectize">
                                                                <label class="control-label"></label>
                                                                <select id="statusA-select" name="statusA" value="{{isset($quartoA->first()->status) ? $quartoA->first()->status : ''}}" required>
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

                                            <div class="col-md-12 my-3">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Situação do quarto: descreva como o hóspede deixou o quarto</label>
                                                    <textarea class="form-control" name="situacao_quarto" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-info">
                                    Realizar checkout
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

            var oldStatusA= $('#statusA-select').attr("value");
            $('#statusA-select').selectize({
                placeholder: 'Status do quarto...',
                onInitialize: function () {
                    this.setValue(oldStatusA, true);
                    //$('.selectize-control').addClass('form-group');
                    $('.selectize-input').addClass('form-control');
                },
            });
        });

    </script>
@endsection
