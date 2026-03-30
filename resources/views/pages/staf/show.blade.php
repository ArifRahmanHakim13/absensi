@extends('layouts.main')

@section('css')
@endsection

@section('content')
    {{-- Header --}}
    <x-content-header :title="'Data Staf'" :btnBack="true" :redirect="'/staf'"></x-content-header>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                {{-- ===================== --}}
                {{-- DATA STAF --}}
                {{-- ===================== --}}
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title pt-1">Detail Data Staf</h3>
                            <div class="float-right">
                                <a href="{{ route('staf.edit', $staf) }}" class="btn btn-warning text-dark btn-sm">
                                    <i class="fas fa-pencil-alt pe-1"></i>
                                    Edit Data
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="/img/fotoprofil/{{ $staf->user->foto }}"
                                     alt="{{ $staf->user->name }}">
                            </div>

                            <h3 class="profile-username text-center mb-5">
                                {{ $staf->user->name }}
                            </h3>

                            <div class="table-responsive">
                                <table class="table table-sm table-hover">

                                    {{-- <tr class="border-bottom">
                                        <td class="fw-bold">Email</td>
                                        <td style="width: 1px;">:</td>
                                        <td>{{ $staf->user->email ?? '-' }}</td>
                                    </tr> --}}

                                    <tr class="border-bottom">
                                        <td class="fw-bold">ID</td>
                                        <td style="width: 1px;">:</td>
                                        <td>{{ $staf->nip ?? '-' }}</td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="fw-bold">Jabatan</td>
                                        <td style="width: 1px;">:</td>
                                        <td>{{ $staf->user->jabatan ?? '-' }}</td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="fw-bold">Jenis Kelamin</td>
                                        <td style="width: 1px;">:</td>
                                        <td class="text-capitalize">{{ $staf->user->jk ?? '-' }}</td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="fw-bold">Telepon/WA</td>
                                        <td style="width: 1px;">:</td>
                                        <td>{{ $staf->user->telepon ?? '-' }}</td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="fw-bold">Alamat</td>
                                        <td style="width: 1px;">:</td>
                                        <td>{{ $staf->user->alamat ?? '-' }}</td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="fw-bold">Username</td>
                                        <td style="width: 1px;">:</td>
                                        <td>{{ $staf->user->username ?? '-' }}</td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- QR CODE / BARCODE (DISEMBUNYIKAN DENGAN KOMENTAR) --}}
                {{-- ================================================= --}}
                {{--
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <div class="float-left pt-1">
                                QR Code (Barcode Global)
                            </div>
                            <div class="float-right">
                                <a href="/staf/{{ $staf->id }}?download=qrcode"
                                   class="btn btn-sm btn-primary"
                                   target="_blank">
                                    <i class="fa fa-download"></i>
                                    Download
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="text-center">
                                @if($barcode)
                                    {!! QrCode::size(300)->generate($barcode->code) !!}
                                @else
                                    <p class="text-danger">Barcode belum tersedia.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                --}}

            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
