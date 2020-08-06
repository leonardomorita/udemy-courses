<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use \App\Product;

use \App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = auth()->user()->store->products()->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        // Retorna a loja do usuário
        $store = auth()->user()->store;
        // Cria um produto para a loja
        $product = $store->products()->create($data);

        // Adiciona na tabela intermediária a relação entre o produto criado com as categorias selecionadas, através do 'sync()'
        $product->categories()->sync($data['categories']);

        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request, "image");
            // Insere as referências da imagem no banco de dados, relacionando o registro da tabela "product" com a tabela "product_photos"
            $product->images()->createMany($images);
        }

        flash('O produto foi criado com sucesso')->success();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = $this->product->find($product);
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();

        $product = $this->product->find($product);
        $product->update($data);
        $product->categories()->sync($data['categories']);

        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request, 'image');
            $product->images()->createMany($images);
        }

        flash('As informações do produto foram atualizadas com sucesso')->success();

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = $this->product->find($product);
        $product->delete();

        flash('O produto foi excluído com sucesso')->success();

        return redirect()->route('admin.products.index');
    }


}
