@extends('admin.layout.app')
@section('title', 'edit-lead')
@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')

    <div class="crms-title row bg-white">
        <div class="col p-0">
            <h3 class="page-title m-0">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="feather-grid"></i>
                </span>
                Edit Lead
            </h3>
        </div>
        <div class="col p-0 text-end">
            <a href="{{ route('Marketing.lead.index') }}" class="btn btn-primary">back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-body">
                    <form action="{{ route('Marketing.lead.update') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-md-12 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="mobile">
                                            <h5>Company Name<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <input type="hidden" name="id" value="{{ $lead->id }}">
                                            <input type="text" name="company_name" id="company_name"
                                                placeholder="Enter Company Name "
                                                class="form-control @error('company_name') is-invalid border border-danger @enderror"
                                                required value="{{ $lead->company_name }}">
                                            @if ($errors->has('company_name'))
                                                <span
                                                    class="error text-danger ms-5">{{ $errors->first('company_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="company_address">
                                            <h5>Company Address<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <textarea name="company_address" id="" placeholder="Write here Company Full address"
                                                class="form-control @error('company_address') is-invalid border border-danger @enderror" cols="5"
                                                rows="3">{{ $lead->company_address }}</textarea>
                                            @if ($errors->has('company_address'))
                                                <span class="error text-danger ms-5">{{ $errors->first('note') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-header p-2" style="background-color: rgb(241, 218, 218)">
                                        <h5>Contact Person Details</h5>
                                    </div>
                                </div>

                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="name">
                                            <h5>Name<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <input type="text" name="name" id="name"
                                                placeholder="Contact Person Name"
                                                class="form-control @error('name') is-invalid border border-danger @enderror"
                                                required value="{{ $lead->name }}">
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
                                                required value="{{ $lead->mobile }}">
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
                                                value="{{ $lead->email }}">
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
                                                rows="2">{{ $lead->address }}</textarea>
                                            @if ($errors->has('address'))
                                                <span
                                                    class="error text-danger ms-5">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-md-12 my-2">
                                    <div class="card-header p-2" style="background-color: rgb(241, 218, 218)"><h5>Lead Regional Area</h5></div>
                                </div>
                                <div class="col-md-4 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="district_id">
                                            <h5>District<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <select name="district_id" id="district_id" class="form-select select2 @error('district_id') is-invalid border border-danger @enderror" required>
                                                <option disabled>Select District</option>
                                                @foreach ($district as $item)
                                                    <option value="{{ $item->district_id }}" {{ $lead->district_id == $item->district_id ? 'selected' : '' }}>{{ $item->district_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('district_id')
                                                <span class="error text-danger ms-5">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="upazila_id">
                                            <h5>Upazila<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <select name="upazila_id" id="upazila_id" class="form-select @error('upazila_id') is-invalid border border-danger @enderror" required>
                                                <option disabled>Select Upazila</option>
                                                @foreach ($upazilas as $upazila)
                                                    <option value="{{ $upazila->thana_id }}" {{ $lead->upazila_id == $upazila->thana_id ? 'selected' : '' }}>{{ $upazila->thana_name }}</option>
                                                @endforeach
                                            </select>
                                            <div id="loadingSpinnerUpazila" style="display: none;">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                            @error('upazila_id')
                                                <span class="error text-danger ms-5">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="union_id">
                                            <h5>Union<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <select name="union_id" id="union_id" class="form-select @error('union_id') is-invalid border border-danger @enderror" required>
                                                <option disabled>Select Union</option>
                                                @foreach ($unions as $union)
                                                    <option value="{{ $union->union_id }}" {{ $lead->union_id == $union->union_id ? 'selected' : '' }}>{{ $union->union_name }}</option>
                                                @endforeach
                                            </select>
                                            <div id="loadingSpinner" style="display: none;">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                            @error('union_id')
                                                <span class="error text-danger ms-5">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="card-header p-2" style="background-color: rgb(241, 218, 218)">
                                        <h5>Product Details</h5>
                                    </div>
                                </div>

                                <div class="col-md-12 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="address">
                                            <h5>Product<span class="text-danger">*</span></h5>
                                        </label>
                                        <div class="user-icon">
                                            <select name="product_id"
                                                class="form-control @error('product_id') is-invalid border border-danger @enderror"
                                                id="">
                                                <option selected disabled>Select Product </option>
                                                @forelse ($product as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $lead->product->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('product_id'))
                                                <span
                                                    class="error text-danger ms-5">{{ $errors->first('product_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                @php
                                    $date = date('Y-m-d');
                                @endphp

                                <div class="col-md-4">
                                    <div class="input-block mb-3">
                                        <h5 class="mb-3">Priority <span class="text-danger">*</span></h5>
                                        <div class="status-radio-btns d-flex">
                                            <div class="people-status-radio">
                                                <input type="radio" class="status-radio" id="test3"
                                                    name="priority" value="high"
                                                    {{ $lead->priority == 'high' ? 'checked' : '' }}>
                                                <label for="test3">High</label>
                                            </div>
                                            <div class="people-status-radio">
                                                <input type="radio" class="status-radio" id="test4"
                                                    name="priority" value="medium"
                                                    {{ $lead->priority == 'medium' ? 'checked' : '' }}>
                                                <label for="test4">Medium</label>
                                            </div>
                                            <div class="people-status-radio">
                                                <input type="radio" class="status-radio" id="test5"
                                                    name="priority" value="low"
                                                    {{ $lead->priority == 'low' ? 'checked' : '' }}>
                                                <label for="test5">Low</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-block mb-3">
                                        <h5 class="mb-3">Status <span class="text-danger">*</span></h5>
                                        <div class="status-radio-btns d-flex">
                                            <div class="people-status-radio">
                                                <input type="radio" class="status-radio" id="test6" name="status"
                                                    value="active" {{ $lead->status == 'active' ? 'checked' : '' }}>
                                                <label for="test6">Active</label>
                                            </div>
                                            <div class="people-status-radio">
                                                <input type="radio" class="status-radio" id="test7" name="status"
                                                    value="closed" {{ $lead->status == 'closed' ? 'checked' : '' }}>
                                                <label for="test7">Closed</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 my-4 text-center form-wizard-button">
                                    <button class="button btn-lights reset-btn" type="reset"
                                        data-bs-dismiss="modal">Reset</button>
                                    <button class="btn btn-primary" type="submit">Update Lead</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     $('button[type="submit"]').prop('disabled', true);
        //     $('.form-control').on('input', function () {
        //         var form = $(this).closest('form');
        //         var requiredFields = form.find('.form-control[required]');
        //         var invalidFields = requiredFields.filter(function() {
        //             return !$(this).val();
        //         });
        //         $('button[type="submit"]').prop('disabled', invalidFields.length > 0);
        //     });
        // });
        // ======

        $('#district_id').on('change', function() {
            let districtId = $('#district_id').val();
            if (districtId) {
                $('#loadingSpinnerUpazila').show();
                $.ajax({
                    url: '{{ route('fetch.upazilas') }}?districtId=' + districtId,
                    type: 'GET',
                    success: function(res) {
                        $('#loadingSpinnerUpazila').hide();
                        $('#upazila_id').empty();
                        $('#upazila_id').append('<option disabled selected>Select Upazila</option>');
                        $.each(res, function(key, value) {
                            $('#upazila_id').append('<option value="' + value.thana_id + '">' + value.thana_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
        $('#upazila_id').on('change', function() {
            let thana_id = $('#upazila_id').val();
            if (thana_id) {
                $('#loadingSpinner').show();
                $.ajax({
                    url: '{{ route('fetch.unions') }}?thana_id=' + thana_id,
                    type: 'GET',
                    success: function(res) {
                        $('#loadingSpinner').hide();
                        $('#union_id').empty();
                        $('#union_id').append('<option disabled selected>Select Union</option>');
                        $.each(res, function(key, value) {
                            $('#union_id').append('<option value="' + value.union_id + '">' + value.union_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>

@endsection

@push('js')
<script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/select2/js/custom-select.js') }}" type="text/javascript"></script>
@endpush
