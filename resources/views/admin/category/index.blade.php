@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h2 class="font-weight-bold mb-4">Category</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">All Categories</p>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table display dataTable">
                                    <thead>
                                        <tr>
                                            <td>Title</td>
                                            <td>Image</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>
                                                    <img src="{{ url('admin/images/category/'.$category->image) }}" class="thumbnail">
                                                </td>
                                                <td>{{ $category->title }}</td>
                                                <td>
                                                    <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}" class="btn btn-primary p-2">Edit</a>
                                                    <a href="javascript:{}" onclick="document.getElementById('delete-category-{{ $category->id }}').submit();" class="btn btn-danger p-2">Delete</a>

                                                    <form action="{{ route('admin.category.destroy', ['category' => $category->id]) }}" id="delete-category-{{ $category->id }}" method="POST">
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