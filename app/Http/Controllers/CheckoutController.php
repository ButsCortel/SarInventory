<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\History;
use App\Models\Product;
use Facade\FlareClient\View as FlareClientView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewView;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'quantity' => ['required', 'gt:0', 'integer'],

        ]);
        $product = Product::findOrFail($request->id);

        if ($product->stock == 0) {
            return response()->json(['message' => 'Insufficient stocks!'], 422);
        };
        $checkout = Checkout::updateOrCreate(
            ["product" => $request->id, "user" => Auth::user()->id],
        );

        $new_val = $checkout->quantity + $request->quantity;

        if ($new_val > $product->stock) {
            return response()->json(['message' => 'Insufficient stocks! ' . $checkout->quantity . ' pc/s already in checkout!'], 422);
        };


        $checkout->quantity += $request->quantity;
        $checkout->save();

        return response()->json(['message' => $request->quantity . ' pc/s ' . $product->name . ' has been added to checkout']);
    }
    public function index()
    {
        $productNoStock = Product::where('stock', '=', '0')->get();
        $products = [];
        foreach (json_decode($productNoStock) as $product) {
            array_push($products, $product->id);
        };
        Checkout::destroy($products);
        $rawCheckouts = Checkout::where('user', Auth::user()->id)->with('product')->get();

        $checkouts = json_decode($rawCheckouts);
        $total = 0;

        foreach ($checkouts as $checkout) {
            $total += $checkout->product->price * $checkout->quantity;
        }





        return view('checkouts.index', ['checkouts' => $checkouts, 'total' => $total]);
    }
    public function ajaxCheckout(Request $request)
    {

        $request->validate([
            'code' => ['required'],
            'quantity' => ['required', 'gt:0', 'integer']
        ]);

        $result = Product::where('code', $request->code)->get();
        if (!count($result)) {
            return response()->json(['message' => 'Product does not exist!'], 422);
        };

        $product = $result[0];
        if ($product->stock == 0) {
            return response()->json(['message' => 'Insufficient stocks!'], 422);
        };

        $checkout = Checkout::firstOrCreate(
            ["product" => $product->id, "user" => Auth::user()->id],
        );

        $new_val = $checkout->quantity + $request->quantity;

        if ($new_val > $product->stock) {
            return response()->json(['message' => 'Insufficient stocks! Only ' . $product->stock . ' pc/s available.'], 422);
        };



        $checkout->quantity += $request->quantity;
        $checkout->save();

        $checkouts = Checkout::where('user', Auth::user()->id)->with('product')->get();
        $total = 0;

        foreach (json_decode($checkouts) as $checkout) {
            $total += $checkout->product->price * $checkout->quantity;
        }

        $totalView = View::make('checkouts.total', ['checkouts' => json_decode($checkouts), 'total' => $total])->render();
        $checkoutsView = View::make('checkouts.checkouts', ['checkouts' => json_decode($checkouts)])->render();

        return response()->json(
            ['checkoutsView' => $checkoutsView, 'totalView' => $totalView, 'checkouts' => json_decode($checkouts)]
        );
    }
    public function destroy($id)
    {

        $checkout = Checkout::where('product', $id);
        if (!$checkout) {
            return response()->json(['message' => 'Checkout does not exist!'], 422);
        };
        $checkout->delete();

        $checkouts = Checkout::where('user', Auth::user()->id)->with('product')->get();
        $total = 0;

        foreach (json_decode($checkouts) as $checkout) {
            $total += $checkout->product->price * $checkout->quantity;
        }

        $totalView = View::make('checkouts.total', ['checkouts' => json_decode($checkouts), 'total' => $total])->render();
        $checkoutsView = View::make('checkouts.checkouts', ['checkouts' => json_decode($checkouts)])->render();

        return response()->json(['checkoutsView' => $checkoutsView, 'totalView' => $totalView, 'checkouts' => json_decode($checkouts)]);
    }
    public function reset()
    {
        $checkouts = Checkout::where('user', Auth::user()->id);
        $checkouts->delete();
        $totalView = View::make('checkouts.total', ['checkouts' => [], 'total' => 0])->render();
        $checkoutsView = View::make('checkouts.checkouts', ['checkouts' => []])->render();
        return response()->json(['checkoutsView' => $checkoutsView, 'totalView' => $totalView]);
    }
}
