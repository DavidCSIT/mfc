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
        Food nourishes us, connects us and creates histories. Recipes are traditions and ways of doing and being that
        are handed down the generations and evolve across time and families.
        At my family cookbook we wanted to capture our family traditions, strengthen our family memories and simply
        nourish this generation and the next. Creating an easy way for recipes to be passed through our family and into
        history.
        Our grandmothers' recipes show their connection to their surroundings and the world in which they lived. Our
        children need the foundations for creating healthy meals and just as we have adapted our eating over time, the
        chance to share new ways with us oldies.
        Whānau can be your biological family or simply a connected group of people.
    </p>

    <h1>Contact Us</h1>
    <p>email Chef@myfamilycookbook.org or use the form below</p>

    <form method="POST" action="/contact">
        @csrf
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="email">Email address</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"
                placeholder="Enter your email">
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="name"
                placeholder="Your name">
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
<div class="container mt-1">
    <h1>Donate</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <h3 class="panel-title display-td">Payment Details</h3>

            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            <form role="form" action="{{ route('payments.store') }}" method="post" class="require-validation"
                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                @csrf
                <div class='row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='control-label'>Name on Card</label> <input class='form-control' size='4'
                            type='text'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='control-label'>Card Number</label> <input autocomplete='off'
                            class='form-control card-number' size='20' type='text'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                        <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc'
                            placeholder='ex. 311' size='4' type='text'>
                    </div>
                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>Expiration Month</label> <input
                            class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                    </div>
                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>Expiration Year</label> <input
                            class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 mt-2">
                        <button class="btn btn-primary btn btn-block" type="submit">$100 USD</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


@endsection