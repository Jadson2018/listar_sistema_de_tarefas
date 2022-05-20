<!DOCTYPE HTML>
<html>
  <head>
    <title>listar</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{url('assets/css/main.css')}}" />
    <!--botstrapp-->
    <link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{url('listarlogoreduzida(3).png')}}" type="image/x-jpg"/>

  </head>
  <body class="" id="pageContent">
    <!-- estilos -->
      <style>
           .containernativo{
               display: flex;
               flex-direction: row;
               justify-content: center;
               align-items: center
           }
           .box {
              width: 300px;
              height: 300px;
              background: #fff;
           }
           .botao-azul-sm{
               background: #6edbdb;
               border: none;
               color: white;
               margin-left: 80px;
               width: 100px;
           }
           .botao-azul-sm:hover{
               background: black;
           }
           .botao-azul-md{
               background: #6edbdb;
               border: none;
               color: white;
               margin-left: 80px;
               width: 100px;
           }
           .modal-backdrop.in{
               filter:alpha(opacity=50);
               opacity:.5
            }
            .pos-esquerda{
              float: left;
            }
            .pos-direita{
              float: right;
           }
           .bgpadrao-azul{
              background:#6edbdb;
           }
           .painel{
               color: white;
           }
           .boxdrop{
               
           }
           .oculto{
               display: none;
           }
           .litle{
              font-size: 10px;
           }
      </style>
    <!-- barra de navegação -->
<div>
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

        <!-- Corpo da pagina -->
        <section id="" class="">
            <div class="container" id="">
              @if($errors->all())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger aviso-erro" role="alert">{{ __($error)}}</div>
                    @endforeach
              @endif
              @if($estatus==1)
                  @foreach($tarefas as $tarefa)
                            <div>
                              <table>
                                <tr>
                                  <th></th>
                                  <th>Data limite</th>
                                  <th>Nome</th>
                                  <th>Custo</th>
                                  <th></th>
                                </tr>
                        @if($tarefa->custo<1000)
                                <tr class="bg-light">
                        @else
                                <tr class="bg-warning">
                        @endif  
                                <td>
                                @if($tarefa->ordem>1)
                                  <button class="btn" onclick="atualizarOrdemUp({{$tarefa->id}},{{$tarefa->ordem}})"><span class="icon solid fa-chevron-up"></span></button>
                                @endif
                                @if($tarefa->ordem<$total)
                                  <button class="btn" onclick="atualizarOrdemDown({{$tarefa->id}},{{$tarefa->ordem}})"><span class="icon solid fa-chevron-down"></span></button>
                                @endif
                                </td>
                                     <td>{{date('d/m/Y',strtotime($tarefa->datalimite))}}</td> 
                                     <td>{{$tarefa->nome}}</td>
                                     <td>{{$tarefa->custo}} R$</td>
                                <td><button data-toggle="modal" data-target="#formModal2{{$tarefa->id}}" class="btn btn-info"><span class="icon solid fa-edit"></span></button><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal2{{$tarefa->id}}"><span class="icon solid fa-trash"></span></button></td>
                                </tr>
                              </table>
                             <div>
                             <form method="POST" action="{{route('tarefas.reoordenar')}}" id="formularioordem{{$tarefa->id}}" enctype="multipart/form-data">
                             @csrf
                             <input type="hidden" name="idatual" id="campoid{{$tarefa->id}}" value="">
                             <input type="hidden" name="ordem" id="campoordem{{$tarefa->id}}" value="">
                             <inpt type="submit" class="oculto">
                             </form>
                            </div>
  
                            <!--Modal-->
                            <div class="modal" id="formModal2{{$tarefa->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class='modal-dialog' role="document">
                                     <div class="modal-content">
                                     <div class="modal-header">
                                         <div class="modal-title">Alterar informações</div>
                                         <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-hidden="true"><span>&times;</button>
                                         </div>
                                  <div class="modal-body">
                                  <form class="form-group" method="POST" action="{{url('/tarefa/dashboard/alterar/'.$tarefa->id)}}" enctype="multipart/form-data">
                                     @csrf
                                     @method('PUT')
                                     <p>Nome<input type="text" placeholder="Nome da tarefa" name="nome" class="form-control"></p>
                                     <p>Custo
                                     <input type="text" placeholder="0,00" name="custo" class="form-control" maxlenght="9" id="valor2{{$tarefa->id}}" onkeyup="formatarMoeda({{$tarefa->id}})"></p>
                                     <div class="form-inline">
                                    <span>Data limite<input type="date" placeholder="Data limite" class="form-control" name="data"></span>
                                    </div>
                                    <button type="submit" class="btn btn-info">Alterar</button>
                                </form>
                                </div>
                             <div class="modal-footer">
                 
                             </div>
                           </div>
                           </div>
                          </div>
                          <div class="modal" id="confirmModal2{{$tarefa->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class='modal-dialog' role="document">
                                     <div class="modal-content">
                                     <div class="modal-header bg-danger text-white">
                                         <div class="modal-title">Excluir tarefa</div>
                                         <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-hidden="true"><span>&times;</button>
                                         </div>
                                  <div class="modal-body">
                                        <p>Tem certeza que deseja excluír a tarefa?</p>
                                        <div class="btn-group">
                                        <button type="button" class="bg-success" data-dismiss="modal">não</button>
                                        <form method="POST" action="/tarefa/excluir/{{$tarefa->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-danger">sim</button>
                                        </form>
                                       </div>
                                </div>
                           </div>
                           </div>
                          </div>
                  @endforeach
              @else
                  <h1>Ainda não há tarefas</h1>
              @endif
              <a href="{{route('tarefas.incluir')}}"><button class="botao-azul-sm pos-direita"><span class="icon solid fa-plus"></span></button></a>
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
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function formatarMoeda(id) {
        var elemento = document.getElementById('valor'+id);
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

    function atualizarOrdemUp(id,ordem){
            var elemento1 = document.getElementById('formularioordem'+id)
            var campoid = document.getElementById('campoid'+id)
            var campoordem = document.getElementById('campoordem'+id)
            campoid.value = id
            campoordem.value = ordem-1
            elemento1.submit()
    }
     function atualizarOrdemDown(id,ordem){
            var elemento1 = document.getElementById('formularioordem'+id)
            var campoid = document.getElementById('campoid'+id)
            var campoordem = document.getElementById('campoordem'+id)
            campoid.value = id
            campoordem.value = ordem+1
            elemento1.submit()
            
    }
    </script>
  </body>
</html>