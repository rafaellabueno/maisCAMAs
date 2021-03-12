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
                        <form class="form" method="post" action="{{route('reservasFunc.cadastrar')}}">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" >
                                            Dados dos hóspedes
                                        </h6>
                                        <div class="col-md-12">

                                                <div class="input-group @error('rg') invalid-feedback @enderror" style="margin-top: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">assignment_ind</i>
                                                    </span>
                                                    <select id="pessoa-select" name="rg" value="{{old('rg')}}" required>
                                                        <option></option>
                                                        @foreach ($pessoas as $pessoa)
                                                            @if(old('rg') == $pessoa->rg)
                                                                <option value="{{$pessoa->rg}}" selected>{{$pessoa->nome}} < {{$pessoa->rg}} ></option>
                                                            @else
                                                                <option value="{{$pessoa->rg}}">{{$pessoa->nome}} < {{$pessoa->rg}} ></option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <div class="col-md-12">
                                                        @error('rg')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            <div class="input-group @error('nome') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <input type="text" class="form-control" id="nome" placeholder="Nome do Hóspede..." name="nome" value="{{ old('nome') }}" required disabled>
                                                <div class="col-md-12">
                                                    @error('nome')
                                                    <span class="help-block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group @error('cidade') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">location_one</i>
                                                    </span>
                                                    <input type="text" class="form-control" id="cidade" placeholder="Cidade..." name="cidade" value="{{ old('cidade') }}" required disabled>

                                                    <div class="col-md-12">
                                                        @error('cidade')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group @error('telefone') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">call</i>
                                                    </span>
                                                    <input type="text" class="form-control" id="telefone" placeholder="Telefone..." name="telefone" value="{{ old('telefone') }}" required disabled>

                                                    <div class="col-md-12">
                                                        @error('telefone')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-12">
                                                <div class="input-group @error('email') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">alternate_email</i>
                                                    </span>
                                                    <input type="text" class="form-control" id="email" placeholder="E-mail..." name="email" value="{{ old('email') }}" required readonly>

                                                    <div class="col-md-12">
                                                        @error('email')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="input-group @error('nome_paciente') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">face</i>
                                                    </span>
                                                    <input type="text" class="form-control" id="paciente" placeholder="Nome do paciente..." name="nome_paciente" value="{{ old('nome_paciente') }}">
                                                    <div class="col-md-12">
                                                        @error('nome_paciente')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1">Data de nascimento</label>
                                                <div class="input-group @error('data') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">calendar_today</i>
                                                    </span>
                                                    <input type="date" class="form-control" id="data_nascimento" placeholder="Data de Nascimento..." name="data" value="{{ old('data') }}" required disabled>

                                                    <div class="col-md-12">
                                                        @error('data')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" onclick="desabilitar('sim')" id="check" name="paciente" > O hóspede é um acompanhante de um paciente da Santa Casa
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

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-category text-info" >
                                            Dados da reserva
                                        </h6>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1">Data de entrada</label>
                                                <div class="input-group @error('data_entrada') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">calendar_today</i>
                                                    </span>
                                                    <input type="date" class="form-control" placeholder="Data de entrada..." name="data_entrada" value="{{ old('data_entrada') }}" required>

                                                    <div class="col-md-12">
                                                        @error('data_entrada')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1">Data de saída</label>
                                                <div class="input-group @error('data_saida') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">calendar_today</i>
                                                    </span>
                                                    <input type="date" class="form-control" placeholder="Data de Nascimento..." name="data_saida" value="{{ old('data_saida') }}" required>

                                                    <div class="col-md-12">
                                                        @error('data_saida')
                                                        <span class="help-block">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group @error('especialidade') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">medical_services</i>
                                                </span>
                                                    <input type="text" class="form-control" placeholder="Especialidade..." name="especialidade" value="{{ old('especialidade') }}" required>
                                                    <div class="col-md-12">
                                                        @error('especialidade')
                                                        <span class="help-block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group @error('quant_hospedes') invalid-feedback @enderror" style="margin-bottom: 20px;">
                                                <span class="input-group-text">
                                                    <i class="material-icons">looks_one</i>
                                                </span>
                                                    <input type="number" class="form-control" placeholder="Quantidade de hóspedes envolvidos..." name="quant_hospedes" value="{{ old('quant_hospedes') }}" required>
                                                    <div class="col-md-12">
                                                        @error('quant_hospedes')
                                                        <span class="help-block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="acessibilidade"> Acessibilidade
                                                        <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="crianca"> Paciente é criança
                                                        <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="urgencia"> Urgência
                                                        <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 my-3">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Observação</label>
                                                    <textarea class="form-control" name="observacao" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-info">
                                    Solicitar
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
        function desabilitar(valor) {
            var status = document.getElementById('paciente').disabled;

            if (valor == 'sim' && !status) {
                document.getElementById('paciente').disabled = true;
            } else {
                document.getElementById('paciente').disabled = false;
            }
        }

        var oldPessoa = $('#pessoa-select').attr("value");
        $('#pessoa-select').selectize({
            placeholder: 'Digite o rg do hóspede...',
            onInitialize: function () {
                this.setValue(oldPessoa, true);
                //$('.selectize-control').addClass('form-group');
                $('.selectize-input').addClass('form-control');
            },
        });

        $('#pessoa-select').change(function(){
            var pessoa = document.getElementById('pessoa-select').value;
            var urlConsulta = '../reservas/dados-pessoa/'+pessoa;
            $.get(urlConsulta, function (res){
                document.getElementById("nome").setAttribute('value', res.nome);
                document.getElementById("pessoa-select").setAttribute('value', res.rg);
                document.getElementById("cidade").setAttribute('value', res.cidade);
                document.getElementById("telefone").setAttribute('value', res.telefone);
                document.getElementById("email").setAttribute('value', res.email)
                document.getElementById("data_nascimento").setAttribute('value', res.data_nascimento);
                if( res.nome_paciente != undefined){
                document.getElementById("paciente").setAttribute('value', "");
                }
                if(document.getElementById("paciente").value != ""){
                    document.getElementById("check").checked = true;
                }
            });
        });

    </script>
@endsection
