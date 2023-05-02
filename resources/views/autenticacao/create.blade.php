@extends('layouts.layout_basico_nao_autenticado')


@section('conteudo')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light">Cadastrar novo usuário</h3></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('autenticacao.store') }}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="name" name="name" type="text" placeholder="Nome" 
                                                                    value ="{{ old('name') }}"/>
                                        <label for="name">Nome</label>
                                        @component('_componentes._erros',['campo' => 'name'])
                                        @endcomponent
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email" name="email" type="email" placeholder="E-mail" 
                                                                    value ="{{ old('email') }}"/>
                                        <label for="email">E-mail</label>
                                        @component('_componentes._erros',['campo' => 'email'])
                                        @endcomponent
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Senha" />
                                        <label for="password">Senha</label>
                                        @component('_componentes._erros',['campo' => 'password'])
                                        @endcomponent
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmação da senha" />
                                        <label for="password_confirmation">Confirmação da senha</label>

                                    </div>
           
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="#"></a>
                                        <button class="btn btn-primary" type="submit">Salvar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div> 
@endsection
