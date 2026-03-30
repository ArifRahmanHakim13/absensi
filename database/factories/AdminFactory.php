<?php

namespace Database\Factories;

use App\Helpers\DummyHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\User;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $user = User::create([
          'name' => $this->faker->name(),
          'jk' => $this->faker->randomElement(['laki-laki','perempuan']),
          'role' => 'admin',
          'telepon' => DummyHelper::randTelepon(),
          'alamat' => DummyHelper::randAlamat(),
          'username' => $this->faker->userName(),
          'password' => 'password',
          'idt' => DummyHelper::idt(),
        ]);
        return [
          'user_id' => $user->id,
        ];
    }
}
