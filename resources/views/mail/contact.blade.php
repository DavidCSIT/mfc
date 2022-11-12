@extends('layouts.app')
@section('content')

<section class="container top">

@if (Session::has('success'))
<div class="alert alert-success text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <p>{{ Session::get('success') }}</p>
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Our Mission -->
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
    <p>email Chef@myfamilycookbook.org </p>

<!-- Donate cc  -->
<section class="container mt-4">
    <h1>Donate by Card </h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <!-- Stripe Credit Card Payement -->
            <script src="https://js.stripe.com/v3/"></script>
            <form action="{{ route('stripe.store') }}" method="post" id="payment-form" class="needs-validation" novalidate>
                @csrf
                <div class="">
                    <input type="text" class="form-control " name="amount" placeholder="Amount in USD" required />
                </div>
                <input type="email" class="form-control" name="email" placeholder="Optionally enter your eMail address for our records" />
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Display form errors. -->
                <div id="card-errors" role="alert" class="text-danger"></div>
                <button class="btn btn-primary my-2">Donate by card </button>
                <a class="ms-1 button is-link btn btn-light" href="/">Cancel </a>
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
                    <strong class="p-2"> bc1qnzdx0yft9rx9zwgxnvzu9yxxmuzul9hc9tlzha </strong> 
                    <img src="{{ asset('img/bitcoin.png') }}" class="ml-2">
                </div>

                <!-- BTC form-->
                <form action="{{ route('stripe.store') }}" method="post" id="payment-form" class="needs-validation" novalidate>
                    @csrf
                    <div class="">
                        <input type="text" class="form-control " name="amount" placeholder="Amount in USD" required />
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Optionally enter your eMail address for our records" />
                    <button class="btn btn-primary my-2">Donate by Bitcoin </button>
                    <a class="ms-1 button is-link btn btn-light" href="/">Cancel </a>
                </form>
            </div>
</section>

<!-- Terms and Conditions -->
<section class="container">
<h1>Terms and Conditions</h1>

<p>Welcome to My Family Cookbook!</p>

<p>These terms and conditions outline the rules and regulations for the use of My Family Cookbook's Website, located at myfamilycookbook.org.</p>

<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use My Family Cookbook if you do not agree to take all of the terms and conditions stated on this page.</p>

<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>

<h3><strong>Cookies</strong></h3>

<p>We employ the use of cookies. By accessing My Family Cookbook, you agreed to use cookies in agreement with the My Family Cookbook's Privacy Policy. </p>

<p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>

<h3><strong>License</strong></h3>

<p>Unless otherwise stated, My Family Cookbook and/or its licensors own the intellectual property rights for all material on My Family Cookbook. All intellectual property rights are reserved. You may access this from My Family Cookbook for your own personal use subjected to restrictions set in these terms and conditions.</p>

<p>You must not:</p>
<ul>
    <li>Republish material from My Family Cookbook</li>
    <li>Sell, rent or sub-license material from My Family Cookbook</li>
    <li>Reproduce, duplicate or copy material from My Family Cookbook</li>
    <li>Redistribute content from My Family Cookbook</li>
</ul>

<p>This Agreement shall begin on the date hereof. </a>.</p>

<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. My Family Cookbook does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of My Family Cookbook,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, My Family Cookbook shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>

<p>My Family Cookbook reserves the right to monitor all content and to remove any content which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>

<p>You warrant and represent that:</p>

<ul>
    <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
    <li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
    <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
    <li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
</ul>

<p>You hereby grant My Family Cookbook a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your content in any and all forms, formats or media.</p>

<h3><strong>Hyperlinking to our Content</strong></h3>

<p>The following organizations may link to our Website without prior written approval:</p>

<ul>
    <li>Search engines;</li>
    <li>News organizations;</li>
    <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
    <li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
</ul>

<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>

<p>We may consider and approve other link requests from the following types of organizations:</p>

<ul>
    <li>commonly-known consumer and/or business information sources;</li>
    <li>dot.com community sites;</li>
    <li>associations or other groups representing charities;</li>
    <li>online directory distributors;</li>
    <li>internet portals;</li>
    <li>accounting, law and consulting firms; and</li>
    <li>educational institutions and trade associations.</li>
</ul>

<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of My Family Cookbook; and (d) the link is in the context of general resource information.</p>

<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>

<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to My Family Cookbook. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>

<p>Approved organizations may hyperlink to our Website as follows:</p>

<ul>
    <li>By use of our corporate name; or</li>
    <li>By use of the uniform resource locator being linked to; or</li>
    <li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>
</ul>

<p>No use of My Family Cookbook's logo or other artwork will be allowed for linking absent a trademark license agreement.</p>

<h3><strong>iFrames</strong></h3>

<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>

<h3><strong>Content Liability</strong></h3>

<p>We shall not be hold responsible for any content that appears on this website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>

<h3><strong>Your Privacy</strong></h3>

<p>Please read Privacy Policy</p>

<h3><strong>Reservation of Rights</strong></h3>

<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>

<h3><strong>Removal of links from our website</strong></h3>

<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>

<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>

<h3><strong>Disclaimer</strong></h3>

<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>

<ul>
    <li>limit or exclude our or your liability for death or personal injury;</li>
    <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
    <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
    <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
</ul>

<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>

<p>We will not be liable for any loss or damage of any nature.</p>

</section>


</body>

@endsection
