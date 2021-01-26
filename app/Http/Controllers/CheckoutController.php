<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $request->validate([
            'id' => ['required'],
            'quantity' => ['required', 'gt:0', 'max:' . $product->stock, 'integer'],

        ]);

        $checkout = Checkout::updateOrCreate(
            ["product" => $request->id, "user" => Auth::user()->id],
        );


        $checkout->quantity += $request->quantity;
        $checkout->save();

        return response()->json(['message' => 'Added to checkout!']);
    }
    public function index()
    {
        $checkouts = Checkout::where('user', Auth::user()->id)->with('product')->get();

        return view('checkout.index')->with('checkouts', json_decode($checkouts));
    }
}
