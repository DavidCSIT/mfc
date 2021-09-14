@extends('layouts.app')
@section('content')

<div class="container-xl top">
  <h1>{{ $recipe->name }}</h1>

  <div class="row ">
    <div class="col-md-7  ">
      <img src="{{ $recipe->image_path }}" class="img-fluid rounded-left " alt="...">
    </div>
    <div class="col-md-5 bg-pink m-left rounded-right m-m-top ">
      <br>
      <div class="row">
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
              @for ($i = $recipe->rating; $i < 5; $i++) * @endfor
            </span>
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col text-center px-3">
          <h4>{{ $recipe->about }}</h4>
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col">
          <h6 class="text-end">
            Recipe author {{$recipe->user->name}}
          </h6>
        </div>
      </div>
    </div>
  </div>

  <div class="row row-margin m-m-top">
    <div class="col-md-4 ">
      <div class="card bg-light-pink">
        <div class="card-body">
          <h5 class="card-title">Ingredients</h5>
          <h6 class="card-subtitle mb-2 text-muted">{!! nl2br(e($recipe->ingredients)) !!}</h6>
        </div>
      </div>
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-7 m-m-top ">
      <div class="card bg-light-pink">
        <div class="card-body">
          <h5 class="card-title">Steps</h5>
          <h6 class="card-subtitle mb-2 text-muted">{!! nl2br(e($recipe->steps)) !!}</h6>
        </div>
      </div>
    </div>
  </div>

  @endsection