<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\User;
use App\Models\Payment;


class StripeController extends Controller
{
    public function create()
    {
        return view('stripe.create');
    }

    public function store(Request $request)
    {
        // Credit Card Donation
        if ($request->input('stripeToken')) {
  
            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey(env('STRIPE_SECRET'));
           
            $token = $request->input('stripeToken');
           
            $response = $gateway->purchase([
                'amount' => $request->input('amount'),
                'currency' => 'USD',
                'token' => $token,
            ])->send();
           
            if ($response->isSuccessful()) {
                // payment was successful: insert transaction data into the database
                $arr_payment_data = $response->getData();
                  
                $isPaymentExist = Payment::where('payment_id', $arr_payment_data['id'])->first();
           
                if(!$isPaymentExist)
                {
                    $payment = new Payment;
                    $payment->payment_id = $arr_payment_data['id'];
                    $payment->amount = $arr_payment_data['amount']/100;
                    $payment->save();
                }
  
                return "Donation is successful. Your payment id is: ". $arr_payment_data['id'];
            } else {
                // payment failed: display message to customer
                return $response->getMessage();
            }     
        }
        // Bitcoin Donation
        else{
            return "Donation recorded";
        }
    }
}
