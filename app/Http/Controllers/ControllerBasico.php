<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelBasico;

class ControllerBasico extends Controller
{
    public function indexPadrao(String $recurso, ModelBasico $model, $dados, bool $com_resumo = false, string $titulo = '', string $msg = '', string $erro = '',
                                                $dados_filtro = null, $filtros = [], $filtro_str = '',
                                                $resumo = null)
    {
     
        if ($titulo == '')
        {
            $titulo = $dados->titulo_plural();    
        }        
        $encoding = mb_internal_encoding();
        $titulo_maiusculo = mb_strtoupper($titulo, $encoding);

        $rota = $recurso .'.index';
        
        $campos = $model->campos();
        $campos_titulos = $model->campos_titulos();


        return view($rota, ['com_resumo' => $com_resumo,
                            'recurso' => $recurso,
                            'titulo' => $titulo,
                            'titulo_maiusculo' => $titulo_maiusculo,
                            'model' => $model,                                
                            'campos' => $campos,
                            'campos_titulos' => $campos_titulos,
                            'dados' => $dados,
                            'msg' => $msg,
                            'erro' => $erro,
                            'dados_filtro' => $dados_filtro,
                            'filtros' => $filtros,
                            'filtro_str' => $filtro_str,
                            'resummo' => $resumo
                        ]);
    }

    public function createPadrao(String $recurso, ModelBasico $dados, string $titulo = '')
    {
        if ($titulo == '')
        {
            $titulo = 'Cadastrar ' .$dados->titulo();    
        }        
        $encoding = mb_internal_encoding();
        $titulo_maiusculo = mb_strtoupper($titulo, $encoding);

        
        $rota = $recurso.'.create';
        $recurso = $recurso.'.store';
      
        $model = $dados;
        $dados = $dados->all(); 

        return view($rota, ['com_resumo' => false,
                            'recurso' => $recurso, 
                            'titulo' => $titulo,
                            'titulo_maiusculo' => $titulo_maiusculo,
                            'model' => $model,                                
                            //'dados' => $dados
                        ]);
    }

    public function editPadrao(String $recurso, ModelBasico $entidade)
    {
        
       $titulo = 'Alterar ' . $entidade->titulo();    
       $rota = $recurso .'.create';
       $recurso = '';
       
          
        return view($rota, ['com_resumo' => false,
                            'titulo' => $titulo,
                            'recurso' => $recurso, 
                            'model' => $entidade, 
                            'dados' => $entidade
                        ]);
    }

}
