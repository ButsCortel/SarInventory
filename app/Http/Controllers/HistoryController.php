<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $histories = History::all(); //retrieve records from db
        return view('histories.index', ['histories' => $histories]);
    }

    //DELETE
    public function destroy()
    {
        History::truncate();
    }
}
