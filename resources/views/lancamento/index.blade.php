@extends('layouts.layout_basico_listagem')


@section('filtros')

<form method="POST" action="{{ route('lancamento.index') }}">
@csrf
<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="form-floating mb-3"> 
            <select class="form-control" name="filtro_conta_id" id="filtro_conta_id">
                <option value="-1">Selecione uma Conta...</option>    
                
                @foreach ($dados_filtro as $filtro)
                    <option value="{{ $filtro->id }}"
                        {{ ((isset($filtros['filtro_conta_id'])) && ($filtros['filtro_conta_id'] == $filtro->id)) ? 'selected' : '' }}>{{ $filtro->toString() }}</option>
                @endforeach
            </select>     
            <label for="filtro_conta_id">Conta</label>                                         
        </div>
    </div>

    <div class="col-xl-2 col-md-6">
        <div class="form-floating mb-3"> 
            <select class="form-control" name="filtro_tipo" id="filtro_tipo">
                <option value="X">Selecione o Tipo...</option>                    
                <option value="E" {{ (isset($filtros['filtro_tipo']) && ($filtros['filtro_tipo'] == "E")) ? 'selected' : '' }}>Entrada</option>
                <option value="S" {{ (isset($filtros['filtro_tipo']) && ($filtros['filtro_tipo'] == "S")) ? 'selected' : '' }}>Saída</option>                                                    
            </select>                                               
            <label for="filtro_tipo">Tipo do Lançamento</label>        
        </div>
    </div>
    <div class="col-xl-2 col-md-6">
        <div class="form-floating mb-3"> 
            <input class="form-control" type="date" id="filtro_data_inicial" name="filtro_data_inicial" 
                                        value="{{ isset($filtros['filtro_data_inicial']) ? $filtros['filtro_data_inicial'] : '' }}">                
            <label for="filtro_data_inicial">Data Inicial</label>                                     
        </div>
    </div>
    <div class="col-xl-2 col-md-6">
        <div class="form-floating mb-3"> 
            <input class="form-control" type="date" id="filtro_data_final" name="filtro_data_final" 
                                        value="{{ isset($filtros['filtro_data_final']) ? $filtros['filtro_data_final'] : '' }}">                
            <label for="filtro_data__final">Data Final</label>                                     
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="form-floating mb-3"> 
            <button class="btn btn-pesquisar btn-primary" id="pesquisar" type="submit"><i class="fas fa-search"></i></button>                        
        </div>
    </div>

</div>
</form>
@endsection

@section('foreachCampos')
    @foreach ($dados as $dado)
    <tr>                    
        <td>{{ $dado->conta()->toString() }}</td>                           
        <td>{{ $dado->tipoToString() }}</td>           
        <td>{{ $dado->dataToString() }}</td>           
        <td>{{ $dado->valorToString() }}</td>           
        <td>{{ $dado->descricao }}</td>           

        <td><a href="{{ route($recurso.'.edit', $dado->id) }}"><i class="fas fa-edit me-1"></i>Alterar</td></a>
        <td>
            <form action="{{  route($recurso.'.destroy', $dado->id) }}" method="POST" id="form_{{$dado->id}}">
                @csrf
                @method('DELETE');
                <a href="#" onclick="document.getElementById('form_{{$dado->id}}').submit()">
                        <i class="fas fa-trash-can me-1"></i>Excluir
                </a>
            </form>            
        </td>
    </tr>
    @endforeach

@endsection


