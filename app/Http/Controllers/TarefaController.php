<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
use App\Models\Tarefa;
use Illuminate\Http\Request;

/*
    |--------------------------------------------------------------------------
    | Controller para a manipulação dos dados das tarefas
    |--------------------------------------------------------------------------
    |
    |este controller é responsável por direcionar o usuário ao dashboard, assim como para editar criar e excluir tarefas
    |
    */

class TarefaController extends Controller
{
    /*direciona o usuário a home*/
    public function tarefasDashboard(Request $request){
        $nome = Auth::user()->name;
        $email = Auth::user()->email;
        $senha = Auth::user()->password;
        $id = Auth::user()->id;

        $qt = Tarefa::where('usuario',$id)->count();
        /*as tarefas são listadas pela ordem de apresentação o campo ordem na tabela*/
        $tarefas = Tarefa::where('usuario',$id)->orderBy('ordem','asc')->get();
        if($qt==0){
            /*se a quantidade de tarefas do usuário for 0 é enviado 0 como status caso contrário 1*/
            $estatus = 0;
        }else{
            $estatus = 1;
        }
        return view("dashboard",['email'=>$email,'tarefas'=>$tarefas,'estatus'=>$estatus,'nome'=>$nome,'total'=>$qt]);
    }
    /*cria uma nova tarefa*/
    public function criarTarefa(){
        $nome = Auth::user()->name;
        $email = Auth::user()->email;
        $senha = Auth::user()->password;
        $id = Auth::user()->id;

        return view("incluir",['email'=>$email,'nome'=>$nome]);
    }
    /*salva a tarefa criada verificando a validade do email e da senha*/
    public function salvarTarefa(Request $request){
           $tarefa = new Tarefa();
           $valor = $request->custo;
           $tarefa->custo = $tarefa->formataCusto($valor);

           $tarefa->datalimite = $request->datalimite;
           $idusuario = Auth::user()->id;
           $tarefa->usuario = $idusuario;
           $tarefas = Tarefa::where('usuario',$idusuario)->count();
           if($tarefas==0){
              $tarefa->ordem = 1;
              $tarefa->nome = $request->nome;
           }else{
              $tarefa->ordem = $tarefas+1;
              $nome = $request->nome;
              $nomes = Tarefa::where('usuario',$idusuario)->where('nome',$nome)->count();
              if($nomes==0){
                 $tarefa->nome = $nome;
              }else{
                  return redirect()->back()->withInput()->withErrors("Já existe uma tarefa com esse nome");
              }
           }
           $tarefa->save();
           return redirect()->route('tarefas.dashboard'); 
    }
    /*altera os dados da tarefa*/
    public function alterarTarefa(Request $request,$id){
           $idUsuario = Auth::user()->id;
           $novonome = $request->nome;
           $novadata = $request->data;
           $dataisset = $request->dataisset;
           $novocusto = $request->custo;
           $tarefas = new Tarefa();
           if(!empty($novonome)){
                $nomesrepetidos = Tarefa::where('usuario',$idUsuario)->where('nome',$novonome)->count();
                //verifica se há nomes repetidos
                if($nomesrepetidos==0){
                     Tarefa::where('id',$id)->update(['nome' => $novonome]);
                }
                else{
                    return redirect()->back()->withInput()->withErrors("Já existe uma tarefa com esse nome");
                }
           }
           date_default_timezone_set('America/Sao_Paulo');
           //verifica se o campo data é vazio
           $temp = strtotime($novadata);
           if($temp!=false){
                Tarefa::where('id',$id)->update(['datalimite' => $novadata]);
           }
           if(!empty($novocusto)){
                $valorcusto = $tarefas->formataCusto($novocusto);
                Tarefa::where('id',$id)->update(['custo' => $valorcusto]);
           }
           return  redirect()->route('tarefas.dashboard');
    }
    /*altera a ordem de apresentação*/
    public function alterarOrdem(Request $request){
           $idUsuario = Auth::user()->id;
           $idatual = $request->idatual;
           $ordem = $request->ordem;
           $tarefa1 = Tarefa::find($idatual);
           $tarefa2 = Tarefa::where('usuario',$idUsuario)->where('ordem',$ordem)->first();
           Tarefa::where('id',$tarefa2->id)->update(['ordem' => $tarefa1->ordem]);
           Tarefa::where('id',$idatual)->update(['ordem' => $ordem]);
           return  redirect()->route('tarefas.dashboard');
    }
    /*apaga uma tarefa*/
    public function destroy($id){
           $idUsuario = Auth::user()->id;
           $totaldetarefas = Tarefa::where('usuario',$idUsuario)->count();
           $tarefa = Tarefa::find($id);
           if($tarefa->ordem==$totaldetarefas){
                //se a tarefa é a primeira na ordem ela é deletada
                Tarefa::findOrFail($id)->delete();
           }else{
                //caso contrário os elementos de ordem superior a tarefa a ser apagada são decrementados
                for($i=$tarefa->ordem+1;$i<=$totaldetarefas;$i++){
                    $tarefa2 = Tarefa::where('usuario',$idUsuario)->where('ordem',$i)->first();
                    $ordemNova = $tarefa2->ordem-1;
                    Tarefa::where('usuario',$idUsuario)->where('ordem',$i)->update(['ordem'=>$ordemNova]);
                }
                Tarefa::findOrFail($id)->delete();
           }
           return redirect()->route('tarefas.dashboard');
    }

}
