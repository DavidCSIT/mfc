<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Meal;
use App\Models\Cuisine;
use App\Models\Family;
use App\Models\User;
use App\Models\Comment;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meals = Meal::all();
        $cuisines = Cuisine::all();
        $family = Family::all();
        $chefs = User::all();

        $search = [];
        $serves = isset($request->serves) ? $request->serves : 0;
        $rating = isset($request->rating) ? $request->rating : 0;
        $oldCuisine = isset($request->cuisine) ? $request->cuisine : 0;
        $oldMeal = isset($request->meal) ? $request->meal : 0;
        $oldChef = isset($request->chef) ? $request->chef : 0;
        $servesFrom = 0;
        $servesTo = 11;

        if (isset($request->rating) && $request->rating != "All") {
            $search['rating'] = $request->rating;
        }

        if (isset($request->cuisine) && $request->cuisine != "All") {
            $search['cuisine_id'] = $request->cuisine;
        }

        if (isset($request->meal) && $request->meal != "All") {
            $search['meal_id'] = $request->meal;
        }

        if (isset($request->chef) && $request->chef != "All") {
            $search['user_id'] = $request->chef;
        }

        if ($request->serves == "1") {
            $servesTo = 2;
        } elseif ($request->serves == "3") {
            $servesFrom = 3;
            $servesTo = 4;
        } elseif ($request->serves == "5") {
            $servesFrom = 5;
        }

        $search['users.family_id'] = Auth::user()->family_id;

        $recipes = Recipe::join('users', 'users.id', '=', 'recipes.user_id' )
            ->where($search)
            ->whereBetween('serves', [$servesFrom, $servesTo])
            ->orderBy('recipes.name', 'asc')
            ->select('recipes.*')
            ->get();
        
        return view('recipes.index', ['recipes' => $recipes, 'serves' => $serves, 'rating' => $rating , 'cuisines' => $cuisines,
            'oldCuisine' => $oldCuisine  , 'meals' => $meals, 'oldMeal'=> $oldMeal, 'chefs' => $chefs, 'oldChef'=> $oldChef]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meal = Meal::all();
        $cuisine = Cuisine::all();
        $family = Family::all();
        return view('recipes.create', ['meals' => $meal, 'cuisines' => $cuisine]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'serves' => 'required',
            'rating' => 'required',
            'about' => 'required',
            'prepTime' => 'required|integer',
            'cookTime' => 'required|integer',
            'meal' => 'required|integer',
            'cuisine' => 'required|integer',
            'ingredients' => 'required',
            'steps' => 'required'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $recipe = new Recipe();
        $recipe->name = request('name');
        $recipe->about = request('about');
        $recipe->serves = request('serves');
        $recipe->image =  request('image');
        $recipe->image_path =  "/images/" . $imageName;
        $recipe->rating =  request('rating');
        $recipe->cookTime =  request('cookTime');
        $recipe->prepTime =  request('prepTime');
        $recipe->meal_id =  request('meal');
        $recipe->cuisine_id =  request('cuisine');
        $recipe->ingredients =  request('ingredients');
        $recipe->steps =  request('steps');
        $recipe->user_id =  Auth::user()->id;
        $recipe->save();

        return redirect('/recipes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(recipe $recipe)
    {
        $recipe_comments = Comment::where('recipe_id', "=", $recipe->id)->get();

        return view('recipes.show', ['recipe' => $recipe, 'recipe_comments' => $recipe_comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(recipe $recipe)
    {
        if (! Gate::allows('update-recipe', $recipe)) {
            abort(403);
        }

        $meal = Meal::all();
        $cuisine = Cuisine::all();
        return view('recipes.edit', ['recipe'=>$recipe,'meals' => $meal, 'cuisines' => $cuisine]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recipe $recipe)
    {
        if (! Gate::allows('update-recipe', $recipe)) {
            abort(403);
        }
        request()->validate([
            'name' => 'required',
            'serves' => 'required',
            'rating' => 'required',
            'about' => 'required',
            'prepTime' => 'required|integer',
            'cookTime' => 'required|integer',
            'meal' => 'required|integer',
            'cuisine' => 'required|integer',
            'ingredients' => 'required',
            'steps' => 'required'
        ]);

        if(isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $recipe->image =  request('image');
            $recipe->image_path =  "/images/" . $imageName;
        }

        $recipe->name = request('name');
        $recipe->about = request('about');
        $recipe->serves = request('serves');
        $recipe->rating =  request('rating');
        $recipe->cookTime =  request('cookTime');
        $recipe->prepTime =  request('prepTime');
        $recipe->meal_id =  request('meal');
        $recipe->cuisine_id =  request('cuisine');
        $recipe->ingredients =  request('ingredients');
        $recipe->steps =  request('steps');
        $recipe->user_id =  Auth::user()->id;
        $recipe->save();

        return redirect('/recipes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(recipe $recipe)
    {
        if (! Gate::allows('update-recipe', $recipe)) {
            abort(403);
        }
        $recipe->delete();
        return redirect('recipes');
    }
}
