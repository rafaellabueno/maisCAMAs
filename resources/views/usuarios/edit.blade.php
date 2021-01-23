@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Adicionar Usuário</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{route('usuarios.editar')}}">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

                            <input type="hidden" name="id_user" value="{{ $user->id }}">

                            <div class="col-md-12">
                                <div class="input-group @error('nome') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                <span class="input-group-text">
                                    <i class="material-icons">person</i>
                                </span>
                                    <input type="text" class="form-control" placeholder="Nome..." name="nome" value="{{isset($user->name) ? $user->name : ''}}" required>

                                    <div class="col-md-12">
                                        @error('nome')
                                        <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group @error('email') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                <span class="input-group-text">
                                    <i class="material-icons">email</i>
                                </span>
                                    <input type="text" class="form-control" placeholder="E-mail..." name="email" value="{{isset($user->email) ? $user->email : ''}}" required>

                                    <div class="col-md-12">
                                        @error('email')
                                        <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group{{ $errors->has('funcao') ? ' has-error' : '' }}">
                                    <span class="input-group-text">
                                        <i class="material-icons">assignment_ind</i>
                                    <div class="selectize">
                                        <label class="control-label"></label>
                                        <select id="funcao-select" name="funcao" value="{{isset($user->funcao_id) ? $user->funcao_id : ''}}" required>
                                            @foreach($funcoes as $funcao)
                                                <option value="{{$funcao->id}}">{{$funcao->nome}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('funcao'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('funcao') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-info">
                                    Salvar Alterações
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
        $(document).ready(function () {
            var oldFuncao = $('#funcao-select').attr("value");
            var texto = 'Selecione uma função...                                                                                                                  ';

            $('#funcao-select').selectize({
                placeholder: texto,
                onInitialize: function () {
                    this.setValue(oldFuncao, true);
                    //$('.selectize-control').addClass('form-group');
                    $('.selectize-input').addClass('form-control');
                },
            });
        });

    </script>
@endsection
