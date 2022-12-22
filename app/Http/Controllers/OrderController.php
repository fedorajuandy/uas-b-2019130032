<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;

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
        $details = Order::join('order_item', 'orders.id', '=', 'order_item.order_id')
            ->join('items', 'order_item.item_id', '=', 'items.id')
            ->get(['order_item.item_id', 'order_item.quantity', 'items.nama', 'items.harga']);

        $total = 0;
        foreach ($details as &$detail) {
            $total += $detail->quantity * $detail->harga;
        }

        return view('details', compact('order', 'details', 'total'));
    }
}
