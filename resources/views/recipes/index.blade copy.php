@extends('layouts.app')
@section('content')

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<!-- will be used to show any messages -->

<div class="container-xl top">
<span class="h1">Recipes</span>
<a href="/recipes/create" class="btn btn-outline-success mb-2 ms-4">New Recipe</a>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Picture</td>
            <td>Serves</td>
            <td>Rating</td>
            <td>Recipe by</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
    @foreach($recipes as $recipe)
        <tr>
            <td>{{ $recipe->id }}</td>
            <td>{{ $recipe->name }}</td>
            <td> <img src="{{ $recipe->image_path }}" class="w-100 p-1" alt="recipe image" alt="recipe images"> </td>
            <td>{{ $recipe->serves }}</td>
            <td>{{ $recipe->rating }}</td>
            <td>{{ $recipe->user->name }}</td>

              <td>
                <form action="recipes/{{$recipe->id}}" method="POST">
                  @method('DELETE')

                  <a class="mt-1 mx-auto btn btn-small btn-success" href="recipes/{{$recipe->id}}">Show</a>

                  @auth
                  <a class="mt-1 mx-auto btn btn-small btn-info" href="recipes/{{$recipe->id}}/edit">Edit </a>

                  @csrf
                  <button type="submit" title="delete" class="mt-1 mx-auto btn btn-small btn-danger" >Delete </button>
                  
                  @endauth

                </form>
              </td>

        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection