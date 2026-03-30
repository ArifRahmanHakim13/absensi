@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Data Absensi'" :btnBack="false"></x-content-header>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">

        @if ($tapel->count() < 1)
          <div class="card">
            <div class="card-body">
              <div class="p-3">
                Tahun belum ada yang diaktifkan!
                <a href="{{ route('tapel.index') }}">Aktifkan Tahun</a>
              </div>
            </div>
          </div>
        @else

        <div class="card">
          <div class="card-header">
            <div class="callout callout-warning my-1">
              <div class="table-responsive">
                <table class="table-borderless">
                  <tr>
                    <td class="fw-bold">Tahun</td>
                    <td class="px-2">:</td>
                    <td>{{ $tapel->tahun }}</td>
                  </tr>

                  {{-- PERIODE DI NONAKTIFKAN (AMAN, HANYA TAMPILAN) --}}
                  {{--
                  <tr>
                    <td class="fw-bold">Periode</td>
                    <td class="px-2">:</td>
                    <td>{{ $tapel->periode() }}</td>
                  </tr>
                  --}}

                  <tr>
                    <td class="fw-bold">Tanggal Efektif</td>
                    <td class="px-2">:</td>
                    <td>{{ $tapel->mulai() }} - {{ $tapel->selesai() }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">

              @if ($months->count() < 1)
                Data bulan tidak ditemukan!
              @else
                @foreach ($months as $bulan)
                  <div class="col-sm-6 col-md-4">
                    <a href="/absensi/admin/{{ $bulan->ym }}" class="text-decoration-none">
                      <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1">
                          <i class="fas fa-calendar"></i>
                        </span>
                        <div class="info-box-content">
                          <span class="info-box-number">
                            {{ $bulan->name }}
                          </span>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              @endif

            </div>
          </div>
        </div>

        @endif
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')
@endsection
