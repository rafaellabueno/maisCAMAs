@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row align-content-center">
            <div class="col-md-12 ">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Hóspede: {{$hospede->first()->nome}}</h4>
                    </div>

                    <div class="card-body align-content-center">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" >
                                            Dados do hópede
                                        </h6>
                                        <div class="row ">
                                            <div class="col-md-12">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                    <label class="text-rose"> {{$hospede->first()->nome}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">location_city</i>
                                                    </span>
                                                    <label class="text-rose"> {{$hospede->first()->cidade}}</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">call</i>
                                                </span>
                                                    <label class="text-rose"> {{$hospede->first()->telefone}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">alternate_email</i>
                                                </span>
                                                    <label class="text-rose"> {{$hospede->first()->email}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">assignment_ind</i>
                                                </span>
                                                    <label class="text-rose"> {{$hospede->first()->rg}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">calendar_today</i>
                                                </span>
                                                    <label class="text-rose"> {{date('d/m/Y', strtotime($hospede->first()->data_nascimento))}}</label>
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
@endsection
