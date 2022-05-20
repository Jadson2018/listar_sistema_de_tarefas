<!Doctype html>
	<html lenguage="pt-br">
         <head>
         	<meta charset="UTF-8">
          <link href="{{url('login.css')}}" rel="stylesheet"/ type="text/css">
          <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet">
         
         </head>
         <body>
          <div class="containernativo">    
          <div class="box">
          <img src="{{url('listarlogo.png')}}" class="logo">
          <form action="{{route('usuarios.autenticar')}}" method="post" class="formulario-login">
            @csrf
              <p><input placeholder="E-mail" type="email" name="email" class="entrada"></p>
              <p><input placeholder="Senha" type="password" name="senha" class="entrada"><p>
              <input type="submit" value="entrar" class="botao-azul">
            </form>
            <div class="cadastro">
            <p>Não possui um cadastro?</p>
            <a href="{{route('usuarios.addusuario')}}"><input type="button" value="cadastre-se" class="botao-preto"></a>
            </div>
            </div>
           </div>
         </body>
</html>