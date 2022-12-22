@extends('layouts.master')

@section('title', 'Item List')

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
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
@endif

<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Item List</h2>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('items.create') }}" class="btn btn-success">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                        <span>Add New Item</span>
                    </a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Stok</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-right">{{ number_format($item->harga, 2, ".", ",") }}</td>
                    <td class="text-right">{{ $item->stok }}</td>
                    <td>
                        <a href="{{ route('items.show', $item->id)  }}" type="button" class="btn btn-sm btn-info">
                            <span class="text-light">View</span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td align="center" colspan="6">No data yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
