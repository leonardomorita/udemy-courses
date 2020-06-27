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

    // Revisar
    public function create()
    {
        $users = User::all(['id', 'name']);
        return view('admin.store.create', compact('users'));
    }

    // Revisar
    public function store(Request $request)
    {
        $data = $request->all();
        $user = \App\User::find($data['user']);
        $store = $user->store()->create($data);

        return $store;
    }
}
