<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){
        $vendors = Vendor::all();
        return view('admin.vendor.index', compact('vendors'));
    }

    public function enable(Vendor $vendor) {
        $vendor->status = 1;
        $vendor->save();
        return redirect()->route('admin.vendor.index'); 
    }

    public function disable(Vendor $vendor) {
        $vendor->status = 0;
        $vendor->save();
        return redirect()->route('admin.vendor.index'); 
    }

    public function destroy(Vendor $vendor) {
        $vendor->delete();
        return redirect()->route('admin.vendor.index');
    }
}
