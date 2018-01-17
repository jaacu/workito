@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 my-3">
            <h4 class="text-capitalize text-center text-dark">Restablecer Contraseña</h4>
        </div>
        <div class="col-sm-12">
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-row">
                    <div class="col-sm-5 text-center mx-auto"> 
                        <label for="email" class="">Correo Electronico:</label>
                        <input id="email" type="email" class="form-control @if( $errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}" required autofocus>
                        @foreach($errors->get('email') as $error)
                        <div class="invalid-feedback">
                            <strong> {{ $error }}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5 text-center mx-auto"> 
                        <label for="password" class="">Contraseña:</label>
                        <input id="password" type="password" class="form-control @if( $errors->has('password')) is-invalid @endif" name="password" required>
                        @foreach($errors->get('password') as $error)
                        <div class="invalid-feedback">
                            <strong> {{ $error }}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5 text-center mx-auto"> 
                        <label for="password-confirm" class="">Confirmar Contraseña:</label>
                        <input id="password-confirm" type="password" class="form-control @if( $errors->has('password_confirmation')) is-invalid @endif" name="password_confirmation" required>
                        @foreach($errors->get('password_confirmation') as $error)
                        <div class="invalid-feedback">
                            <strong> {{ $error }}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-md-5 mx-auto">
                        <button type="submit" class="btn btn-primary">
                            Restablecer Contraseña
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
