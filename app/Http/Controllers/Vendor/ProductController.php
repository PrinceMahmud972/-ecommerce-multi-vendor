<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create() {
        $sections = Section::all();
        return view('vendor.product.create', compact('sections'));
    }

    public function store(Request $request) {
        dd($request->all());
    }



    public function verifySlug(Request $request) {
        $validator = Validator::make($request->all(), ['slug' => 'required|string']);
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product = Product::where('slug', $request->slug)->first();
        
        if(!$product) {
            return response()->json(['success' => true]);
        } else {
            if($request->id && ($request->slug == $product->slug) && ($request->id == $product->id)) {
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]); 
        }
    }
}
