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
                        <form class="form" method="post" action="{{route('quartos.cadastrar')}}">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="input-group @error('numero') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                        <span class="input-group-text">
                                            <i class="material-icons">looks_one</i>
                                        </span>
                                        <input type="number" class="form-control" placeholder="Número..." name="numero" value="{{ old('numero') }}" required>

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
                                        <input type="number" class="form-control" placeholder="Andar..." name="andar" value="{{ old('andar') }}" required>

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
                                                <select id="status-select" name="status" value="{{ old('status') }}" required>
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
                                                            <input class="form-check-input" type="checkbox" name="berco">BERÇO
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                            <input type="number" class="form-control" placeholder="  Quantidade..." name="quantberco" value="{{ old('quantberco') }}" >
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
                                                        <input class="form-check-input" type="checkbox" name="bicama">BICAMA
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                        <input type="number" class="form-control" placeholder="  Quantidade..." name="quantbicama" value="{{ old('quantbicama') }}" >
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
                                                    <input class="form-check-input" type="checkbox" name="camacasal">CAMA DE CASAL
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                    <input type="number" class="form-control" placeholder="  Quantidade..." name="quantcamacasal" value="{{ old('quantcamacasal') }}" >
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
                                                <input class="form-check-input" type="checkbox" name="cama">CAMA DE SOLTEIRO
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                                <input type="number" class="form-control" placeholder="  Quantidade..." name="quantcamasolteiro" value="{{ old('quantcamasolteiro') }}" >
                                            </label>

                                        </div>
                                    </div>
                                </div>
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
                                            <input class="form-check-input" type="checkbox" name="banheiro">O quarto possui banheiro
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
                                                <input class="form-check-input" type="checkbox" name="acessibilidade">Acessibilidade
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
                    <textarea class="form-control" name="observacao" rows="2"></textarea>
                </div>
            </div>

            <div class="col-md-12 ">
                <button type="submit" class="btn btn-info">
                    Cadastrar
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
