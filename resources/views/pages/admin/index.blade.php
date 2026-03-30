@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Data Admin'" :btnBack="false"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('admin.create') }}" class="btn btn-sm float-left btn-primary btn-icon-split">
              <i class="fa fa-plus"></i>
              Tambah Admin
            </a>
          </div>
          <div class="card-body">
            @if ($admin->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover fs-14 mb-0">
                  <thead>
                  <tr class="bg-dark text-white">
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">L/P</th>
                    <th scope="col">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                      @foreach ($admin as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->user->name }}</td>
                          <td>{{ $item->user->jk == 'laki-laki' ? 'L' : 'P' }}</td>
                          <td class="project-actions">
                            <div class="btn-group">
                              <a class="btn btn-success btn-sm mx-1" href="{{ route('admin.show', $item) }}" data-toggle="tooltip" data-placement="top" title="Show">
                                  <i class="fas fa-eye"> </i>
                                  {{-- Show --}}
                              </a>
                              <a class="btn btn-warning btn-sm mx-1" href="{{ route('admin.edit', $item) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                  <i class="fas fa-pencil-alt"> </i>
                                  {{-- Edit --}}
                              </a>
                              <button type="button" class="btn btn-danger btn-delete btn-sm mx-1" data-toggle="tooltip" data-placement="top" title="Delete" data-id="{{ $item->id }}" data-name="{{ $item->user->name }}" >
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
            Data Admin:
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

@endsection

@section('js')
<script>
  $('.btn-delete').on('click', function(){
    $('#delete-name').html($(this).data('name'));
    $('#form-delete').attr('action', '/admin/' + $(this).data('id'));
    $('#modal-delete').modal('show');
  });
</script>
@endsection
