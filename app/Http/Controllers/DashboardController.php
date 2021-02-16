<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $start30 = Carbon::now()->subDays(30)->startOfDay();
        $start7 = Carbon::now()->subDays(7)->startOfDay();
        $end = Carbon::now()->endOfDay();

        $query = Sale::whereBetween('created_at', [$start30, $end]);
        $lastMonthTotal = $query->sum('total');
        $lastWeekQuery = $query->whereBetween('created_at', [$start7, $end]);
        $lastWeekTotal = $lastWeekQuery->sum('total');
        $todayQuery = $query->whereDate('created_at', '=', date('Y-m-d'));
        $todayTotal = $todayQuery->sum('total');

        $products = Product::where('stock', '<', '6')->get();
        $histories = History::orderBy('created_at', 'DESC')->paginate(10);

        return view('dashboard', ['products' => $products, 'histories' => $histories, 'lastMonthTotal' => $lastMonthTotal, 'lastWeekTotal' => $lastWeekTotal, 'todayTotal' => $todayTotal]);
    }
}
