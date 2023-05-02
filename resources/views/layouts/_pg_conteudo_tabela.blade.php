<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <i class="fas fa-table me-1"></i>
            @if ($com_resumo) 
                {{ $model->titulo_plural() }}
            @else
                {{ $titulo }}
            @endif        
        </div>
        @if (!$com_resumo)
            <div>
                <a class="btn btn-primary" href="{{ route($recurso.'.create') }}">Cadastrar</a>
            </div>
        @endif
    </div>
    <div class="card-body">

    @yield('filtros')
    
    @if ($filtro_str != '') 
        <div class="msg-info card-body">
            {{ $filtro_str }}
        </div>
    @endif

    @if ($dados->count() == 0)
        <div class="msg-info card-body">
            NÃO EXISTE NENHUM ITEM CADASTRADO
        </div>
    @else
        @if (isset($msg) && ($msg != ''))
            <div class="msg-sucesso card-body">
                {{ $msg }}
            </div>
        @endif
        @if (isset($erro) && ($erro != ''))
            <div class="msg-erro card-body">
                {{ $erro }}
            </div>
        @endif

        <table id="datatablesSimple">
            <thead>
               
                <tr>                    
                    @foreach ($campos_titulos as $titulo)
                        <th>{{ $titulo }}</th>
                    @endforeach

                    <th></th>
                    <th></th>
                </tr>

            </thead>
            <tbody>

                @yield('foreachCampos')
                
            </tbody>
            
            <tfoot>
                <tr>
                    @foreach ($campos_titulos as $titulo)
                        <th>{{ $titulo }}</th>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    @endif
    </div>

