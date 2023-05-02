@extends('layouts.layout_basico_cadastro')


@section('conteudo_form')
        <form method="POST" action="{{ route('lancamento.store') }}">                                     
         @csrf
            <input class="form-control" type="hidden" name="id" id="id" value="{{ isset($model->id) ? $model->id : old('id') }}">
            <div class="form-floating mb-3"> 
                <select class="form-control" name="conta_id" id="conta_id">
                    <option value="">Selecione uma Conta...</option>    
                    @foreach ($contas as $conta)
                        <option value="{{ $conta->id }}"
                            {{ (isset($model->conta_id) ? $model->conta_id : old('conta_id') == $conta->id) ? 'selected' : '' }}>{{ $conta->toString() }}</option>
                    @endforeach
                </select>                                               
                <label for="conta_id">Conta</label>
                                                
                @component('_componentes._erros',['campo' => 'conta_id'])
                @endcomponent
            </div>
            
            <div class="form-floating mb-3">
                <input class="form-control" type="date" id="data" name="data" placeholder="Data" 
                                                        value="{{ isset($model->data) ? $model->data : old('date')}}">
                <label for="data">Data</label>

                @component('_componentes._erros',['campo' => 'data'])
                @endcomponent
            </div>
            
            <div class="form-floating mb-3"> 
                <select class="form-control" name="tipo" id="tipo">
                    <option value="">Selecione o Tipo do Lançamento...</option>    
                    <option value="E" {{ ((isset($model->tipo) ? $model->tipo : old('tipo')) == "E") ? 'selected' : '' }}>Entrada</option>
                    <option value="S" {{ ((isset($model->tipo) ? $model->tipo : old('tipo')) == "S") ? 'selected' : '' }}>Saída</option>                                                    
                </select>                                               
                <label for="tipo">Tipo do Lançamento</label>
                                                
                @component('_componentes._erros',['campo' => 'tipo'])
                @endcomponent
            </div>
                         
            <div class="form-floating mb-3">
                <input class="form-control dinheiro money" type="text"
                        id="valor" name="valor" placeholder="Valor" 
                        value="{{ isset($model->valor) ? $model->valor : old('valor')}}">
                <label for="valor">Valor</label>

                @component('_componentes._erros',['campo' => 'valor'])
                @endcomponent
            </div>

            
            @component('_componentes._input_text',['campo' => 'descricao', 'label' => 'Descrição', 'value' => isset($model->descricao) ? $model->descricao : old('descricao')])
            @endcomponent

            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <div><a class="btn btn-danger" href="{{ route('lancamento.index') }}">Cancelar</a></div>
                <div><button class="btn btn-primary" type="submit">Salvar</button></div>                                                
            </div>
        </form>
    
    
@endsection
