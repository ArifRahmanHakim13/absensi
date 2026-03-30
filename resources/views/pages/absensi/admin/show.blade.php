@extends('layouts.main')

@section('css')
<style>
  .tanggal {
      cursor: pointer;
    }
  .type {
      cursor: pointer;
    }
  .status {
      cursor: pointer;
  }
  .status-hadir {
      cursor: pointer;
  }
  .min-w-30 {
    min-width: 30px;
  }
  .bg-h {
        background-color: #28a745
    }

    .bg-s {
      background-color:#007bff
    }

    .bg-i{
      background-color: #ffc107
    }

    .bg-a{
      background-color: #dc3545
    }
</style>
@endsection

@section('content')

@php
    use Carbon\Carbon;
@endphp
{{-- Header --}}
<x-content-header :title="'Data Absensi'" :btnBack="true" :redirect="'/absensi/admin'"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        @if ($tapel->count() < 1)
            <div class="card">
              <div class="card-body">
                <div class="p-3">
                  Tahun belum ada yang diaktifkan! <a href="{{ route('tapel.index') }}">Aktifkan Tahun</a>
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
                              <td class="fw-bold">Tahun</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ $tapel->tahun }}</td>
                            </tr>
                            <!-- <tr>
                              <td class="fw-bold">Periode</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ $tapel->periode() }}</td>
                            </tr> -->
                            <tr>
                              <td class="fw-bold">Bulan</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ $namabulan  }}</td>
                            </tr>
                          </table>
                        </div>

                      </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm table-hover table-bordered border-dark">
                <thead>
                  <tr class="border-dark">
                    <th class="border-dark text-center align-middle bg-info" rowspan="3">No</th>
                    <th class="border-dark text-center align-middle bg-info" rowspan="3" style="min-width: 200px">Nama Staf</th>
                    <th class="border-dark text-center align-middle bg-info" rowspan="3">ID</th>
                    <th class="border-dark text-center align-middle bg-info" rowspan="3">L/P</th>
                    <th class="border-dark text-center align-middle bg-info" colspan="{{ count($tanggals) * 2 }}">Tanggal</th>
                    <th class="border-dark text-center align-middle bg-info" colspan="4">Jumlah</th>
                  </tr>
                  <tr>
                    @foreach ($tanggals as $tanggal)
                      @if (Str::before(Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y'), ',') == 'Minggu')
                        <th class="border-dark text-center tanggal bg-danger" data-toggle="tooltip" data-placement="top" title="{{ Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}" colspan="2">
                          {{ Str::afterLast($tanggal, '-') }}
                        </th>
                      @elseif ($libur->pluck('tanggal')->contains($tanggal))
                        <th class="border-dark text-center tanggal bg-danger" data-toggle="tooltip" data-placement="top" title="{{ Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}" colspan="2">
                          {{ Str::afterLast($tanggal, '-') }}
                        </th>
                      @else
                        <th class="border-dark text-center tanggal bg-secondary tanggal-absensi" data-toggle="tooltip" data-placement="top" title="{{ Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}" colspan="2" data-tanggal-pretty="{{ date('d-m-Y', strtotime($tanggal)) }}" data-tanggal="{{ $tanggal }}">
                          {{ Str::afterLast($tanggal, '-') }}
                        </th>
                      @endif
                    @endforeach
                    <th class="bg-success border-dark status align-middle text-center min-w-30" data-toggle="tooltip" data-placement="top" title="Hadir" rowspan="2">H</th>
                    <th class="bg-primary border-dark status align-middle text-center min-w-30" data-toggle="tooltip" data-placement="top" title="Sakit" rowspan="2">S</th>
                    <th class="bg-warning border-dark status align-middle text-center min-w-30" data-toggle="tooltip" data-placement="top" title="Izin" rowspan="2">I</th>
                    <th class="bg-danger border-dark status align-middle text-center min-w-30" data-toggle="tooltip" data-placement="top" title="Alfa" rowspan="2">A</th>
                  </tr>
                  <tr>
                    @foreach ($tanggals as $tanggal)
                      @if (Str::before(Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y'), ',') == 'Minggu')
                        <th class="border-dark bg-danger min-w-30" data-toggle="tooltip" data-placement="top" data-title="Libur Hari Minggu">

                        </th>
                        <th class="border-dark bg-danger min-w-30" data-toggle="tooltip" data-placement="top" data-title="Libur Hari Minggu">

                        </th>
                      @elseif ($libur->pluck('tanggal')->contains($tanggal))
                        <th class="border-dark bg-danger min-w-30" data-toggle="tooltip" data-placement="top" data-title="{{ $libur->firstWhere('tanggal', $tanggal)->keterangan }}">

                        </th>
                        <th class="border-dark bg-danger min-w-30" data-toggle="tooltip" data-placement="top" data-title="{{ $libur->where('tanggal', $tanggal)->first()->keterangan }}">

                        </th>
                      @else
                        <th class="type border-dark text-center min-w-30 bg-success" data-toggle="tooltip" data-placement="top" title="Masuk">
                          M
                        </th>
                        <th class="type border-dark text-center min-w-30 bg-warning" data-toggle="tooltip" data-placement="top" title="Pulang">
                          P
                        </th>
                      @endif
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ($staf as $staf)
                      <tr>
                        <td class="border-dark">{{ $loop->iteration }}</td>
                        <td class="border-dark">{{ $staf->user->name }}</td>
                        <td class="border-dark">{{ $staf->nip .''. $staf->nuptk }}</td>
                        <td class="border-dark">{{ $staf->user->jk == 'laki-laki' ? 'L' : 'P' }}</td>
                        @foreach ($tanggals as $tanggal)
                          @if (Str::before(Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y'), ',') == 'Minggu')
                            <td class="border-dark bg-danger min-w-30" data-toggle="tooltip" data-placement="top" data-title="Libur Hari Minggu">

                            </td>
                            <td class="border-dark bg-danger min-w-30" data-toggle="tooltip" data-placement="top" data-title="Libur Hari Minggu">

                            </td>
                          @elseif ($libur->pluck('tanggal')->contains($tanggal))
                            <td class="border-dark bg-danger min-w-30" data-toggle="tooltip" data-placement="top" data-title="{{ $libur->firstWhere('tanggal', $tanggal)->keterangan }}">

                            </td>
                            <td class="border-dark bg-danger min-w-30" data-toggle="tooltip" data-placement="top" data-title="{{ $libur->firstWhere('tanggal', $tanggal)->keterangan }}">

                            </td>
                          @else

                            @if (in_array($tanggal, $absens->pluck('tanggal')->toArray()))

                              @php
                                $absMasuk = $absens->where('tanggal', $tanggal)->where('staf_id', $staf->id)->where('type', 'masuk')->first() ?? [];
                                $ketMasuk = $absMasuk->status ?? '';
                              @endphp
                              @if ($ketMasuk != '')
                                <td class="border-dark text-center align-middle status-hadir"
                                    data-name="{{ $staf->user->name }}"
                                    data-type="Absen Masuk"
                                    data-tanggal="{{ date('d-m-Y', strtotime($tanggal)) }}"
                                    data-created-at="{{ $absMasuk->created_at->format('d-m-Y, H:i') }}"
                                    data-status="{{ $absMasuk->status }}"
                                >
                                  <span class="badge text-uppercase text-white bg-{{ $ketMasuk }}">{{ $ketMasuk }}</span>
                                </td>
                              @else
                                <td class="border-dark">
                                </td>
                              @endif

                              @php
                                $absPulang = $absens->where('tanggal', $tanggal)->where('staf_id', $staf->id)->where('type', 'pulang')->first() ?? [];
                                $ketPulang = $absPulang->status ?? '';
                              @endphp
                              @if ($ketPulang != '')
                                <td class="border-dark text-center align-middle status-hadir"
                                    data-name="{{ $staf->user->name }}"
                                    data-type="Absen Pulang"
                                    data-tanggal="{{ date('d-m-Y', strtotime($tanggal)) }}"
                                    data-created-at="{{ $absPulang->created_at->format('d-m-Y, H:i') }}"
                                    data-status="{{ $absPulang->status }}"
                                >
                                  <span class="badge text-uppercase text-white bg-{{ $ketPulang }}">{{ $ketPulang }}</span>
                                </td>
                              @else
                                <td class="border-dark">
                                </td>
                              @endif

                            @else
                              <td class="border-dark">
                              </td>
                              <td class="border-dark">
                              </td>
                            @endif

                          @endif
                        @endforeach
                        <td class="border-dark text-center align-middle">{{ $absens->where('staf_id', $staf->id)->where('status', 'h')->count() }}</td>
                        <td class="border-dark text-center align-middle">{{ $absens->where('staf_id', $staf->id)->where('status', 's')->count() }}</td>
                        <td class="border-dark text-center align-middle">{{ $absens->where('staf_id', $staf->id)->where('status', 'i')->count() }}</td>
                        <td class="border-dark text-center align-middle">{{ $absens->where('staf_id', $staf->id)->where('status', 'a')->count() }}</td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

<div class="modal fade text-left" id="modal-tanggal">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fw-bold">Absensi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <table>
                <td><b>Tanggal</b></td>
                <td>:</td>
                <td style="padding-left: 10px" id="show-absen-tanggal-pretty"></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer justify-content-between">
            <a href="" class="btn btn-primary" id="btn-absen-masuk">Input Absen Masuk</a>
            <a href="" class="btn btn-primary" id="btn-absen-pulang">Input Absen Pulang</a>
        </div>
      </div>
  </div>
</div>

<div class="modal fade text-left" id="modal-status-hadir">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fw-bold">Status Kehadiran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <table>
              <tr>
                <td><b>Nama Staf</b></td>
                <td>:</td>
                <td style="padding-left: 10px" id="show-kehadiran-name"></td>
              </tr>
              <tr>
                <td><b>Jenis Absen</b></td>
                <td>:</td>
                <td style="padding-left: 10px" id="show-kehadiran-type"></td>
              </tr>
              <tr>
                <td><b>Tanggal</b></td>
                <td>:</td>
                <td style="padding-left: 10px" id="show-kehadiran-tanggal"></td>
              </tr>
              <tr>
                <td><b>Absen Pada</b></td>
                <td>:</td>
                <td style="padding-left: 10px" id="show-kehadiran-created-at"></td>
              </tr>
              <tr>
                <td><b>Status</b></td>
                <td>:</td>
                <td style="padding-left: 10px" id="show-kehadiran-status"></td>
              </tr>
            </table>
          </div>
      </div>
  </div>
</div>

@endsection

@section('js')
<script>
  $('.status-hadir').on('click', function(){
    $('#modal-status-hadir').modal('show');
    $('#show-kehadiran-name').html($(this).data('name'));
    $('#show-kehadiran-type').html($(this).data('type'));
    $('#show-kehadiran-tanggal').html($(this).data('tanggal'));
    $('#show-kehadiran-created-at').html($(this).data('created-at'));

    let status = ($(this).data('status'));
    if (status == 'h') {
      var ket = 'Hadir';
    } else if (status == 's') {
      var ket = 'Sakit';
    } else if (status == 'i') {
      var ket = 'Izin';
    } else if (status == 'a') {
      var ket = 'Alfa';
    } else {
      var ket = '';
    }
    $('#show-kehadiran-status').html(ket);
  });

  $('.tanggal-absensi').on('click', function(){
    $('#show-absen-tanggal-pretty').html($(this).data('tanggal-pretty'));
    $('#btn-absen-masuk').attr('href', '/absensi/admin/masuk/' + $(this).data('tanggal'));
    $('#btn-absen-pulang').attr('href', '/absensi/admin/pulang/' + $(this).data('tanggal'));
    $('#modal-tanggal').modal('show');
  });
</script>
@endsection
