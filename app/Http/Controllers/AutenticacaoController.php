<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AutenticacaoController extends Controller
{
    public function entrar() {
        return view('autenticacao.entrar');
    }

    public function autenticar(Request $request) {

        $user = User::where('email',$request->email)->where('password',$request->password)->get()->first();
        
        if ($user != null) {

            session_start();

            session()->put('name', $user->name);
            session()->put('email', $user->email);

            return redirect()->route('resumo.index');

        } else {
            $user = User::where('email',$request->email)->get()->first();
            if ($user != null) {
                $msg = 'Senha inválida!';
            } else {
                $msg = 'E-mail não cadastrado!';
            }

            return redirect()->route('autenticacao.entrar')->withErrors(['msg' => $msg, 'email' => $request->email, 'password' => $request->password]);
        }
    }

    public function create() {
        return view('autenticacao.create');
    }

    public function store(Request $request) {

        $user = new User();        
        
        $request->validate($user->rules(), $user->feedback());

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->save();
        $msg = 'Usuário cadastrado com sucesso: ' . $user->nome;

        return redirect()->route('autenticacao.entrar')->with(['msg' => $msg]);

    }

    public function sair() {

        if (isset($_SESSION['email'])) {
            session_destroy();

        

        }        
        $_SESSION['nome'] = '';
        $_SESSION['email'] = '';        
        session(['name' => '']);
        session(['email' => '']);
        return redirect()->route('autenticacao.entrar');
    }

    public function lembrar() {
        return view('autenticacao.lembrar');
    }
}

