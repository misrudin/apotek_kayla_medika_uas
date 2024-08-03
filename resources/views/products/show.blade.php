@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Detail Produk</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}">Daftar Produk</a>
                </li>
                <li class="breadcrumb-item active">Detail Produk</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="avatar avatar-xl">
                    <img class="avatar-img rounded"
                        src="{{ asset('storage/' . $product->photo) }}"
                        alt="{{ $product->name }}"
                        onerror="this.src='data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=';">
                </div>
                <p class="card-title mt-4">{{ $product->name }}</p>
                <p class="card-text">Kategori: {{ $product->category }}</p>
                <p class="card-text">Harga: {{ formatRupiah($product->price) }}</p>
                <p class="card-text">Stok: {{ formatNumber($product->stock) }}</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Kembali</a>
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
            </div>
        </div>
    </div>
</div>

@endsection
