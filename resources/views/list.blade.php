@extends('layouts.master')

@section('title', 'Order List')

@push('css_after')
<style>
    td {
        max-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush

@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Order List</h2>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('orders.create') }}" class="btn btn-success">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                        <span>Create New Order</span>
                    </a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('orders.details', $order->id)  }}" type="button" class="btn btn-sm btn-info">
                            <span class="text-light">Items</span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td align="center" colspan="6">No order yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
