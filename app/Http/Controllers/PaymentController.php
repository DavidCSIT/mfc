<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe;
use Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => request('amount'),
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose"
        ]);
        
        $payment = new Payment();
        $payment->amount = $request->amount;
        $payment->user_id = Auth::user()->id;
        $payment->save();

        Session::flash('success', 'Donation successful! Thank-you');
           
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payement  $payement
     * @return \Illuminate\Http\Response
     */
    public function show(Payement $payement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payement  $payement
     * @return \Illuminate\Http\Response
     */
    public function edit(Payement $payement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payement  $payement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payement $payement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payement  $payement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payement $payement)
    {
        //
    }
}
