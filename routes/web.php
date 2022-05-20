<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TarefaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get("/usuario/cadastro",[UserController::class,'cadastrarUsuario'])->name("usuarios.addusuario");
Route::get("/usuario/fazerlogin",[UserController::class,'fazerLogin'])->name("usuarios.fazerlogin");
Route::post("/usuario/salvar",[UserController::class,'salvarUsuario'])->name("usuarios.salvar");
Route::post("/usuario/autenticar",[UserController::class,'autenticarUsuario'])->name("usuarios.login");
Route::get("/usuario/direcionar",[UserController::class,'direcionaDashboard'])->name("usuarios.direciona");
Route::get("/tarefa/dashboard/incluir",[TarefaController::class,'criarTarefa'])->name("tarefas.incluir");
Route::post("/tarefa/dashboard/salvar",[TarefaController::class,'salvarTarefa'])->name("tarefas.salvar");
Route::get("/tarefa/dashboard",[TarefaController::class,'tarefasDashboard'])->name("tarefas.dashboard");
Route::put("/tarefa/dashboard/alterar/{id}",[TarefaController::class,'alterarTarefa'])->name("tarefas.alterar");
Route::get("/usuario/logout",[UserController::class,'logout'])->name("usuarios.logout");
Route::post("/tarefa/reoordenar",[TarefaController::class,'alterarOrdem'])->name('tarefas.reoordenar');
Route::delete("/tarefa/excluir/{id}",[TarefaController::class,'destroy'])->name('tarefas.excluir');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
