<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;
    
    public function formataCusto($stringcusto){
           $valor=str_replace('.','j', $stringcusto);
           $valorformat=str_replace(',','.',$valor);
           $valorformat=str_replace('j','',$valorformat);
           $valorcusto = floatval($valorformat);
           return $valorcusto;
    }
}
