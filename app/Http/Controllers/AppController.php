<?php

use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function index()
    {
        $items = DB::table('items')
            ->select(DB::raw('COUNT(*) AS count'))
            ->first();
        $item_count = $items->count;

        $orders = DB::table('orders')
            ->select(DB::raw('COUNT(*) AS count'))
            ->first();
        $order_count = $orders->count;

        return view('index', compact('item_count', 'order_count'));
    }
}
