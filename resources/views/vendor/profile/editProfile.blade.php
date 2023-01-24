@extends('vendor.layouts.layout')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Profile</h1>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Your Profile</h3></div>
                <div class="card-body">
                    <form action="{{ route('vendor.updateProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="inputFirstName" name="first_name" type="text" value="{{ old('first_name') ?? $vendor->first_name }}" />
                                    <label for="inputFirstName">First name</label>
                                </div>
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" id="inputLastName" name="last_name" type="text" value="{{ old('last_name') ?? $vendor->last_name }}" />
                                    <label for="inputLastName">Last name</label>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="mobile" type="text" name="mobile" value="{{ old('mobile') ?? $vendor->mobile }}" />
                            <label for="mobile">Mobile</label>
                            @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="formImage" type="file" name="profile_image" placeholder="johnDoe" />
                                    <label for="formImage">Profile Image</label>
                                </div>
                                @error('profile_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <img class="img-fuild" id="previewImage" src="{{ url('vendor/images/users/'.$vendor->profile_image) }}" style="height: 200px; height: 200px; object-fit:cover">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 mb-0">
                            <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" value="Update Profile"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection