<?php

// Estuda: OK

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');

        if ( !Auth::check() ) {
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();

        $total = 0;

        $cartItems = array_map(function($item) {
            return $item['amount'] * $item['price'];
        }, session()->get('cart'));

        $total = array_sum($cartItems);

        return view('checkout', compact('total'));
    }

    public function proccess(Request $request)
    {
        try {
            $data = $request->all();
            $cartItems = session()->get('cart');
            $user = auth()->user();
            $reference = 'XPTO';

            $creditCardPayment = new CreditCard($cartItems, $user, $data, $reference);
            $result = $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                'store_id' => 42,
            ];

            $user->orders()->create($userOrder);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'O pedido foi criado com sucesso.',
                    'order' => $reference
                ]
            ]);
        } catch ( \Exception $e ) {
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => 'Problemas ao processar o pedido.'
                ]
                ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
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
