@extends('layouts.app')
@section('content')

<!-- Page Heading and Search -->
<div class="container-xl top">

    <form method="GET" action="/recipes" enctype="multipart/form-data" class="row gy-2 gx-3 align-items-center mt-2 ">

        <h1 class="me-3">Our Family Recipes</h1>

        <div class="col-lg-auto col-6 mt-3  ">
            <a href="/recipes/create" class="btn btn-outline-success mb-2 ms-4">New Recipe</a>
        </div>
        @csrf
        <div class="col-lg-auto col-2">
            <label class="form-check-label" for="serves">Serves</label>
        </div>

        <div class="col-lg-auto col-4 ">
            <select class="form-select" id="serves" name="serves" onchange="this.form.submit()">
                <option>All</option>
                <option value="1" {{ $serves == 1 ? 'selected':'' }}>1 - 2 </option>
                <option value="3" {{ $serves == 3 ? 'selected':'' }}>3 - 4</option>
                <option value="5" {{ $serves == 5 ? 'selected':'' }}>5+</option>
            </select>
        </div>

        <div class="col-lg-auto col-2 ">
            <label class="form-check-label" for="rating">Rating</label>
        </div>
        <div class="col-lg-auto col-4 ">
            <select class="form-select" id="rating" name="rating" onchange="this.form.submit()">
                <option>All</option>
                <option value="1" {{ $rating == 1 ? 'selected':'' }}>*</option>
                <option value="2" {{ $rating == 2 ? 'selected':'' }}>**</option>
                <option value="3" {{ $rating == 3 ? 'selected':'' }}>***</option>
                <option value="4" {{ $rating == 4 ? 'selected':'' }}>****</option>
                <option value="5" {{ $rating == 5 ? 'selected':'' }}>*****</option>
            </select>
        </div>

        <div class="col-lg-auto col-2">
            <label class="form-check-label" for="chef">Chef</label>
        </div>
        <div class="col-lg-auto col-4">
            <select class="form-select" id="chef" name="chef" onchange="this.form.submit()">
                <option>All</option>
                @foreach ($chefs as $chef)
                <option value="{{$chef->id}}" {{ $chef->id == $oldChef ? 'selected':'' }}> {{$chef->name}} </option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-auto col-2">
            <label class="form-check-label" for="cuisine">Cuisine</label>
        </div>
        <div class="col-lg-auto col-4">
            <select class="form-select" id="cuisine" name="cuisine" onchange="this.form.submit()">
                <option>All</option>
                @foreach ($cuisines as $cuisine)
                <option value="{{$cuisine->id}}" {{ $cuisine->id == $oldCuisine ? 'selected':'' }}> {{$cuisine->name}} </option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-auto col-2">
            <label class="form-check-label" for="meal">Meal</label>
        </div>
        <div class="col-lg-auto col-4">
            <select class="form-select" id="meal" name="meal" onchange="this.form.submit()">
                <option>All</option>
                @foreach ($meals as $meal)
                <option value="{{$meal->id}}" {{ $meal->id == $oldMeal ? 'selected':'' }}> {{$meal->name}} </option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<!-- Recipes -->
<div class="container-xl">
    @foreach($recipes as $recipe)
    <h1 class="mt-4">{{ $recipe->name }}</h1>

    <div class="row ">
        <div class="col-lg-7 bg-pink rounded-left  ">
            <img src="{{ $recipe->image_path }}" class="img-fluid rounded-left   " alt="...">
        </div>
        <div class="col-lg-5 bg-pink m-left rounded-right m-m-top ">
            <div class="row mt-4">
                <div class="col text-center">
                    <h7>Serves</h7>
                </div>
                <div class="col text-center border-start">
                    <h7>Prep Time</h7>
                </div>
                <div class="col text-center border-start">
                    <h7>Cook Time</h7>
                </div>
            </div>

            <div class="row ">
                <div class="col text-center ">
                    <h3>{{ $recipe->serves }}</h3>
                </div>
                <div class="col text-center border-start">
                    <h3>{{ $recipe->prepTime }} mins</h3>
                </div>
                <div class="col text-center border-start">
                    <h3>{{ $recipe->cookTime }} mins</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1 class="text-center">
                        @for ($i = 0; $i < $recipe->rating; $i++) * @endfor
                            <span style="color:darkgray">
                                @for ($i = $recipe->rating; $i < 5; $i++) * @endfor </span>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col text-center px-3">
                    <h4>{{ $recipe->about }}</h4>
                </div>
            </div>

            <br>
            <div class="row ms-2">
                <div class="col">
                    <form action="recipes/{{$recipe->id}}" method="POST">
                        @method('DELETE')

                        <a class="mt-1 mx-auto btn btn-small btn-success " href="recipes/{{$recipe->id}}">Show</a>

                        @auth
                        @can('update-recipe', $recipe)
                        <a class="mt-1 mx-auto btn btn-small btn-info" href="recipes/{{$recipe->id}}/edit">Edit </a>

                        @csrf
                        <button type="submit" title="delete" class="mt-1 mx-auto btn btn-small btn-danger">Delete </button>
                        @endcan
                        @endauth
                </div>
                <div class="col">
                    <h6 class="text-end">
                        Recipe chef {{$recipe->user->name}}
                    </h6>
                </div>
            </div>
            </form>
        </div>
    </div>
    @endforeach

</div>
@endsection