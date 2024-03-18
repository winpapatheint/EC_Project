<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $brands = Brand::latest()->get();
        return view('seller.product.product_add',compact('brands'));
    }
}
