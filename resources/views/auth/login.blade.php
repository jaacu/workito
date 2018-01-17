@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row mt-2">
      <div class="col-sm-12">
        <h3 class="text-center text-primary">Inicio de Sesión</h3>
    </div>
    <div class="col-sm-12">
        <form method="POST" action="{{ route('login') }}" class="">
            <div class="">
                {{ csrf_field() }}
                <div class=" form-row ">
                    <div class="col-sm-4 mx-auto"> 
                        <label for="email" class="">Correo Electronico</label>
                        <input id="email" type="email" class="form-control @if( $errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}" required autofocus>
                        @if ( $errors->has('email') )
                        <div class="invalid-feedback">
                            <strong> {{ $errors->first('email') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class=" form-row ">
                    <div class="col-sm-4 mx-auto"> 
                        <label for="password" class="">Contraseña</label>
                        <input id="password" type="password" class="form-control @if( $errors->has('password')) is-invalid @endif" name="password" value="{{ old('password') }}"  required>
                        @if ( $errors->has('password') )
                        <div class="invalid-feedback">
                            <strong> {{ $errors->first('password') }}</strong>
                        </div>
                        @endif
                    </div>
                </div> 

                <div class="form-row">
                    <div class="col-sm-4 mx-auto">
                        <div class="form-check">
                            <input class="form-check-input ml-1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember"> Recuerdame </label>                            
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-sm-4 mx-auto">
                        <button type="submit" class="btn btn-primary">
                            Entrar
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
