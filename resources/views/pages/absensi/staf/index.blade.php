@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Absensi'" :btnBack="false"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        @if ($tapel->count() < 1)
            <div class="card">
              <div class="card-body">
                <div class="p-3">
                  Tahun belum ada yang diaktifkan! silahkan hubungi Admin!
                </div>
              </div>
            </div>
        @elseif($is_libur == true)
          <div class="card">
            <div class="card-body">
              <div class="p-3">
                Keterangan: LIBUR
              </div>
            </div>
          </div>
        @else
        <div class="card">
          <div class="card-header">
            <div class="callout callout-warning my-1">
              <div class="row">
                  <div class="col">
                      <div class="row">
                        <div class="table-responsive">
                          <table class="table-borderless">
                            <tr>
                              <td class="fw-bold">Nama</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Tahun</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ $tapel->tahun }}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Periode</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ $tapel->periode() }}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Tanggal</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ date('d-m-Y', strtotime($tanggal)) }}</td>
                            </tr>
                            {{-- <tr>
                              <td class="fw-bold">QR Code</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td><a href="/guru/{{ auth()->user()->guru->id }}?download=qrcode" class="text-primary " target="_blank">Download</a></td>
                            </tr> --}}
                          </table>
                        </div>

                      </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="text-center fw-bold">
                  PILIH PRESENSI
                </div>
              </div>
            </div>
            <div class="row my-3">

              <div class="col-md-6">
                <a href="/absensi/staf/masuk">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-camera"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-number">
                        Presensi Masuk
                      </span>
                      @if ($absen->where('type', 'masuk')->count() > 0)
                        <small class="text-success">
                          <i class="fa fa-check-circle"></i>
                          Sudah Absen
                        </small>
                      @else
                        <small class="text-danger">
                          <i class="fa fa-question-circle"></i>
                          Belum Absen
                        </small>
                      @endif
                    </div>
                  </div>
                </a>
              </div>

              <div class="col-md-6">
                <a href="/absensi/staf/pulang">
                  <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-camera"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-number">
                        Presensi Pulang
                      </span>
                      @if ($absen->where('type', 'pulang')->count() > 0)
                        <small class="text-success">
                          <i class="fa fa-check-circle"></i>
                          Sudah Absen
                        </small>
                      @else
                        <small class="text-danger">
                          <i class="fa fa-question-circle"></i>
                          Belum Absen
                        </small>
                      @endif
                    </div>
                  </div>
                </a>
              </div>

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
