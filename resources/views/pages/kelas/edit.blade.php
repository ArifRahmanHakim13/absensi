@extends('layouts.main')

@section('css')

@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Data Kelas'" :btnBack="true" :redirect="'/kelas'"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-secondary">
          <div class="card-header align-items-center">
            <h3 class="card-title pt-1">Edit Data Kelas</h3>
            <div class="float-right py-0">
              <button class="btn btn-light btn-sm rounded-pill" data-toggle="popover" data-trigger="focus" title="Informasi" data-placement="left" data-content="* Merupakan kolom yang wajib diisi."><i class="fa fa-info"></i></button>
            </div>
          </div>

          <form class="form-horizontal" action="{{ route('kelas.update', $kelas) }}" method="POST">
          @csrf
          @method('PUT')

            <div class="card-body">

              @include('pages.kelas._editform')

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
