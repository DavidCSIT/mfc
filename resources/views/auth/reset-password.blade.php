@extends('layouts.app')
@section('content')

<div class="container">
    <div class="form top">

        <h1>Password Reset</h1>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="row">
                <div class="col-md-6 mt-2 ">
                    <div class="form-group">
                        <input name="email" type="text" class="form-control" placeholder="Email *" value="{{@old('email', $request->email)}}" required autofocus />
                    </div>
                </div>

                <!-- Password -->
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <input name="password" type="password" class="form-control" placeholder="New Password *" value="" required />
                    </div>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="row justify-content-end">
                <div class="col-md-6 mt-2 ">
                    <div class="form-group">
                        <input name="password_confirmation" type="password" class="form-control" placeholder="New Password *" value="" required />
                    </div>
                </div>
            </div>
    </div>
 
    <input class="btn btn-secondary mt-2" type="submit" value="Submit">
    </form>
    <br>

    <!-- Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>



@endsection