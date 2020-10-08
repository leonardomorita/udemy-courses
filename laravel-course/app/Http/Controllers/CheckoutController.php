<?php

// Estuda: OK

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if ( !Auth::check() ) {
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();
        // var_dump(session()->get('pagseguro_session_code'));
        // session()->forget('pagseguro_session_code');

        return view('checkout');
    }

    public function proccess(Request $request)
    {
        dd($request->all());
    }

    private function makePagSeguroSession()
    {
        // Verificar se tem o código do pagseguro na sessão atual
        if ( !session()->has('pagseguro_session_code') ) {
            // Não tem o código

            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            return session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
