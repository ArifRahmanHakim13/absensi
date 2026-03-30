<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
    @if ($jenis == 'perbulan')
      REKAPITULASI ABSENSI {{ $sekolah->name }} - {{ $namabulan }}
    @else
      REKAPITULASI ABSENSI {{ $sekolah->name }} - Tahun {{ $tapel->tahun }}
      {{-- Periode {{ $tapel->periode() }} --}}
    @endif
  </title>
  <style>
    .fw-bold{ font-weight: bold; }
    .align-middle{ align-content: center; }
    .text-center{ text-align: center; }
  </style>
</head>

<body style="font-family: 'Times New Roman'; font-size: 14px">

<div class="row" style="padding: 30px">
  <div class="text-center">
    <h3 class="fw-bold mb-1">REKAPITULASI ABSENSI</h3>
    <h3 class="fw-bold">{{ $sekolah->name }}</h3>
    <p>{{ $sekolah->alamat }}</p>
    <hr />
  </div>

  <div class="col-12">
    <table class="table-sm" border="0" cellspacing="1">
      <tr>
        <td class="fw-bold">Tahun</td>
        <td>:</td>
        <td>{{ $tapel->tahun }}</td>
      </tr>

      {{-- PERIODE DI NONAKTIFKAN (HANYA TAMPILAN, AMAN) --}}
      {{--
      <tr>
        <td class="fw-bold">Periode</td>
        <td>:</td>
        <td>{{ $tapel->periode() }}</td>
      </tr>
      --}}

      <tr>
        <td class="fw-bold">Jenis Rekapitulasi</td>
        <td>:</td>
        <td>{{ $jenis }}</td>
      </tr>

      @if ($jenis == 'perbulan')
        <tr>
          <td class="fw-bold">Bulan</td>
          <td>:</td>
          <td>{{ $namabulan }}</td>
        </tr>
      @else
        <tr>
          <td class="fw-bold">Tanggal</td>
          <td>:</td>
          <td>{{ $tapel->mulai() }} - {{ $tapel->selesai() }}</td>
        </tr>
      @endif
    </table>
    <hr />
  </div>

  <div class="section-body" style="margin-top: 30px">
    <table class="table table-sm table-bordered" border="1" cellspacing="0" style="width:100%">
      <thead>
        <tr>
          <td rowspan="3" class="text-center fw-bold">No</td>
          <td rowspan="3" class="text-center fw-bold">ID</td>
          <td rowspan="3" class="text-center fw-bold">Nama Staf</td>
          <td rowspan="3" class="text-center fw-bold">L/P</td>
          <td colspan="8" class="text-center fw-bold">Jumlah</td>
        </tr>
        <tr>
          <td colspan="4" class="text-center fw-bold">Masuk</td>
          <td colspan="4" class="text-center fw-bold">Pulang</td>
        </tr>
        <tr>
          @for ($i = 0; $i < 2; $i++)
            <td class="text-center fw-bold">H</td>
            <td class="text-center fw-bold">S</td>
            <td class="text-center fw-bold">I</td>
            <td class="text-center fw-bold">A</td>
          @endfor
        </tr>
      </thead>

      <tbody>
        @foreach ($staf as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->nip }}  {{ $item->nuptk }}</td>
          <td>{{ $item->user->name }}</td>
          <td class="text-center">{{ $item->user->jk == 'laki-laki' ? 'L' : 'P' }}</td>

          @foreach (['masuk', 'pulang'] as $type)
            @foreach (['h','s','i','a'] as $st)
              @php
                $count = $absens->where('staf_id', $item->id)
                                ->where('type', $type)
                                ->where('status', $st)
                                ->count();
              @endphp
              <td class="text-center">{{ $count ?: '' }}</td>
            @endforeach
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  window.onload = function() {
    var style = document.createElement('style');
    style.innerHTML = '@media print { @page { size: landscape; } }';
    document.head.appendChild(style);
    window.print();
  }
</script>

</body>
</html>
