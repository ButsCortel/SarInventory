<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\History;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        if (Auth::user()->role === 'GUEST') {
            return response()->json(['message' => 'Unauthorized Account!'], 401);
        };

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
            $product = Product::find($checkout['product']['id']);
            $history = new History();
            $history->previous_stock = $product->stock;
            $product->stock -= $checkout['quantity'];
            $history->stock = $product->stock;
            $history->note = $checkout['quantity'] . ' pc/s sold';
            $history->action = 'SOLD';
            $history->user = Auth::user()->id;
            $history->product = $checkout['product']['id'];
            $product->save();
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

        $start30 = Carbon::now()->subDays(30)->startOfDay();
        $start7 = Carbon::now()->subDays(7)->startOfDay();
        $end = Carbon::now()->endOfDay();

        $query = Sale::whereBetween('created_at', [$start30, $end]);
        $lastMonthSales = $query->get();
        $lastMonthTotal = $query->sum('total');
        $lastWeekQuery = $query->whereBetween('created_at', [$start7, $end]);
        $lastWeekSales = $lastWeekQuery->get();
        $lastWeekTotal = $lastWeekQuery->sum('total');
        $todayQuery = $query->whereDate('created_at', '=', date('Y-m-d'));
        $todaySales = $todayQuery->get();
        $todayTotal = $todayQuery->sum('total');

        $monthItems = 0;
        foreach ($lastMonthSales as $sale) {
            foreach ($sale->checkouts as $checkout) {
                $monthItems += $checkout['quantity'];
            };
        }
        $weekItems = 0;
        foreach ($lastWeekSales as $sale) {
            foreach ($sale->checkouts as $checkout) {
                $weekItems += $checkout['quantity'];
            };
        }
        $todayItems = 0;
        foreach ($todaySales as $sale) {
            foreach ($sale->checkouts as $checkout) {
                $todayItems += $checkout['quantity'];
            };
        }



        return view('sales.index', ['sales' => $todaySales, 'lastMonth' => [$lastMonthTotal, $monthItems], 'lastWeek' => [$lastWeekTotal, $weekItems], 'today' => [$todayTotal, $todayItems]]);
    }
    public function filter(Request $request)
    {
        $sales = [];
        if ($request->from || $request->to) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $sales = Sale::whereBetween('created_at', [$from, $to])->get();
        } else {
            $sales = Sale::all();
        }
        $saleBody = View::make('sales.sale_body', ['sales' => $sales])->render();

        return response()->json(['saleBody' => $saleBody]);
    }

    public function sortBy(Request $request)
    {
    }
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        $user = User::find($sale->user);


        return view('sales.show', ['sale' => $sale, 'user' => $user]);
    }
    // public function create()
    // {
    //     return view('sales.add');
    // }
}
