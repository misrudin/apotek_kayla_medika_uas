@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Transaksi</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Produk: {{ $transaction->product->name }}</h5>
                <p class="card-text">Jumlah: {{ $transaction->quantity }}</p>
                <p class="card-text">Total Harga: {{ formatRupiah($transaction->total_price) }}</p>
                <p class="card-text">Tanggal: {{ $transaction->created_at->format('d M Y, H:i') }}</p>
                <a href="{{ route('transactions.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
