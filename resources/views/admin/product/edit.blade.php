@extends('admin.layout.app')
@section('title', 'edit-product')

@section('content')

    @push('css')

    <link rel="stylesheet" href="{{asset('backend/assets/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datetimepicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap4.min.css')}}" />
    @endpush

        <div class="crms-title row bg-white">
            <div class="col p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="feather-grid"></i>
                    </span>
                    Edit Products
                </h3>
            </div>
            <div class="col p-0 text-end">
                <a href="{{route('Product.index')}}" class="btn btn-primary">back</a>
            </div>
        </div>

        <div class="page-header pt-3 mb-0 text-end mb-2">
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <form action="{{route('Product.update')}}" method="POST" enctype="multipart/form-data" name="productEdit">
                            @csrf
                            @if ($errors->any())
                                <div class="">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            @php
                                                toastr()->error($error);
                                            @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="name">
                                            <h5>Product Name<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <input type="hidden" name="id" value="{{$product->id}}">
                                            <input type="text" name="name" id="name" placeholder="Product Name"
                                                class="form-control @error('name') is-invalid border border-danger @enderror" required value="{{$product->name}}">
                                            @if ($errors->has('name'))
                                                <span class="error text-danger ms-5">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">
                                            <h5>Product Category<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <select name="category_id" id="catId" class="form-control @error('category_id') is-invalid border border-danger @enderror" required>
                                                <option disabled selected>Select Category</option>
                                                @forelse ($cat as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="error text-danger ms-5">{{ $errors->first('category_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">
                                            <h5>Sub Category<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <select name="sub_category_id" id="subCategoryId" class="form-control @error('sub_category_id') is-invalid border border-danger @enderror" required >
                                                <option disabled selected>Select Category</option>
                                                @forelse ($subcat as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <div id="loadingSpinner" style="display: none;">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                            @if ($errors->has('sub_category_id'))
                                                <span class="error text-danger ms-5">{{ $errors->first('sub_category_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2 mt-5" style="margin-top: 100px;">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">
                                            <h5>Product Price<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <input type="number" name="price" class="form-control @error('price') is-invalid border border-danger @enderror" placeholder="Product Price" required  value="{{$product->price}}">
                                            @if ($errors->has('price'))
                                                <span class="error text-danger ms-5">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 my-2">
                                    <img src="{{asset($product->image)}}" height="80px" width="100px" alt="">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">
                                            <h5>Product Image<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid border border-danger @enderror">
                                            @if ($errors->has('image'))
                                                <span class="error text-danger ms-5">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-white" id="addSpecification">
                                        <div class="p-3" style="background-color: rgba(202, 99, 104, 0.2)"><h5>Product Specification Details</h5></div>
                                        <thead>
                                            <tr>
                                                <th class="col-sm-4">Icon</th>
                                                <th class="col-md-4">Title</th>
                                                <th class="col-md-4">Description</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbodyoneSpecifi">
                                            @forelse ($specifications as $item)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="specification_id[]" value="{{$item->id}}">
                                                    <input name="icon[]" placeholder="Icon class name from fontawesome"
                                                        type="text" class="form-control @error('icon') is-invalid border border-danger @enderror" value="{{$item->icon}}">
                                                        @if ($errors->has('icon'))
                                                            <span class="error text-danger ms-5">{{ $errors->first('icon') }}</span>
                                                        @endif
                                                    </td>
                                                <td>
                                                    <input name="title[]" placeholder="Enter title" type="text" class="form-control @error('title') is-invalid border border-danger @enderror" value="{{$item->title}}">
                                                    @if ($errors->has('title'))
                                                        <span class="error text-danger ms-5">{{ $errors->first('title') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input name="description[]" placeholder="Enter description" type="text" class="form-control @error('description') is-invalid border border-danger @enderror" value="{{$item->description}}">
                                                    @if ($errors->has('description'))
                                                        <span class="error text-danger ms-5">{{ $errors->first('description') }}</span>
                                                    @endif
                                                </td>
                                            </tr>

                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">
                                            <h5>Short Description<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <textarea name="short_description" id="summernote-one" cols="10" rows="5" class="form-control @error('short_description') is-invalid border border-danger @enderror"
                                                placeholder="Product short description">{{$product->short_description}}</textarea>
                                                @if ($errors->has('short_description'))
                                                    <span class="error text-danger ms-5">{{ $errors->first('short_description') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">
                                            <h5>Long Description<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <textarea name="long_description" id="summernote" cols="10" rows="5" class="form-control @error('long_description') is-invalid border border-danger @enderror"
                                                placeholder="Product long Description">{{ $product->long_description }}</textarea>
                                            @if ($errors->has('long_description'))
                                                <span class="error text-danger ms-5">{!! $errors->first('long_description') !!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <label class="col-form-label">
                                    <h5>Product Status<span class="text-danger">*</span></h5>
                                </label>
                                <div class="d-flex mb-3">
                                    <div class="m-2">
                                        <input type="radio" id="monthlyRadio" name="status" value="active" {{ $product->status == 'active' ? 'checked' : '' }}>
                                        <label for="monthlyRadio">Active</label>
                                    </div>
                                    <div class="m-2">
                                        <input type="radio" id="yearlyRadio" name="status" value="deactive" {{ $product->status == 'deactive' ? 'checked' : '' }}>
                                        <label for="yearlyRadio">Deactive</label>
                                    </div>
                                </div>

                            </div>

                                <div class="col-lg-12 my-3 text-center form-wizard-button">
                                    <button class="btn btn-primary px-5" type="submit">Update</button>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @push('js')
        <script src="{{asset('backend/assets/js/select2.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    @endpush

    <script>
        document.forms['productEdit']['category_id'].value = {{$product->category_id}};
        document.forms['productEdit']['sub_category_id'].value = {{$product->sub_category_id}};
    </script>

@endsection

