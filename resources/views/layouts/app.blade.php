<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME','Workito')}}</title>
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ mix('css/app.css' ) }}" rel="stylesheet">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

    {{-- <link href="{{ mix('css/all.css') }}" rel="stylesheet"> --}}
    {{-- <script src="{{ mix('js/all.js') }}"></script> --}}
</head>
<body>
    <div id="app" class="container">
        <nav class="navbar navbar-toggleable-md sticky-top">
            <a class=" navbar-brand mb-0 h1" @if(Auth::guest() ) href="{{ route('inicio') }}" @else href="{{ route('home') }}" @endif> {{env('APP_NAME','Workito')}}</a>
            @if (Auth::guest())        
            <a class="  h4 nav-item nav-link" href="{{ route('login') }}">Inicar Sesión</a>
            <a class=" h4 nav-item nav-link" href="{{ route('register') }}">Registrarse</a>
            @else
            <button class="btn btn-outline-dark navbar-toggler navbar-toggler-right text-capitalize" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                {{ Auth::user()->name }} <span class="caret"></span>
            </button>
            <div class="collapse navbar-collapse text-center bg-light" id="navbarSupportedContent" style="">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <div>
                            <a class="dropdown-item" href="/user/perfil">Mi perfil</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            @lang('Logout')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                @if( Auth::user()->isAdmin() or Auth::user()->isDeveloper() )
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Notificaciones <span class="caret"></span>
                    </a>
                    <notifications :user="{{ Auth::user()->id }}"></notifications>
                </li>
                @endif
            </ul>
            @endif
        </div>
    </nav>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif 
    @yield('content')
    <br> <br> <br>


</div>
{{-- <script> 
    alert('pene')
</script> --}}
<script src="{{ mix('js/app.js') }}"></script>
{{-- {{dd(App\Http\Controllers\DeveloperController::devsScript())}} --}}
@includeWhen( App\Http\Controllers\DeveloperController::devsScript() , 'dev.script' )
</body>
</html>
