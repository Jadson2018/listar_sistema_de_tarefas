<!DOCTYPE HTML>
<!--
  Prologue by HTML5 UP
  html5up.net | @ajlkn
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
  <head>
    <title>listar</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{url('assets/css/main.css')}}" />
    <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{url('listarlogoreduzida.png')}}" type="image/x-jpg"/>
    <link href="{{url('incluir.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{url('listarlogoreduzida(3).png')}}" type="image/x-jpg"/>
  </head>
  <body>
<!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('tarefas.dashboard')}}">listar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse float-right" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        
      </li>
    </ul>
    <p class="litle">logado como</p>
    {{$nome}}
    <a class="nav-link float-right" href="{{route('usuarios.logout')}}">sair</a>
  </div>
</nav>
    <style>
        .botao-azul{
           background:#6edbdb;
           height:40px;
           width:180px;
           border:none;
           border-radius:1%;
         }
         .botao-azul:hover{
           background:black;
         }
         .litle{
              font-size: 10px;
         }
    </style>
    <!-- Main -->
      <div id="main">
        <!-- Intro -->
          <section>
            <div class="container">
               @if ($errors->all())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger aviso-erro" role="alert">{{ __($error)}}</div>
                    @endforeach
               @endif
                  <form method="POST" action="{{route('tarefas.salvar') }}" class="form-group">
                    @csrf
                      <label for="nomedatarefa">Nome da tarefa</label>
                      <input type="text" placeholder="Nome da tarefa" id="nomedatarefa" name="nome" class="form-control col-sm-4">
                      <label for="valor">Custo</label>
                      <input type="text" placeholder="0,00" name="custo" class="form-control col-sm-4" maxlenght="9" id="valor" onkeyup="formatarMoeda()">
                      <label for="data">Data limite</label>
                      <input type="date" placeholder="Data limite" id="data" name="datalimite" class="form-control col-sm-4">
                      <button type="submit" class="botao-azul">incluir</button>
                      </div>
                      </div>
                  </form>
            </div>
          </section>

      </div>
    <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrolly.min.js"></script>
      <script src="assets/js/jquery.scrollex.min.js"></script>
      <script src="assets/js/browser.min.js"></script>
      <script src="assets/js/breakpoints.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script>
      function formatarMoeda() {
        var elemento = document.getElementById('valor');
        var valor = elemento.value;

        valor = valor + '';
        valor = parseInt(valor.replace(/[\D]+/g, ''));
        valor = valor + '';
        valor = valor.replace(/([0-9]{2})$/g, ",$1");

        if (valor.length > 6) {
            valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }

        elemento.value = valor;
        if(valor == 'NaN') elemento.value = '';
    }
</script>
  </body>
</html>