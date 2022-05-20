<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

/*
    |--------------------------------------------------------------------------
    | Controller para a manipulação dos dados do usuário
    |--------------------------------------------------------------------------
    |
    |este controller é responsável por direcionar o usuário as páginas de login, cadastro e logout 
    |
    */
class UserController extends Controller
{
    /*direciona a pagina de login*/
    public function fazerLogin(){
        return view("login");
    }
    /*verifica os dados informados eleva ao controler da dashboard*/
    public function direcionaDashboard(){
           if(Auth::check()===true){
                return redirect()->route("tarefas.dashboard");
           }
    }
    /*autentica os dados informados*/
    public function autenticarUsuario(Request $request){
          if(!filter_var($request->email,filter:FILTER_VALIDATE_EMAIL)){
              return redirect()->back()->withInput()->withErrors("E-mail informado não é válido");
          }
          $credentials = [
                 'email' => $request->email,
                 'password' => $request->password
          ];
          if(Auth::attempt($credentials)){
              return redirect()->route("usuarios.direciona");
          }
          return redirect()->back()->withInput()->withErrors(["E-mail ou senha incorreto"]);
    }
    /*realiza o logout*/
    public function logout(){
        Auth::logout();
        return redirect()->route("home");
    }
    /*direciona a pagina de cadastro*/
    public function cadastrarUsuario(){
        return view("cadastro");
    }
    /*verifica se o email não está sendo usado e se a senha tem mais de oito caracteres após todas as verificações o usuário é salvo*/
    public function salvarUsuario(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if (User::where('email', $user->email)->exists()) {
           return redirect()->back()->withInput()->withErrors(["O e-mail já está em uso"]);
        }
        else{
            if(strlen($request->password)>=8){
                  $user->save();
            }else{
                 return redirect()->back()->withInput()->withErrors(["A senha precisa de no mínimo 8 caracteres"]);
            }
        }
        return redirect()->route('home'); 
    
}
}
