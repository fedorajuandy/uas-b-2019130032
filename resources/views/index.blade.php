@extends('layouts.master')

@section('title', 'Home')

@section('content')
<h2 class="mt-4 mb-3">Overview</h2>
<div class="d-flex">
    <div class="card bg-info mr-3" style="width: 18rem;">
        <div class="card-body">
            <p class="card-title">Item count</p>
            <h3 class="card-text text-light">{{ $item_count }}</h4>
            <a href="{{ route('items.index') }}" class="btn btn-primary mt-3 float-right">View All Items</a>
        </div>
    </div>
    <div class="card bg-info mr-3" style="width: 18rem;">
        <div class="card-body">
            <p class="card-title">Order count</p>
            <h3 class="card-text text-light">{{ $order_count }}</h4>
            <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3 float-right">View All Orders</a>
        </div>
    </div>
</div>
@endsection
