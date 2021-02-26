@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row align-content-center">
            <div class="col-md-12 ">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Visualizar Quarto</h4>
                    </div>
                    <div class="card-body align-content-center">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="input-group" style="margin-bottom: 20px;">
                                        <span class="input-group-text">
                                            <i class="material-icons">looks_one</i>
                                        </span>
                                        <label class="text-rose"> Número do quarto: {{$quarto->numero}} </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="input-group" style="margin-bottom: 20px;">
                                        <span class="input-group-text">
                                            <i class="material-icons">stairs</i>
                                        </span>
                                        <label class="text-rose"> Andar: {{$quarto->andar}} </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group" style="margin-bottom: 20px;">
                                        <span class="input-group-text">
                                            <i class="material-icons">stairs</i>
                                        </span>
                                        <label class="text-rose"> Status:
                                            @if($quarto->status == "Ocupado")
                                                <span class="badge badge-danger">Ocupado</span>
                                            @endif
                                            @if($quarto->status == "Livre")
                                                    <span class="badge badge-sucess">Livre</span>
                                            @endif
                                            @if($quarto->status == "Inativo")
                                                <span class="badge badge-light">Inativo</span>
                                            @endif
                                        </label>
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body align-content-center">
                                        <h6 class="card-category text-info" >
                                            INFORMAÇÕES DO QUARTO
                                        </h6>
                                        <div class="row text-center">
                                            @foreach($camas as $cama)
                                                @if($cama->cama == "Berço")
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div  class="card-header text-white" style="background-color:#ff9966">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" checked disabled type="checkbox" name="berco">BERÇO
                                                                <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                                <br><br><label> Quantidade: {{$cama->quantidade}} </label>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                @endif
                                                    @if($cama->cama == "Bicama")
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div  class="card-header text-white" style="background-color:#e3b7d2">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" checked disabled type="checkbox" name="bicama">BICAMA
                                                                <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                                <br><br><label> Quantidade: {{$cama->quantidade}} </label>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    @endif
                                                    @if($cama->cama == "Cama Casal")
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div  class="card-header text-white" style="background-color:#98e5e7">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" checked disabled type="checkbox" name="camacasal">CAMA DE CASAL
                                                                <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                                <br><br><label> Quantidade: {{$cama->quantidade}} </label>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    @endif
                                                    @if($cama->cama == "Cama Solteiro")
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-header text-white" style="background-color:#ffc5c5">

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" checked disabled type="checkbox" name="cama">CAMA DE SOLTEIRO
                                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                                                <br><br><label> Quantidade: {{$cama->quantidade}} </label>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    @endif
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div class="row justify-content-center">
                                            <div class="col-md-5">
                                                <div class="card">
                                                    <i class="material-icons">bathtub</i>
                                                    <div class="card-body">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" disabled @if($quarto->banheiro == 1) checked @endif type="checkbox" name="banheiro">O quarto possui banheiro
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
                                                                <input class="form-check-input" type="checkbox" disabled @if($quarto->acessibilidade == 1) checked @endif name="acessibilidade">Acessibilidade
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
                                            <textarea class="form-control" disabled name="observacao" rows="2">{{$quarto->observacao}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
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
