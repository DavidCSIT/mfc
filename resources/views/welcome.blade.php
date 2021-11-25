@extends('layouts.app')
@section('content')

<!-- Background header image -->
<div class="home py-5 d-flex  ">
    <div class="container text-light ">
        <h4 class="hero-box mt-5" id="search">Share your recipes your way</h4>
        <h4 class="hero-box">Cook and connect today</h4>
        <h4 class="hero-box">History for generations</h4>
    </div>
</div>

<!-- Search -->
<div class="container-xxl">
    <form method="GET" action="#search" enctype="multipart/form-data" class="row gy-2 gx-3 align-items-center mt-1 mb-5">

        <div class="row justify-content-center mt-4">
            <div class="col-lg-auto mt-2 col-2 ">
                <label class="form-check-label mt-1" for="family">Family</label>
            </div>
            <div class="col-lg-auto mt-2 col-4 ">
                <select class="form-select" id="family" name="family" onchange="this.form.submit()">
                    <option>All</option>
                    @foreach ($familys as $family)
                    <option value="{{$family->id}}" {{ $family->id == $oldFamily ? 'selected':'' }}> {{$family->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-auto mt-2 col-2 ">
                <label class="form-check-label mt-1" for="serves">Serves</label>
            </div>

            <div class="col-lg-auto mt-2 col-4  ">
                <select class="form-select" id="serves" name="serves" onchange="this.form.submit()">
                    <option>All</option>
                    <option value="1" {{ $serves == 1 ? 'selected':'' }}>1 - 2 </option>
                    <option value="3" {{ $serves == 3 ? 'selected':'' }}>3 - 4</option>
                    <option value="5" {{ $serves == 5 ? 'selected':'' }}>5+</option>
                </select>
            </div>

            <div class="col-lg-auto mt-2 col-2  ">
                <label class="form-check-label mt-1" for="rating">Rating</label>
            </div>
            <div class="col-lg-auto mt-2 col-4  ">
                <select class="form-select" id="rating" name="rating" onchange="this.form.submit()">
                    <option>All</option>
                    <option value="1" {{ $rating == 1 ? 'selected':'' }}>*</option>
                    <option value="2" {{ $rating == 2 ? 'selected':'' }}>**</option>
                    <option value="3" {{ $rating == 3 ? 'selected':'' }}>***</option>
                    <option value="4" {{ $rating == 4 ? 'selected':'' }}>****</option>
                    <option value="5" {{ $rating == 5 ? 'selected':'' }}>*****</option>
                </select>
            </div>

            <div class="col-lg-auto mt-2 col-2 ">
                <label class="form-check-label mt-1" for="cuisine">Cuisine</label>
            </div>
            <div class="col-lg-auto mt-2 col-4 ">
                <select class="form-select" id="cuisine" name="cuisine" onchange="this.form.submit()">
                    <option>All</option>
                    @foreach ($cuisines as $cuisine)
                    <option value="{{$cuisine->id}}" {{ $cuisine->id == $oldCuisine ? 'selected':'' }}> {{$cuisine->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-auto mt-2 col-2 ">
                <label class="form-check-label mt-1" for="meal">Meal</label>
            </div>
            <div class="col-lg-auto mt-2 col-4 ">
                <select class="form-select" id="meal" name="meal" onchange="this.form.submit()">
                    <option>All</option>
                    @foreach ($meals as $meal)
                    <option value="{{$meal->id}}" {{ $meal->id == $oldMeal ? 'selected':'' }}> {{$meal->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>

<!-- Recipes -->
<div class="container-xxl">
    @foreach($recipes as $recipe)
    <h1 class="mt-4">{{ $recipe->name }}</h1>

    <div class="row clickable " onclick="location.href='/recipes/{{$recipe->id}}'">
        <div class="col-lg-7 bg-pink rounded-left   ">
            <img src="{{ $recipe->image_path }}" class="img-fluid rounded-left " alt="...">
        </div>
        <div class="col-lg-5 bg-pink rounded-right ">
            <div class="row mt-2 mr-0 ">
                <div class="col text-center">
                    <h6>Serves</h6>
                </div>
                <div class="col text-center border-start">
                    <h6>Prep Time</h6>
                </div>
                <div class="col text-center border-start">
                    <h6>Cook Time</h6>
                </div>
            </div>

            <div class="row">
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
                                @for ($i = $recipe->rating; $i < 5; $i++) * @endfor </span> </h1> </div> </div> <div class="row">
                                    <div class="col text-center px-3">
                                        <h4>{{ $recipe->about }}</h4>
                                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col me-2">
                        <h6 class="text-end ">
                            Recipe author {{$recipe->user->name}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @endsection