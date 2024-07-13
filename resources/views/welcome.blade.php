@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Selamat Datang di Apotek Kayla Medika!</h1>
            <p class="lead">Aplikasi untuk manajemen produk di Apotek Kayla Medika.</p>
            <hr class="my-4">
            <p>Silakan mulai dengan mengelola produk atau gunakan fitur lainnya.</p>
            <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}" role="button">Lihat Produk</a>
        </div>
    </div>
@endsection