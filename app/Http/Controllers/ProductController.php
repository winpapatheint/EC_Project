<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AllProduct()
    {
        return view('seller.product.product_all');
    }

    public function DetailProduct()
    {
        return view('seller.product.product_detail');
    }

    public function AddProduct()
    {
        $brands = Brand::latest()->get();
        $countries = Country::latest()->get();
        return view('seller.product.product_add',compact('brands','countries'));
    }

    public function StoreProduct(Request $request)
    {
        $product = new Product();
        if ($request->hasFile('product_thambnail')) {
            $filename = $request->file('product_thambnail')->store('upload/thambnail');
            $product->product_thambnail = $filename;
        }
        return view('seller.product.product_all');
    }

    public function EditProduct()
    {
        return view('seller.product.product_edit');
    }

    public function UpdateProduct()
    {
        return view('seller.product.product_update');
    }

    public function DeleteProduct()
    {
        return view('seller.product.product_all');
    }
}
