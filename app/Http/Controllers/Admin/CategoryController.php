<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index() {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create() {
        $sections = Section::all();
        return view('admin.category.create', compact('sections'));
    }

    public function store(Request $request) {
        $request->validate([
            'section' => 'required|integer',
            'title' => 'required|string|max:50',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
        ]);
        
        $category = new Category();
        $category->section_id = $request->section;
        $category->title = $request->title;
        if($request->image) {
            $category->image = $this->uploadImage($request->image);
        }
        $category->save();
        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category) {
        $sections = Section::all();
        return view('admin.category.edit', compact('category', 'sections'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'section' => 'required|integer',
            'title' => 'required|string|max:50', 
        ]);
        $category->section_id = $request->section;
        $category->title = $request->title;

        if($request->image) {
            $this->deleteImage($category->image);
            $category->image = $this->uploadImage($request->image);
        }
        $category->save();
        return redirect()->route('admin.category.index');

    }

    public function destroy(Category $category) {
        $this->deleteImage($category->image);
        $category->delete();
        return redirect()->route('admin.category.index');
    }

    public function uploadImage($image) {
        $imageName = time().rand(100,999).'.'.$image->extension();
        $image->move(public_path('admin/images/category'), $imageName);
        return $imageName;
    }

    public function deleteImage($imageName) {
        if(File::exists(public_path('admin/images/category/'.$imageName))) {
            File::delete(public_path('admin/images/category/'.$imageName));
        }
    }
}
