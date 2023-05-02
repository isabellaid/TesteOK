<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lancamento;
use App\Models\Conta;

class LancamentoController extends ControllerBasico
{
    public $filtro_str = '';
    public $filtros = [];   

    public function index(String $msg = '', Request $request = null)
    {
        $model = new Lancamento();
        $lancamentos = new Lancamento();        

        $recurso = 'lancamento';
        $titulo = 'Lançamentos';
        
        $dados_filtro_contas = new Conta();
        $dados_filtro_contas = $dados_filtro_contas->orderBy('numero')->get();
        
        if ($request) {
            $lancamentos = $this->montaFiltro($request, $lancamentos);
        }
        $lancamentos = $lancamentos->orderBy('data')->get();

        return $this->indexPadrao($recurso, $model, $lancamentos, false, $titulo, $msg, '', $dados_filtro_contas, $this->filtros, $this->filtro_str);
    }

    public function create()
    {
        $dados = new Lancamento();
        $recurso = 'lancamento';        
        $contas = Conta::orderBy('numero')->get();

        $titulo = 'Cadastrar ' .$dados->titulo();    

        $rota = $recurso.'.create';
        $recurso = $recurso.'.store';

        return view($rota, ['com_resumo' => false,
                            'recurso' => $recurso, 
                            'titulo' => $titulo,
                            'contas' => $contas,
                        //    'dados' => $dados
                        ]);

    }

    public function store(Request $request)
    {

        if (isset($request->filtro_conta_id)) {
            return $this->pesquisar($request);
        }
        
        $lancamento = new Lancamento();        
        $request->validate($lancamento->rules(), $lancamento->feedback());
       
        if (isset($request->id)) {
            $lancamento = Lancamento::find($request->id);            
            $msg = 'Lançamento alterado com sucesso: ' ;
        } else {
            $lancamento = new Lancamento();        
            $msg = 'Lançamento cadastrado com sucesso: ' ;
        }

        $lancamento->conta_id = $request->get('conta_id');
        $lancamento->tipo = $request->get('tipo');
        $lancamento->data = $request->get('data');
        
        $str = $request->get('valor');
        $str = str_replace('.', '', $str); 
        $str = str_replace(',', '.', $str); 
        $lancamento->valor = $str;
        $lancamento->descricao = $request->get('descricao');        

        $conta = Conta::find($lancamento->conta_id);
        if ( $this->verificaSaldoIndisponivel($lancamento)) {
            $contas = new Conta;
            $contas = $contas->orderBy('numero')->get();
            
            $msg = ' SALDO INDISPONÍVEL!   Saldo atual = R$ ' . $conta->saldoToString();
            return view('lancamento.create', ['com_resumo' => false,
                            'titulo' => 'Lançamento',
                            'recurso' => 'lancamento',
                            'contas' =>$contas, 
                            'model' => $lancamento,
                            'msg' => $msg]);

        }

        //to-do: transação
        $this->atualizaSaldoConta($lancamento);
        $lancamento->save();        
     
        $msg .= $lancamento->toString();
        $recurso = 'lancamento';
        $titulo = 'Lançamentos Bancários';

        $dados_filtro = new Conta();
        $dados_filtro = $dados_filtro->orderBy('numero')->get();
        
        $model = new Lancamento();
        $lancamentos = new Lancamento();
        $lancamentos = $lancamentos::orderBy('data')->get();

        return $this->indexPadrao($recurso, $model, $lancamentos, false, $titulo, $msg, '', $dados_filtro);

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $lancamento = Lancamento::find($id);
        $lancamento->valor = number_format($lancamento->valor, 2, ',', '.');
        if (!$lancamento)
        {
            $msg ='Lançamento não encontrado: ' . $id;
            return $this->index($msg);
        }
        
                
        $recurso = 'lancamento';        
        $contas = Conta::orderBy('numero')->get();

        $titulo = 'Alterar ' .$lancamento->titulo();    
                
                $rota = $recurso.'.create';
        $recurso = $recurso.'.store';
      
        return view($rota, ['com_resumo' => false,
                            'recurso' => $recurso, 
                            'titulo' => $titulo,
                            'contas' => $contas,
                            'model' => $lancamento]);


    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $lancamento = Lancamento::find($id);        
        if ($lancamento) {
            $msg = 'Lançamento excuído com sucesso: '. $lancamento->toString(); ;
        } else {
            $msg = 'Lançamento não existe!';
        }
        $del = $lancamento->delete();
        if (!$del) {
            $msg = 'Erro! Não foi possível excluir: '. $lancamento->toString();;
        }
        return $this->index($msg);        
    }

    public function pesquisar(Request $request) {        
        return $this->index('',$request);
    }

    public function montaFiltro(Request $request, Lancamento $lancamentos) {

        if (($request->filtro_conta_id) && ($request->filtro_conta_id > -1)) {
            $lancamentos = $lancamentos->where('conta_id', $request->filtro_conta_id);
            $conta = Conta::find($request->filtro_conta_id);
            $this->filtro_str .= 'Conta: ' . $conta->toString();
            $this->filtros['filtro_conta_id'] = $request->filtro_conta_id;
        }

        if (($request->filtro_tipo) && ($request->filtro_tipo != 'X')) {
            $lancamentos = $lancamentos->where('tipo', $request->filtro_tipo);
            $this->filtro_str .= ($this->filtro_str != '') ? ' - ' : '';
            $this->filtro_str .= $request->filtro_tipo == 'E' ? 'Tipo: Entrada' : 'Tipo: Saída';
            $this->filtros['filtro_tipo'] = $request->filtro_tipo;
        }

        if ($request->filtro_data_inicial) {
            
            $this->filtros['filtro_data_inicial'] = $request->filtro_data_inicial;
            $data_ini = $request->filtro_data_inicial;
            $data_ini = str_replace('.', '', $data_ini); 
            $data_ini = str_replace(',', '.', $data_ini); 

            $lancamentos = $lancamentos->where('data', '>=',  $data_ini);
            $this->filtro_str .= ($this->filtro_str != '') ? ' - ' : '';
            $this->filtro_str .= 'Data inicial: ' . implode('/', array_reverse(explode('-', $request->filtro_data_inicial)));
            
        }

        if ($request->filtro_data_final) {
            
            $this->filtros['filtro_data_final'] = $request->filtro_data_final;
            $data_fim = $request->filtro_data_final;
            $data_fim = str_replace('.', '', $data_fim); 
            $data_fim = str_replace(',', '.', $data_fim); 

            $lancamentos = $lancamentos->where('data', '<=',  $data_fim);
            $this->filtro_str .= ($this->filtro_str != '') ? ' - ' : '';
            $this->filtro_str .= 'Data final: ' . implode('/', array_reverse(explode('-', $request->filtro_data_final)));
            
        }
               
        return $lancamentos;
    }

    public function calcularResumo($lancamentos) {

        $resumo = [];
        
       $resumo['qtde_total'] = $lancamentos->count();

        $lancamentosR = Lancamento::where('tipo','E')->get();
        $resumo['qtde_entradas'] = $lancamentosR->count();
        $resumo['valor_entradas'] = $lancamentosR->sum('valor');
        

        $lancamentosR = Lancamento::where('tipo','S')->get();
        $resumo['qtde_saidas'] = $lancamentosR->count();
        $resumo['valor_saidas'] = $lancamentosR->sum('valor');

        $resumo['valor_final'] = $resumo['valor_entradas'] - $resumo['valor_saidas'];
        
        return $resumo;

    }

    public function verificaSaldoIndisponivel(Lancamento $lancamento) {
                        
        $conta = $this->atualizaSaldoEdicao($lancamento);            
        
        if (($lancamento->id != null)  &&  ($lancamento->tipo == 'E')) {
            return $lancamento->valor + $conta->saldo < 0;            
        } else {
            if ($lancamento->valor > $conta->saldo) {
                return true;
            }
        }
        return false;
    }

    public function atualizaSaldoConta(Lancamento $lancamento) {
            
        $conta = $this->atualizaSaldoEdicao($lancamento);

        if ($lancamento->tipo == 'E') {
            $conta->saldo += $lancamento->valor;
        } else {
            $conta->saldo -= $lancamento->valor;            
        }

        $conta->save();
    }

    public function atualizaSaldoEdicao(Lancamento $lancamento) {

        if ($lancamento->id != null) {
                        
            $conta = Conta::find($lancamento->conta_id);
            $lancamentoBD = Lancamento::find($lancamento->id);
            if ($lancamento->tipo == 'E') {
                $conta->saldo -= $lancamentoBD->valor;
            } else {
                $conta->saldo += $lancamentoBD->valor;
            }
        } else {
            $conta = Conta::find($lancamento->conta_id);
        }

        return $conta;                
    } 

}
