<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
          [
            'staf_id' => 1,
            'name' => '1A',
            'tingkat' => 1,
          ],
          [
            'staf_id' => null,
            'name' => '1B',
            'tingkat' => 1,
          ],
          [
            'staf_id' => 2,
            'name' => '2A',
            'tingkat' => 2,
          ],
          [
            'staf_id' => 3,
            'name' => '3A',
            'tingkat' => 3,
          ],
          [
            'staf_id' => 4,
            'name' => '4A',
            'tingkat' => 4,
          ],
          [
            'staf_id' => 5,
            'name' => '5A',
            'tingkat' => 5,
          ],
          [
            'staf_id' => 6,
            'name' => '6A',
            'tingkat' => 6,
          ],
        ])->each(fn($q) => Kelas::create($q));
    }
}
