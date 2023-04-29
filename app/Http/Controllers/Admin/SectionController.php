<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SectionController extends Controller
{

    public function index() {
        $sections = Section::all();
        return view('admin.section.index', compact('sections'));
    }

    public function create() {
        return view('admin.section.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:50',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
        ]);
        
        $section = new Section();
        $section->title = $request->title;
        if($request->image) {
            $section->image = $this->uploadImage($request->image);
        }
        $section->save();
        return redirect()->route('admin.section.index');
    }

    public function edit(Section $section) {
        return view('admin.section.edit', compact('section'));
    }

    public function update(Request $request, Section $section) {
        $request->validate([
            'title' => 'required|string|max:50', 
        ]);

        $section->title = $request->title;

        if($request->image) {
            $this->deleteImage($section->image);
            $section->image = $this->uploadImage($request->image);
        }
        $section->save();
        return redirect()->route('admin.section.index');

    }

    public function destroy(Section $section) {
        $this->deleteImage($section->image);
        foreach($section->categories as $category) {
            CategoryController::deleteImage($category->image);
            $category->delete();
        } 
        $section->delete();
        return redirect()->route('admin.section.index');
    }

    public function uploadImage($image) {
        $imageName = time().rand(100,999).'.'.$image->extension();
        $image->move(public_path('admin/images/section'), $imageName);
        return $imageName;
    }

    public function deleteImage($imageName) {
        if(File::exists(public_path('admin/images/section/'.$imageName))) {
            File::delete(public_path('admin/images/section/'.$imageName));
        }
    }
}
