@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Rekapitulasi Absensi'" :btnBack="false"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        @if ($tapel->count() < 1)
          <div class="card">
            <div class="card-body">
              <div class="p-3">
                Tahun belum ada yang diaktifkan!
                @can('admin')
                  <a href="{{ route('tapel.index') }}">Aktifkan Tahun</a>
                @endcan
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

                  {{-- PERIODE DIKOMEN --}}
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
            <form action="{{ route('rekapitulasi.print') }}" method="GET" target="_blank">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jenis" class="required">Jenis Rekapitulasi</label>
                    <select name="jenis" id="jenis"
                      class="form-control @error('jenis') is-invalid @enderror" required>
                      <option value="" disabled selected hidden>-- Pilih --</option>
                      <option value="perbulan">Pilih Bulan</option>

                      {{-- OPSI PERTAHUN DIKOMEN AGAR TIDAK TERLIHAT --}}
                      {{--
                      <option value="periode">Pertahun</option>
                      --}}
                    </select>
                    @error('jenis')
                      <span class="invalid-feedback mt-1">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6 d-none" id="yearmonth-col">
                  <div class="form-group">
                    <label for="yearmonth" class="required">Bulan</label>
                    <select name="yearmonth" id="yearmonth"
                      class="form-control @error('yearmonth') is-invalid @enderror">
                      <option value="" disabled selected hidden>-- Pilih --</option>
                      @foreach ($months as $item)
                        <option value="{{ $item->ym }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                    @error('yearmonth')
                      <span class="invalid-feedback mt-1">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-download"></i>
                    Download Rekapitulasi
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')
<script>
  $(document).ready(function(){
    $('#jenis').on('change', function(){
      ymToggle();
    });

    function ymToggle(){
      var jenis = $('#jenis').val();
      if (jenis === 'perbulan') {
        $('#yearmonth').attr('required', true);
        $('#yearmonth-col').removeClass('d-none');
      } else {
        $('#yearmonth').removeAttr('required');
        $('#yearmonth').val('');
        $('#yearmonth-col').addClass('d-none');
      }
    }
  });
</script>
@endsection
