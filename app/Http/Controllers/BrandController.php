<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AddBrand()
    {
        return view('seller.brand.brand_add');
    }

    public function StoreBrand(Request $request)
    {
        $brands = new Brand();
        if ($request->hasFile('brand_icon')) {
            $file = $request->file('brand_icon');

            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('upload/brand', $filename);
            $brands->brand_icon = $filename;
        }
        $brands->brand_name = $request->input('brand_name');
        $brands->save();
        return redirect()->route('add.product');
    }
}
