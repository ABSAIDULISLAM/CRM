@extends('admin.layout.app')

@section('title', 'edit-category')

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
                    Edit Category
                </h3>
            </div>
            <div class="col p-0 text-end">
                <a href="{{route('Category.index')}}" class="btn btn-primary">back</a>
            </div>
        </div>

        <div class="page-header pt-3 mb-0">
            <div class="row">

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <form action="{{route('Category.update')}}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group row">
                                <div class="col-md-6 my-3">
                                    <label class="col-form-label">Category Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{$category->name}}" />
                                    <input class="form-control" type="hidden" name="id" value="{{$category->id}}" />
                                </div>
                                <div class="col-md-6 my-3">
                                    <label class="col-form-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="active" {{$category->status == 'active' ? 'selected' :''}}>Active</option>
                                        <option value="deactive" {{$category->status == 'deactive' ? 'selected' :''}}>Deactive</option>
                                        @if ($errors->has('status'))
                                            <span class="error text-danger ms-5">{{ $errors->first('status') }}</span>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6  my-3 d-flex">
                                    <div class="tx">
                                        <label class="col-form-label">Category Image <span class="text-danger"></span></label>
                                        <input class="form-control" type="file" name="image" />
                                        @error('image')
                                            <span class="error text-danger ms-5">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="m-4">
                                        <img src="{{asset($category->image)}}" alt="" height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center py-3 mt-4">
                                <button type="submit" class="px-5 border-0 btn btn-primary btn-gradient-primary btn-rounded">Update</button>&nbsp;&nbsp;
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

@endsection

