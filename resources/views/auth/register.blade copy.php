@extends('layouts.app')
@section('content')

<div class="container form top">

    <h1>Sign up a new family</h1>
    
    <h3>Note: If you want to join an existing family cookbook, ask the manager to send you an invite</h3>

    <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation" novalidate>
        @csrf

        <div class="col-md-6">
            <div class="form-group mt-2">
                <input name="name" type="text" class="form-control" placeholder="Your Name *" value="" minlength="5" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback"> Please enter a valid name. </div>
            </div>

            <div class="form-group mt-2">
                <input name="email" type="email" class="form-control" placeholder="Email *" value="" minlength="5" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback"> Please enter a valid email. </div>
            </div>
        </div>

        <div class="col-md-6 ">
            <div class="form-group mt-2">
                <input name="password" type="password" class="form-control" placeholder="Your Password *" value="" minlength="8" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback"> Please enter a valid password. </div>
            </div>

            <div class="form-group mt-2">
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password *" value="" minlength="8" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback"> Please enter a valid password. </div>
            </div>
        </div>

        <div class="col-md-6 ">
            <select class="form-select" id="family" name="family" required>
                <option value="" disabled selected>Select your family</option>
                @foreach ($familys as $family)
                <option value="{{$family->id}}" {{ $family->id == $oldFamily ? 'selected':'' }}> {{$family->name}} </option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback"> Select your family</div>
        </div>

        <div class="form-group mt-2">
            <input name="family" type="email" class="form-control" placeholder="Enter the Family name for your cookbook" value="" minlength="2" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback"> Please enter a valid family name. </div>
        </div>


        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Submit">
    </form>
    <br>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection