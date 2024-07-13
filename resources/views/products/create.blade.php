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
        <form action="{{ route('products.store') }}" method="POST" class="mt-4">
            @csrf
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
@endsection
