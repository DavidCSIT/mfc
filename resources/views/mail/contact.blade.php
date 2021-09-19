@extends('layouts.app')
@section('content')

<div class="container container-xl top">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1>About Us</h1>

    <p>
        Food nourishes us, connects us and creates histories. Recipes are traditions and ways of doing and being that are handed down the generations and evolve across time and families.
        At my family cookbook we wanted to capture our family traditions, strengthen our family memories and simply nourish this generation and the next. Creating an easy way for recipes to be passed through our family and into history.
        Our grandmothers' recipes show their connection to their surroundings and the world in which they lived. Our children need the foundations for creating healthy meals and just as we have adapted our eating over time, the chance to share new ways with us oldies.
        Whānau can be your biological family or simply a connected group of people.
    </p>

    <h1>Contact Us</h1>
    <p>email Chef@myfamilycookbook.org or use the form below</p>

    <form method="POST" action="/contact">
        @csrf
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="email">Email address</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Your name">
            <span class="text-danger">{{ $errors->first('name') }}</span>

        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="exampleInputPassword1">Comment</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            <span class="text-danger">{{ $errors->first('comment') }}</span>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection