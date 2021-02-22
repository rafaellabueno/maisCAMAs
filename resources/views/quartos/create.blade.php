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
                        <form class="form" method="post" action="{{route('usuarios.cadastrar')}}">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

                            <div class="row ">
                                <div class="col-md-4">
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

                                <div class="col-md-4">
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


                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-header card-header-icon card-header-rose">
                                            <div class="card-icon">
                                                <i class="material-icons">language</i>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                             2 BICAMAS (4 pessoas)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-info">
                                    Cadastrar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
