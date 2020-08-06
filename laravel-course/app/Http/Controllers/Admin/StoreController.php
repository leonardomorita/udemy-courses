<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;

class StoreController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        // Verifica se o usuário tem uma loja
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {
        // $stores = \App\Store::paginate(10);

        // Retorna a loja relacionada com o usuário logado
        $store = auth()->user()->store;

        return view('admin.store.index', compact('store'));
    }

    public function create()
    {
        $users = \App\User::all(['id', 'name']);

        return view('admin.store.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();

        // Pega as informações do atual usuário
        $user = auth()->user();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request);
        }

        $store = $user->store()->create($data);

        flash('A loja foi criada com sucesso')->success();

        return $store;
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('admin.store.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        $data = $request->all();

        $store = \App\Store::find($store);
        $store->update($data);

        flash('As informações da loja foram atualizadas com sucesso')->success();

        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();

        return redirect()->route('admin.stores.index');
    }
}
