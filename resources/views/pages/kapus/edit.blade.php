@extends('layouts.main')

@section('css')
@endsection

@section('content')

{{-- Header --}}
<x-content-header 
    :title="'Data Kepala Puskesmas'" 
    :btnBack="true" 
    :redirect="'/kapus'"
/>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">

                <div class="card card-secondary">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Edit Data Kepala Puskesmas</h3>

                        <button class="btn btn-light btn-sm rounded-pill"
                            data-toggle="popover"
                            data-trigger="focus"
                            title="Informasi"
                            data-placement="left"
                            data-content="* Merupakan kolom yang wajib diisi.">
                            <i class="fa fa-info"></i>
                        </button>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('kapus.update', $kapus->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            {{-- Safe include: tidak error meski ada field yang hilang --}}
                            @includeWhen(
                                View::exists('pages.kapus._editform'), 
                                'pages.kapus._editform', 
                                ['kapus' => $kapus]
                            )

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
