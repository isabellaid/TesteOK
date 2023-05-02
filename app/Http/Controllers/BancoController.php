<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banco;
use App\Models\Conta;

use function PHPSTORM_META\elementType;

class BancoController extends ControllerBasico
{
    public function index(String $msg = '', String $erro = '')
    {
        $model = new Banco;
        $dados = Banco::orderBy('nome')->get();
        $recurso = 'banco';
        $titulo = 'Bancos';
        
        return $this->indexPadrao($recurso, $model, $dados, false, $titulo, $msg, $erro);
    }

    public function create()
    {
        $dados = new Banco;
        $recurso = 'banco';        
        
        return $this->createPadrao($recurso, $dados);
    }

    public function store(Request $request)
    {    

        $banco = new Banco();        
        $request->validate($banco->rules(), $banco->feedback());
        
        $banco->codigo = $request->get('codigo');
        $banco->nome = $request->get('nome');
        $banco->save();

        $msg = 'Banco cadastrado com sucesso: ' ;
        $msg .= $banco->toString();

        $recurso = 'banco';
        $titulo = 'BANCOS';
        
        $model = new Banco();
        $bancos = new Banco();
        $bancos = $banco::orderBy('codigo')->get();

        return $this->indexPadrao($recurso, $model, $bancos, false, $titulo, $msg);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $banco = Banco::find($id);
        if (!$banco)
        {
            $msg ='Banco não encontrado: ' . $id;
            return $this->index($msg);
        }
        $recurso = 'banco';
        return $this->editPadrao($recurso, $banco);

    }


    public function update(Request $request, $id)
    {

        $banco = Banco::find($request->id);
        if (isset($banco)) {
            $msg = 'Banco alterado com sucesso: ' ;
        } else {
            $msg = 'Banco não encontrado: ' ;
        }

        $request->validate($banco->rules(), $banco->feedback());
        
        $banco->codigo = $request->get('codigo');
        $banco->nome = $request->get('nome');
        $banco->save();

        $msg .= $banco->toString();
        $recurso = 'banco';
        $titulo = 'BANCOS';
        
        $model = new Banco();
        $bancos = new Banco();
        $bancos = $banco::orderBy('codigo')->get();

        return $this->indexPadrao($recurso, $model, $bancos, false, $titulo, $msg);
    }

    public function destroy($id)
    {
        $banco = Banco::find($id);        
        $msg = '';
        $erro = '';

        $contas = Conta::where('banco_id',$banco->id)->get();
        if ($contas->count() > 0) {
            $erro = 'Existem contas cadastradas para este banco. Não foi possível excluir: '. $banco->toString();
        } else {
            if ($banco) {
                $banco->delete();
                $msg = 'Banco excuído com sucesso: '. $banco->toString();
            } else {
                $erro = 'Banco não existe!';
            }
        
        }

        return $this->index($msg, $erro);        
    }
}
