@extends('layouts.app')
@section('content')

<div class="container-xl top">
  <h1>Edit Recipe</h1>

  <form method="POST" action="/recipes/{{$recipe->id}}" enctype="multipart/form-data" class="needs-validation" novalidate>
    @method('PUT')
    @csrf

    <div class="row">
      <div class="field form-group col-md-6 ">
        <label for="name">Name</label>
        <div class="control">
          <input class="form-control input @error('name') is-invalid @enderror" type="text" name="name" value="{{$recipe->name}}" id="name" placeholder="Recipe name" minlength="1" required>
        </div>
      </div>

      <div class="custom-file field form-group col-md-6 ">
        <label for="image">New Image</label>
        <div class="control">
          <input type="file" name="image" class="hidden custom-file-input form-control input @error('image') is-invalid @enderror" id="chooseFile">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-4 col-xl-2">
        <label for="prepTime">Prep Time (mins)</label> </label>
        <input type="text" class="form-control @error('prepTime') is-invalid @enderror" id="prepTime" name="prepTime" value="{{$recipe->prepTime}}" required>
      </div>

      <div class="form-group col-md-4 col-xl-2">
        <label for="cookTime">Cook Time (mins)</label> </label>
        <input type="text" class="form-control @error('cookTime') is-invalid @enderror" id="cookTime" name="cookTime" value="{{$recipe->cookTime}}" required>
      </div>

      <div class="field form-group col-md-4 col-xl-2">
        <label for="serves">Serves</label>
        <div class="control">
          <select class="form-control input @error('rating') is-invalid @enderror" id="serves" name="serves">
            @for ($i = 1; $i <= 10; $i++) <option {{ $recipe->serves == $i ? 'selected' : '' }}>{{$i}}</option> @endfor
          </select>
        </div>
      </div>

      <div class="form-group col-md-4 col-xl-2">
        <label for="rating">Rating</label>
        <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating">
          @for ($i = 1; $i <= 5; $i++) <option {{ $recipe->rating == $i ? 'selected' : '' }}>{{$i}}</option>
            @endfor
        </select>
      </div>

      <div class="form-group col-md-4 col-xl-2">
        <label for="meal">Meal</label>
        <select class="form-control @error('meal') is-invalid @enderror" id="meal" name="meal">
          @foreach ($meals as $meal)
          <option {{ $recipe->meal_id == $meal->id ? 'selected' : '' }} value="{{$meal->id}}"> {{$meal->name}} </option>
          @endforeach
        </select>
      </div>

      <div class="form-group col-md-4 col-xl-2">
        <label for="cuisine">Cuisine</label>
        <select class="form-control @error('cuisine') is-invalid @enderror" id="cuisine" name="cuisine">
          @foreach ($cuisines as $cuisine)
          <option {{ $recipe->cuisine_id == $cuisine->id ? 'selected' : '' }} value="{{$cuisine->id}}"> {{$cuisine->name}} </option>
          @endforeach
        </select>
      </div>
    </div>

    <label for="about" class="form-label">About</label>
    <textarea class="form-control" id="about" name="about" required>{{$recipe->about}}</textarea>

    <label for="ingredients">Ingredients</label>
    <textarea class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients" rows="8" required>{!! $recipe->ingredients !!}</textarea>

    <label for="steps">Steps</label>
    <div class="control">
      <textarea class="form-control @error('steps') is-invalid @enderror" id="steps" name="steps" rows="8" required>{!! $recipe->steps !!}</textarea>
    </div>

    <div class="field is-grouped mt-3">
      <div class="control">
        <button class="button is-link btn btn-primary" type="submit" name="button">Update Recipe</button>
        <a class="ms-1 button is-link btn btn-light" href="/">Cancel </a>
      </div>
    </div>
  </form>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

</div>
@endsection