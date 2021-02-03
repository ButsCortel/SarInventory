<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\History;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SaleController extends Controller
{
    public function getChange(Request $request)
    {
        $request->validate([
            'checkouts' => ['required'],
            'checkout_ids' => ['required'],
            'total' => ['required', 'numeric'],
            'payment' => ['required'],
        ]);

        $change = $request->payment - $request->total;

        if ($change < 0) {
            return response()->json(['message' => 'Insufficient payment!'], 422);
        };




        return response()->json(['change' => $change, 'total' => $request->total]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'checkouts' => ['required'],
            'checkout_ids' => ['required'],
            'total' => ['required', 'numeric'],
            'payment' => ['required'],
            'change' => ['required'],
        ]);

        if ($request->payment < $request->total) {
            return response()->json(['message' => 'Insufficient payment!'], 422);
        };

        $sale = new Sale();
        $sale->user = Auth::user()->id;
        $sale->checkouts = $request->checkouts;
        $sale->total = $request->total;
        $sale->payment = $request->payment;
        $sale->change = $request->change;
        $sale->save();
        Checkout::destroy($request->checkout_ids);


        foreach ($request->checkouts as $checkout) {
            DB::table('products')
                ->where('id', $checkout['product']['id'])
                ->decrement('stock', $checkout['quantity']);
            $history = new History();
            $history->note = $checkout['quantity'] . ' pc/s sold';
            $history->action = 'SOLD';
            $history->user = Auth::user()->id;
            $history->product = $checkout['product']['id'];
            $history->save();
        };
        $totalView = View::make('checkouts.total', ['checkouts' => [], 'total' => 0])->render();
        $checkoutsView = View::make('checkouts.checkouts', ['checkouts' => []])->render();

        return response()->json(
            ['checkoutsView' => $checkoutsView, 'totalView' => $totalView, 'checkouts' => []]
        );
    }
    public function index()
    {
        return view('sales.index');
    }
    public function show()
    {
        return view('sales.show');
    }
    // public function create()
    // {
    //     return view('sales.add');
    // }
}
