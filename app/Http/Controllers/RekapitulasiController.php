<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Staf;
use App\Models\Libur;
use App\Models\Sekolah;
use App\Models\Tapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RekapitulasiController extends Controller
{
  public function index() {
    $tapel = Tapel::where('is_aktif', 1)->exists() ? Tapel::where('is_aktif', 1)->first() : collect([]);

    if ($tapel->count() > 0) {

      $mulai = $tapel->mulai;
      $selesai = $tapel->selesai;

      $startDate = Carbon::createFromFormat('Y-m-d', $mulai)->startOfMonth();
      $endDate = Carbon::createFromFormat('Y-m-d', $selesai)->endOfMonth();

      $bulanCollection = new Collection();

      while ($startDate->lessThanOrEqualTo($endDate)) {
        $bulanCollection->push((object)[
            'ym' => $startDate->format('Y-m'), // example: 2024-01
            'name' => $startDate->translatedFormat('F Y') // example: Januari 2024
        ]);
        $startDate->addMonth();
      }
      $months = $bulanCollection;

    } else {
      $months = collect([]);
    }

    return view('pages.rekapitulasi.index',[
      'tapel' => $tapel,
      'months' => $months
    ]);
  }

  public function print(Request $request) {
    $tapel = Tapel::where('is_aktif', 1)->firstOrFail();
    $tglLibur = Libur::pluck('tanggal');

    if ($request->jenis == 'perbulan') {

      list($year, $month) = explode('-', $request->yearmonth); // pisahin bulan dan tahun
      $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth(); // cek tanggal awal bulan ini
      $endDate = $startDate->copy()->endOfMonth(); // cek tanggal akhir bulan ini
      $datesInMonth = []; // buat wadah tanggal

      $startDateOfMonth = $startDate->copy(); // get tanggal awal bulan ini

      while ($startDate->lessThanOrEqualTo($endDate)) { // loop tanggal diantara awal dan akhir bulan
          $datesInMonth[] = $startDate->toDateString();
          $startDate->addDay(); // Tambah 1 hari
      }

      $tanggalDiBulanIni = $datesInMonth; // regenerate nama array
      $namaBulan = Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y'); // get nama bulan, exm: Januari 2024


      // get data absen di bulan ini
      $absens = Absen::whereBetween('tanggal', [$startDateOfMonth, $endDate])
                     ->where('tapel_id', $tapel->id)
                     ->whereNotIn('tanggal', $tglLibur)
                     ->get();

    } else {
      $absens = Absen::whereBetween('tanggal', [$tapel->mulai, $tapel->selesai])
                     ->where('tapel_id', $tapel->id)
                     ->whereNotIn('tanggal', $tglLibur)
                     ->get();
    }

    return view('pages.rekapitulasi.print',[
      'jenis' => $request->jenis,
      'namabulan' => $namaBulan ?? '',
      'tapel' => $tapel,
      'absens' => $absens,
      'staf' => Staf::with('user:id,name,jk')->get(),
      'sekolah' => Sekolah::first()
    ]);
  }
}
