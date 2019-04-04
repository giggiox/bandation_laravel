<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">  <!--METTICI STA LINEA SENNO QUANDO COMPILI IL VUE con npm run dev TI DA ERRORE-->
        @yield('css')
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <style>
            @yield('styles')
        </style>

    </head>
    <body>
        @section('navbar')
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="{{route('/')}}">Bandation</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user/login')}}">log in </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user/register')}}">registrati</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{\Auth::user()->name}}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{url('user')}}"><i class="fas fa-user"></i> guarda profilo</a>

                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('user/logout')}}"><i class="fas fa-sign-out-alt"></i> log out</a>
                                    </div>
                                </li>
                            @endguest



                        </ul>
                    </div>
                </div>
            </nav><!-- navbar end -->
        @show


        @yield('content')




        <!-- Footer -->
        <footer class="py-5" style="background-color:#009afe">
            <div class="container">
                <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2018</p>
            </div>
            <!-- /.container -->
        </footer>

    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>



    <script type="text/javascript">
        @yield('scripts')
    </script>

    </body>
</html>
