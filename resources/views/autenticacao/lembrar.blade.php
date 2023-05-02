@extends('layouts.layout_basico_nao_autenticado')


@section('conteudo')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Recuperar senha</h3></div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Insira seu e-mail para enviar o link de recuperação de senha</div>
                                <form>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                        <label for="inputEmail">E-mail</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2 mb-0">
                                        <a class="small" href="{{ route('autenticacao.entrar') }}">Retornar ao login</a>
                                        <a class="btn btn-primary" href="#">XXXXXXX</a>
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

</div>
@endsection
