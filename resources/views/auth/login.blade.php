@extends('layouts.app')
@section('content')
 @if ($errors->all())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger aviso-erro" role="alert">{{ __($error)}}</div>
            @endforeach
@endif
<div class="containernativo">
<div class="box">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="nativo"><img src="{{url('listarlogo.png')}}" class="logo"></div>
                <div class="">
                    <form method="POST" action="{{ route('usuarios.login') }}">
                        @csrf
                        <div class="form-group row">

                            <div class="col-md-12">
                                <p><input id="email" type="email" class="form-control entrada" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail"></p>

                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <p><input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Senha"></p>

                                <button type="submit" class="btn btn-info btn-block">
                                    {{ __('entrar') }}
                                </button>
                            </div>
                        </div>

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-12">
                                <div class="cadastro">
                                   <p>Não possui um cadastro?</p>
                                   <a href="{{route('usuarios.addusuario')}}"><input type="button" value="cadastre-se" class="btn btn-dark"></a>
                                 </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
