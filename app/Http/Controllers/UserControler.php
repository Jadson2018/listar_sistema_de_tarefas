<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function fazerLogin(){
        return view("login");
    }
    public function cadastrarUsuario(){
        return view("addUsuario");
    }
    public function salvarUsuario(Request $request){
        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = $request->senha;
        $user->save();  
    }
}
