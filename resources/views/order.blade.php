@extends('layouts.master')

@section('title', 'Create New Order')

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
            <label>Item list</label>
            <table class="table table-striped table-hover" id="items-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama }}</td>
                        <td class="text-right">{{ $item->harga }}</td>
                        <td class="text-right">{{ $item->stok }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td align="center" colspan="6">No available item.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="control-group after-add-more">
                <div class="col-md-12 mb-3">
                    <button class="btn btn-secondary btn-block add-more" type="button">Add an item</button>
                </div>
            </div>
            <div class="control-group">
                <div class="row">
                    <div class="d-flex align-items-end">
                        <div class="col-md-8 col-sm-8 mb-3">
                            <label for="id">Item</label>
                            <select class="custom-select form-control @error('id') is-invalid @enderror nama" name="id" id="id" value="{{ old('id') }}">
                                <option value="option_select" disabled selected>Select item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                                @error('id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <div class="col-md-8 col-sm-6 mb-3">
                            <label for="title">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror quantity" name="quantity" id="quantity" value="{{ old('quantity') }}" oninput="viewTotal()">
                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 my-3">
            <div class="d-flex justify-content-between">
                <p class="text-muted">Total harga (termasuk PPN 11%)</p>
                <h5 id="sum"></h5>
            </div>
        </div>
    </div>

    <button class="btn btn-primary btn-lg btn-block" type="submit">Create</button>
</form>

<div class="copy invisible">
    <div class="control-group">
        <div class="row">
            <div class="d-flex align-items-end">
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="id">Item</label>
                    <select class="custom-select form-control @error('id') is-invalid @enderror nama" name="id" id="id" value="{{ old('id') }}">
                        <option value="option_select" disabled selected>Select item</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                        @error('id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <div class="col-md-6 col-sm-5 mb-3">
                    <label for="title">Quantity</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror quantity" name="quantity" id="quantity" value="{{ old('quantity') }}" oninput="viewTotal()">
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-sm-3 mb-3">
                    <button class="btn btn-danger btn-block remove" type="button">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_after')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".add-more").click(function(){
          var html = $(".copy").html()
          $(".after-add-more").after(html)
      });

      $("body").on("click",".remove",function(){
          $(this).parents(".control-group").remove()
      });
    });

    function ribuan(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    function komaKeTitik(x) {
        return x.toString().replaceAll(',', '.')
    }

    const round = (number, decimalPlaces) => {
        const factorOfTen = Math.pow(10, decimalPlaces)
        return Math.round(number * factorOfTen) / factorOfTen
    }

    function calculatePPN(harga) {
        return round(harga * 0.11, 2)
    }

    function calculateTotal(harga, pajak) {
        return round(Number(harga) + Number(pajak), 2)
    }

    function viewTotal() {
        let table = document.getElementById("items-table")
        let rows = table.rows
        let rowsLenMin = rows.length
        let colsLenMin = table.rows[0].cells.length
        let nama_field = document.getElementsByClassName('nama')
        let nama_count = nama_field.length
        let sum = 0;
        let q = document.getElementsByClassName('quantity');

        let quantities = [];
        qlength = q.length - 1
        for (let i = 0; i < qlength; i++) {
            quantities.push(Number(q[i].value))
        }

        for (let j = 0; j < nama_count; j++) {
            for (i = 1; i < rowsLenMin; i++) {
                y = rows[i].getElementsByTagName("TD")[0];

                if (y.innerHTML == nama_field[j].value) {
                    sum += Number(rows[i].getElementsByTagName("TD")[2].innerHTML) * quantities[j]
                }
            }
        }

        document.getElementById('sum').innerHTML = ribuan(komaKeTitik(calculateTotal(sum, calculatePPN(sum)).toFixed(2)))
    }
</script>
@endpush
