<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Staf;
use App\Models\Kapus;
use App\Models\Libur;
use App\Models\Barcode;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $barcode = null; // default aman jika QR belum ada

        $user = Auth::user();

        // ======================
        // ADMIN
        // ======================
        if ($user->isAdmin()) {
            $data = array_merge($data, $this->dataAdmin());

            // QR Code terbaru (GLOBAL)
            $barcode = Barcode::latest()->first();
        }

        // ======================
        // STAF
        // ======================
        if ($user->isStaf()) {
            $data = array_merge($data, $this->dataStaf());

            // STAF juga pakai QR Code GLOBAL
            $barcode = Barcode::latest()->first();
        }

        // ======================
        // KAPUS
        // ======================
        if ($user->isKapus()) {
            $data = array_merge($data, $this->dataKapus());

            // Kapus melihat QR Code GLOBAL
            $barcode = Barcode::latest()->first();
        }

        return view('pages.dashboard.index', compact('data', 'barcode'));
    }

    // ======================
    // DATA ADMIN
    // ======================
    private function dataAdmin()
    {
        return [
            [
                'title'  => 'Data Staf',
                'count'  => Staf::count(),
                'colour' => 'bg-primary',
                'route'  => 'staf.index',
            ],
            [
                'title'  => 'Data Admin',
                'count'  => Admin::count(),
                'colour' => 'bg-success',
                'route'  => 'admin.index',
            ],
            [
                'title'  => 'Data Kapus',
                'count'  => Kapus::count(),
                'colour' => 'bg-warning',
                'route'  => 'kapus.index',
            ],
            [
                'title'  => 'Data Hari Libur',
                'count'  => Libur::count(),
                'colour' => 'bg-danger',
                'route'  => 'libur.index',
            ],
        ];
    }

    // ======================
    // DATA KAPUS
    // ======================
    private function dataKapus()
    {
        return [
            [
                'title'  => 'Rekapitulasi Absensi',
                'count'  => '',
                'colour' => 'bg-primary',
                'route'  => 'rekapitulasi.index',
            ],
        ];
    }

    // ======================
    // DATA STAF
    // ======================
    private function dataStaf()
    {
        return [
            [
                'title'  => 'Absen Hari Ini',
                'count'  => '',
                'colour' => 'bg-success',
                'route'  => 'absensi.staf.index',
            ],
        ];
    }
}
