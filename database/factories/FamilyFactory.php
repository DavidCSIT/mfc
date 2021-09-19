<?php

namespace Database\Factories;

use App\Models\family;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FamilyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = family::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'image' => $this->faker->image,
            'family_code' => Str::random(20),
            'public_access' => false,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
