<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct()
    {
        return view('product.add-product');
    }
    public function storeProduct(Request $request)
    {
        $roles = [
            'name.*' => 'required|string|max:255',
            'model.*' => 'nullable|string|max:255',
            'company.*' => 'nullable|string|max:255',
            'price.*' => 'nullable|numeric|min:0',
        ];
        $customMessages = [
            'name.*.required' => 'Product name is required.',
            'name.*.string' => 'Product name must be a string.',
            'name.*.max' => 'Product name may not be greater than 255 characters.',
            'model.*.string' => 'Model must be a string.',
            'model.*.max' => 'Model may not be greater than 255 characters.',
            'company.*.string' => 'Company must be a string.',
            'company.*.max' => 'Company may not be greater than 255 characters.',
            'price.*.numeric' => 'Price must be a number.',
            'price.*.min' => 'Price must be at least 0.',
        ];
        $request->validate($roles, $customMessages);
        // dd($request->all());
        try{
            foreach($request->name as $key => $product){
            // $products = new Product();
            // $products->name = $product;
            // $products->model = $request->model[$key] ?? null;
            // $products->company = $request->company[$key] ?? null;
            // $products->price = $request->price[$key] ?? 0;
            // $products->save();
            Product::create([
                'name' => $product,
                'model' => $request->model[$key] ?? null,
                'company' => $request->company[$key] ?? null,
                'price' => $request->price[$key] ?? 0,
            ]);
        }
        return redirect()->back()->with('success', 'Products added successfully!');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => 'Something went wrong!'])->withInput();
        }


    }
}
