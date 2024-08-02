@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Produk</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" class="form-control" id="photo">
            </div>
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="category">Kategori:</label>
                <input type="text" class="form-control" id="category" name="category">
            </div>
            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="form-group">
                <label for="stock">Stok:</label>
                <input type="number" class="form-control" id="stock" name="stock">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let query = $(this).val();

                // Send an AJAX request to the search route
                $.ajax({
                    url: "{{ route('products.index') }}",
                    type: "GET",
                    data: {query: query},
                    success: function(data) {
                        // Clear previous results
                        $('#product-list').empty();

                        // Append new results to the product-list tbody
                        data.forEach(function(product, index) {
                            $('#product-list').append(`
                                <tr>
                                    <td class="text-center">${index + 1}</td>
                                    <td>
                                        <div class="avatar avatar-lg">
                                            <img class="avatar-img rounded" src="{{ asset('storage/${product.photo}') }}" alt="${product.name}">
                                        </div>
                                    </td>
                                    <td>${product.name}</td>
                                    <td>${product.category}</td>
                                    <td>${product.price}</td>
                                    <td>${product.stock}</td>
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
