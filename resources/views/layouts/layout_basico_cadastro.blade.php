@extends('layouts.layout_basico')



@section('conteudo')
    <div class="form-cadastro">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">{{ $titulo }}</h3></div>
                                    <div class="card-body">
                                        @if (isset($msg))
                                            <div class="msg-erro">                                            
                                                {{ $msg }} 
                                            </div>                                            
                                        @endif
                                        @yield('conteudo_form')
                                        
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="{{ url()->previous() }}">Voltar</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    
    
@endsection
