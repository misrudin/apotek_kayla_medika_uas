@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Detail Transaksi</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('transactions.index') }}">Daftar Transaksi</a>
                </li>
                <li class="breadcrumb-item active">Detail Transaksi</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4>Informasi Transaksi</h4>
                <table class="table mt-2">
                    <tr>
                        <td>ID Transaksi:</td>
                        <td>{{ $transaction->id }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pelanggan:</td>
                        <td>{{ $transaction->customer_name }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal:</td>
                        <td>{{ $transaction->formatted_date }}</td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td>{{ formatRupiah($transaction->total_amount) }}</td>
                    </tr>
                </table>

                <h4 class="mt-4">Detail Produk</h4>
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->product->name }}</td>
                                <td>{{ formatRupiah($product->price) }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ formatRupiah($product->total) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
        }).format(number);
    }
</script>
@endsection
