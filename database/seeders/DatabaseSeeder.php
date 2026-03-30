<?php

namespace Database\Seeders;

use App\Helpers\DummyHelper;
use App\Models\Admin;
use App\Models\Barcode;
use App\Models\Sekolah;
use App\Models\Tapel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // TAPEL
        collect([
            [
                'tahun' => '2024/2025',
                'semester' => '1',
                'mulai' => '2024-07-15',
                'selesai' => '2024-12-23',
                'is_aktif' => 1,
            ],
        ])->each(fn($q) => Tapel::create($q));

        // SEKOLAH
        collect([
            [
                'name' => 'SDN 1 INDONESIA',
                'telepon' => DummyHelper::randTelepon(),
                'email' => 'info@sdn1.com',
                'alamat' => DummyHelper::randAlamat(),
                'logo' => 'logosekolah.png',
            ],
        ])->each(fn($q) => Sekolah::create($q));

        // USER (ADMIN)
        collect([
            [
                'name' => 'Nama Admin',
                'jk' => 'laki-laki',
                'role' => 'admin',
                'telepon' => DummyHelper::randTelepon(),
                'alamat' => DummyHelper::randAlamat(),
                'username' => 'admin',
                'password' => 'password',
                'idt' => DummyHelper::idt(),
            ],
        ])->each(fn($q) => User::create($q));

        // ADMIN
        Admin::create([
            'user_id' => 1
        ]);

        /*
        |--------------------------------------------------------------------------
        | BARCODE (SINGLE)
        |--------------------------------------------------------------------------
        | Hanya 1 barcode untuk semua staf.
        | Tidak memiliki staf_id atau guru_id.
        | Kolomnya adalah `code`.
        */
        Barcode::create([
            'code' => strtoupper(Str::random(20)) // atau DummyHelper::idt()
        ]);

    }
}
