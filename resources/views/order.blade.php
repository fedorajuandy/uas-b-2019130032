@extends('layouts.master')

@section('title', 'Create New Order')

@section('content')
<h2 class="mt-4 mb-3">Create New Order</h2>
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="title">Status</label>
            <select class="custom-select form-control" name="status" id="status" value="{{ old('status') }}">
                <option value="Selesai" selected>Selesai</option>
                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
            </select>
        </div>
        <div class="d-flex align-items-end">
            <div class="col-md-10 col-sm-6 mb-3">
                <label for="title">Items</label>
                <select class="custom-select form-control @error('id') is-invalid @enderror" name="id" id="id" value="{{ old('id') }}">
                    <option value="option_select" disabled selected>Select item</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                    @error('id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </select>
            </div>
            <div class="col-md-10 col-sm-6 mb-3">
                <label for="title">Quantity</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity') }}">
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 col-sm-2 mb-3">
                <button class="btn btn-secondary btn-block">Add</button>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Item id</th>
                        <th>Item name</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td align="center" colspan="6">No item yet.</td>
                    </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
        <div class="col-md-12 my-3">
            <div class="d-flex justify-content-between">
                <p class="text-muted">Total harga (termasuk PPN 11%)</p>
                <h5>{{ number_format(0, 2, ".", ",") }}</h5>
            </div>
        </div>
    </div>

    <button class="btn btn-primary btn-lg btn-block" type="submit">Create</button>
</form>
@endsection
