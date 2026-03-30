<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Barcode;
use App\Models\Staf;
use App\Models\Libur;
use App\Models\Tapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AbsensiStafController extends Controller
{
    // Halaman dashboard absensi staf
    public function index() {
        $tapel = Tapel::where('is_aktif', 1)->firstOrFail();
        $tanggal = date('Y-m-d');
        $libur = Libur::pluck('tanggal');

        // Cek hari libur
        if ($libur->contains($tanggal)) {
            $is_libur = true;
        } else if (Str::before(Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y'), ',') == 'Minggu') {
            $is_libur = true;
        } else {
            $is_libur = false;
        }

        $absen = Absen::where('staf_id', auth()->user()->staf->id)
                      ->where('tanggal', $tanggal)
                      ->where('tapel_id', $tapel->id)
                      ->get();

        return view('pages.absensi.staf.index', [
            'tapel' => $tapel,
            'tanggal' => $tanggal,
            'is_libur' => $is_libur,
            'absen' => $absen
        ]);
    }

    // Halaman scan QR (masuk/pulang)
    public function create($type) {
        if (!in_array($type, ['masuk','pulang'])) {
            abort(404);
        }

        $tapel = Tapel::where('is_aktif', 1)->firstOrFail();

        return view('pages.absensi.staf.create', [
            'tapel' => $tapel,
            'tanggal' => date('Y-m-d'),
            'type' => $type
        ]);
    }

    // Proses simpan absensi
    public function store(Request $request, $tanggal, $type) {
        $tapel = Tapel::where('is_aktif', 1)->firstOrFail();

        // Ambil staf yang sedang login
        $staf = auth()->user()->staf;
        $stafId = $staf->id;

        if (!$staf) {
            return redirect(route('absensi.staf.index'))->withFailed('Staf tidak ditemukan!');
        }

        // Cek apakah staf sudah absen
        $sudahAbsen = Absen::where('staf_id', $stafId)
                           ->where('tanggal', $tanggal)
                           ->where('type', $type)
                           ->exists();

        if ($sudahAbsen) {
            return redirect(route('absensi.staf.index'))
                   ->withWarning('Anda sudah melakukan absen ' . $type . ' pada hari ini!');
        }

        try {
            DB::beginTransaction();

            Absen::create([
                'staf_id' => $stafId,
                'tapel_id' => $tapel->id,
                'tanggal' => $tanggal,
                'type' => $type,
                'status' => 'h', // hadir
            ]);

            DB::commit();

            return redirect(route('absensi.staf.index'))
                   ->withSuccess('Anda berhasil melakukan absen ' . $type . '!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withFailed('Gagal! Silakan coba lagi.');
        }
    }
}
