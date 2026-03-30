@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Data User'" :btnBack="false"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('user.create') }}" class="btn btn-sm float-left btn-primary btn-icon-split">
              <i class="fa fa-plus"></i>
              Tambah User
            </a>
            <button class="btn btn-sm float-right btn-info btn-icon-split" data-toggle="modal" data-target="#modal-filter">
              <i class="fa fa-filter me-2"></i>
              Filter Data
            </button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($user->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover fs-14 mb-0 {{ Auth::user()->dark_mode == '1' ? 'bg-light' : '' }}">
                  <thead>
                  <tr class="bg-dark text-white">
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                      @foreach ($user as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->role }}</td>
                          <td class="project-actions">
                            <div class="btn-group">
                              <a class="btn btn-success btn-sm mx-1" href="{{ route('user.show', $item) }}" data-toggle="tooltip" data-placement="top" title="Show">
                                  <i class="fas fa-eye"> </i>
                                  {{-- Show --}}
                              </a>
                              <a class="btn btn-warning btn-sm mx-1" href="{{ route('user.edit', $item) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                  <i class="fas fa-pencil-alt"> </i>
                                  {{-- Edit --}}
                              </a>
                              <button type="button" class="btn btn-danger btn-delete btn-sm mx-1" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                  <i class="fas fa-trash"> </i>
                                  {{-- Delete --}}
                              </button>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            @endif
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade text-left" id="modal-delete">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fw-bold" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            Data User:
            <p class="text-primary fw-bold" id="delete-name"></p>
            Apakah anda yakin data tersebut akan dihapus?
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
            <form action="" method="POST" class="d-inline float-end" id="form-delete">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </div>
      </div>
  </div>
</div>

@include('pages.user._filter')

@endsection

@section('js')
<script>
  $('.btn-delete').on('click', function(){
    $('#delete-name').html($(this).data('name'));
    $('#form-delete').attr('action', '/user/' + $(this).data('id'));
    $('#modal-delete').modal('show');
  });
</script>
@endsection
