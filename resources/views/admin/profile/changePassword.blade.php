@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h2 class="font-weight-bold mb-4">Profile</h2>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <form class="forms-sample" action="{{ route('admin.updateChangePassword') }}" method="POST">
                        @csrf
                        @method('put')
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $admin->email }}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" name="current_password" class="form-control" id="currentPassword" required>
                        @error('current_password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="newPassword" required>
                        @error('new_password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Confirm Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control" id="exampleInputConfirmPassword1" required>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Change</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection