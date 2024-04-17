<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubCategoryTitle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function allProduct()
    {
        $products = Product::latest()->paginate(4);
        return view('seller.product.product_all',compact('products'));
    }

    public function getSubTitle($categoryId)
    {
        $subcategories = SubcategoryTitle::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function getSubcategory($subtileId)
    {
        $subcategories = Subcategory::where('sub_category_title_id', $subtileId)->get();
        return response()->json($subcategories);
    }

    public function detailProduct($id)
    {
        $data = Product::find($id);
        $multiImgs = MultiImg::where('product_id',$id)->get();
        return view('seller.product.product_detail',compact('data','multiImgs'));
    }

    public function addProduct()
    {
        $brands = Brand::latest()->get();
        $countries = Country::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subcatitle = SubCategoryTitle::latest()->get();
        return view('seller.product.product_add',compact('brands','countries','categories','subcategories','subcatitle'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'sub_category_title_id' => 'required|string|max:255',
            'sub_category_id' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'product_qty' => 'required|numeric',
            'product_tags' => 'required|string|max:255',
            'product_size' => 'required|string|max:255',
            'product_color' => 'required|string|max:255',
            'original_price' => 'required|numeric',
            'short_desc' => 'required|string|max:255',
            'long_desc' => 'required|string|max:255',
            'product_thambnail' => 'required|image|mimes:jpeg,png,jpg,gif',
            'multi_img' => 'required',
            'estimate_date' => 'required|string|max:255',
            'delivery_price' => 'required|string|max:255',
        ]);

        $img = $request->file('product_thambnail');
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $img->move('upload/product_thambnail', $filename);

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'country_id' => $request->country_id,
            'category_id' => $request->category_id,
            'sub_category_title_id' => $request->sub_category_title_id, //$request->sub_category_title_id
            'sub_category_id' => $request->sub_category_id,//$request->sub_category_id
            'seller_id' => Auth::user()->id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'original_price' => $request->original_price,
            'selling_price' => $request->calculated_selling_price,
            'discount_percent' => $request->discount_percent,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'product_thambnail' => $filename,
            'status' => 1,
            'estimate_date' => $request->estimate_date,
            'delivery_price' => $request->delivery_price,
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
        return redirect('/seller/productlist')->with('flash_message', 'Data added successfully');
    }


    public function editProduct($id)
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

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);
        $old_img = $request->old_img;
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'product_qty' => 'required|numeric',
            'product_tags' => 'required|string|max:255',
            'product_size' => 'required|string|max:255',
            'product_color' => 'required|string|max:255',
            'original_price' => 'required|numeric',
            'short_desc' => 'required|string|max:255',
            'long_desc' => 'required|string|max:255',
            'estimate_date' => 'required|string|max:255',
        ]);

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
        $product->brand_id = $request->brand_id;
        $product->country_id = $request->country_id;
        $product->seller_id = Auth::user()->id;
        $product->category_id= $request->category_id;
        $product->sub_category_id= $request->sub_category_id;
        $product->sub_category_title_id= $request->sub_category_title_id;
        $product->product_name= $request->product_name;
        $product->product_code= $request->product_code;
        $product->product_qty= $request->product_qty;
        $product->product_tags= $request->product_tags;
        $product->product_size= $request->product_size;
        $product->product_color= $request->product_color;
        $product->original_price= $request->original_price;
        $product->discount_percent= $request->discount_percent;
        $product->short_desc= $request->short_desc;
        $product->long_desc= $request->long_desc;
        $product->product_thambnail= $filename;
        $product->estimate_date= $request->estimate_date;
        $product->status= 1;
        $product->updated_at= Carbon::now();
        $product->update();
        return redirect('/seller/productlist')->with('flash_message', 'Data updated successfully');
    }

    public function deleteProduct(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        File::delete($product->product_thambnail);
        Product::findOrFail($id)->delete();
        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            File::delete($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }
        return back()->with('flash_message', 'Data deleted successfully');
    }


    public function changeStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return redirect()->back();
    }

    public function updateMultiImg(Request $request)
    {
        $request->validate([
            'multi_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
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
        return back()->with('flash_message', 'Image updated successfully');
    }

    public function deleteMultiImg($id)
    {
        $old_img = MultiImg::findOrFail($id);
        File::delete($old_img->photo_name);
        MultiImg::findOrFail($id)->delete();
        return back()->with('flash_message', 'Image deleted successfully');
    }

    public function productList()
    {
        $products = Product::all();

        return view('products', compact('products'));
    }

    public function review()
    {
        $id = Auth::user()->id;
        $review = Review::where('user_id',$id)->latest()->paginate(10);
        return view('seller.product.product_review',compact('review'));
    }

    public function changeRtStatus(Request $request)
    {
        $star = Review::find($request->review_id);
        $star->status = $request->status;
        $star->save();
        return redirect()->back();
    }

    public function updateReview(Request $request)
    {
        $review = Review::find($request->review_id);
        $review->comment = $request->comment;
        $review->updated_at= Carbon::now();
        $review->save();
        return redirect()->back();
    }

    public function deleteReview(Request $request)
    {
        $id = $request->id;
        Review::findOrFail($id)->delete();
        return back()->with('flash_message', 'Data deleted successfully');
    }
}