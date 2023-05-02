<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lancamento;
use App\Models\Conta;

class ResumoController extends ControllerBasico
{
    
    public function index(String $msg = '', Request $request = null) {

        $titulo = 'RESUMO BANCÁRIO';

        $model = new Lancamento();
        $lancamentos = new Lancamento();        

        $recurso = 'lancamento';
        if ($titulo == '') {
            $titulo = 'Lançamentos';
        }
               
        $dados_filtro_contas = new Conta();
        $dados_filtro_contas = $dados_filtro_contas->orderBy('numero')->get();

        $lancamnentoController = new LancamentoController;

        if ($request) {
            $lancamentos = $lancamnentoController->montaFiltro($request, $lancamentos);
        }                        
        $lancamentos = $lancamentos->orderBy('data')->get();
        
        $resumo =  $lancamnentoController->calcularResumo($lancamentos);
        
        return $this->indexPadrao($recurso, $model, $lancamentos, true, $titulo, $msg, '', $dados_filtro_contas, $lancamnentoController->filtros, $lancamnentoController->filtro_str, $resumo);
    }
}
