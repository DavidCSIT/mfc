<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', [HomeController::class, 'index']);

Route::resource('recipes.comments', CommentController::class)->only(['create','destroy','store'])->middleware(['auth', 'verified']);

Route::resource('recipes', RecipeController::class)->except(['show'])->middleware(['auth', 'verified']);
Route::resource('recipes', RecipeController::class)->only(['show']);

Route::resource('familys', FamilyController::class)->middleware(['auth', 'verified']);
Route::resource('payments', PaymentController::class);

Route::get('contact', [ContactController::class, 'contact'])->name('contact');
Route::post('contact', [ContactController::class, 'contactPost'])->name('contactPost');

Route::put('users/{user}', [RegisteredUserController::class, 'update'])->name('updateUser')->middleware();
Route::delete('users/{user}', [RegisteredUserController::class, 'destroy'])->name('destroyUser')->middleware();
Route::get('users/invite', [RegisteredUserController::class, 'invite'])->name('invite')->middleware();

Route::get('stripe', [StripeController::class, 'create'])->name('stripe.create');
Route::post('stripe', [StripeController::class, 'store'])->name('stripe.store');

require __DIR__.'/auth.php';

// Route::get('/', function () { return view('welcome'); });
// Route::resource('recipes', RecipeController::class)->only(['index','create','store','edit','store','update','destroy'])->middleware('auth');
// Route::resource('recipes', RecipeController::class) ->middleware('auth');
// Route::get('/dashboard', function () { return view('welcome');});
// Route::get('recipes/{receipe}/comments', [CommentController::class, 'index'])->name('comment.index');
// Route::get('stripe', [StripeController::class, 'create'])->name('stripe.create');
// Route::post('stripe', [StripeController::class, 'store'])->name('stripe.store');
