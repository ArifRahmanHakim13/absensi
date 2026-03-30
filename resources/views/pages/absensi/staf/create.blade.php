@extends('layouts.main')

@section('css')

<style>
  #preview{
    z-index: 1;
    /* height: 500px; */
    /* width: 500px; */
    /* margin: 0px auto; */
  }

  /* .card{
    display: grid;
    grid-template-columns: 500px;
    grid-template-rows: 500px;
    background: white;
  } */

  /* .card .wrapper{
    background-image: url('https://i.hizliresim.com/p6gcx5c.png');
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 10px;

  } */

  .wrapper .scanner{
    animation-play-state: running;
    z-index: 2;
  }

  .scanner {
    width: 100%;
    height: 3px;
    background-color: red;
    opacity: 0.7;
    position: relative;
    box-shadow: 0px 0px 8px 10px rgba(170, 11, 23, 0.49);
    top: 50%;
    animation-name: scan;
    animation-duration: 4s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    animation-play-state: paused;
  }

  @keyframes scan {
    0%{
      box-shadow: 0px 0px 8px 10px rgba(170, 11, 23, 0.49);
      top: 50%;
    }

    25%{
      box-shadow: 0px 6px 8px 10px rgba(170, 11, 23, 0.49);
      top: 5px;
    }

    75%{
      box-shadow: 0px -6px 8px 10px rgba(170, 11, 23, 0.49);
      top: 98%;
    }
  }
</style>

@endsection

@section('content')

{{-- Header --}}
<x-content-header :title="'Absensi'" :btnBack="true" :redirect="'/absensi/staf'"></x-content-header>

{{-- Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        @if ($tapel->count() < 1)
          <div class="card">
            <div class="card-body">
              <div class="p-3">
                Tahun belum ada yang diaktifkan! <a href="{{ route('tapel.index') }}">Aktifkan Tahun </a>
              </div>
            </div>
          </div>
        @else
        <div class="card">
          <div class="card-header">
            <div class="callout callout-warning my-1">
              <div class="row">
                  <div class="col">
                      <div class="row">
                        <div class="table-responsive">
                          <table class="table-borderless">
                            <tr>
                              <td class="fw-bold">Nama</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Tahun</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ $tapel->tahun }}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Periode</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ $tapel->periode() }}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Tanggal</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td>{{ date('d-m-Y', strtotime($tanggal)) }}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Jenis Absen</td>
                              <td style="width: 1px" class="px-2">:</td>
                              <td class="text-capitalize">Absen {{ $type }}</td>
                            </tr>
                          </table>
                        </div>

                      </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col">
                <div class="text-center fw-bold">
                  ARAHKAN QR CODE KE KAMERA !!!
                </div>
                <div class="text-center mt-2">
                  <button id="switch-camera" class="btn btn-secondary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                      <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                    </svg>
                    <span style="padding-left: 4px"> Ganti Kamera</span>
                  </button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <div class="info-box">
                  <div class="info-box-content p-0" style="width: 300px; height: 300px">

                    <div class="wrapper">
                      <div class="scanner"></div>
                      <video id="preview"></video>
                    </div>

                    <form action="{{ route('absensi.staf.store', [$tanggal, $type]) }}" method="POST" id="formscan">
                    @csrf
                      <input type="hidden" name="idt" id="idt">
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')
<script type="text/javascript" src="/customize/instacam.js"></script>
<script type="text/javascript">

  let cameras = [];
  let activeCameraIndex = 0;

  function isMobile(){
    return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
  }

  function updateMirror(){
    const isFrontCamera = cameras[activeCameraIndex].name.toLowerCase().includes('front');
    if (isMobile()) {
      scanner.mirror = isFrontCamera;
    } else {
      scanner.mirror = isFrontCamera;
    }
  }

  function selectInitialCamera(){
    if (isMobile()) {
      activeCameraIndex = cameras.findIndex(camera => camera.name.toLowerCase().includes('back'));
      if (activeCameraIndex === -1) {
        activeCameraIndex = 0;
      }
    }
  }

  let scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    mirror: false
  });

  scanner.addListener('scan', function (content) {
    console.log(content);
    document.getElementById('idt').value = content;
    document.getElementById('formscan').submit();
  });

  Instascan.Camera.getCameras().then(function (availableCameras) {
    if (availableCameras.length > 0) {
      cameras = availableCameras;
      selectInitialCamera();
      updateMirror();
      scanner.start(cameras[activeCameraIndex]);
    } else {
      console.error('Kamera tidak ditemukan.');
    }
  }).catch(function (e) {
    console.error(e);
  });

  document.getElementById('switch-camera').addEventListener('click', function(){
    activeCameraIndex = (activeCameraIndex + 1) % cameras.length;
    updateMirror();
    scanner.start(cameras[activeCameraIndex]);
  });

  // scanner.addListener('scan', function(c){
  //   // alert('oke');
  //   document.getElementById('idt').value = c;
  //   document.getElementById('formscan').submit();
  // });
</script>
@endsection
