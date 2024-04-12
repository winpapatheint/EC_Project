<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function addBrand()
    {
        return view('seller.brand.brand_add');
    }

    public function storeBrand(Request $request)
    {
        $brands = new Brand();
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('brand_icon')) {
            $imageName = time().'.'.$request->brand_icon->extension();
            $request->brand_icon->move(public_path('upload/brand'), $imageName);
            // $filename = $request->file('brand_icon')->store('upload/brand');
            $brands->brand_icon = $imageName;
        }
        $brands->brand_name = $request->input('brand_name');
        $brands->save();
        return redirect()->route('add.product');
    }
}