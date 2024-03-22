<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Product;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::latest()->get();
        return view('seller.product.product_all',compact('products'));
        // return view('seller.product.product_all');
    }

    public function DetailProduct($id)
    {
        $data = Product::find($id);
        return view('seller.product.product_detail',compact('data'));
    }

    public function AddProduct()
    {
        $brands = Brand::latest()->get();
        $countries = Country::latest()->get();
        return view('seller.product.product_add',compact('brands','countries'));
    }

    public function StoreProduct(Request $request)
    {
        $file = $request->file('product_thambnail');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('upload/product_thambnail', $filename);

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
            $ext = $img->getClientOriginalExtension();
            $filename = time() . '_' . rand(100, 999) . '.' . $ext;
            $img->move('upload/multiImg', $filename);
            MultiImg::create([
                'product_id' => $product_id,
                'photo_name' => $filename,
                'created_at' => Carbon::now(),
            ]);
        }


        return redirect('/seller/all/product');
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

    public function changeStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => 'Status updated successfully']);
    }
}
