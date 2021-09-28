@extends('layouts.app')
@section('content')

@if (Session::has('success'))
<div class="alert alert-success text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('success') }}</p>
</div>
@endif

<!-- Our Mission -->
<section class="container top">
    <h1>Our Mission</h1>

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
</section>

<!-- Contact Us-->
<section class="container mt-4">
    <h1>Contact Us</h1>
    <p>email Chef@myfamilycookbook.org or use the form below</p>

    <form method="POST" action="/contact">
        @csrf
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <input name="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Your name">
            <span class="text-danger">{{ $errors->first('name') }}</span>

        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
            <span class="text-danger">{{ $errors->first('comment') }}</span>
        </div>

        <button type="submit" class="btn btn-primary my-2">Send Message</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</section>

<!-- Donate cc  -->
<section class="container mt-4">
    <h1>Donate by Card </h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <!-- Stripe Credit Card Payement -->
            <script src="https://js.stripe.com/v3/"></script>
            <form action="{{ route('stripe.store') }}" method="post" id="payment-form" class="needs-validation" novalidate>
                @csrf
                <div class="col-4">
                    <input type="text" class="form-control col-4" name="amount" placeholder="Amount in USD" required />
                </div>
                <input type="email" class="form-control" name="email" placeholder="Optionally enter your eMail address for our records" />
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Display form errors. -->
                <div id="card-errors" role="alert" class="text-danger"></div>
                <button class="btn btn-primary my-2">Donate by card </button>
            </form>
            <script>
                var publishable_key = "{{ env('STRIPE_KEY') }}";
            </script>
            <script src="{{ asset('/js/stripe.js') }}"></script>
        </div>
    </div>
</section>

<!-- Donate btc  -->
<section class="container mt-4">
    <h1>Donate by Bitcoin</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <p>Bitcoin is a secure and digital currency. You can send BTC to the following address and optionally let us know using the form below:</p>
            <div>
                <div class="d-flex-sm mb-3">
                    <strong class="p-2"> 38WBMr9qwq8zXrUatBGK1sapWZiKmbj8vA </strong> 
                    <img src="{{ asset('img/bitcoin.png') }}" class="ml-2">
                </div>

                <!-- BTC form-->
                <form action="{{ route('stripe.store') }}" method="post" id="payment-form" class="needs-validation" novalidate>
                    @csrf
                    <div class="col-4">
                        <input type="text" class="form-control col-4" name="amount" placeholder="Amount in USD" required />
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Optionally enter your eMail address for our records" />
                    <button class="btn btn-primary my-2">Donate by Bitcoin </button>
                </form>
            </div>
</section>
</body>

@endsection