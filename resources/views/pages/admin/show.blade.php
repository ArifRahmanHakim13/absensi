@extends('layouts.main')

@section('css')

@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Data Admin'" :btnBack="true" :redirect="'/admin'"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-secondary">
          <div class="card-header align-items-center">
            <h3 class="card-title pt-1">Detail Data Admin</h3>
            <div class="float-right">
              <a href="{{ route('admin.edit', $admin) }}" class="btn btn-warning text-dark btn-sm">
                <i class="fas fa-pencil-alt pe-1"></i>
                Edit Data
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="/img/fotoprofil/{{ $admin->user->foto }}"
                   alt="{{ $admin->user->name }}">
            </div>

            <h3 class="profile-username text-center mb-5">{{ $admin->user->name }}</h3>

            <div class="table-responsive">
              <table class="table table-sm table-hover">
                  {{-- <tr class="border-bottom">
                    <td class="fw-bold">Email</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $admin->user->email ?? '-' }}</td>
                  </tr> --}}
                  <tr class="border-bottom">
                    <td class="fw-bold">Jenis Kelamin</td>
                    <td style="width: 1px;">:</td>
                    <td class="text-capitalize">{{ $admin->user->jk ?? '-' }}</td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="fw-bold">Telepon/WA</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $admin->user->telepon ?? '-' }}</td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="fw-bold">Alamat</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $admin->user->alamat ?? '-' }}</td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="fw-bold">Username</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $admin->user->username ?? '-' }}</td>
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
