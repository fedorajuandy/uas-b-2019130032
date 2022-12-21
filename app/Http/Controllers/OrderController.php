<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('order', compact('orders'));
    }

    public function createOrder(Request $request)
    {
        $validateData = $request->validate([
            'status' => 'required|max:32',
        ]);

        Order::create($validateData);

        $request->session()->flash('success', 'Successfully adding new data!');
        return redirect()->route('index');
    }
}
