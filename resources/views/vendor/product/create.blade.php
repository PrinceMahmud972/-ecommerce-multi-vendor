@extends('vendor.layouts.layout')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">My Shop</h1>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Your Product Page</h3></div>
                <div class="card-body">
                    <form action="{{ route('vendor.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="inputProductTitle" name="title" type="text" 
                                        oninput="checkSlugExists('inputProductTitle', 'inputProductSlug')"
                                    />
                                    <label for="inputProductTitle">Prodct Title</label>
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" id="inputProductSlug" name="slug" type="text" />
                                    <label for="inputProductSlug">Slug</label>
                                    <span class="text-danger" id="slugError"></span>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="section" id="inputSection" class="form-control"
                                        onchange="getCategories()"
                                    >
                                        <option disabled selected>Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->title }}</option>
                                        @endforeach
                                    </select>
                                    <label for="inputSection">Section</label>
                                    @error('section')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="category" id="inputCategory" class="form-control" disabled>
                                        
                                    </select>
                                    <label for="inputCategory">Select Category</label>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="bannerImage" type="file" name="banner"
                                        onchange="imagePreview('#bannerImage', '#previewBannerImage')"
                                    />
                                    <label for="bannerImage">Banner Image</label>
                                </div>
                                @error('banner')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <img class="img-fluid" id="previewBannerImage" src="" style="height: 200px; height: 200px; object-fit:cover">
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea name="description" id="description" class="form-control"></textarea>
                            <label for="description">Description</label>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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