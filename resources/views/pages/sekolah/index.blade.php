@extends('layouts.main')

@section('css')
@endsection

@section('content')
    {{-- Header --}}
    <x-content-header :title="'Data Puskesmas'" :btnBack="false"></x-content-header>

    {{-- Content --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <div class="card-title">Edit Data Puskesmas</div>
                        </div>
                        <div class="card-body">
                            @include('pages.sekolah._editdata')
                        </div>
                        <div class="card-footer justify-content-between">
                            <div class="checkbox d-inline">
                                <label> <input type="checkbox" id="update-data-confirm" required> Saya yakin akan mengubah
                                    data tersebut </label>
                            </div>
                            <button type="submit" class="btn btn-primary float-right"
                                id="update-data-button">Simpan</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <div class="card-title">Edit Logo Puskesmas</div>
                        </div>
                        <div class="card-body">
                            @include('pages.sekolah._editlogo')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')
    @include('partials.toast2');
    @include('pages.sekolah.script');
@endsection
