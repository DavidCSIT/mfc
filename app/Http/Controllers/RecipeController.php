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
    { {

            $meals = Meal::all();
            $cuisines = Cuisine::orderBy('name', 'asc')->get();
            $search = [];

            if (Auth::check()) {
                $familys = Family::where('id', Auth::user()->family_id)->get();
                $selectedFamily = Auth::user()->family_id;
                $search['users.family_id'] = Auth::user()->family_id;
            } elseif (isset($request->family)) {
                $familys = Family::where('public_access', 1)->get();
                $selectedFamily = $request->family;
                $search['users.family_id'] = $request->family;
            } else {
                $familys = Family::where('public_access', 1)->get();
                $selectedFamily = 1;
                $search['users.family_id'] = 1;
            }

            $serves = $request->query('serves', 0);
            $rating = isset($request->rating) ? $request->rating : 0;
            $oldCuisine = isset($request->cuisine) ? $request->cuisine : 0;
            $oldMeal = isset($request->meal) ? $request->meal : 0;

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

            if ($request->serves == "1") {
                $servesTo = 2;
            } elseif ($request->serves == "3") {
                $servesFrom = 3;
                $servesTo = 4;
            } elseif ($request->serves == "5") {
                $servesFrom = 5;
            }

            $search['families.public_access'] = 1;
            // $recipes = DB::table('recipes')
            //     ->join('users', 'users.id', '=', 'recipes.user_id' )
            //     ->where('users.family_id','=', 1)
            //     ->get();
            $recipes = Recipe::join('users', 'users.id', '=', 'recipes.user_id')
                ->join('families', 'families.id', '=', 'users.family_id')
                ->where($search)
                ->whereBetween('serves', [$servesFrom, $servesTo])
                ->orderBy('rating', 'desc')
                ->select('recipes.*')
                ->get();

            return view('welcome', [
                'recipes' => $recipes, 'serves' => $serves, 'rating' => $rating, 'cuisines' => $cuisines,
                'oldCuisine' => $oldCuisine, 'meals' => $meals, 'oldMeal' => $oldMeal, 'familys' => $familys, 'selectedFamily' => $selectedFamily
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meals = Meal::all();
        $cuisines = Cuisine::orderBy('name', 'asc')->get();
        $family = Family::all();
        return view('recipes.create', ['meals' => $meals, 'cuisines' => $cuisines]);
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
            'name' => 'required|max:30',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:8192',
            'serves' => 'required',
            'rating' => 'required',
            'about' => 'required|max:300',
            'prepTime' => 'required|integer',
            'cookTime' => 'required|integer',
            'meal' => 'required|integer',
            'cuisine' => 'required|integer',
            'ingredients' => 'required|max:1000',
            'steps' => 'required|max:1000'
        ]);

        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->extension();
     
        $filePath = public_path('/images');

        $img = Image::make($image->path());
        $img->resize(1000, 1000, function ($const) {
            $const->aspectRatio();
            $const->upSize();
        })->save($filePath.'/'.$input['imagename']);

        // $imageName = time() . '.' . $request->image->extension();   V2
        // $request->file('image')->move(public_path('images'), $imageName);   V2
        
        //$path = $request->image->store('images');  V1

        $recipe = new Recipe();
        $recipe->name = request('name');
        $recipe->about = request('about');
        $recipe->serves = request('serves');
        $recipe->image =  request('image');
        $recipe->image_path =  "/images/" . $input['imagename'];
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
        if (Gate::allows('Recipe-in-my-cookbook', $recipe) ||  Gate::allows('recipe-public', $recipe)) {
            $recipe_comments = Comment::where('recipe_id', "=", $recipe->id)->get();
            return view('recipes.show', ['recipe' => $recipe, 'recipe_comments' => $recipe_comments]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(recipe $recipe)
    {
        if (!Gate::allows('update-recipe', $recipe)) {
            abort(403);
        }

        $meal = Meal::all();
        $cuisine = Cuisine::all();
        return view('recipes.edit', ['recipe' => $recipe, 'meals' => $meal, 'cuisines' => $cuisine]);
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
        if (!Gate::allows('update-recipe', $recipe)) {
            abort(403);
        }
        request()->validate([
            'name' => 'required|max:30',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:8192',
            'serves' => 'required',
            'rating' => 'required',
            'about' => 'required|max:300',
            'prepTime' => 'required|integer',
            'cookTime' => 'required|integer',
            'meal' => 'required|integer',
            'cuisine' => 'required|integer',
            'ingredients' => 'required|max:1000',
            'steps' => 'required|max:1000'
        ]);

        if (isset($request->image)) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
         
            $filePath = public_path('/images');
    
            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
                $const->upSize();
            })->save($filePath.'/'.$input['imagename']);
            $recipe->image_path =  "/images/" . $input['imagename'];
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
        if (!Gate::allows('update-recipe', $recipe)) {
            abort(403);
        }
        $recipe->delete();
        return redirect('recipes');
    }
}
