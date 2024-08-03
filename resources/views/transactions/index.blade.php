@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Daftar Transaksi</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Daftar Transaksi</li>
            </ul>
        </div>
    </div>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary">Tambah</a>
</div>
@if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <input type="text" id="search" class="form-control" placeholder="Cari Produk..."
                        style="width: 200px; display: inline-block;">
                    <div class="wordset">
                        <ul>
                            <li>
                                <a href="{{ route('report.products') }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="pdf"><img
                                        src="{{ asset("assets/img/icons/pdf.svg") }}"
                                        alt="img" /></a>
                            </li>
                            <li>
                                <a href="{{ route('report.products.excel') }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="{{ asset("assets/img/icons/excel.svg") }}"
                                        alt="img" /></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive overflow-hidden">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="transaction-list">
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>{{ formatRupiah($transaction->total_price) }}</td>
                                    <td>{{ $transaction->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transactions.show', $transaction->id) }}"
                                            class="btn btn-success btn-sm text-white">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
