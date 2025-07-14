<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PendingTransaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
public function payment(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Calculate total from cart
    $totalAmount = 0;
    foreach ($cart as $item) {
        $price = is_numeric($item['price']) ? $item['price'] : floatval($item['price']);
        $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
        $totalAmount += $price * $quantity;
    }

    $transaction_id = uniqid('txn_');

    // Save to pending_transactions table
    PendingTransaction::create([
        'transaction_id' => $transaction_id,
        'cart' => $cart,
        'total_amount' => $totalAmount,
    ]);

    // Build AmarPay payload
    $payload = [
        'store_id'      => config('amarpay.store_id'),
        'tran_id'       => $transaction_id,
        'success_url'   => url('/amarpay/success'),
        'fail_url'      => url('/amarpay/fail'),
        'cancel_url'    => url('/amarpay/cancel'),

        'amount'        => number_format($totalAmount, 2, '.', ''),
        'currency'      => 'BDT',
        'signature_key' => config('amarpay.signature_key'),
        'desc'          => 'Cart Purchase',

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

    // Curl to AmarPay
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
        return redirect('/')->with('error', 'Payment URL generation failed!');
    }
}

public function success(Request $request)
{
    $transaction_id = $request->input('mer_txnid') ?? $request->input('opt_a');

    if (!$transaction_id) {
        return redirect('/product')->with('error', 'No transaction ID received.');
    }

    $pending = PendingTransaction::where('transaction_id', $transaction_id)->first();

    if (!$pending) {
        return redirect('/product')->with('error', 'No transaction record found.');
    }

    $cart = $pending->cart;

    if (empty($cart)) {
        return redirect('/product')->with('error', 'Cart is empty.');
    }

    foreach ($cart as $item) {
        // Find the product by title (assuming titles are unique)
        $product = Product::where('title', $item['title'])->first();

        if (!$product) {
            Log::warning('Product not found for title: ' . $item['title']);
            continue;
        }

        Log::info('Creating order for product ID: ' . $product->id);

        Order::create([
            'product_id' => $product->id,
            'quantity'   => $item['quantity'] ?? 1,
            'status'     => 1,
        ]);
    }

 
Log::info('Before clearing cart session:', session()->all());

$pending->delete();
session()->forget(['cart', 'transaction_id', 'total_amount']);
session()->regenerate();

Log::info('After clearing cart session:', session()->all());

    session()->flash('success', 'Order placed successfully!');

    return redirect('/about'); // Redirect to a clean confirmation page
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
