<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('about');
            $table->string('image');
            $table->string('image_path');
            $table->integer('serves');
            $table->integer('rating');
            $table->integer('prepTime');
            $table->integer('cookTime');
            $table->longText('ingredients');
            $table->longText('steps');
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('meal_id')->constrained();
            $table->foreignId('cuisine_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
