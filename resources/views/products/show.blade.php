@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Produk</h1>
    <div class="card mt-4">
        <div class="card-header">
            <h5>{{ $product->name }}</h5>
        </div>
        <div class="card-body">
            <p class="card-title">Kategori: {{ $product->category }}</p>
            <p class="card-text">Harga: {{ formatRupiah($product->price) }}</p>
            <p class="card-text">Stok: {{ formatNumber($product->stock) }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali</a>
            <a href="{{ route('products.edit', $product->id) }}"
                class="btn btn-warning">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
