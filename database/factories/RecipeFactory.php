<?php

namespace Database\Factories;

use App\Models\recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        return [
            'name' => $this->faker->foodName(),
            'about' => $this->faker->paragraph,
            'image' => 'meal.jpg',
            'image_path' => '/img/meal' . $this->faker->numberBetween(1, 3) . ".jpg",
            'serves' => $this->faker->randomDigit,
            'rating' => $this->faker->numberBetween(1, 4),
            'prepTime' => $this->faker->numberBetween(5, 15),
            'cookTime' => $this->faker->numberBetween(5, 60),
            'ingredients' => $this->faker->vegetableName() . "\n" . $this->faker->vegetableName() ."\n" . $this->faker->fruitName() . "\n" . $this->faker->meatName() ."\n" . $this->faker->sauceName(),
            'steps' => $this->faker->sentence() . "\n" . $this->faker->sentence() . "\n" . $this->faker->sentence() . $this->faker->sentence() . "\n" . $this->faker->sentence() . "\n" . $this->faker->sentence() . "\n" . $this->faker->sentence() . $this->faker->sentence() . "\n" . $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => $this->faker->numberBetween(1, 3),
            'meal_id' => $this->faker->numberBetween(1, 4),
            'cuisine_id' => $this->faker->numberBetween(1, 4)
        ];
    }
}
