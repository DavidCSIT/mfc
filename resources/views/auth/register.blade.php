@extends('layouts.app')
@section('content')

<div class="container form top">

    <h1>Create a new family cookbook</h1>
    
    <p>Start a new family cookbook to manager how you want!</p>
    <p>As the administrator you invite others to join using a secure link </p>
    <p>As the administrator you accept responsbility for the content in your cookbook </p>
    <p>As the administrator you decide if the cookbook private to your family only or public read only</p>
   
    <h4>Note: If you want to join an existing family cookbook, ask the manager to send you an invite</h4>

    <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation" novalidate>
        @csrf

        <div class="col-md-6">
            <div class="form-group mt-2">
                <input name="name" type="text" class="form-control" placeholder="Your Name *" value="{{ @old('name') }}" minlength="2" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback"> Please enter a valid name. </div>
            </div>

            <div class="form-group mt-2">
                <input name="email" type="email" class="form-control" placeholder="Email *" value="{{ @old('email') }}" minlength="5" required>
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

        <div class="form-group mt-2">
            <input name="family" type="text" class="form-control" placeholder="Enter the Family name for your cookbook" value="{{ @old('family') }}" minlength="2" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback"> Please enter a valid family name. </div>
        </div>

        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="invalidCheck" name="invalidCheck"  {{ !empty(@old('invalidCheck')) ? 'checked' : '' }} required>
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-check2">
                <input class="form-check-input" type="checkbox" value="1" id="public" name="public"  {{ !empty(@old('public')) ? 'checked' : '' }}  >
                <label class="form-check-label" for="public">
                    Allow anyone to view your cookbook ? 
                </label>
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