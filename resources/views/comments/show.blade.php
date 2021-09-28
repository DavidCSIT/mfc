@extends('layouts.app')
@section('content')

<div class="container-xl top">
  <h1>Comment</h1>

  <div class="row ">
    <div class="col text-center ">
      <h3>{{ $comment->comment }}</h3>
    </div>

    <div class="row">
      <div class="col">
        <h6 class="text-end">
          {{$comment->comment}}
        </h6>
      </div>
    </div>
  </div>
</div>


@endsection