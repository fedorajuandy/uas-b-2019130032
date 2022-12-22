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
        <div class="col-md-12 mb-3">
            <label for="title">Items</label>
        </div>
        <div class="col-md-12 my-3">
            <div class="d-flex justify-content-between">
                <p class="text-muted">Total akhir</p>
                <h5>{{ number_format(0, 2, ".", ",") }}</h5>
            </div>
        </div>
    </div>

    <button class="btn btn-primary btn-lg btn-block" type="submit">Create</button>
</form>
@endsection
