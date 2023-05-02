@extends('layouts.layout_basico')

@section('conteudo')

    @include('layouts._pg_conteudo_cabecalho')

    @if($com_resumo)    
        @include('layouts._pg_conteudo_cards')
    @endif  
    
    @include('layouts._pg_conteudo_tabela')



                        
@endsection 