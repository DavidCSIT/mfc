<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index']);

Route::resource('recipes', RecipeController::class)->except(['show'])->middleware(['auth', 'verified']);;
Route::resource('recipes', RecipeController::class)->only(['show']);

Route::get('/dashboard', function () { return view('welcome');});

Route::get('/contact', [ContactController::class, 'contact'])->name('about');
Route::post('/contact', [ContactController::class, 'contactPost'])->name('contactPost');

require __DIR__.'/auth.php';

// Route::get('/', function () { return view('welcome'); });
// Route::resource('recipes', RecipeController::class)->only(['index','create','store','edit','store','update','destroy'])->middleware('auth');
// Route::resource('recipes', RecipeController::class) ->middleware('auth');