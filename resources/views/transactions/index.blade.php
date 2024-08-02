@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1>Daftar Transaksi</h1>
        <div>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Tambah</a>
            <a href="{{ route('transactions-report') }}" class="btn btn-secondary ml-2">Report</a>
        </div>
    </div>
    @if($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $transaction->product->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ formatRupiah($transaction->total_price) }}</td>
                        <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="{{ route('transactions.show', $transaction->id) }}"
                                class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
