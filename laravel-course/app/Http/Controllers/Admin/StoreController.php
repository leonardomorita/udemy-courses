<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = \App\Store::paginate(10);

        return view('admin.store.index', compact('stores'));
    }

    public function create()
    {
        $users = User::all(['id', 'name']);

        return view('admin.store.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = \App\User::find($data['user']);
        $store = $user->store()->create($data);

        return $store;
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('admin.store.edit', compact('store'));
    }

    public function update(Request $request, $store)
    {
        $data = $request->all();

        $store = \App\Store::find($store);

        $store->update($data);

        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);

        $store->delete();

        return redirect()->route('admin.stores.index');
    }
}
