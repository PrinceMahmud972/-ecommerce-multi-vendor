@extends('vendor.layouts.layout')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Change Password</h1>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Change Your Password</h3></div>
                <div class="card-body">
                    <form action="{{ route('vendor.updateChangePassword') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputEmail" type="email" value="{{ $vendor->email }}" disabled />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="current_password" id="current_password" type="password" placeholder="Password" />
                            <label for="current_password">Password</label>
                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="new_password" name="new_password" type="password" placeholder="Create a password" />
                                    <label for="new_password">Password</label>
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="inputPasswordConfirm" name="new_password_confirmation" type="password" placeholder="Confirm password" />
                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input class="btn btn-primary" type="submit" value="Update">
                        </div>
                    </form>
                    @error('login')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

@endsection