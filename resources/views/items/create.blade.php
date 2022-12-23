@extends('layouts.master')

@section('title', 'Add New Item')

@section('content')
<h2 class="mt-4 mb-3">Add New Item</h2>
<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="title">Id</label>
            <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" id="id" value="{{ $random_id }}" readonly>
            @error('id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="title">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}">
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="title">Harga</label>
            <input min="0" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" value="{{ old('harga') }}">
            @error('harga')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="title">Stok</label>
            <input min="0" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok" value="{{ old('stok') }}">
            @error('stok')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button class="btn btn-primary btn-lg btn-block mt-3" type="submit">Add</button>
</form>
@endsection
