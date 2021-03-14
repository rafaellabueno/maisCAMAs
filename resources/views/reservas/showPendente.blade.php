@extends('layouts.welcome')

@section('css')
    <style>
        .bootbox-alert div div div button.btn-primary{
            background-color: orange
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row align-content-center">
            <div class="col-md-12 ">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Solicitar nova reserva</h4>
                    </div>


                    <div class="row align-content-center d-none" id="loadCadastro">

                        <div class="loader loader--style2 " title="1">
                            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="1150px" height="80px" viewBox="0 0 50 50" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                          <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
                              <animateTransform attributeType="xml"
                                                attributeName="transform"
                                                type="rotate"
                                                from="0 25 25"
                                                to="360 25 25"
                                                dur="0.6s"
                                                repeatCount="indefinite"/>
                          </path>
                          </svg>
                        </div>

                    </div>

                    <div class="card-body align-content-center">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                            <div class="row text-right">
                                <div id="aceita" class="col-md-12">
                                <a type="button" href="{{ route('reservas.aprovar', $reserva->first()->id) }}" rel="tooltip" class="btn btn-success btn-round">
                                    <i class="material-icons">check</i>
                                </a>
                                    <a href="javascript:void(0);" id-reserva="{{ $reserva->first()->id }}" type="button" rel="tooltip" class="btn btn-danger btn-round exclusao">
                                        <i class="material-icons">close</i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" >
                                            Dados dos hópedes
                                        </h6>
                                        <div class="row ">
                                            <div class="col-md-12">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                    <label class="text-rose"> {{$reserva->first()->nome}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">location_city</i>
                                                    </span>
                                                    <label class="text-rose"> {{$reserva->first()->cidade}}</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">call</i>
                                                </span>
                                                    <label class="text-rose"> {{$reserva->first()->telefone}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">alternate_email</i>
                                                </span>
                                                    <label class="text-rose"> {{$reserva->first()->email}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">assignment_ind</i>
                                                </span>
                                                    <label class="text-rose"> {{$reserva->first()->rg}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                    @if($reserva->first()->nome_paciente != NULL)
                                                    <label class="text-rose"> {{$reserva->first()->nome_paciente}}</label>
                                                    @else
                                                    <label class="text-rose"> </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">calendar_today</i>
                                                </span>
                                                    <label class="text-rose"> {{date('d/m/Y', strtotime($reserva->first()->data_nascimento))}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" style="margin-bottom: 20px;">
                                            Dados da reserva
                                        </h6>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">calendar_today</i>
                                                </span>
                                                    <label class="text-rose"> {{date('d/m/Y', strtotime($reserva->first()->data_entrada))}}</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">calendar_today</i>
                                                </span>
                                                    <label class="text-rose"> {{date('d/m/Y', strtotime($reserva->first()->data_saida))}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">medical_services</i>
                                                </span>
                                                    <label class="text-rose"> {{$reserva->first()->especialidade}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">looks_one</i>
                                                </span>
                                                    <label class="text-rose"> {{$reserva->first()->quant_hospedes}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="acessibilidade" @if($reserva->first()->acessibilidade == TRUE) checked @endif disabled> Acessibilidade
                                                        <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="crianca" @if($reserva->first()->crianca == TRUE) checked @endif disabled> Paciente é criança
                                                        <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="urgencia" @if($reserva->first()->urgencia == TRUE) checked @endif disabled> Urgência
                                                        <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 my-3">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Observação</label>
                                                    <textarea class="form-control" name="observacao" rows="2" disabled> {{$reserva->first()->observacao}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="ModalDelete" class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="ModalDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recusar reserva</h5>
                </div>

                <div class="modal-body">
                    <span>Para recusar a reserva, confirme sua senha.</span>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">textsms</i>
                    </span>
                        <input type="text" placeholder="Observação de recusa..." id="observacaoDelete" class="form-control" name="observacao_recusa" required>
                    </div>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock_outline</i>
                    </span>
                        <input type="password" placeholder="Senha..." class="form-control" id="passwordDelete" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info excluir" data-dismiss="modal">Recusar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/bootbox.min.js') }}" type="text/javascript"></script>
    <script type="application/javascript">
        $('.exclusao').click(function(){
            var idReserva = $(this).attr('id-reserva');

            $("#ModalDelete").modal();

            $('.excluir').click(function(){
                $('#loadCadastro').removeClass('d-none');
                $('#aceita').addClass('d-none');
                $('#id-reserva').addClass('d-none');
                var urlConsulta = '../recusar/'+idReserva+'/'+$('#passwordDelete').val()+'/'+$('#observacaoDelete').val();
                $.get(urlConsulta, function (res){
                    if(res == 'true'){
                        window.location.href = "{{ route('reservas.lista')}}";
                    }else if(res == 'false'){
                        console.log('tcheu');
                        bootbox.alert("Senha incorreta");
                        $('#loadCadastro').addClass('d-none');
                        $('#aceita').removeClass('d-none');
                        $('#id-reserva').removeClass('d-none');
                    }else{

                    }

                });
            });

        });
    </script>

@endsection
