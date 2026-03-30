@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Data Pertahun'" :btnBack="false"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('tapel.create') }}" class="btn btn-sm float-left btn-primary btn-icon-split">
              <i class="fa fa-plus"></i>
              Tambah Pertahun
            </a>
          </div>
          <div class="card-body">
            @if ($tapel->count() < 1)
              Data masih kosong!
            @else
              <div class="table-responsive">
                <table id="myTable" class="table table-sm table-hover fs-14 mb-0">
                  <thead>
                  <tr class="bg-dark text-white">
                    <th scope="col">No</th>
                    <th scope="col">Tahun</th>

                    {{-- PERIODE DI NONAKTIFKAN (AMAN, HANYA TAMPILAN) --}}
                    {{--
                    <th scope="col">Periode</th>
                    --}}

                    <th scope="col">Mulai</th>
                    <th scope="col">Selesai</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($tapel as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->tahun }}</td>

                          {{-- PERIODE DI NONAKTIFKAN (AMAN, HANYA TAMPILAN) --}}
                          {{--
                          <td>{{ $item->periode == '1' ? 'Periode I' : 'Periode II' }}</td>
                          --}}

                          <td>{{ date('d-m-Y', strtotime($item->mulai)) }}</td>
                          <td>{{ date('d-m-Y', strtotime($item->selesai)) }}</td>
                          <td>
                            @if ($item->is_aktif == '1')
                              <span class="badge bg-success"> AKTIF </span>
                            @else
                              <span class="badge bg-danger"> NON-AKTIF </span>
                            @endif
                          </td>
                          <td class="project-actions">
                            <div class="btn-group">
                              <a class="btn btn-warning btn-sm mx-1"
                                 href="{{ route('tapel.edit', $item) }}"
                                 data-toggle="tooltip"
                                 title="Edit">
                                  <i class="fas fa-pencil-alt"></i>
                              </a>
                              <button type="button"
                                      class="btn btn-danger btn-delete btn-sm mx-1"
                                      data-toggle="tooltip"
                                      title="Delete"
                                      data-id="{{ $item->id }}"
                                      data-name="{{ $item->tahun }}">
                                  <i class="fas fa-trash"></i>
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
              <h5 class="modal-title fw-bold">Konfirmasi Hapus Data</h5>
              <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
            Data Pertahun:
            <p class="text-primary fw-bold" id="delete-name"></p>
            Apakah anda yakin data tersebut akan dihapus?
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
            <form action="" method="POST" id="form-delete">
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
    $('#form-delete').attr('action', '/tapel/' + $(this).data('id'));
    $('#modal-delete').modal('show');
  });
</script>
@endsection
