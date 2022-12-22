@extends('layouts.master')

@section('title', $item->nama)

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
@endif

<div class="mt-4 col-md-12">
    <div class="row">
        <div class="col-md-8">
            <h2>{{ $item->nama }}</h2>
        </div>
        <div class="col-md-4">
            <div class="float-right">
                <div class="btn-group" role="group">
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary ml-3">Edit</a>
                    <button type="button" class="btn btn btn-danger ml-3" data-toggle="modal" data-target="#confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <hr class="mt-2">

    <div class="card border-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">Harga</div>
        <div class="card-body text-dark">
          <h4 class="card-title mb-0">{{ $item->harga }}</h4>
        </div>
    </div>
    <div class="card border-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">Stok</div>
        <div class="card-body text-dark">
          <h4 class="card-title mb-0">{{ $item->stok }}</h4>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="confirmDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Delete confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @method('DELETE')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
