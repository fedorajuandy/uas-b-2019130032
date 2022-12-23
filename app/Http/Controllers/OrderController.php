<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        $items = Item::where('stok', '>', '0')->get();

        return view('order', compact('items'));
    }

    // 1. Details not working; I do not know how to get those class names properly ;-;
    // 2. Update, same with number 1
    // 3. These are all... trials, and mostly errors TTATT
    public function createOrder(Request $request)
    {
        // GET DATAS
        // https://stackoverflow.com/questions/58078757/class-illuminate-support-facades-input-not-found
        $inputs = $request->all();

        $ids = $request->get('.nama');
        $quantities = $request->get('.quantity');

        // MAKE ORDER
        $order = new Order;
        $order->status = $request->get('status');;
        $order->save();

        // ATTACH ITEMS AND INSERT QUANTITY
        /* $items = Item::find($ids);
        foreach ($ids as &$id) {
            $order->items()->attach($id);
        } */

        /* $c = count(Request::get('nama'));

        $id = Request::get('nama');
        $q = Request::get('quantity');

        for ($i = 0; $i < $c; ++$i) {
            $order->items()->attach($id[$i], $q[$i]);
        } */

        // UPDATE STOK
        // https://stackoverflow.com/questions/26355913/inserting-multiple-data-laravel-4
        /* foreach ($order->items as $item) {
            $i = 0;
            $book->pivot->quantity = $quantities[$i];
            $book->push();
            $i++;
        } */

        // REDIRECT
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
