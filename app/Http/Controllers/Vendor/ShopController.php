<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function home() {
        $vendor = Vendor::with('shop')->find(Auth::guard('vendor')->id());
        $shop = $vendor->shop;
        return view('vendor.shop.home', compact('shop'));
    }

    public function create() {
        if(Shop::where('vendor_id', Auth::guard('vendor')->id())->first()){
            return redirect()->route('vendor.shop.home');
        }
        return view('vendor.shop.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|unique:shops,slug',
            'website' => 'string|max:100',
            'trade_license_number' => 'required|string|numeric',
            'banner' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'tin_number' => 'string|numeric',
            'bin_number' => 'string|numeric'
        ]);

        $slug = Shop::where('slug', $request->slug)->first();
        if(!$slug) {
            $shop = new Shop();
            $shop->vendor_id = Auth::guard('vendor')->id();
            $shop->name = $request->name;
            $shop->slug = $request->slug;
            $shop->website = $request->website;
            $shop->trade_license_number = $request->trade_license_number;
            $shop->tin_number = $request->tin_number;
            $shop->bin_number = $request->bin_number;
            $shop->status = 0;

            $shop->banner = $this->uploadImage($request->banner);

            $shop->save();

            return redirect()->route('vendor.shop.home');

        }

        return back()->withErrors([
            'slug' => 'Slug already exits!'
        ]);
    } 

    public function verifySlug(Request $request) {
        $validator = Validator::make($request->all(), ['slug' => 'required|string']);
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $slug = Shop::where('slug', $request->slug)->first();
        
        if(!$slug) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]); 
        }
    }


    public function uploadImage($image) {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('vendor/images/shops'), $imageName);
        return $imageName;
    }

    public function deleteImage($imageName) {
        if(File::exists(public_path('vendor/images/shops/'.$imageName))) {
            File::delete(public_path('vendor/images/shops/'.$imageName));
        }
    }
}
