@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h2 class="font-weight-bold mb-4">Vendor</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">All Vendors</p>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table display dataTable">
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Image</td>
                                            <td>Name</td>
                                            <td>Email</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $vendor)
                                            <tr>
                                                <td>{{ $vendor->id }}</td>
                                                <td>
                                                    <img src="{{ url('vendor/images/users/'.$vendor->profile_image) }}" class="thumbnail">
                                                </td>
                                                <td>{{ $vendor->first_name . ' ' . $vendor->last_name }}</td>
                                                <td>{{ $vendor->email }}</td>
                                                <td>
                                                    @if($vendor->status)
                                                        <span class="btn btn-sm btn-success disabled">Active</span>
                                                    @else
                                                        <span class="btn btn-sm btn-warning disabled">Disabled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($vendor->status)
                                                        <form class="inline-block" action="{{ route('admin.vendor.disable', ['vendor' => $vendor->id]) }}" id="disable-vendor-{{ $vendor->id }}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                        </form>
                                                        <a href="javascript:{}" onclick="document.getElementById('disable-vendor-{{ $vendor->id }}').submit();" class="btn btn-warning p-2">Disable</a>
                                                    @else
                                                        <form class="inline-block" action="{{ route('admin.vendor.enable', ['vendor' => $vendor->id]) }}" id="enable-vendor-{{ $vendor->id }}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                        </form>
                                                            <a href="javascript:{}" onclick="document.getElementById('enable-vendor-{{ $vendor->id }}').submit();" class="btn btn-success p-2">Enable</a>
                                                    @endif

                                                    <a href="javascript:{}" onclick="document.getElementById('delete-vendor-{{ $vendor->id }}').submit();" class="btn btn-danger p-2">Delete</a>
                                                    <form action="{{ route('admin.vendor.destroy', ['vendor' => $vendor->id]) }}" id="delete-vendor-{{ $vendor->id }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection