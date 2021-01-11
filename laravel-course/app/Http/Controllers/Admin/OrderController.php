<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order;

    public function __construct(UserOrder $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = auth()->user()->store->orders()->paginate(10);
        // dd(unserialize($orders[0]->items));

        return view('admin.orders.index', compact('orders'));
    }
}