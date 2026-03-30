<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Tapel;

class TapelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tapel::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tahun' => $this->faker->word(),
            'semester' => $this->faker->randomElement(["1","2"]),
            'mulai' => $this->faker->date(),
            'selesai' => $this->faker->date(),
            'is_aktif' => $this->faker->boolean(),
        ];
    }
}
