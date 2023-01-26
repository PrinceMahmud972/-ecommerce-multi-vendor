@extends('vendor.layouts.layout')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">My Shop</h1>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Your Own Shop</h3></div>
                <div class="card-body">
                    <form action="{{ route('vendor.shop.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="inputShopName" name="name" type="text" />
                                    <label for="inputShopName">Shop Name</label>
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" id="inputShopSlug" name="slug" type="text" />
                                    <label for="inputShopSlug">Slug</label>
                                    <span class="text-danger" id="slugError"></span>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="website" name="website" type="text" />
                                    <label for="website">Website</label>
                                </div>
                                @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" id="tradeLicense" name="trade_license_number" type="text" />
                                    <label for="tradeLicense">Trade License Number</label>
                                    @error('trade_license_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="formImage" type="file" name="banner" placeholder="johnDoe" />
                                    <label for="formImage">Banner Image</label>
                                </div>
                                @error('banner')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <img class="img-fluid" id="previewImage" src="" style="height: 200px; height: 200px; object-fit:cover">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="tin_number" name="tin_number" type="text" />
                                    <label for="tin_number">TIN (Tax Identification Number)</label>
                                </div>
                                @error('tin_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" id="bin_number" name="bin_number" type="text" />
                                    <label for="bin_number">BIN (Business Identification Number)</label>
                                    @error('bin_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 mb-0">
                            <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" value="Create Shop"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection