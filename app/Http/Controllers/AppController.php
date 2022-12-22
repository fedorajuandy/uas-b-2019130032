<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $item_count = Item::all()->count();
        $order_count = Order::all()->count();

        return view('index', compact('item_count', 'order_count'));
    }
}
