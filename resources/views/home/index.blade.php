@extends('layouts.app')

@section('content')
<div class="page-header">
  <div class="row">
      <div class="col">
          <h3 class="page-title">Beranda</h3>
          <ul class="breadcrumb">
              <li class="breadcrumb-item active">Beranda</li>
          </ul>
      </div>
  </div>
</div>
<div class="row">
<div class="col-sm-12">
    <div class="alert alert-primary" role="alert">
        Selamat datang <strong>{{ Auth::user()->name }}</strong>
    </div>
</div>
</div>

@endsection
