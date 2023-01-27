@extends('vendor.layouts.layout')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">My Shop</h1>
    @if (!$shop)
      <div class="row justify-content-center">
        <h3>You Don't have a Shop. <a href="{{ route('vendor.shop.create') }}" class="btn btn-primary btn-lg">Create Now</a></h3>
      </div>
    @else
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-12 col-xl-12">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-image:url({{ url('vendor/images/shops/'.$shop->banner) }}); background-color: #000; height:200px; box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.3)">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                <img src="{{ url('vendor/images/shops/'.$shop->profile) }}"
                  alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                  style="width: 150px; z-index: 1">
                <a href="{{ route('vendor.shop.edit') }}" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                  style="z-index: 1;">
                  Edit profile
                </a>
              </div>
              <div class="ms-3" style="margin-top: 100px;">
                <h3>{{ $shop->name }}</h3>
                <p>{{ '@'.$shop->slug }}</p>
              </div>
            </div>
            <div class="p-4 text-black" style="background-color: #f8f9fa;">
              <div class="d-flex justify-content-end text-center py-1">
                <div>
                  <p class="mb-1 h5">253</p>
                  <p class="small text-muted mb-0">Products</p>
                </div>
                <div class="px-3">
                  <p class="mb-1 h5">1026</p>
                  <p class="small text-muted mb-0">Orders</p>
                </div>
                {{-- <div>
                  <p class="mb-1 h5">478</p>
                  <p class="small text-muted mb-0">Pending Orders</p>
                </div> --}}
              </div>
            </div>
            <div class="card-body p-4 text-black">
              <div class="mb-5">
                <p class="lead fw-normal mb-1">About Shop</p>
                <div class="p-4" style="background-color: #f8f9fa;">
                  <p class="font-italic mb-1">Website: {{ $shop->website }}</p>
                  {{-- <p class="font-italic mb-1">Lives in New York</p>
                  <p class="font-italic mb-0">Photographer</p> --}}
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Recent Products</p>
                <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
              </div>
              <div class="row g-2">
                <div class="col mb-2">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(112).webp"
                    alt="image 1" class="w-100 rounded-3">
                </div>
                <div class="col mb-2">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(107).webp"
                    alt="image 1" class="w-100 rounded-3">
                </div>
              </div>
              <div class="row g-2">
                <div class="col">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp"
                    alt="image 1" class="w-100 rounded-3">
                </div>
                <div class="col">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp"
                    alt="image 1" class="w-100 rounded-3">
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    @endif
</div>

@endsection