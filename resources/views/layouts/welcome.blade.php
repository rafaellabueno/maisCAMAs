<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>+CAMAs</title>
        <link rel="icon" href="{{ asset('img/logo.png') }}" sizes="32x32" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/material-dashboard.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/material-dashboard-rtl.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/selectize.css') }}" rel="stylesheet">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-info">
        @if (Route::has('login'))
            <div class="container">
                <a href="{{ route('inicio') }}" style="right: 30px;">
                    <img href="{{ url('/') }}" src="{{ asset('img/logo.png') }}" width="60" alt="+CAMAs">
                </a>

                @auth
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNavDropdown">
                        <span class="material-icons" style="color: white;">list</span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: #fff; position: absolute; height: 120%; width: 100%; margin-top: -7.5%;">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <p style="margin-left: 1.75rem; margin-top: 0.25rem;">Sair</p>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                @else
                    @if (Route::current()->getName() != 'login')
                        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNavDropdown">
                            <span class="material-icons" style="color: white;">list</span>
                        </button>

                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

        @yield('content')
        <!--   Core JS Files   -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
        <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('js/material-dashboard.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/arrive.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
        <script src="{{ asset('js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="{{ asset('js/nouislider.min.js') }}" type="text/javascript"></script>
        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
        <script src="{{ asset('js/bootstrap-selectpicker.js') }}"></script>
        <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
        <script src="{{ asset('js/chartist.min.js') }}"></script>
        <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.bootstrap-wizard.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/jquery.tagsinput.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/jquery-jvectormap.js') }}"></script>
        <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.js') }}"></script>


        @yield('js')
    </body>
</html>
