@extends('admin.layout.app')
@section('title', 'Payment-Receive')

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
                    Receive Payment
                </h3>
            </div>
            <div class="col p-0 text-end">
                <a href="{{route('Payment.index')}}" class="btn btn-primary">back</a>
            </div>
        </div>

        <div class="page-header pt-3 mb-0 text-end mb-2">

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="name"><h5>Client Name<span class="text-danger">*</span></h5></label>
                                        <div class="user-icon">
                                            <input class="form-control" readonly value="Mr Jhon" type="text" name="name" id="name" placeholder="Product Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="name"><h5>Invoice No.<span class="text-danger">*</span></h5></label>
                                        <div class="user-icon">
                                            <input class="form-control" readonly value="#AS63543" type="text" name="name" id="name" placeholder="Product Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="name"><h5>Recivable Amount<span class="text-danger">*</span></h5></label>
                                        <div class="user-icon">
                                            <input class="form-control" readonly value="50000" type="text" name="name" id="name" placeholder="Product Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="name"><h5>Recive Amount<span class="text-danger">*</span></h5></label>
                                        <div class="user-icon">
                                            <input class="form-control" value="40000" type="text" name="name" id="name" placeholder="Product Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="name"><h5>Receive Date<span class="text-danger">*</span></h5></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 my-2">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label" for="name"><h5>Payment Type<span class="text-danger">*</span></h5></label>
                                        <div class="user-icon">
                                            <select name="" id="" class="form-control">
                                                <option value="">Select One</option>
                                                <option value="">Cash</option>
                                                <option value="">Bkash</option>
                                                <option value="">Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 text-center mt-5 form-wizard-button">
                                    <button class="btn btn-primary px-5" type="submit">Receive</button>
                                </div>
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

