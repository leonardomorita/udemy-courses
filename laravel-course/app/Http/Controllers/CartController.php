<?php

// Estuda: OK

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
        if ( session()->has('cart') ) {
            // Verificar se o produto já existe no carrinho. Se existir, apenas aumentar a quantidade do produto que já existe no carrinho. Se não existir, coloque o produto no carrinho com a quantidade especificada pelo usuário na requisição
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');
            if ( in_array($product['slug'], $productsSlugs) ) {
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            } else {
                // Existe a variável 'cart' na sessão, então vai ser adicionado um novo produto na variável 'cart' da sessão
                session()->push('cart', $product);
            }
        } else {
            // Não existe a variável 'cart' na sessão, então vai ser criado a mesma na sessão com o primeiro produto
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash('O produto foi adicionado no carrinho.')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug)
    {
        // Verifica se a variável 'cart' está na sessão atual
        if ( !session()->has('cart') ) {
            // Não tem a variável
            return redirect()->route('cart.index');
        }

        // Tem a variável
        $products = session()->get('cart');
        $products = array_filter($products, function($product) use($slug) {
            // Será retorna apenas os produtos que não tiver o mesmo slug do que foi passado na requisição
            return $product['slug'] != $slug;
        });

        // Sobreescrever a variável 'cart' da sessão com os produtos atualizados, depois que passou do filtro
        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        // Remover a variável 'cart' da sessão
        session()->forget('cart');

        flash('A compra foi cancelada.')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function($product) use ($slug, $amount) {
            // Verificar se o slug passado na requisição, existe no carrinho na sessão atual. Ou seja, será verificado se o mesmo produto existe no carrinho. Caso existir, incrementar a quantidade atual com a quantidade que será acrescentada
            if ($slug == $product['slug']) {
                $product['amount'] += $amount;
            }
            return $product;
        }, $products);

        return $products;
    }
}
