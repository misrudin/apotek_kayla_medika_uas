@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Transaksi</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('transactions.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="product_id">Pilih Produk:</label>
                <select class="form-control" id="product_id" name="product_id" onchange="calculateTotal()">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} ( {{ formatRupiah($product->price) }} )</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" onchange="calculateTotal()">
            </div>
            <div class="form-group">
                <label for="total_price">Total Harga:</label>
                <input type="text" class="form-control" id="total_price" name="total_price" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        function calculateTotal() {
            let product_id = document.getElementById('product_id').value;
            let quantity = parseInt(document.getElementById('quantity').value);
            let price = parseFloat(document.querySelector(`option[value="${product_id}"]`).getAttribute('data-price'));
            let total_price = quantity * price;

            document.getElementById('total_price').value = formatRupiah(total_price, 'Rp ');
        }

        function formatRupiah(angka, prefix){
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }
    </script>
@endsection
