@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Produk</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label for="category">Kategori:</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}">
            </div>
            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            <div class="form-group">
                <label for="stock">Stok:</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
