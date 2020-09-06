<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Verifica se na sessão tem a variável 'cart'. Se tiver, atribuir o valor de 'cart' da sessão na variável. Caso contrário, atribua um array vazio
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = $request->product;

        // Verifica na sessão a existência da variável 'cart'
        if (session()->has('cart')) {
            // Existe a variável 'cart' na sessão, então vai ser adicionado um novo produto na variável 'cart' da sessão
            session()->push('cart', $product);
        } else {
            // Não existe a variável 'cart' na sessão, então vai ser criado a mesma na sessão com o primeiro produto
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash('O produto foi adicionado no carrinho.')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }
}
