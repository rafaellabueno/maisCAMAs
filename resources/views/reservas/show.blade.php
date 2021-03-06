@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row align-content-center">
            <div class="col-md-12 ">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Solicitar nova reserva</h4>
                    </div>

                    <div class="card-body align-content-center">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

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

                            @if($reserva->first()->status == "Recusada")
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" style="margin-bottom: 20px;">
                                            Observação da recusa
                                        </h6>
                                        <div class="row ">
                                            <div class="col-md-12">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">textsms</i>
                                                </span>
                                                    <label class="text-rose"> {{$reserva->first()->observacao_recusa}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

