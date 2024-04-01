@extends('admin.layout.app')

@section('title', 'Payment-Invoice')
@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@section('content')

    <div class="crms-title row bg-white">
        <div class="col p-0">
            <h3 class="page-title m-0">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="feather-grid"></i>
                </span>
                Payment Invoice
            </h3>
        </div>
        <div class="col p-0 text-end">
            <a href="{{ route('Invoice.index') }}" class="btn btn-primary">Manage Invoice</a>
        </div>
    </div>

    <div class="page-header pt-3 mb-0">
        <div class="row">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="{{ route('Invoice.payment-store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-6 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Invoice Id<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="text" name="inv_id" id="inv_id" placeholder="Lead Owner Id"
                                    value="{{$data->inv_id}}" readonly
                                    class="form-control @error('inv_id') is-invalid border border-danger @enderror"
                                    required>
                                @if ($errors->has('inv_id'))
                                    <span class="error text-danger ms-5">{{ $errors->first('inv_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="paymentMethod">
                                <h5>Payment Method<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <select name="payment_method" id="paymentMethod" class="form-control" required>
                                    <option disabled selected>Select Payment Method</option>
                                    <option value="0">Cash On</option>
                                    <option value="1">Bkash</option>
                                    <option value="2">Card</option>
                                </select>
                                @if ($errors->has('payment_method'))
                                    <span class="error text-danger ms-5">{{ $errors->first('payment_method') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @php
                    $date = date('Y-m-d');
                    @endphp
                    <div class="col-md-4 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Paid Date<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="date" name="date" id="date" placeholder="Lead Owner Id"
                                    value="{{$date}}"
                                    class="form-control @error('date') is-invalid border border-danger @enderror"
                                    required>
                                @if ($errors->has('date'))
                                    <span class="error text-danger ms-5">{{ $errors->first('date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="payable_amount">
                                <h5>Payable Amount<span class="text-danger"></span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="number" name="payable_amount" id="payable_amount" placeholder="Enter Here Your Paid Amount"
                                    class="form-control @error('payable_amount') is-invalid border border-danger @enderror"
                                     value="{{$payable}}">
                                @if ($errors->has('payable_amount'))
                                    <span class="error text-danger ms-5">{{ $errors->first('payable_amount') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="name">
                                <h5>Paid Amount<span class="text-danger">*</span></h5>
                            </label>
                            <div class="user-icon">
                                <input type="number" name="paid_amount" id="paid_amount" placeholder="Enter Here Your Paid Amount"
                                    class="form-control @error('paid_amount') is-invalid border border-danger @enderror" max="{{$payable}}"
                                    required>
                                @if ($errors->has('paid_amount'))
                                    <span class="error text-danger ms-5">{{ $errors->first('paid_amount') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 my-2">
                        <div class="input-block mb-3">
                            <label class="col-form-label" for="description">
                                <h5>Description<span class="text-danger"></span></h5>
                            </label>
                            <div class="user-icon">
                                <textarea name="description" id="summernote" class="form-control" cols="10" rows="4"></textarea>
                                @if ($errors->has('description'))
                                    <span class="error text-danger ms-5">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="submit-section my-4">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





@endsection
@push('js')
<script src="{{ asset('backend/assets/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/summernote/summernote-bs4.min.js') }}" type="text/javascript"></script>
@endpush
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        // =====
        // for button check
        $('button[type="submit"]').prop('disabled', true);

        $('.form-control').on('input', function () {
            var form = $(this).closest('form');
            var invalidFields = form.find('.form-control:invalid');

            $('button[type="submit"]').prop('disabled', invalidFields.length > 0);
        });
    });

    </script>
