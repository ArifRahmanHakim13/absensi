@extends('layouts.main')

@section('css')

@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Data User'" :btnBack="true" :redirect="'/user'"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header align-items-center">
            <h3 class="card-title pt-1">Edit Data User</h3>
            <div class="float-right py-0">
              <button class="btn btn-light btn-sm rounded-pill" data-toggle="popover" data-trigger="focus" title="Informasi" data-placement="left" data-content="* Merupakan kolom yang wajib diisi."><i class="fa fa-info"></i></button>
            </div>
          </div>

          <form class="form-horizontal" action="{{ route('user.update', $user) }}" method="POST">
          @csrf
          @method('PUT')

            <div class="card-body">

              @include('pages.user._editform')

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="confirm" required>
                    <label class="form-check-label" for="confirm">Saya yakin sudah mengisi dengan benar</label>
                  </div>
                </div>
              </div>

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
