<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conta;


class Lancamento extends ModelBasico
{
    use HasFactory;

    protected $fillable = ['conta_id', 'tipo', 'data', 'valor', 'descricao'];

    public function rules() {
        return [
            'conta_id' => 'required',
            'tipo' => 'required|min:1|max:1',
            'data' => 'required',
            'valor' => 'required',
            'descricao' => 'required'
        ];
    }

    public function feedback() {
        return [
            'conta_id.required' => 'O campo conta é obrigatória', //mudar no arquivo genérico min max
            'data.required' => 'O campo data é obrigatória',
            'descricao.required' => 'O campo descrição é obrigatório',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres.',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres.',        
            'required' => 'O campo :attribute é obrigatório.'                     
        ];
    }

    public function conta() {
        //$this->belongsTo(Conta::class)->first();
        return $this->belongsTo(Conta::class,'conta_id','id')->first();
    }

    public function titulo() {
        return 'Lançamento bancário';
    }
    
    public function titulo_plural() {
        return 'Lançamentos bancários';
    }

    public function campos_titulos() {
        return ['Conta', 'Tipo', 'Data', 'Valor', 'Descrição'];
    }

    public function tipoToString() {
        switch ($this->tipo) {
            case 'E' : return 'Entrada';
                break;
            case 'S' : return 'Saída';
                break;        
        }            
    }

    public function dataToString() {        
       // dd($this->data);
       $data = implode('/', array_reverse(explode('-', $this->data)));
       return $data;
    }

    public function valorToString() {
        return number_format($this->valor, 2, ',', '.');
    }

    public function toString() {
        return $this->conta()->toString() .  ' - ' . $this->data . ' - ' . $this->tipoToString() . 
                    ' = R$ ' . $this->valorToString() .  ' [' . $this->descricao . ']';
    }
}
