<?php

use Illuminate\Support\Facades\Route;

Route::get('/entrar', [App\Http\Controllers\AutenticacaoController::class, 'entrar'] )->name('autenticacao.entrar');
Route::post('/entrar', [App\Http\Controllers\AutenticacaoController::class, 'autenticar'] )->name('autenticacao.autenticar');
Route::get('/novo', [App\Http\Controllers\AutenticacaoController::class, 'create'] )->name('autenticacao.create');
Route::post('/novo', [App\Http\Controllers\AutenticacaoController::class, 'store'] )->name('autenticacao.store');
Route::get('/sair', [App\Http\Controllers\AutenticacaoController::class, 'sair'] )->name('autenticacao.sair');
Route::get('/lembrar', [App\Http\Controllers\AutenticacaoController::class, 'lembrar'] )->name('autenticacao.lembrar');


Route::middleware('autenticacao.manual')->group(function(){
    Route::get('/', [App\Http\Controllers\ResumoController::class, 'index'] )->name('resumo.index');

    Route::resource('banco', App\Http\Controllers\BancoController::class);
    Route::put('/banco/{id}/edit', [App\Http\Controllers\BancoController::class, 'update'])->name('banco.update');
    Route::resource('conta', App\Http\Controllers\ContaController::class);
    Route::resource('lancamento', App\Http\Controllers\LancamentoController::class);    
    
});

