<?php

namespace Database\Factories;

use App\Helpers\DummyHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Staf;
use App\Models\User;

class StafFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staf::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user = User::create([
            'name'     => $this->faker->name(),
            'jk'       => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'jabatan'  => $this->faker->randomElement([
                'Dokter Umum',
                'Dokter Gigi',
                'Perawat',
                'Bidan',
                'Tenaga Farmasi',
                'Administrasi',
                'Petugas Kebersihan',
            ]),
            'role'     => 'staf',
            'telepon'  => DummyHelper::randTelepon(),
            'alamat'   => DummyHelper::randAlamat(),
            'username' => $this->faker->userName(),
            'password' => 'password',
            'idt'      => DummyHelper::idt(),
        ]);

        return [
            'user_id' => $user->id,
            'nip'     => DummyHelper::randNip(),
            'nuptk'   => DummyHelper::randNuptk(),
        ];
    }
}
