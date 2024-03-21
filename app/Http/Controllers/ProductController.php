<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Product;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function AllProduct()
    {
        // $products = Product::latest()->get();
        // return view('seller.product.product_all',compact('products'));
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
        $request->hasFile('product_thambnail');
        $filename = $request->file('product_thambnail')->store('upload/product_thambnail');

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'country_id' => $request->country_id,
            'seller_id' => Auth::user()->id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_percent' => $request->discount_percent,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'product_thambnail' => $filename,
            'status' => 1,
            'estimate_date' => $request->estimate_date,
            'created_at' => Carbon::now(),
        ]);

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $path = $img->store('upload/product/multi_img');
            MultiImg::create([
                'product_id' => $product_id,
                'photo_name' => $path,
                'created_at' => Carbon::now(),
            ]);
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
