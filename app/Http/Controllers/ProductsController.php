<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    //
    public function index(Request $request,Product $product)
    {
//        pd(\Storage::disk('admin'));
        $products = $product->where('on_sale', true)->paginate(16);
        return view('products.index', ['products' => $products]);
    }
}
