@extends('admin.layout.app')

@section('title', 'Edit-invoice')

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
                    <h3 class="page-title">Edit Client</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">edit Client</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('Client.update') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="contact-input-set">
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" for="name">
                                        <h5>Name<span class="text-danger">*</span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <input type="hidden" name="id" value="{{$client->id}}">
                                        <input type="text" name="name" id="name" placeholder="Client Name"
                                            class="form-control @error('name') is-invalid border border-danger @enderror"
                                            required value="{{ $client->name }}">
                                        @if ($errors->has('name'))
                                            <span class="error text-danger ms-5">{{ $errors->first('name') }}</span>
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
                                            class="form-control @error('mobile') is-invalid border border-danger @enderror"
                                            required value="{{ $client->mobile }}">
                                        @if ($errors->has('mobile'))
                                            <span class="error text-danger ms-5">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 my-2 ">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" for="image">
                                        <h5>Image<span class="text-danger"></span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <input type="file" name="image" id="image"
                                            class="form-control @error('image') is-invalid border border-danger @enderror">
                                        @if ($errors->has('image'))
                                            <span class="error text-danger ms-5">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 my-2">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" for="email">
                                        <h5>Email<span class="text-danger"></span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <input type="email" name="email" id="email" placeholder="Valid Email"
                                            class="form-control @error('email') is-invalid border border-danger @enderror"
                                             value="{{ $client->email}}">
                                        @if ($errors->has('email'))
                                            <span class="error text-danger ms-5">{{ $errors->first('email') }}</span>
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
                                            class="form-control @error('address') is-invalid border border-danger @enderror" required cols="5"
                                            rows="2">{{$client->address}}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="error text-danger ms-5">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card-header p-2" style="background-color: rgb(241, 218, 218)">
                                    <h5>Product Details</h5>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-block mb-3">
                                    <h5 class="mb-3">Status</h5>
                                    <div class="status-radio-btns d-flex">
                                        <div class="people-status-radio">
                                            <input type="radio" class="status-radio" id="test6" name="status"
                                                value="active" {{ $client->status== 'active' ? 'checked': '' }} >
                                            <label for="test6">Active</label>
                                        </div>
                                        <div class="people-status-radio">
                                            <input type="radio" class="status-radio" id="test7" name="status"
                                                value="deactive" {{ $client->status== 'deactive' ? 'checked': '' }}>
                                            <label for="test7">Deactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center form-wizard-button">
                                <button class="button btn-lights reset-btn" type="reset"
                                    data-bs-dismiss="modal">Reset</button>
                                <button class="btn btn-primary" type="submit">Save Lead</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @includeIf('admin.product.partial.add_project')


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
