<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use App\Models\Notification;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\SubCategoryTitle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    public function allProduct()
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $limit = 10;
        $id = Auth::user()->created_by ?? Auth::id();
        $productsQuery = Product::where('seller_id', $id);

        if ($search !== null) {
            $productsQuery->where(function($query) use ($search) {
                $query->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('product_code', 'like', '%' . $search . '%');
            });
        }

        $products = $productsQuery->latest()->paginate($limit);

        $ttl = $products->total();
        $ttlpage = ceil($ttl / $limit);

        return view('seller.product.product_all', compact('products', 'ttl', 'ttlpage', 'search'));
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
        $validatedData = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'country_id' => 'required|exists:countries,id',
            'category_id' => 'required|exists:categories,id',
            'sub_category_title_id' => 'present|exists:sub_category_titles,id',
            'sub_category_id' => 'present|exists:sub_categories,id',
            'product_name' => 'present|string|max:255',
            'product_qty' => 'present|string|max:255',
            'product_tags' => 'present|string|max:255',
            'product_size' => 'present|string|max:255',
            'product_color' => 'present|string|max:255',
            'original_price' => 'present|string|max:255',
            'short_desc' => 'present|string|max:255',
            'long_desc' => 'present|string|max:255',
            'care_instructions' => 'present|string|max:255',
            'product_thambnail' => 'present|image|mimes:jpeg,png,jpg,gif',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'estimate_date' => 'present|string|max:255',
            'delivery_price' => 'present|string|max:255',
            'delivery_price' => 'present|string|max:255',
        ]);

        $datePrefix = date('ym');
        $latestProduct = Product::where('product_code', 'like', $datePrefix . '%')->latest()->first();
        $sequentialNumber = 1;
        if ($latestProduct) {
            $latestProductCode = $latestProduct->product_code;
            $sequentialNumber = intval(substr($latestProductCode, strlen($datePrefix))) + 1;
        }
        $newProductCode = $datePrefix . str_pad($sequentialNumber, 5, '0', STR_PAD_LEFT);

        $img = $request->file('product_thambnail');
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('upload/product_thambnail'), $filename);

        $id = Auth::user()->created_by ?? Auth::id();
        $sellerData = Seller::where('user_id',$id)->get();
        $commission = $sellerData->commission;
        $product_id = Product::insertGetId([
            'product_code' => $newProductCode,
            'brand_id' => $validatedData['brand_id'],
            'country_id' => $validatedData['country_id'],
            'category_id' => $validatedData['category_id'],
            'sub_category_title_id' => $validatedData['sub_category_title_id'],
            'sub_category_id' => $validatedData['sub_category_id'],
            'seller_id' => $id,
            'product_name' => $validatedData['product_name'],
            'product_qty' => $validatedData['product_qty'],
            'in_stock' => $validatedData['product_qty'],
            'product_tags' => $validatedData['product_tags'],
            'product_size' => $validatedData['product_size'],
            'product_color' => $validatedData['product_color'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $request->calculated_selling_price,
            'discount_percent' => $request->discount_percent ?? 0,
            'short_desc' => $validatedData['short_desc'] ,
            'long_desc' => $validatedData['long_desc'],
            'care_instructions' => $validatedData['care_instructions'],
            'product_thambnail' => $filename,
            'commission' => $commission,
            'status' => 1,
            'estimate_date' => $validatedData['estimate_date'],
            'delivery_price' => $validatedData['delivery_price'],
            'created_at' => Carbon::now(),
        ]);

        $images = $request->file('images');
        foreach ($images as $img) {
            $filename = time() . '_' . rand(100, 999) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('upload/multiImg'), $filename);
            MultiImg::create([
                'product_id' => $product_id,
                'photo_name' => $filename,
                'created_at' => Carbon::now(),
            ]);
        }

        $inquiry_email = 'info-test@asia-hd.com';
        $user = User::where('id', Auth::user()->id)->select('email', 'name')->first();

        $email = $user->email;
        $name = $user->name;
        $data = array('name'=>$name);
        if (!empty($request->email)) {
            $mail = Mail::send([], $data, function($message) use ($request, $inquiry_email,$name,$email) {
                $message->to($inquiry_email, 'Ecommerce ')->subject($name.'からの質問');
                $message->from($email,$name);
                $message->setBody("E commerce 公式サイトから、以下の通知がありました。
                \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                \r\n名前：　".$name."
                \r\n"."メールアドレス：　".$email."
                \r\n
                \r\n"."通知のお知らせ：　
                \r\n
                \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
            });
        }

        $notification = Notification::find(3);
        $newval = array('time' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        );
        $notification->update( $newval);

        $msg = ('Product added Successfully');
        return redirect('/productlist')->with('success', $msg);
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
            'category_id' => 'required|exists:categories,id',
            'sub_category_title_id' => 'present|exists:sub_category_titles,id',
            'sub_category_id' => 'present|exists:sub_categories,id',
            'product_name' => 'required|string|max:255',
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
            $img->move(public_path('upload/product_thambnail'), $filename);
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
        $product->product_qty= $request->product_qty;
        $product->in_stock= $request->product_qty;
        $product->product_tags= $request->product_tags;
        $product->product_size= $request->product_size;
        $product->product_color= $request->product_color;
        $product->original_price= $request->original_price;
        $product->discount_percent= $request->discount_percent ?? 0;
        $product->selling_price = $request->calculated_selling_price;
        $product->short_desc= $request->short_desc;
        $product->long_desc= $request->long_desc;
        $product->care_instructions= $request->care_instructions;
        $product->product_thambnail= $filename;
        $product->estimate_date= $request->estimate_date;
        $product->status= 1;
        $product->delivery_price= $request->delivery_price;
        $product->updated_by = Auth::user()->id;
        $product->updated_at= Carbon::now();
        $product->update();
        $msg = ('Product updated Successfully');
        return redirect('/productlist')->with('success', $msg);
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
        $msg = ('Product deleted Successfully');
        return back()->with('success', $msg);
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
        $id = $request->product_id;
        if ($request->has('multi_img')) {
            foreach($request->multi_img as $id => $img) {
                if ($img->isValid()) {
                    $filename = time() . '_' . rand(100, 999) . '.' . $img->getClientOriginalExtension();
                    $img->move(public_path('upload/multiImg'), $filename);

                    MultiImg::where('id', $id)->update([
                        'photo_name' => $filename,
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $newImg = $request->File('new_img');
        if ($newImg->isValid()) {
            $filename = time() . '_' . rand(100, 999) . '.' . $newImg->getClientOriginalExtension();
            $newImg->move(public_path('upload/multiImg'), $filename);

            MultiImg::create([
                'product_id' => $id,
                'photo_name' => $filename,
                'created_at' => Carbon::now(),
            ]);
        }

        $msg = ('Image updated Successfully');
        return redirect('/productlist')->with('success', $msg);
    }

    public function deleteMultiImg(Request $request)
    {
        $id = $request->id;
        $old_img = MultiImg::findOrFail($id);
        $filePath = public_path('upload/multiImg/' . $old_img->photo_name);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        MultiImg::findOrFail($id)->delete();
        $msg = ('Image deleted Successfully');
        return redirect('/productlist')->with('success', $msg);
    }


    public function review()
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $limit = 10;
        $id = Auth::user()->created_by ?? Auth::id();
        $query = Review::where('user_id', $id);

        if ($search) {
            $query->whereHas('product', function($q) use ($search) {
                $q->where('product_name', 'LIKE', "%{$search}%");
            });
        }

        $review = $query->latest()->paginate($limit);

        $ttl = $review->total();
        $ttlpage = ceil($ttl / $limit);

        return view('seller.product.product_review', compact('review', 'ttl', 'ttlpage'));
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
        $msg = ('Review deleted Successfully');
        return back()->with('success', $msg);
    }
}
