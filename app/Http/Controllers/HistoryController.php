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
    // public function store()
    // {

    //     $history = new History();

    //     $history->name = request('name');
    //     $history->description = request('description');
    //     $history->price = request('price');
    //     $history->stock = request('stock');
    //     $history->thumbnail = request('thumbnail');
    //     $history->category = request('category');
    //     $history->user = request('user');
    //     $history->last_user = request('last_user');

    //     // $history->save();


    //     return redirect('/histories')->with('message', 'history was added successfully!');
    // }
    // public function destroy($id)
    // {
    //     $history = history::findOrFail($id);
    //     $history->delete();
    // }
    // public function update($id)
    // {
    //     $history = history::findOrFail($id);
    //     // $history->delete();
    // }
}
