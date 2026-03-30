<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Sekolah;

class SekolahFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sekolah::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'telepon' => $this->faker->word(),
            'email' => $this->faker->safeEmail(),
            'alamat' => $this->faker->text(),
            'logo' => $this->faker->word(),
        ];
    }
}
