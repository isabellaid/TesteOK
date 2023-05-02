<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Banco;

class Conta extends ModelBasico
{
    use HasFactory;
    
    protected $fillable = ['banco_id', 'tipo', 'numero', 'saldo'];

    public function rules() {
        return [
            'banco_id' => 'required',
            'tipo' => 'required|min:1|max:1',
            'numero' => 'required|min:3|max:10',
            'saldo' => 'required'
        ];
    }

    public function feedback() {
        return [
            'banco_id.required' => 'O campo banco é obrigatório', //mudar no arquivo genérico min max
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres.',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres.'                     

        ];
    }

    public function banco() {
        return $this->belongsTo(Banco::class,'banco_id','id')->first();
    }

    public function lancamentos() {
        return $this->hasMany(Lancamento::class,'conta_id','id')->get();
    }

    public function titulo() {
        return 'Conta Bancária';
    }
    
    public function campos_titulos() {
        return ['Banco', 'Tipo', 'Número', 'Saldo'];
    }
    
    public function tipoToString() {
        switch ($this->tipo) {
            case 'C' : return 'Conta Corrente';
                break;
            case 'P' : return 'Conta Poupança';
                break;
            case 'S' : return 'Conta Salário';
                break;        
        }            
    }

    public function saldoToString() {
        return number_format($this->saldo, 2, ',', '.');
    }

    public function toString() {
        return $this->numero . ' - [' . $this->banco()->nome . ']';
    }
}
