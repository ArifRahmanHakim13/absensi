<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Absen;
use App\Models\Staf;
use App\Models\Tapel;

class AbsenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Absen::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'staf_id' => Staf::factory(),
            'tapel_id' => Tapel::factory(),
            'status' => $this->faker->randomElement(["h","i","s.a"]),
            'type' => $this->faker->randomElement(["masuk","pulang"]),
            'tanggal' => $this->faker->date(),
        ];
    }
}
