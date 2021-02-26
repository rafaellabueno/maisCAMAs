@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row align-content-center">
            <div class="col-md-12 ">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Adicionar Quarto</h4>
                    </div>
                    <div class="card-body align-content-center">
                        <form class="form" method="post" action="{{route('quartos.editar')}}">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

                            <input type="hidden" id="id_quarto" name="id_quarto" value="{{ $quarto->id }}">

                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                        <span class="input-group-text">
                                            <i class="material-icons">looks_one</i>
                                        </span>
                                        <input type="number" class="form-control" placeholder="Número..." name="numero" value="{{isset($quarto->numero) ? $quarto->numero : ''}}" required>

                                        <div class="col-md-12">
                                            @error('numero')
                                            <span class="help-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group @error('andar') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                        <span class="input-group-text">
                                            <i class="material-icons">stairs</i>
                                        </span>
                                        <input type="number" class="form-control" placeholder="Andar..." name="andar" value="{{isset($quarto->andar) ? $quarto->andar : ''}}" required>

                                        <div class="col-md-12">
                                            @error('andar')
                                            <span class="help-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <div class="input-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                        <span class="input-group-text">
                                            <i class="material-icons">done</i>
                                            <div class="selectize">
                                                <label class="control-label"></label>
                                                <select id="status-select" name="status" value="{{isset($quarto->status) ? $quarto->status : ''}}" required>
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

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" >
                                            INFORMAÇÕES DO QUARTO
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div  class="card-header text-white" style="background-color:#ff9966">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" id="c1" type="checkbox" @foreach($camas as $cama) @if($cama->cama == "Berço") checked @endif @endforeach  name="berco">BERÇO
                                                                <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                                <input type="number" class="form-control" placeholder="  Quantidade..." id="berco" name="quantberco" value="{{old('quantberco') }}" >
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div  class="card-header text-white" style="background-color:#e3b7d2">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" id="c2" @foreach($camas as $cama) @if($cama->cama == "Bicama") checked @endif @endforeach  name="bicama">BICAMA
                                                                <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                                <input type="number" class="form-control" placeholder="  Quantidade..." id="bicama" name="quantbicama" value="{{ old('quantbicama') }}" >

                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div  class="card-header text-white" style="background-color:#98e5e7">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" id="c3" @foreach($camas as $cama) @if($cama->cama == "Cama Casal") checked @endif @endforeach name="camacasal">CAMA DE CASAL
                                                                <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                                <input type="number" class="form-control" id="camacasal" placeholder="  Quantidade..." id="cama" name="quantcamacasal"  value="{{ old('quantcamacasal') }}" >
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header text-white" style="background-color:#ffc5c5">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" id="c4" name="cama" @foreach($camas as $cama) @if($cama->cama == "Cama Solteiro") checked @endif @endforeach>CAMA DE SOLTEIRO
                                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                                                <input type="number" class="form-control" id="cama" placeholder="  Quantidade..." name="quantcamasolteiro" value="{{ old('quantcamasolteiro') }}" >
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                @error('error')
                                                <span class="help-block ">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row justify-content-center">
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <i class="material-icons">bathtub</i>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" name="banheiro"  @if($quarto->banheiro == 1) checked @endif>O quarto possui banheiro
                                                                <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <i class="material-icons">accessible</i>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" name="acessibilidade" @if($quarto->acessibilidade == 1) checked @endif>Acessibilidade
                                                                <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12 my-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Observações do quarto</label>
                                            <textarea class="form-control" name="observacao" rows="2" data-value="{{isset($quarto->observacao) ? $quarto->observacao : ''}}"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-info">
                                            Salvar alterações
                                        </button>
                                    </div>
                                </div>
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
            id = document.getElementById("id_quarto").value;

            c1 = document.getElementById("c1");
            c2 = document.getElementById("c2");
            c3 = document.getElementById("c3");
            c4 = document.getElementById("c4");

            if(c1.checked) {
                berco = document.getElementById("berco");
                var urlConsulta = '../../cama/quant-cama/' + "Berço" + '/' + id;
                $.get(urlConsulta, function (res) {
                    berco.value = res;
                });
            }

            if(c2.checked) {
                bicama = document.getElementById("bicama");
                var urlConsulta = '../../cama/quant-cama/' + "Bicama" + '/' + id;
                $.get(urlConsulta, function (res) {
                    bicama.value = res;
                });
            }

            if(c3.checked) {
                camacasal = document.getElementById("camacasal");
                var urlConsulta = '../../cama/quant-cama/' + "Cama Casal" + '/' + id;
                $.get(urlConsulta, function (res) {
                    camacasal.value = res;
                });
            }

            if(c4.checked) {
                cama = document.getElementById("cama");
                var urlConsulta = '../../cama/quant-cama/' + "Cama Solteiro" + '/' + id;
                $.get(urlConsulta, function (res) {
                    cama.value = res;
                });
            }

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
