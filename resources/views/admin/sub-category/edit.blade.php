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
                    Edit Sub-category
                </h3>
            </div>
            <div class="col p-0 text-end">
                <a href="{{route('Sub-category.index')}}" class="btn btn-primary">back</a>
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
                        <form action="{{route('Sub-category.update')}}" method="POST" name="editform">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label"><h5>Category Name <span class="text-danger">*</span></h5></label>
                                        <div class="user-icon">
                                            <select name="category_id" id="category_id"
                                                class="form-control @error('category_id') is-invalid border border-danger @enderror">
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
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label"><h5>Sub-category Name <span class="text-danger">*</span></h5></label>
                                        <div class="user-icon">
                                            <input type="hidden" name="id" value="{{$category->id}}">
                                            <input class="form-control @error('name') is-invalid border border-danger @enderror"
                                                type="text" name="name" value="{{$category->name}}">
                                            @if ($errors->has('name'))
                                                <span class="error text-danger ms-5">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-2">
                                    <label class="col-form-label">Status</label>
                                    <select class="form-control @error('status') is-invalid border border-danger @enderror" name="status">
                                        <option value="active" {{$category->status == 'active' ? 'selected': ''}}>Active</option>
                                        <option value="deactive" {{$category->status == 'deactive' ? 'selected': ''}}>Deactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="error text-danger ms-5">{{ $errors->first('status') }}</span>
                                    @endif
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

    <script>
        document.forms['editform']['category_id'].value = {{$category->category_id}};
    </script>

@endsection

