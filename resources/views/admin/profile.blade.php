@extends('admin.layout.app')

@section('title', 'profile')

@section('content')

    @push('css')
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}">
    @endpush


    <div class="content container-fluid pb-0">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img src="{{ asset($data->image ? : 'backend/assets/img/icons/company-icon-10.svg') }}" alt="User Image"></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{$data->name}}</h3>
                                            <h6 class="text-muted">{{$data->role_as}}</h6>
                                            {{-- <small class="text-muted">Web</small> --}}
                                            {{-- <div class="staff-id">Employee ID : </div> --}}
                                            <div class="small doj text-muted">Date of
                                                Join : {{$data->created_at}}</div>
                                            <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send
                                                    Message</a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Phone:</div>
                                                <div class="text"><a href="#">{{$data->mobile}}</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Email:</div>
                                                <div class="text"><a href="#"><span>{{$data->email}}</span></a>
                                                </div>
                                            </li>
                                            {{-- <li>
                                                <div class="title">Birthday:</div>
                                                <div class="text">24th July</div>
                                            </li> --}}
                                            {{-- <li>
                                                <div class="title">Address:</div>
                                                <div class="text">1861 Bayonne Ave,
                                                    Manchester Township, NJ, 08759
                                                </div>
                                            </li> --}}
                                            {{-- <li>
                                                <div class="title">Gender:</div>
                                                <div class="text">Male</div>
                                            </li>
                                            <li>
                                                <div class="title">Reports to:</div>
                                                <div class="text">
                                                    <div class="avatar-box">
                                                        <div class="avatar avatar-xs">
                                                            <img src="assets/img/profiles/avatar-16.jpg" alt="User Image">
                                                        </div>
                                                    </div>
                                                    <a href="profile.html">
                                                        Jeffery Lalor
                                                    </a>
                                                </div>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Profile</a>
                        </li>
                        {{-- <li class="nav-item"><a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Projects</a>
                        </li>
                        <li class="nav-item"><a href="#bank_statutory" data-bs-toggle="tab" class="nav-link">Bank &
                                Statutory <small class="text-danger">(Admin Only)</small></a></li>
                        <li class="nav-item"><a href="#emp_assets" data-bs-toggle="tab" class="nav-link">Assets</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">

            <div id="emp_profile" class="pro-overview tab-pane fade show active">
                <div class="row">
                    @includeIf('errors.error')
                    <div class="col-md-12 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row  my-2">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10 my-2">
                                            <input type="text" name="name" value="{{ $data->name }}"
                                                class="form-control @error('name') is-invalid border border-danger @enderror"
                                                id="inputName" placeholder="Name">
                                            @if ($errors->has('name'))
                                                <span class="error text-danger ">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row my-2">
                                        <label for="inputName" class="col-sm-2 col-form-label">Mobile</label>
                                        <div class="col-sm-10 my-2">
                                            <input type="number" name="mobile" value="{{ $data->mobile }}"
                                                class="form-control @error('mobile') is-invalid border border-danger @enderror"
                                                id="inputName" placeholder="mobile number">
                                            @if ($errors->has('mobile'))
                                                <span class="error text-danger ">{{ $errors->first('mobile') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row my-2">
                                        <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10 my-3">
                                            <input type="email" name="email" value="{{ $data->email }}"
                                                class="form-control @error('email') is-invalid border border-danger @enderror"
                                                id="inputName" placeholder="email App number">
                                            @if ($errors->has('email'))
                                                <span class="error text-danger ">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10 my-2">
                                            <input type="password" name="old_password"
                                                class="form-control @error('old_password') is-invalid border border-danger @enderror"
                                                id="inputEmail" placeholder="old Password">
                                            @if ($errors->has('old_password'))
                                                <span class="error text-danger ">{{ $errors->first('old_password') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row my-2">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10 my-2">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid border border-danger @enderror"
                                                id="inputEmail" placeholder="New Password">
                                            @if ($errors->has('password'))
                                                <span class="error text-danger ">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group row my-2">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10 my-2">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid border border-danger @enderror"
                                                id="inputEmail">
                                            <img src="{{ asset($data->image) }}" alt="profile-image" height="80px"
                                                width="80px">
                                            @if ($errors->has('image'))
                                                <span class="error text-danger ">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group row my-2 ml-auto my-3">
                                        <div class="offset-sm-2 col-sm-10  my-2">
                                            <button type="submit" class="btn btn-success ">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
