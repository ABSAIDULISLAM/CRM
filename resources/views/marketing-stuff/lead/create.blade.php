@php
    if (auth()->user()->role_as == 'admin') {
        $myRoute = 'Admin.';
    } elseif (auth()->user()->role_as == 'office_staff') {
        $myRoute = 'Office.';
    } elseif (auth()->user()->role_as == 'marketing_staff') {
        $myRoute = 'Marketing.';
    } else {
        $myRoute = 'User.';
    }
@endphp

@extends('admin.layout.app')

@section('title', 'Create-Lead')

@section('content')

    <div class="content container-fluid">

        <div class="crms-title row bg-white mb-4">
            <div class="col p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="feather-grid"></i>
                    </span>
                    Create Lead
                </h3>
            </div>
            <div class="col p-0 text-end">
                <a href="{{ route('Marketing.lead.index') }}" class="btn btn-primary">Manage Leads</a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('Marketing.lead.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @includeIf('errors.error')
                    <div class="contact-input-set">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" for="mobile">
                                        <h5>Company Name<span class="text-danger">*</span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <input type="text" name="company_name" id="company_name" placeholder="Enter Company Name "
                                            class="form-control @error('company_name') is-invalid border border-danger @enderror"
                                            required value="{{ old('company_name') }}">
                                        @if ($errors->has('company_name'))
                                            <span class="error text-danger ms-5">{{ $errors->first('company_name') }}</span>
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
                                            rows="3">{{ old('company_address') }}</textarea>
                                        @if ($errors->has('company_address'))
                                            <span class="error text-danger ms-5">{{ $errors->first('note') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card-header p-2" style="background-color: rgb(241, 218, 218)"><h5>Contact Person Details</h5></div>
                            </div>

                            <div class="col-md-6 my-2">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" for="name">
                                        <h5>Name<span class="text-danger">*</span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <input type="text" name="name" id="name" placeholder="Contact Person Name"
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
                                        <h5>Email<span class="text-danger"></span></h5>
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
                            <hr>

                            <div class="col-md-12 my-3">
                                <div class="card-header p-2" style="background-color: rgb(241, 218, 218)"><h5>Product Details</h5></div>
                            </div>

                            {{-- <div class="col-md-4 my-2">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">
                                        <h5>Product Category<span class="text-danger">*</span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <select name="category_id" id="catId" class="form-control @error('category_id') is-invalid border border-danger @enderror" required>
                                            <option disabled selected>Select Category</option>
                                            @forelse ($category as $item)
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
                            <div class="col-md-4 my-2">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">
                                        <h5>Sub Category<span class="text-danger">*</span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <select name="sub_category_id" id="subCategoryId" class="form-control @error('sub_category_id') is-invalid border border-danger @enderror" required value="{{old('')}}">
                                        </select>
                                        <div id="loadingSpinner" style="display: none;">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </div>
                                        @if ($errors->has('sub_category_id'))
                                            <span class="error text-danger ms-5">{{ $errors->first('sub_category_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-12 my-2">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" for="address">
                                        <h5>Product<span class="text-danger">*</span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <select name="product_id" class="form-control @error('product_id') is-invalid border border-danger @enderror" id="">
                                            <option selected disabled>Select Product </option>
                                            @forelse ($product as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @if ($errors->has('product_id'))
                                            <span class="error text-danger ms-5">{{ $errors->first('product_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <hr>
                            @php
                                $date = date('Y-m-d');
                            @endphp
                            <div class="col-md-4 my-2 ">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" for="next_contact_date">
                                        <h5>Next Contact Date<span class="text-danger">*</span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <input type="date" name="next_contact_date" id="next_contact_date" value="{{$date}}"
                                            class="form-control @error('next_contact_date') is-invalid border border-danger @enderror">
                                        @if ($errors->has('next_contact_date'))
                                            <span
                                                class="error text-danger ms-5">{{ $errors->first('next_contact_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-block mb-3">
                                    <h5 class="mb-3">Priority <span class="text-danger">*</span></h5>
                                    <div class="status-radio-btns d-flex">
                                        <div class="people-status-radio">
                                            <input type="radio" class="status-radio" id="test3" name="priority"
                                                value="high" checked>
                                            <label for="test3">High</label>
                                        </div>
                                        <div class="people-status-radio">
                                            <input type="radio" class="status-radio" id="test4" name="priority"
                                                value="medium">
                                            <label for="test4">Medium</label>
                                        </div>
                                        <div class="people-status-radio">
                                            <input type="radio" class="status-radio" id="test5" name="priority"
                                                value="low">
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
                                                value="active" checked>
                                            <label for="test6">Active</label>
                                        </div>
                                        <div class="people-status-radio">
                                            <input type="radio" class="status-radio" id="test7" name="status"
                                                value="closed">
                                            <label for="test7">Closed</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 my-2">
                                <div class="input-block mb-3">
                                    <label class="col-form-label" for="note">
                                        <h5>Note <span class="text-danger"></span></h5>
                                    </label>
                                    <div class="user-icon">
                                        <textarea name="note" id="" placeholder="Write here note about this Lead"
                                            class="form-control @error('note') is-invalid border border-danger @enderror" cols="5"
                                            rows="3">{{ old('note') }}</textarea>
                                        @if ($errors->has('note'))
                                            <span class="error text-danger ms-5">{{ $errors->first('note') }}</span>
                                        @endif
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('button[type="submit"]').prop('disabled', true);
            $('.form-control').on('input', function () {
                var form = $(this).closest('form');
                var requiredFields = form.find('.form-control[required]');
                var invalidFields = requiredFields.filter(function() {
                    return !$(this).val();
                });
                $('button[type="submit"]').prop('disabled', invalidFields.length > 0);
            });
        });
        // ======
        function fetchSubCatInfo() {
            let catId = $('#catId').val();
            if (catId) {
                $('#loadingSpinner').show();
                $.ajax({
                    url: '{{ route('fetch.sub-cat') }}?catId=' + catId,
                    type: 'GET',
                    success: function(res) {
                        $('#loadingSpinner').hide();
                        $('#subCategoryId').empty();
                        $('#subCategoryId').append('<option disabled selected>Select Sub-category</option>');
                        $.each(res, function(key, value) {
                            $('#subCategoryId').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
        $('#catId').on('change', function() {
            fetchSubCatInfo();
        });
    </script>



@endsection
