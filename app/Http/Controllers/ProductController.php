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
            'thumbnail' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:5120']

        ]);

        $product = new Product();
        $history = new History();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category = $request->category;
        $product->code = Str::random(20);
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




        return redirect('/products')->with('message', 'Product was added successfully!');
    }
    public function destroy($id)
    {
        error_log($id . 'wtf');
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('message', 'Product was deleted successfully!');
    }
    public function update($id)
    {
        $product = Product::findOrFail($id);

        // $product->delete();
    }
}
