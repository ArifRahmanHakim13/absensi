@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<x-content-header 
    :title="'Data Kepala Puskesmas'" 
    :btnBack="true" 
    :redirect="'/kapus'"
/>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">

        <div class="card card-secondary">

          <div class="card-header align-items-center d-flex justify-content-between">
            <h3 class="card-title pt-1 m-0">Tambah Data Kepala Puskesmas</h3>

            <button class="btn btn-light btn-sm rounded-pill"
                data-toggle="popover"
                data-trigger="focus"
                title="Informasi"
                data-placement="left"
                data-content="* Merupakan kolom yang wajib diisi.">
              <i class="fa fa-info"></i>
            </button>
          </div>

          {{-- FORM --}}
          <form class="form-horizontal" action="{{ route('kapus.store') }}" method="POST">
            @csrf

            <div class="card-body">

              {{-- 🔥 pastikan file ini TIDAK ada input nuptk --}}
              @include('pages.kapus._createform')

            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-outline-info float-right">Reset</button>
            </div>

          </form>

        </div>

      </div>
    </div>
  </div>
</section>

@endsection

@section('js')
@endsection
