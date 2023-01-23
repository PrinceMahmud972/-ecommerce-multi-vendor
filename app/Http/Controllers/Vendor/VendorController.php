<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{

    public function dashboard() {
        return view('vendor.dashboard');
    }

    public function register() {
        return view('vendor.register');
    }

    public function storeRegister(Request $request) {
        
        $request->validate([
            'username' => 'required|string|max:100',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'mobile' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50|confirmed'
        ]);

        $vendor = new Vendor();

        $vendor->username = $request->username;
        $vendor->first_name = $request->first_name;
        $vendor->last_name = $request->last_name;
        $vendor->mobile = $request->mobile;
        $vendor->email = $request->email;
        $vendor->password = Hash::make($request->username);
        $vendor->profile_image = 'default_image.jpg';
        
        $vendor->save();

        return redirect()->route('vendor.login');
    }

    public function login() {
        return view('vendor.login');
    }

    public function postLogin(Request $request) {
        $creds = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|max:100'
        ]);

        if(Auth::guard('vendor')->attempt($creds)){
            return redirect()->route('vendor.dashboard');
        }
        
        return back()->withErrors([
            'login'=> 'Incorrect email/password. Please try again'
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }
}
