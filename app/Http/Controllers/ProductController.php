<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubCategoryTitle;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::latest()->paginate(4);
        return view('seller.product.product_all',compact('products'));
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
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subcatitle = SubCategoryTitle::latest()->get();
        return view('seller.product.product_add',compact('brands','countries','categories','subcategories','subcatitle'));
    }

    public function StoreProduct(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'sub_category_id' => 'required|string|max:255',
            'sub_category_title_id' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'product_qty' => 'required|numeric',
            'product_tags' => 'required|string|max:255',
            'product_size' => 'required|string|max:255',
            'product_color' => 'required|string|max:255',
            'selling_price' => 'required|numeric',
            'short_desc' => 'required|string|max:255',
            'long_desc' => 'required|string|max:255',
            'product_thambnail' => 'required',
            'multi_img' => 'required',
            'estimate_date' => 'required|string|max:255',
        ]);

        $img = $request->file('product_thambnail');
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $img->move('upload/product_thambnail', $filename);

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'country_id' => $request->country_id,
            'seller_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_category_title_id' => $request->sub_category_title_id,
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
            $filename = time() . '_' . rand(100, 999) . '.' . $img->getClientOriginalExtension();
            $img->move('upload/multiImg', $filename);
            MultiImg::create([
                'product_id' => $product_id,
                'photo_name' => $filename,
                'created_at' => Carbon::now(),
            ]);
        }

        return redirect('/seller/all/product')->with('flash_message', 'Data added successfully');
    }


    public function EditProduct($id)
    {
        $brands = Brand::latest()->get();
        $countries = Country::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subcatitle = SubCategoryTitle::latest()->get();
        $products = Product::findOrFail($id);
        $multiImgs = MultiImg::where('product_id',$id)->get();
        return view('seller.product.product_edit',compact('brands','countries','products','categories','subcategories','subcatitle','multiImgs'));
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;
        $old_img = $request->old_img;

        if($request->hasFile('product_thambnail')) {
            if(File::exists($old_img)) {
                File::delete($old_img);
            }
            $img = $request->file('product_thambnail');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move('upload/product_thambnail', $filename);
        } else {
            $filename = $old_img;
        }

        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'country_id' => $request->country_id,
            'seller_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_category_title_id' => $request->sub_category_title_id,
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
        return redirect('/seller/all/product')->with('flash_message', 'Data updated successfully');
    }

    public function DeleteProduct($id)
{
    $product = Product::findOrFail($id);
    File::delete($product->product_thambnail);
    Product::findOrFail($id)->delete();
    $images = MultiImg::where('product_id',$id)->get();
    foreach($images as $img){
        File::delete($img->photo_name);
        MultiImg::where('product_id',$id)->delete();
    }
    return back()->with('flash_message', 'Data deleted successfully');
}



    public function ChangeStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return redirect()->back();
    }

    public function UpdateMultiImg(Request $request)
    {
        $imgs = $request->multi_img;
        foreach($imgs as $id => $img)
        {
            $imgDel = MultiImg::findOrFail($id);
            File::delete($imgDel->photo_name);
        }
        $filename = time() . '_' . rand(100, 999) . '.' . $img->getClientOriginalExtension();
        $img->move('upload/multiImg', $filename);
        MultiImg::where('id',$id)->update([
            'photo_name' => $filename,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('flash_message', 'Image updated successfully');
    }

    public function DeleteMultiImg($id)
    {
        $old_img = MultiImg::findOrFail($id);
        File::delete($old_img->photo_name);
        MultiImg::findOrFail($id)->delete();
        return redirect()->back()->with('flash_message', 'Image deleted successfully');
    }
}
