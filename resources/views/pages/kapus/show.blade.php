@extends('layouts.main')

@section('css')

@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Data Kepala Sekolah'" :btnBack="true" :redirect="'/kapus'"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-secondary">
          <div class="card-header align-items-center">
            <h3 class="card-title pt-1">Detail Data Kepala Sekolah</h3>
            <div class="float-right">
              <a href="{{ route('kapus.edit', $kapus) }}" class="btn btn-warning text-dark btn-sm">
                <i class="fas fa-pencil-alt pe-1"></i>
                Edit Data
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="/img/fotoprofil/{{ $kapus->user->foto }}"
                   alt="{{ $kapus->user->name }}">
            </div>

            <h3 class="profile-username text-center mb-5">{{ $kapus->user->name }}</h3>

            <div class="table-responsive">
              <table class="table table-sm table-hover">
                  {{-- <tr class="border-bottom">
                    <td class="fw-bold">Email</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $kapus->user->email ?? '-' }}</td>
                  </tr> --}}
                  <tr class="border-bottom">
                    <td class="fw-bold">ID</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $kapus->nip ?? '-' }}</td>
                  </tr>
                  <!-- <tr class="border-bottom">
                    <td class="fw-bold">NUPTK</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $kapus->nuptk ?? '-' }}</td>
                  </tr> -->
                  <tr class="border-bottom">
                    <td class="fw-bold">Jenis Kelamin</td>
                    <td style="width: 1px;">:</td>
                    <td class="text-capitalize">{{ $kapus->user->jk ?? '-' }}</td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="fw-bold">Telepon/WA</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $kapus->user->telepon ?? '-' }}</td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="fw-bold">Alamat</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $kapus->user->alamat ?? '-' }}</td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="fw-bold">Username</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $kapus->user->username ?? '-' }}</td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')

@endsection
