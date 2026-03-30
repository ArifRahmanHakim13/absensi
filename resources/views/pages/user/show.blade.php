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
            <h3 class="card-title pt-1">Detail Data User</h3>
            <div class="float-right">
              <a href="{{ route('user.edit', $user) }}" class="btn btn-warning text-dark btn-sm">
                <i class="fas fa-pencil-alt pe-1">
                </i>
                Detail Data
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="/img/profile.jpg"
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center mb-5">{{ $user->name }}</h3>

            <div class="table-responsive">
              <table class="table table-sm table-hover">
                  <tr class="border-bottom">
                    <td class="fw-bold">Status Akun</td>
                    <td style="width: 1px;">:</td>
                    <td class="">
                      <span class="badge bg-success">
                        AKTIF
                      </span>
                    </td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="fw-bold">Email</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $user->email ?? '-' }}</td>
                  </tr>
                  <tr class="border-bottom">
                    <td class="fw-bold">Username</td>
                    <td style="width: 1px;">:</td>
                    <td class="">{{ $user->username ?? '-' }}</td>
                  </tr>
              </table>
          </div>

          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')

@endsection
