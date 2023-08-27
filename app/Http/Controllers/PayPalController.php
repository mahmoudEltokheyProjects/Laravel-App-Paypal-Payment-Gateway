<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;


class PayPalController extends Controller
{
    // ++++++++++++++++++++++++++++ payment() ++++++++++++++++++++++++++++
    public function payment()
    {
        $data = [];
        $data['items'] =
        [
            [
                'name' => 'Apple',
                'price' => 100 ,
                'description' => 'Macbook Laptop',
                'qty' => 1
            ]
        ];
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order Invoice Description";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total']=100;

        $provider = new ExpressCheckout;

        $reponse = $provider->setExpressCheckout($data);
        $reponse = $provider->setExpressCheckout($data,true);

        return redirect($reponse['paypal_link']);
    }
    // ++++++++++++++++++++++++++++ cancel() ++++++++++++++++++++++++++++
    public function cancel()
    {
        dd('You are Cancel This Payment');
    }
    // ++++++++++++++++++++++++++++ success() ++++++++++++++++++++++++++++
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $reponse = $provider->getExpressCheckoutDetails($request->token);
        if( in_array( strtoupper($reponse['ACK']) , ['SUCCESS','SUCCESSWITHWARNING'] ) )
        {
            dd('Your Payment was successfully , Thanks!');
        }
        else
        {
            dd('Please Try Again Later');
        }
    }
}
