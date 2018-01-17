{{ csrf_field() }}
<div class=" form-row ">
    <div class="col-sm-6 mx-auto"> 
        <label for="name" class="">Nombre</label>
        <input id="name" type="name" class="form-control @if( $errors->has('name')) is-invalid @endif" name="name" value="{{ old('name') }}" required autofocus>
        @if ( $errors->has('name') )
        <div class="invalid-feedback">
            <strong> {{ $errors->first('name') }}</strong>
        </div>
        @endif
    </div>
</div>

<div class=" form-row ">
    <div class="col-sm-6 mx-auto"> 
        <label for="email" class="">Correo Electronico</label>
        <input id="email" type="email" class="form-control @if( $errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}"  required>
        @if ( $errors->has('email') )
        <div class="invalid-feedback">
            <strong> {{ $errors->first('email') }}</strong>
        </div>
        @endif
    </div>
</div>

<div class=" form-row ">
    <div class="col-sm-6 mx-auto"> 
        <label for="NIF" class="">NIF</label>
        <input id="NIF" type="NIF" class="form-control @if( $errors->has('NIF')) is-invalid @endif" name="NIF" value="{{ old('NIF') }}"  required>
        @if ( $errors->has('NIF') )
        <div class="invalid-feedback">
            <strong> {{ $errors->first('NIF') }}</strong>
        </div>
        @endif
    </div>
</div>

<div class=" form-row ">
    <div class="col-sm-6 mx-auto"> 
        <label for="contacto" class="">Contacto</label>
        <input id="contacto" type="contacto" class="form-control @if( $errors->has('contacto')) is-invalid @endif" name="contacto" value="{{ old('contacto') }}"  required>
        @if ( $errors->has('contacto') )
        <div class="invalid-feedback">
            <strong> {{ $errors->first('contacto') }}</strong>
        </div>
        @endif
    </div>
</div>

<div class=" form-row ">
    <div class="col-sm-6 mx-auto"> 
        <label for="cuentaSkype" class="">Cuenta de Skype</label>
        <input id="cuentaSkype" type="cuentaSkype" class="form-control @if( $errors->has('cuentaSkype')) is-invalid @endif" name="cuentaSkype" value="{{ old('cuentaSkype') }}"  required>
        @if ( $errors->has('cuentaSkype') )
        <div class="invalid-feedback">
            <strong> {{ $errors->first('cuentaSkype') }}</strong>
        </div>
        @endif
    </div>
</div>
