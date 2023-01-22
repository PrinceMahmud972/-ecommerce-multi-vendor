<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function login() {
        return view('admin.login');
    }

    public function postLogin(Request $request) {
        $creds = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|max:100'
        ]);

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.dashboard');
        }
        
        return back()->withErrors([
            'login'=> 'Incorrect email/password. Please try again'
        ]);

        
    }

    public function logout() {
        Session::flush();
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function changePassword() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.changePassword', compact('admin'));
    }

    public function updateChangePassword(Request $request) {
        $request->validate([
            'current_password' => 'required|max:100',
            'new_password' => 'required|max:100|confirmed'
        ]);

        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        if(!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'Your current password is incorrect!'
            ]);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Successfully updated the password!');
    }

    public function editProfile() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.editProfile', compact('admin'));
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'mobile' => 'required|string|max:20',
        ]);

        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->mobile = $request->mobile;

        if($request->profile_image) {
            $request->validate([
                'profile_image' => 'image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $this->deleteImage($admin->profile_image);
            $admin->profile_image = $this->uploadImage($request->profile_image);
        }

        $admin->save();
        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully!');
    }

    public function uploadImage($image) {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('admin/images/users'), $imageName);
        return $imageName;
    }

    public function deleteImage($imageName) {
        if(File::exists(public_path('admin/images/users/'.$imageName))) {
            File::delete(public_path('admin/images/users/'.$imageName));
        }
    }
}
