    <h1 class="mt-4">{{ $titulo_maiusculo }}</h1>
    <ol class="breadcrumb mb-4">
        @if ($com_resumo)
            <li class="breadcrumb-item active">Teste LARAVEL - quadros totalizadores com dados fixos</li>
        @else
            <li class="breadcrumb-item active">Teste LARAVEL</li>            
        @endif
    </ol>