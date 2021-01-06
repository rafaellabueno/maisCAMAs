@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 40rem;">
                <img class="card-img-top" src="{{ asset('img/MadreAna.jpg') }}" rel="nofollow" alt="Casa de Apoio Madre Ana">
                <div class="card-body text-center">
                    <p class="card-text">Bem-vindo(a) a Ferramenta Digital para Gerenciamento da Casa de Apoio Madre Ana </p>
                    @if(Auth::guest())
                    <a class="btn btn-info btn-round" href="{{ route('login') }}">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
