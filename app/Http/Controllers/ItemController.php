<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $random_id = random_int(1000000000000000, 9999999999999999);
        $x = 0;

        $duplicates = DB::table('items')->select('id')->get();
        $existing = DB::table('items')
            ->select(DB::raw('COUNT(*) AS count'))
            ->first();
        $counter = $existing->count;

        foreach ($duplicates as &$duplicate) {
            while ($x <= $counter) {
                if ($duplicate->id == $random_id) {
                    $random_id = random_int(1000000000000000, 9999999999999999);
                } else {
                    $x++;
                }
            }
        }

        return view('items.create', compact('random_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|min:16|max:16',
            'nama' => 'required|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Item::create($validateData);

        $request->session()->flash('success', 'Successfully adding new item!');
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact("item"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $rules = [
            'id' => 'required|min:16|max:16',
            'nama' => 'required|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ];

        $validated = $request->validate($rules);

        $item->update($validated);
        $request->session()->flash('success', "Successfully updating {$validated['nama']}.");
        return redirect()->route('authors.show', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', "Successfully deleting {$item['nama']}.");
    }
}
