@extends('admin.layout.app')

@section('title', 'Estimate-create')

@section('content')

    @push('css')
        <link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}" />
    @endpush

    <div class="crms-title row bg-white">
        <div class="col p-0">
            <h3 class="page-title m-0">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="feather-grid"></i>
                </span>
                Create Client
            </h3>
        </div>
        <div class="col p-0 text-end">
            <a href="{{ route('Client.index') }}" class="btn btn-primary">Manage Client</a>
        </div>
    </div>

    <div class="page-header pt-3 mb-0">
        <div class="row">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('Client.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" name="name" id="name" placeholder="Client Name"
                                        class="form-control @error('name') is-invalid border border-danger @enderror"
                                        required value="{{ old('name') }}">
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
                                        required value="{{ old('mobile') }}">
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
                                    <h5>Email<span class="text-danger">*</span></h5>
                                </label>
                                <div class="user-icon">
                                    <input type="email" name="email" id="email" placeholder="Valid Email"
                                        class="form-control @error('email') is-invalid border border-danger @enderror"
                                        value="{{ old('email') }}">
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
                                        rows="2">{{ old('address') }}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="error text-danger ms-5">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center form-wizard-button my-4">
                            <button class="button btn-lights reset-btn" type="reset"
                                data-bs-dismiss="modal">Reset</button>
                            <button class="btn btn-primary" type="submit">Save Client</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('backend/assets/js/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    @endpush
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('button[type="submit"]').prop('disabled', true);
            $('.form-control').on('input', function() {
                var form = $(this).closest('form');
                var requiredFields = form.find('.form-control[required]');
                var invalidFields = requiredFields.filter(function() {
                    return !$(this).val();
                });
                $('button[type="submit"]').prop('disabled', invalidFields.length > 0);
            });
        });
    </script>
@endsection
