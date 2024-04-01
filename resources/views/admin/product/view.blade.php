@extends('admin.layout.app')

@section('title', 'View Lead')

@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h3 class="page-title my-3">Details Product </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">view product </li>
                    </ul>
                </div>
                <div class="col-md-8 float-end ms-auto">
                    <div class="d-flex title-head">
                        <div class="view-icons">
                            <a href="javascript:void(0);" class="list-view btn btn-link" id="collapse-header"><i
                                    class="las la-expand-arrows-alt"></i></a>

                        </div>
                        <div class="form-sort">

                        </div>
                        <a href="{{route('Product.index')}}" class="btn add-btn" ><i
                                class="la la-plus-circle"></i>Manage Details</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">

            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">

                        <label for="" class="my-2"><h5>Product Image</h5></label>
                        <div class="image text-center">
                            <img src="{{asset($product->image)}}" height="170px" width="170px"  alt="">
                        </div>


                        <div class="specifications my-3">
                            <label for="" class=" my-3"><h5>Product Specification</h5></label>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripted">
                                    <thead>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($product->specification as $item)
                                        <tr>
                                            <td><i class="{{$item->icon}}"></i></td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->description}}</td>
                                        </tr>
                                        @empty

                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="specifications my-3">
                            <label for="" class=" my-3"><h5>Product Details</h5></label>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripted">
                                    <tr>
                                        <th>Product Name</th>
                                        <td>{{$product->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Category</th>
                                        <td>{{$product->category->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Sub-category</th>
                                        <td>{{$product->category->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product slug</th>
                                        <td>{{$product->slug}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product price</th>
                                        <td>{{$product->price}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product created_at</th>
                                        <td>{{$product->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product status</th>
                                        <td>{{$product->status}}</td>
                                    </tr>
                                    <tr>
                                        <th>short_description</th>
                                        <td>{{$product->short_description}}</td>
                                    </tr>
                                    <tr>
                                        <th>long_description</th>
                                        <td>{!! $product->long_description !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
