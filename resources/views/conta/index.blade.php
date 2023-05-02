@extends('layouts.layout_basico_listagem')

@section('foreachCampos')
    @foreach ($dados as $dado)
    <tr>                    
        <td>{{ $dado->banco()->nome }}</td>                           
        <td>{{ $dado->tipoToString() }}</td>           
        <td>{{ $dado->numero }}</td>           
        <td>{{ $dado->saldoToString() }}</td>           
        
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


