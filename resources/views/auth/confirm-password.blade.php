@extends('layouts.app')
@section('content')

<div class="container">
    <div class="form top">

        <h1>Please confirm your password before continuing</h1>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="password" type="password" class="form-control" placeholder="Your Password *" value="" />
                    </div>
                </div>
            </div>
            <br>
            <input class="btn btn-secondary" type="submit" value="Submit">
        </form>
        <br>
        <p>Forgot your password?</p>

        <a class="btn btn-light" href="{{ route('password.request') }}">Reset Password </a>

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
</div>

@endsection