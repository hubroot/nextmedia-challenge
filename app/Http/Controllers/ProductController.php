<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    function list() {
        return view('products.list');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|unique:products,name|max:255',
            ]);

            $product = Product::create($request->all());
            $product->categories()->sync($request->input('category'));

            return $product;
        }
        return view('products.create');
    }
}
