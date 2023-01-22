@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h2 class="font-weight-bold mb-4">Settings</h2>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Profile</h4>
                    <form class="forms-sample" action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                      <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ $admin->username }}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') ?? $admin->email }}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') ?? $admin->first_name }}">
                        @error('first_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') ?? $admin->last_name }}">
                        @error('last_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control" id="mobile" value="{{ old('mobile') ?? $admin->mobile }}">
                        @error('mobile')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <img class="img-fuild" id="previewImage" src="{{ url('admin/images/users/'.$admin->profile_image) }}" style="height: 200px; height: 200px; object-fit:cover">
                        <input type="file" id="formImage" name="profile_image" class="form-control file-upload-info" placeholder="Upload Image">
                        @error('profile_image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Update</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection