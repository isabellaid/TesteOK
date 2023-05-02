<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ID Brasil Sistemas - Teste</title>
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/all.js') }}" crossorigin="anonymous"></script>
</head>

    <body class="sb-nav-fixed">
        
        @include('layouts.__pg_cabecalho')

        <div id="layoutSidenav">

            @include('layouts.__pg_menu_lateral_nao_autenticado')    

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
                        @yield('conteudo')

                    </div>
                </main>
                @include('layouts.__pg_rodape')    
            </div>
        </div>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/simple-datatables.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    </body>
</html>
