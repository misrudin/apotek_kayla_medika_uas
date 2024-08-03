@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Daftar Produk</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Daftar Produk</li>
            </ul>
        </div>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah</a>
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
                                <a target="_blank" href="{{ route('report.products') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="{{ asset("assets/img/icons/pdf.svg") }}"
                                        alt="img" /></a>
                            </li>
                            <li>
                                <a href="{{ route('report.products.excel') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
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
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="avatar avatar-lg">
                                            <img class="avatar-img rounded"
                                                src="{{ asset('storage/' . $product->photo) }}"
                                                alt="{{ $product->name }}"
                                                onerror="this.src='data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=';">
                                        </div>
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ formatRupiah($product->price) }}</td>
                                    <td>{{ formatNumber($product->stock) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="btn btn-success btn-sm text-white">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-primary btn-sm text-white">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form
                                            action="{{ route('products.destroy', $product->id) }}"
                                            method="POST" style="display:inline;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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
@section('script')
<script>
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
        }).format(number);
    }

    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID', {
            maximumFractionDigits: 0,
        }).format(number);
    }

    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let query = $(this).val();
            $.ajax({
                url: "{{ route('products.index') }}",
                type: "GET",
                data: {
                    query: query
                },
                success: function (data) {
                    $('#product-list').empty();

                    data.forEach(function (product, index) {
                        $('#product-list').append(`
                            <tr>
                                <td class="text-center">${index + 1}</td>
                                <td>
                                    <div class="avatar avatar-lg">
                                        <img class="avatar-img rounded" src="{{ asset('storage/${product.photo}') }}" alt="${product.name}"
                                                    onerror="this.src='data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=';"
                                        >
                                    </div>
                                </td>
                                <td>${product.name}</td>
                                <td>${product.category}</td>
                                <td>${formatRupiah(product.price)}</td>
                                <td>${formatNumber(product.stock)}</td>
                                <td class="text-center">
                                    <a href="/products/${product.id}" class="btn btn-success btn-sm text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/products/${product.id}/edit" class="btn btn-primary btn-sm text-white">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="/products/${product.id}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
@csrf
@method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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
