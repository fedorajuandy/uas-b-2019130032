@extends('layouts.master')

@section('title', "Order $order->id Details")

@push('css_after')
<style>
    td {
        max-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    table.table tr th:first-child {
        width: auto;
    }

    table.table tr th:last-child {
        width: auto;
    }
</style>
@endpush

@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Order {{ $order->id }} Item List <span class="badge badge-{{ $order->status == 'Selesai' ? 'success' : 'danger' }} ml-2">{{ $order->status }}</span>
                    </h2>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Item id</th>
                    <th>Name</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($details as $detail)
                <tr>
                    <td>{{ $detail->item_id }}</td>
                    <td>{{ $detail->nama }}</td>
                    <td class="text-right">{{ $detail->quantity }}</td>
                    <td class="text-right">{{ number_format($detail->quantity * $detail->harga, 2, ".", ",") }}</td>
                </tr>
                @empty
                <tr>
                    <td align="center" colspan="6">No itmes.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <p class="text-muted">Total akhir</p>
            <h5>{{ number_format($total, 2, ".", ",") }}</h5>
        </div>
    </div>
</div>
@endsection
