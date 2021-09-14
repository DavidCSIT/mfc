@extends('layouts.app')
@section('content')

<div class="container">
    <div class="form top">

        <h1>Forgot your password? &nbsp; No problem </h1>

        @if (session('status') == 'verification-link-sent')
        <p>
            A new verification link has been sent to the email address you provided during registration.
        </p>
        @endif

        <p>
            Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="col-md-6">
                <div class="form-group">
                    <input name="email" type="text" class="form-control" placeholder="Email *" value="" />
                </div>
                <br>
                <input type="submit" value="Resend Verification Email">
        </form>

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