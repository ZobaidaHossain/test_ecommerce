<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $store_id = config('amarpay.store_id');
        $signature_key = config('amarpay.signature_key');
        $transaction_id = uniqid();

        $payload = [
            'store_id'      => $store_id,
            'tran_id'       => $transaction_id,
     'success_url'   => url('/amarpay/success'),
'fail_url'      => url('/amarpay/fail'),
'cancel_url'    => url('/amarpay/cancel'),

            'amount'        => '10',
            'currency'      => 'BDT',
            'signature_key' => $signature_key,
            'desc'          => 'Course Purchase',
            'cus_name'      => 'Nazmul',
            'cus_email'     => 'nazmul@gmail.com',
            'cus_add1'      => 'House A-55 Road 10',
            'cus_add2'      => 'Jhenaidah, Khulna, Bangladesh',
            'cus_city'      => 'Jhenaidah',
            'cus_state'     => 'Jhenaidah',
            'cus_postcode'  => '7200',
            'cus_country'   => 'Bangladesh',
            'cus_phone'     => '+8801700000001',
            'type'          => 'json',
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://sandbox.aamarpay.com/jsonpost.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $responseObject = json_decode($response, true);

        if (isset($responseObject['payment_url']) && $responseObject['payment_url']) {
            return redirect()->away($responseObject['payment_url']);
        } else {
            return redirect()->to('/')->with('errorMessage', 'Payment URL generation failed!');
        }
    }

  public function success(Request $request)
{
   return redirect('/about')->with('errorMessage', 'Payment successfyl.');
}



    public function fail(Request $request)
    {
        return redirect('/')->with('errorMessage', 'Payment failed.');
    }

    public function cancel(Request $request)
    {
        return redirect('/cart')->with('warningMessage', 'Payment was cancelled.');
    }
}
