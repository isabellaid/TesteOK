@extends('layouts.layout_basico_cadastro')


@section('conteudo_form')
        <form method="POST" action="{{ route('conta.store') }}">                                     
        @csrf
            <input class="form-control" type="hidden" name="id" id="id" value="{{ isset($model->id) ? $model->id : old('id') }}">
            <div class="form-floating mb-3"> 
                <select class="form-control" name="banco_id" id="banco_id">
                    <option value="">Selecione um Banco...</option>    
                    @foreach ($bancos as $banco)
                        <option value="{{ $banco->id }}"
                            {{ ((isset($model->banco_id) ? $model->banco_id : old('banco_id')) == $banco->id) ? 'selected' : '' }}>{{ $banco->nome }}</option>
                    @endforeach
                </select>                                               
                <label for="banco_id">Banco</label>
                                                
                @component('_componentes._erros',['campo' => 'banco_id'])
                @endcomponent
            </div>
                                            
            <div class="form-floating mb-3"> 
                <select class="form-control" name="tipo" id="tipo">
                    <option value="">Selecione o Tipo da Conta...</option>    
                    <option value="C" {{ ((isset($model->tipo) ? $model->tipo : old('tipo')) == "C") ? 'selected' : '' }}>Conta Corrente</option>
                    <option value="P" {{ ((isset($model->tipo) ? $model->tipo : old('tipo')) == "P") ? 'selected' : '' }}>Conta Poupança</option>
                    <option value="S" {{ ((isset($model->tipo) ? $model->tipo : old('tipo')) == "S") ? 'selected' : '' }}>Conta Salário</option>                                                    
                </select>                                               
                <label for="tipo">Tipo da Conta</label>
                                                
                @component('_componentes._erros',['campo' => 'tipo'])
                @endcomponent
            </div>
                                            
            <div class="form-floating mb-3">
                <input class="form-control" type="text"
                        id="numero" name="numero" 
                        value="{{ isset($model->numero) ? $model->numero : old('numero')}}">
                <label for="numero">Númeror</label>

                @component('_componentes._erros',['campo' => 'valor'])
                @endcomponent
            </div>

                         
            <div class="form-floating mb-3">
                <input class="form-control dinheiro" type="text"
                        id="saldo" name="saldo" placeholder="Saldo" 
                        value="{{ isset($model->saldo) ? $model->saldo : old('saldo')}}">
                <label for="saldo">Saldo</label>

                @component('_componentes._erros',['campo' => 'saldo'])
                @endcomponent
            </div>

            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <div><a class="btn btn-danger" href="{{ route('conta.index') }}">Cancelar</a></div>
                <div><button class="btn btn-primary" type="submit">Salvar</button></div>                                                
            </div>
        </form>
@endsection
