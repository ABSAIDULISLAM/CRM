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
                Create Lead owner
            </h3>
        </div>
        <div class="col p-0 text-end">
            <a href="{{ route('Lead-owner.index') }}" class="btn btn-primary">Manage Lead owner</a>
        </div>
    </div>

    <div class="page-header pt-3 mb-0">
        <div class="row">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('Lead-owner.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @includeIf('errors.error')
                <div class="row">
                    <div class="col-md-12 my-2 ">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Lead Owner Name<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="text" name="name" id="name" placeholder="Lead Owner Name"
                                    class="form-control @error('name') is-invalid border border-danger @enderror" required value="{{old('name')}}" place>
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
                                    class="form-control @error('user_name') is-invalid border border-danger @enderror" required value="{{old('mobile')}}">
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
                                    class="form-control @error('email') is-invalid border border-danger @enderror" required value="{{old('email')}}">
                                @if ($errors->has('email'))
                                    <span class="error text-danger ms-5">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @php
                        $latestLeadOwner = App\Models\LeadOwner::latest()->first();
                        $invoiceNumber = $latestLeadOwner ? $latestLeadOwner->lead_owner_id + 1 : 10001;

                    @endphp

                    <div class="col-md-6 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Lead Owner Id<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="text" name="lead_owner_id" id="lead_owner_id" placeholder="Lead Owner Id" value="{{ $invoiceNumber }}" readonly
                                    class="form-control @error('lead_owner_id') is-invalid border border-danger @enderror" required>
                                @if ($errors->has('lead_owner_id'))
                                    <span class="error text-danger ms-5">{{ $errors->first('lead_owner_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Lead Owner Image<span class="text-danger"></span></h5>
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
                    <div class="col-md-6 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="user_name">
                                <h5>UserName<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="text" name="user_name" id="user_name" placeholder="User Name"
                                    class="form-control @error('user_name') is-invalid border border-danger @enderror" required value="{{old('user_name')}}">
                                @if ($errors->has('user_name'))
                                    <span class="error text-danger ms-5">{{ $errors->first('user_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Confirm Password<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="password" name="password" id="password" placeholder="Enter Password"
                                    class="form-control @error('password') is-invalid border border-danger @enderror" required >
                                @if ($errors->has('password'))
                                    <span class="error text-danger ms-5">{{ $errors->first('password') }}</span>
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
                                class="form-control @error('address') is-invalid border border-danger @enderror" required cols="10" rows="3">{{old('address')}}</textarea>
                                @if ($errors->has('address'))
                                    <span class="error text-danger ms-5">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="submit-section my-3">
                    <button class="btn btn-primary submit-btn">Submit</button>
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
    {{-- <script>
        $(document).ready(function(){
            $('button[type="submit"]').prop('disabled', true);

            $('.form-control').on('input', function () {
                var form = $(this).closest('form');
                var invalidFields = form.find('.form-control:invalid');

                $('button[type="submit"]').prop('disabled', invalidFields.length > 0);
            });
        });
    </script> --}}

@endsection
