<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    public function index()
    {
        // $stores = \App\Store::paginate(10);

        // Retorna a loja relacionada com o usuário logado
        $store = auth()->user()->store;

        return view('admin.store.index', compact('store'));
    }

    public function create()
    {
        if (auth()->user()->store()->count())
        {
            flash('Você já tem uma loja criada.')->warning();

            return redirect()->route('admin.stores.index');
        }

        $users = \App\User::all(['id', 'name']);

        return view('admin.store.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        if (auth()->user()->store()->count())
        {
            flash('Você já tem uma loja criada.')->warning();

            return redirect()->route('admin.stores.index');
        }

        $data = $request->all();

        // Pega as informações do atual usuário
        $user = auth()->user();
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
