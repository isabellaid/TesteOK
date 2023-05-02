<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conta;
use App\Models\Banco;

class ContaController extends ControllerBasico
{
    public function index(String $msg = '', String $erro = '')
    {
        $model = new Conta;
        $dados = Conta::orderBy('numero')->get();
        $recurso = 'conta';
        $titulo = 'Contas Bancárias';
        
        return $this->indexPadrao($recurso, $model, $dados, false, $titulo, $msg, $erro);
    }

    public function create()
    {
        $dados = new Conta;
        $recurso = 'conta';        
        $bancos = Banco::orderBy('nome')->get();

        $titulo = 'Cadastrar ' .$dados->titulo();    
                
        //$encoding = mb_internal_encoding();
        //$titulo_maiusculo = mb_strtoupper($titulo, $encoding);
        
        $rota = $recurso.'.create';
        $recurso = $recurso.'.store';
      
        return view($rota, ['com_resumo' => false,
                            'recurso' => $recurso, 
                            'titulo' => $titulo,
                            //'titulo_maiusculo' => $titulo_maiusculo,
                            //'model' => $dados,                                
                            'bancos' => $bancos,
                            'dados' => $dados]);

    }

    public function store(Request $request)
    {    
        if (isset($request->id)) {
            $conta = Conta::find($request->id);
            $msg = 'Conta alterada com sucesso: ' ;
        } else {
            $conta = new Conta();        
            $msg = 'Conta cadastrada com sucesso: ' ;
        }

        $request->validate($conta->rules(), $conta->feedback());

        $conta->banco_id = $request->get('banco_id');
        $conta->tipo = $request->get('tipo');
        $conta->numero = $request->get('numero');
        $str = $request->get('saldo');
        $str = str_replace('.', '', $str); 
        $str = str_replace(',', '.', $str); 
        $conta->saldo = $str;
        
        $conta->save();

        $msg .= $conta->toString();
        $recurso = 'conta';    
        
        $model = new Conta();
        $contas = new Conta();
        $contas = $contas::orderBy('numero')->get();

        $titulo = 'Contas Bancárias';
        
        return $this->indexPadrao($recurso, $model, $contas, false, $titulo, $msg);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $conta = Conta::find($id);
        $conta->saldo = number_format($conta->saldo, 2, ',', '.');
        if (!$conta)
        {
            $msg ='Conta não encontrada: ' . $id;
            return $this->index($msg);
        }
        
                
        $recurso = 'conta';        
        $bancos = Banco::orderBy('nome')->get();

        $titulo = 'Alterar ' .$conta->titulo();    
                
        
        $rota = $recurso.'.create';
        $recurso = $recurso.'.store';
      
        return view($rota, ['com_resumo' => false,
                            'recurso' => $recurso, 
                            'titulo' => $titulo,                      
                            'bancos' => $bancos,
                            'model' => $conta]);


    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $conta = Conta::find($id);        
        $msg = '';
        $erro = '';

        if ($conta->lancamentos()->count() > 0) {
            $erro = 'Existem lançamentos cadastrados para esta conta. Não foi possível excluir: '. $conta->toString();
        } else {
            if ($conta) {
                $conta->delete();
                $msg = 'Conta excuída com sucesso: '. $conta->toString();
            } else {
                $erro = 'Conta não existe!';
            }
        
        }

        return $this->index($msg, $erro);      

    }
}
