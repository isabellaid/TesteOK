@extends('layouts.layout_basico_cadastro')


@section('conteudo_form')
        <form method="POST" action="{{ ($recurso == 'banco.store') ? route('banco.store') : '#'}}">                                     
        @csrf
            @if ($recurso != 'banco.store')
                @method('PUT')
            @endif
            <input class="form-control" type="hidden" name="id" id="id" value="{{ isset($model->id) ? $model->id : old('id') }}">
            
        
            @component('_componentes._input_text',['campo' => 'codigo', 'label' => 'Código', 'value' => isset($model->codigo) ? $model->codigo : old('codigo')])
            @endcomponent



            @component('_componentes._input_text',['campo' => 'nome', 'label' => 'Nome', 'value' => isset($model->nome) ? $model->nome : old('nome')])
            @endcomponent

                         
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <div><a class="btn btn-danger" href="{{ route('banco.index') }}">Cancelar</a></div>
                <div><button class="btn btn-primary" type="submit">Salvar</button></div>                                                
            </div>
        </form>
                                    
@endsection
