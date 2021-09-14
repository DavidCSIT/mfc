@extends('layouts.app')
@section('content')

<div class="container">
    <div class="form top">

        <h1>Thanks for signing up! </h1>

        <p>
            {{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
        <p>
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <input type="submit" value="Resend Verification Email">
        </form>
        <br>

    </div>
</div>
</div>

@endsection

