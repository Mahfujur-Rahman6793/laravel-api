<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct()
    {
        return view('product.add-product');
    }
    public function storeProduct(Request $request)
    {
        dd($request->all());
        return view('product.add-product');
    }
}
