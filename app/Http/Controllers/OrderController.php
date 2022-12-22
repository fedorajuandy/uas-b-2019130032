<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        return view('order');
    }

    public function createOrder(Request $request)
    {
        $validateData = $request->validate([
            'status' => 'required|max:32',
        ]);

        Order::create($validateData);

        $request->session()->flash('success', 'Successfully creating new order.');
        return redirect()->route('index');
    }

    public function list()
    {
        $orders = Order::all();
        return view('list', compact('orders'));
    }

    public function details(Order $order)
    {
        $details = DB::table('order_item')
            ->where('order_id', $order->order_id)
            ->get();
        return view('details', compact('details'));
    }
}
