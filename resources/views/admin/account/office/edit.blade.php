@extends('admin.layout.app')

@section('title', 'Edit-Office-stuff')

@section('content')

    @push('css')
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}">
    @endpush

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Edit Office Stuff</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">edit Office Stuff</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('Account.office.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @includeIf('errors.error')
                    <div class="row">
                        <div class="col-md-6 my-2 ">
                            <div class="input-block mb-3">
                                <label class="col-form-label" for="name">
                                    <h5>Office Stuff Name<span class="text-danger">*</span></h5>
                                </label>
                                <div class="user-icon">
                                    <input type="hidden" name="userid" value="{{$leadowner->user->id}}">
                                    <input type="hidden" name="id" value="{{$leadowner->id}}">
                                    <input type="text" name="name" id="name" placeholder="Office Stuff Name"
                                        class="form-control @error('name') is-invalid border border-danger @enderror" required value="{{$leadowner->user->name}}" place>
                                    @if ($errors->has('name'))
                                        <span class="error text-danger ms-5">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 my-2">
                            <div class="input-block mb-3">
                                <label class="col-form-label" for="user_name">
                                    <h5>UserName<span class="text-danger">*</span></h5>
                                </label>
                                <div class="user-icon">
                                    <input type="text" name="user_name" id="user_name" placeholder="User Name"
                                        class="form-control @error('user_name') is-invalid border border-danger @enderror" required value="{{$leadowner->user_name}}">
                                    @if ($errors->has('user_name'))
                                        <span class="error text-danger ms-5">{{ $errors->first('user_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="input-block mb-3">
                                <label class="col-form-label" for="mobile">
                                    <h5>Mobile<span class="text-danger">*</span></h5>
                                </label>
                                <div class="user-icon">
                                    <input type="number" name="mobile" id="mobile" placeholder="Mobile Number"
                                        class="form-control @error('user_name') is-invalid border border-danger @enderror" required value="{{$leadowner->user->mobile}}">
                                    @if ($errors->has('mobile'))
                                        <span class="error text-danger ms-5">{{ $errors->first('mobile') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="input-block mb-3">
                                <label class="col-form-label" for="email">
                                    <h5>Email<span class="text-danger">*</span></h5>
                                </label>
                                <div class="user-icon">
                                    <input type="email" name="email" id="email" placeholder="Valid Email"
                                        class="form-control @error('email') is-invalid border border-danger @enderror" required value="{{$leadowner->user->email}}">
                                    @if ($errors->has('email'))
                                        <span class="error text-danger ms-5">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 my-2">
                            <img src="{{asset($leadowner->user->image)}}" height="55px;" width="90px;" alt="">
                            <div class="input-block mb-3">
                                <label class="col-form-label" for="name">
                                    <h5>Image<span class="text-danger">*</span></h5>
                                </label>
                                <div class="user-icon">
                                    <input type="file" name="image" id="lead_owner_id" placeholder="Lead Owner Id"
                                        class="form-control @error('image') is-invalid border border-danger @enderror" value="{{old('name')}}">
                                    @if ($errors->has('image'))
                                        <span class="error text-danger ms-5">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 my-2 mt-5" style="margin-top: 200px;">
                            <div class="input-block mb-3">
                                <label class="col-form-label" for="status">
                                    <h5>Status<span class="text-danger">*</span></h5>
                                </label>
                                <div class="user-icon">
                                    <select name="status" id="status"
                                    class="form-control @error('status') is-invalid border border-danger @enderror">
                                    <option selected disabled>Select Status</option>
                                    <option value="active" {{$leadowner->user->status=='active'?'selected':''}}>Active</option>
                                    <option value="deactive" {{$leadowner->user->status=='deactive'?'selected':''}}>Deactive</option>
                                </select>
                                    @if ($errors->has('status'))
                                        <span class="error text-danger ms-5">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 my-2">
                            <div class="input-block mb-3">
                                <label class="col-form-label" for="address">
                                    <h5>Address<span class="text-danger">*</span></h5>
                                </label>
                                <div class="user-icon">
                                    <textarea name="address" id="address" placeholder="Enter Your Full Address"
                                    class="form-control @error('address') is-invalid border border-danger @enderror" required cols="10" rows="3">{{$leadowner->address}}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="error text-danger ms-5">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section my-3">
                        <button class="btn btn-primary submit-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('backend/assets/js/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/theme-settings.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/greedynav.js') }}" type="text/javascript"></script>

    @endpush

@endsection
