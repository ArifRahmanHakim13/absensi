@extends('layouts.main')

@section('css')
<style>
</style>
@endsection

@section('content')

@php
    use Carbon\Carbon;
@endphp

{{-- Header --}}
<x-content-header :title="'Kelola Absensi ' . $type" :btnBack="true" :redirect="$redirect"></x-content-header>

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

                  {{-- 🔕 PERIODE DISEMBUNYIKAN (AMAN) --}}
                  {{--
                  <tr>
                    <td class="fw-bold">Periode</td>
                    <td class="px-2">:</td>
                    <td>{{ $tapel->periode() }}</td>
                  </tr>
                  --}}

                  <tr>
                    <td class="fw-bold">Jenis Absen</td>
                    <td class="px-2">:</td>
                    <td class="text-capitalize">Absen {{ $type }}</td>
                  </tr>

                  <tr>
                    <td class="fw-bold">Hari, Tanggal</td>
                    <td class="px-2">:</td>
                    <td>
                      {{ Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="card-body">
            @if ($staf->count() < 1)
              <div class="p-3">Belum ada data staf!</div>
            @else

            <form action="{{ route('absensi.admin.store', [$type, $tanggal]) }}" method="POST">
              @csrf
              <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped border-dark">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th>No</th>
                      <th>ID</th>
                      <th>Nama Staf</th>
                      <th>L/P</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($staf as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nip }}/{{ $item->nuptk }}</td>
                        <td>
                          <input type="hidden" name="staf_id[]" value="{{ $item->id }}">
                          {{ $item->user->name }}
                        </td>
                        <td class="text-center">
                          {{ $item->user->jk == 'laki-laki' ? 'L' : 'P' }}
                        </td>
                        <td>
                          <select name="status[]" class="form-control">
                            <option value=""></option>
                            <option value="h" {{ optional($absen->where('staf_id',$item->id)->where('tanggal',$tanggal)->first())->status=='h'?'selected':'' }}>Hadir</option>
                            <option value="s" {{ optional($absen->where('staf_id',$item->id)->where('tanggal',$tanggal)->first())->status=='s'?'selected':'' }}>Sakit</option>
                            <option value="i" {{ optional($absen->where('staf_id',$item->id)->where('tanggal',$tanggal)->first())->status=='i'?'selected':'' }}>Izin</option>
                            <option value="a" {{ optional($absen->where('staf_id',$item->id)->where('tanggal',$tanggal)->first())->status=='a'?'selected':'' }}>Alpa</option>
                          </select>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <button type="submit" class="btn btn-success float-right">Simpan</button>
              <div class="float-right me-3 mt-2">
                <input type="checkbox" required> Saya yakin akan mengubah data tersebut
              </div>
            </form>

            @endif
          </div>
        </div>

        @endif
      </div>
    </div>
  </div>
</section>
@endsection
