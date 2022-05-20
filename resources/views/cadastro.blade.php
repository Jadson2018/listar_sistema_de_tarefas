@extends('layouts.app')

@section('content')
         @if($errors->all())
              @foreach($errors->all() as $error)
                 <div class="alert alert-danger aviso-erro" role="alert">{{__($error)}}</div>
              @endforeach
         @endif
          <div class="containernativo">    
          <div class="box">
          <h1 class="font-padrao">Cadastro</h1>
          <form action="{{route('usuarios.salvar')}}" method="POST" class="formulario-login">
            @csrf
              <p><input type="text" placeholder="nome" name="name" class="form-control"></p>
              <p><input placeholder="E-mail" type="email" name="email" class="form-control" value="{{ old('email') }}"></p>
              <p><input placeholder="Senha" type="password" name="password" class="form-control"><p>
              <input type="submit" value="cadastrar" class="btn btn-info btn-block">
            </form>
            </div>
           </div>
@endsection 