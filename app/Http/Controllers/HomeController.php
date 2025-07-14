<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Services\ProductService;
use App\Services\SliderService;
use App\Traits\SystemTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    use SystemTrait;
    protected $sliderService,$productService;
    public function __construct(SliderService $sliderService,ProductService $productService)
    {
        $this->sliderService=$sliderService;
        $this->productService=$productService;

    }
    public function index(){

        $data['sliders'] = $this->sliderService->activeList();
$data['products']=$this->productService->activeList();

        return view('page.home', $data);
    }
    public function about(){
        return view('page.about');
    }
    public function blog(){
        return view('page.blog');
    }
    public function cart(){
        return view('page.cart');
    }
    public function contact(){
        return view('page.contact');
    }
    public function product(){
        return view('page.product');
    }
    public function shop(){
        return view('page.shop');
    }
    public function store(Request $request)
    {
        // Decode JSON input
        $cartItems = $request->json()->all();

        if (empty($cartItems)) {
            return response()->json(['error' => 'Your cart is empty.'], 400);
        }

        foreach ($cartItems as $item) {
            $product = Product::where('title', $item['title'])->first();

            if (!$product) {
                // Log and skip missing products
                Log::error('Product not found for title: ' . $item['title']);
                continue;
            }

            try {
                // Create order for each cart item
                Order::create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'] ?? 1,
                    'status' => 1,
                ]);
            } catch (\Exception $e) {
                // Log errors for debugging
                Log::error('Error creating order for product title: ' . $item['title'] . ' - ' . $e->getMessage());
            }
        }

        return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    }

    ///////////////////////////////
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $cart[] = $request->all();
        session(['cart' => $cart]);

        return response()->json(['success' => true, 'message' => 'Product added to cart!']);
    }
//     public function addToCart(Request $request)
// {
//     $cart = session()->get('cart', []);

//     $cart[] = [
//         'product_id' => $request->product_id,
//         'title' => $request->title,
//         'price' => $request->price,
//         'image' => $request->image,
//         'brand' => $request->brand,
//         'quantity' => $request->quantity ?? 1
//     ];

//     session()->put('cart', $cart);

//     return response()->json(['success' => true, 'cart' => $cart]);
// }


    // public function getCart()
    // {
    //     $cart = session()->get('cart', []);


    //     return response()->json(['cart' => $cart, 'count' => count($cart)]);
    // }
 public function getCart()
{
    Log::info('getCart session ID: ' . session()->getId());
    Log::info('getCart session cart: ' . json_encode(session()->get('cart', [])));

    $cart = session()->get('cart', []);
    return response()->json(['cart' => $cart, 'count' => count($cart)]);
}

    public function removeCartItem(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'index' => 'required|integer',
        ]);

        // Fetch the cart from session or database (adjust according to your setup)
        $cart = session()->get('cart', []);

        // Check if the index exists in the cart
        if (isset($cart[$request->index])) {
            unset($cart[$request->index]); // Remove the item
            session()->put('cart', $cart); // Save the updated cart back to the session

            return response()->json(['success' => true, 'message' => 'Item removed successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in the cart'], 404);
    }

    public function updateCartItem(Request $request)
{
    // Validate the request
    $request->validate([
        'index' => 'required|integer',
        'quantity' => 'required|integer|min:1',
    ]);

    // Fetch the cart from the session
    $cart = session()->get('cart', []);

    // Check if the index exists in the cart
    if (isset($cart[$request->index])) {
        $cart[$request->index]['quantity'] = $request->quantity; // Update the quantity
        session()->put('cart', $cart); // Save the updated cart

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
    }

    return response()->json(['success' => false, 'message' => 'Item not found in the cart'], 404);
}




}
