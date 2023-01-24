<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

    public function changePassword() {
        $vendor = Auth::guard('vendor')->user();

        return view('vendor.profile.changePassword', compact('vendor'));
    }

    public function updateChangePassword(Request $request) {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed|max:50'
        ]);
        
        $vendor = Vendor::where('id', Auth::guard('vendor')->user()->id)->first();
        if(Hash::check($request->current_password, $vendor->password)) {
            $vendor->password = Hash::make($request->new_password);
            $vendor->save();

            return redirect()->route('vendor.dashboard');
        }

        return back()->withErrors(['current_password'=> 'your current password is incorrect']);
    }

    public function editProfile() {
        $vendor = Auth::guard('vendor')->user();

        return view('vendor.profile.editProfile', compact('vendor'));
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'mobile' => 'required|string|max:50',
        ]);
    
        $vendor = Vendor::where('id', Auth::guard('vendor')->user()->id)->first();
        $vendor->first_name = $request->first_name;
        $vendor->last_name = $request->last_name;
        $vendor->mobile = $request->mobile;
        if($request->profile_image) {
            $request->validate([
                'profile_image' => 'image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $this->deleteImage($vendor->profile_image);
            $vendor->profile_image = $this->uploadImage($request->profile_image);
        }

        $vendor->save();
        return redirect()->route('vendor.dashboard');
    }


    public function uploadImage($image) {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('vendor/images/users'), $imageName);
        return $imageName;
    }

    public function deleteImage($imageName) {
        if(File::exists(public_path('vendor/images/users/'.$imageName))) {
            File::delete(public_path('vendor/images/users/'.$imageName));
        }
    }
}
