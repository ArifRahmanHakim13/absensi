<?php

namespace Database\Factories;

use App\Helpers\DummyHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Barcode;
use App\Models\Staf;

class BarcodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barcode::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'staf_id' => Staf::factory(),
            'idt' => DummyHelper::idt(),
        ];
    }
}
