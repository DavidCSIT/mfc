@extends('layouts.app')
@section('content')

<div class="container-xl top">

    @foreach($comments as $comment)
    <h1 class="h1-margins">{{ $comment->comment }}</h1>
    @endforeach

</div>
@endsection