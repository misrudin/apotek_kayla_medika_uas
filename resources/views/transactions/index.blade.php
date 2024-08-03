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
                    <input type="text" id="search" class="form-control" placeholder="Cari Transaksi..." style="width: 200px;">
                    <div class="wordset">
                        <ul>
                            <li>
                                <a target="_blank" href="{{ route('report.transactions') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="{{ asset("assets/img/icons/pdf.svg") }}"
                                        alt="img" /></a>
                            </li>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Transaksi</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="transaction-list">
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->customer_name }}</td>
                                    <td>{{ $transaction->transaction_date->format('d M Y, H:i') }}</td>
                                    <td>
                                        <ul>
                                            @foreach($transaction->products as $transactionProduct)
                                                <li>{{ $transactionProduct->product->name }} ({{ $transactionProduct->quantity }} x {{ formatRupiah($transactionProduct->price) }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ formatRupiah($transaction->products->sum('total')) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('transactions.show', $transaction->id) }}"
                                            class="btn btn-success btn-sm text-white">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
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

@section('script')
<script>
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
        }).format(number);
    }

    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let query = $(this).val();
            $.ajax({
                url: "{{ route('transactions.index') }}",
                type: "GET",
                data: {
                    query: query
                },
                success: function (data) {
                    $('#transaction-list').empty();
                    data.forEach(function (transaction) {
                        let productsList = '';
                        transaction.products.forEach(function (transactionProduct) {
                            productsList += `
                                <li>${transactionProduct.product.name} (${transactionProduct.quantity} x ${formatRupiah(transactionProduct.price)})</li>
                            `;
                        });
                        $('#transaction-list').append(`
                            <tr>
                                <td>${transaction.id}</td>
                                <td>${transaction.customer_name}</td>
                                <td>${transaction.formatted_date}</td>
                                <td><ul>${productsList}</ul></td>
                                <td>${formatRupiah(transaction.total_amount)}</td>
                                <td class="text-center">
                                    <a href="/transactions/${transaction.id}" class="btn btn-success btn-sm text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        });
    });
</script>
@endsection
