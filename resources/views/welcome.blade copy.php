@extends('layouts.app')
@section('content')

<!-- Background header image -->
<div class="home py-5 d-flex  ">
    <div class="container text-light ">
        <br> <br>
        <h1 class="hero-box" >Share your recipes your way</h1>
        <h4 class="hero-box">Friends - Family - Anyone -> Your Choose</h4>
        <h4 class="hero-box"> Signup -> Invite -> Share</h4>
    </div>
</div>
<!-- Background header image -->

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<!-- will be used to show any messages -->

<div class="container-xxl">

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>Picture</td>
            <td>Serves</td>
            <td>Rating</td>
            <td>PrepTime</td>
            <td>Recipe by</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    @foreach($recipes as $recipe)
        <tr>
            <td>{{ $recipe->name }}</td>
            <td> <img src="{{ $recipe->image_path }}" class="w-50 p-1" alt="recipe image"> </td>
            <td>{{ $recipe->serves }}</td>
            <td>{{ $recipe->rating }}</td>
            <td>{{ $recipe->prepTime }}</td>
            <td>{{ $recipe->user->name }}</td>


              <td>
                <form action="recipes/{{$recipe->id}}" method="POST">
                  @method('DELETE')

                  <a class="mt-1 mx-auto btn btn-small btn-success" href="recipes/{{$recipe->id}}">Show this recipe</a>

                  @auth
                  <a class="mt-1 mx-auto btn btn-small btn-info" href="recipes/{{$recipe->id}}/edit">Edit this recipe</a>

                  @csrf
                  <button type="submit" title="delete" class="mt-1 mx-auto btn btn-small btn-danger" >Delete this recipe</button>
                  
                  @endauth

                </form>
              </td>

        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection