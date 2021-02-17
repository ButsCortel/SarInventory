<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $histories = History::with(['product', 'user'])->get(); //retrieve records from db

        return view('histories.index', ['histories' => json_decode($histories)]);
    }
    public function show($id)
    {
        $history = History::findOrFail($id);
        $user = User::find($history->user);
        $product = Product::find($history->product);
        return view('histories.show', ["history" => $history, "user" => $user, "product" => $product]);
    }

    //DELETE
    public function destroy()
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['message' => 'Unauthorized Account!'], 401);
        };

        History::truncate();
    }
}
