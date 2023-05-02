@extends('layouts.layout_basico_nao_autenticado')


@section('conteudo')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Entrar no sistema</h3></div>
                            <div class="card-body">

                                @if($errors->any())                                                  
                                    <div class="msg-erro card-body">
                                        {{ $errors->first() }}
                                    </div>
                                @endif

                                <form  method="POST" action="{{ route('autenticacao.autenticar') }}">
                                    @csrf

                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" name="email" type="email" 
                                                                    value="{{ $errors->any() ? $errors->first('email') : '' }}"/>
                                        <label for="email">E-mail</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="password" name="password" type="password" 
                                                                    value="{{ $errors->any() ? $errors->first('email') : ''}}"/>
                                        <label for="password">Senha</label>
                                    </div>
           
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="{{ route('autenticacao.lembrar')}}">Esqueceu a senha?</a>
                                        <button class="btn btn-primary" type="submit" href="#">Entrar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="{{ route('autenticacao.create') }}">Cadastrar novo usuário</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div> 
@endsection
