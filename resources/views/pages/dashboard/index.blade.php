@extends('layouts.main') 

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h4 class="m-0 fw-bold">Dashboard</h4>
      </div>
    </div>
  </div>
</div>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">

    {{-- Ringkasan Data --}}
    <div class="row">
      @foreach ($data as $item)
        <div class="col-lg-3 col-6">
          <div class="small-box {{ $item['colour'] }}">
            <div class="inner">
              <h3>{{ $item['count'] }}</h3>
              <p>{{ $item['title'] }}</p>
            </div>
            <a href="{{ route($item['route']) }}" class="small-box-footer">
              Lihat detail <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      @endforeach

      {{-- Profil --}}
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3></h3>
            <p>Profil</p>
          </div>
          <a href="{{ route('profil.index') }}" class="small-box-footer">
            Lihat detail <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>

    {{-- ===================== --}}
    {{-- QR CODE (HANYA ADMIN) --}}
    {{-- ===================== --}}
    @can('admin')
    <div class="row mt-4">
      <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <div class="card card-secondary shadow-lg">

          {{-- Judul QR --}}
          <div class="card-header text-center">
            <span class="fw-bold fs-5">QR Code</span>
          </div>

          <div class="card-body text-center">
            @if($barcode)
              <div class="qr-wrapper">
                {!! QrCode::size(550)->generate($barcode->code) !!}
              </div>
            @else
              <p class="text-danger">QR Code belum tersedia.</p>
            @endif
          </div>

        </div>
      </div>
    </div>
    @endcan

  </div>
</section>
@endsection

{{-- ===================== --}}
{{-- CSS RESPONSIVE QR --}}
{{-- ===================== --}}
@section('css')
<style>
.qr-wrapper svg {
    width: 100%;
    max-width: 550px; /* Desktop */
    height: auto;
}

/* Tablet */
@media (max-width: 768px) {
    .qr-wrapper svg {
        max-width: 420px;
    }
}

/* HP */
@media (max-width: 576px) {
    .qr-wrapper svg {
        max-width: 300px;
    }
}
</style>
@endsection

@section('js')
@endsection
