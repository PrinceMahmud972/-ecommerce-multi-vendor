@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h2 class="font-weight-bold mb-4">Category</h2>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create New Category</h4>
                    <form class="forms-sample" action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="title">Section</label>
                        <select name="section" class="form-control">
                          @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->title }}</option>
                          @endforeach
                        </select>
                        @error('section')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Category Image</label><br>
                        <img class="img-fuild m-2" id="previewImage" src="" style="height: 150px; height: 150px; object-fit:cover">
                        <input type="file" id="formImage" name="image" class="form-control file-upload-info" placeholder="Upload Image">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-success mr-2">Create</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection