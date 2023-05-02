<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Conta;

class Banco extends ModelBasico
{
    use HasFactory;

    protected $fillable = ['codigo', 'nome'];

    public function rules() {
        //dd($this->id);
        return [            
            'codigo' => 'required|max:3|unique:bancos,codigo,'.$this->id.'|min:3',
            'nome' => 'required|min:2|max:60'
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório', //mudar no arquivo genérico min max
            'codigo.unique' => 'Código já existe',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres.',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres.'                     
        ];
    }

    public function contas() {        
        return $this->hasMany(Conta::class,'id','conta_id')->get();
    }


    public function titulo() {
        return 'Banco';
    }

    public function campos_titulos() {
        return ['Código', 'Nome'];
    }

    public function campos() {
        return ['codigo', 'nome'];
    }

    public function toString() {
        return $this->codigo . ' - [' . $this->nome . ']';
    }

}
