<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Staf;
use App\Models\Libur;
use App\Models\Tapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AbsensiAdminController extends Controller
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

      return view('pages.absensi.admin.index',[
        'tapel' => $tapel,
        'months' => $months
      ]);
    }

    public function show($yearmonth){

      $tapel = Tapel::where('is_aktif', 1)->firstOrFail();

      list($year, $month) = explode('-', $yearmonth); // pisahin bulan dan tahun
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

      $libur = Libur::get();
      $tglLibur = Libur::pluck('tanggal');

      // get data absen di bulan ini
      $absens = Absen::whereBetween('tanggal', [$startDateOfMonth, $endDate])
                     ->where('tapel_id', $tapel->id)
                     ->whereNotIn('tanggal', $tglLibur)
                     ->get();

      return view('pages.absensi.admin.show',[
        'tapel' => $tapel,
        'tanggals' => $tanggalDiBulanIni,
        'namabulan' => $namaBulan,
        'staf' => Staf::with('user:id,name,jk')->get(),
        'absens' => $absens,
        'libur' => $libur,
        'tglLibur' => $tglLibur,
      ]);
    }

    public function create($type, $tanggal) {
      $tapel = Tapel::where('is_aktif', 1)->firstOrFail();
      $absen = Absen::where('tanggal', $tanggal)
                    ->where('type', $type)
                    ->where('tapel_id', $tapel->id)
                    ->get();

      return view('pages.absensi.admin.create',[
        'redirect' => '/absensi/admin/' . Str::beforeLast($tanggal, '-'),
        'tapel' => $tapel,
        'tanggal' => $tanggal,
        'type' => $type,
        'staf' => Staf::with('user:id,name,jk')->get(),
        'absen' => $absen
      ]);

    }

    public function store(Request $request, $type, $tanggal) {
      $tapel = Tapel::where('is_aktif', 1)->firstOrFail();

      $staf = $request->staf_id;
      foreach ($staf as $i => $stafId) {
        if ($request->status[$i] != null) {
          Absen::updateOrCreate(
            [
              'staf_id' => $stafId,
              'tapel_id' => $tapel->id,
              'type' => $type,
              'tanggal' => $tanggal,
            ],
            [
              'status' => $request->status[$i]
            ]
          );
        }
      }

      return redirect(route('absensi.admin.show', Str::beforeLast($tanggal, '-')))->withSuccess('Data Absensi berhasil diperbarui!');
    }
}
