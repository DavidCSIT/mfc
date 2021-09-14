<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Meal::factory(1)->create(['name' => 'Whenever']);
        \App\Models\Meal::factory(1)->create(['name' => 'Breakfast']);
        \App\Models\Meal::factory(1)->create(['name' => 'Lunch']);
        \App\Models\Meal::factory(1)->create(['name' => 'Dinner']);

        \App\Models\Cuisine::factory(1)->create(['name' => 'Kiwi']);
        \App\Models\Cuisine::factory(1)->create(['name' => 'Indian']);
        \App\Models\Cuisine::factory(1)->create(['name' => 'Asia']);
        \App\Models\Cuisine::factory(1)->create(['name' => 'Mexican']);
        
        \App\Models\Family::factory(1)->create(['name' => 'Cartman']);
        \App\Models\Family::factory(1)->create(['name' => 'Downer','private' => '1']);
        \App\Models\Family::factory(1)->create(['name' => 'Davidson']);

        \App\Models\User::factory(1)->create(['email' => 'cartman@a.com','family_id' => '1']);
        \App\Models\User::factory(1)->create(['email' => 'downer@a.com','family_id' => '2']);
        \App\Models\User::factory(1)->create(['email' => 'davidson@a.com','family_id' => '3']);
   
        \App\Models\Recipe::factory(1)->create(
            ['name' => 'Lamb and French  Lentil Salad',
            'about' => 'A Middle Eastern-inspired light and zingy main meal or lunch. This simple yet satisfying salad recipe sees tender lamb loin fillets served alongside filling puy lentils, a sharp pomegranate vinaigrette, and tangy greek Yoghurt. Serve with warm grilled flatbreads and youre onto a winner. Delicious!',
            'image' => 'lamb.jpg',
            'image_path' => '/img/lamb.jpg',
            'serves' => 4,
            'rating' => 5,
            'prepTime' => 30,
            'cookTime' => 30,            
            'user_id' => 1,
            'meal_id' => 3,
            'cuisine_id' => 1
            ]
        );

        \App\Models\Recipe::factory(20)->create();
    }
}
