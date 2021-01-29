<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\History;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Uploader;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = Product::all(); //retrieve records from db
        return view('products.index', ['products' => $products]);
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', ['product' => $product]);
    }
    public function create()
    {

        return view('products.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'stock' => ['required', 'gt:0', 'integer'],
            'category' => ['required'],
            'thumbnail' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'code' => ['required', 'unique:products']

        ]);

        $product = new Product();
        $history = new History();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category = $request->category;
        $product->code = $request->code;
        $product->user = Auth::user()->id;
        $product->last_user = Auth::user()->id;

        if ($request->hasFile('thumbnail')) {
            $response = Uploader::upload($request->file('thumbnail'));
            error_log($response['secure_url']);
            $product->thumbnail = $response['secure_url'];
        }

        $product->save();

        $history->user = Auth::user()->id;
        $history->product = $product->id;
        $history->save();

        return redirect()->route('products.index')->with('success_create', 'Product was created successfully!');
    }
    public function destroy($id)
    {

        $product = Product::findOrFail($id);
        $product->delete();



        return redirect()->route('products.index')->with('success_delete', 'Product was deleted successfully!');
    }
    public function update($id)
    {
        $product = Product::findOrFail($id);
    }
    public function restock($id, Request $request)
    {
        $request->validate([
            'stock' => ['required', 'gt:0', 'integer'],
        ]);
        $product = Product::findOrFail($id);
        $product->stock += $request->stock;
        $product->save();

        $history = new History();
        $history->user = Auth::user()->id;
        $history->product = $product->id;
        $history->action = 'RESTOCK';
        $history->save();

        return redirect()->route('products.show', $product->id)->with('success_restock', $request->stock . ' pc/s has been added to ' . $product->name . '!');
    }

    public function showAddStock()
    {

        return view('products.addStock');
    }
    public function addStock(Request $request)
    {
        error_log($request->id);
        $request->validate([
            'stock' => ['required', 'gt:0', 'integer'],
            'id' => ['required']
        ]);
        $product = Product::findOrFail($request->id);
        $product->stock += $request->stock;
        $product->save();

        $history = new History();
        $history->user = Auth::user()->id;
        $history->product = $product->id;
        $history->action = 'RESTOCK';
        $history->save();

        return response()->json(['message' => $request->stock . ' pc/s has been added to ' . $product->name]);
    }

    public function fetch(Request $request)
    {
        $product = Product::where('code', $request->code)->get();

        return response()->json(['product' => $product]);
    }
}
