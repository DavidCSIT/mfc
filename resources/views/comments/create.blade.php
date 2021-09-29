@extends('layouts.app')
@section('content')

<div class="container-xl container-xl top">
  <h1>What do think</h1>

  <form method="POST" action="/recipes/{{$recipe->id}}/comments" enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf

    <div class="row ">
      <div class="field form-group col-md-6 ">
        <label for="comment">Comment</label>
        <div class="control">
          <input class="form-control input @error('comment') is-invalid @enderror" type="text" comment="comment" value="{{ @old('comment') }}" name = "comment" id="comment" placeholder="Recipe comment" minlength="2" required>
        </div>
      </div>
      
    <div class="field is-grouped mt-3">
      <div class="control">
        <button class="button is-link btn btn-primary" type="submit" comment="button">Submit Comment</button>
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
ExceptionHandler

</div>
@endsection