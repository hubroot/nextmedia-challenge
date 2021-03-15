<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Product;
use \App\Models\Category;

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
        $products = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('name')->get();

        return view('products.list')->with([
            'products' => $products,
            'categories' => $categories
        ]);
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
