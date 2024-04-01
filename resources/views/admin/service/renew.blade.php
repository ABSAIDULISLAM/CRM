@extends('admin.layout.app')

@section('title', 'Service-Renew')

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
                    Service Renew
                </h3>
            </div>
            <div class="col p-0 text-end">
                <a href="{{route('Service.index')}}" class="btn btn-primary">back</a>
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
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6 my-2">
                                    <label class="col-form-label"><h5>Lead name <span class="text-danger">*</span></h5></label>
                                    <input class="form-control" readonly type="text" name="name" />
                                </div>
                                <div class="col-md-6 my-2">
                                    <label class="col-form-label"><h5>Product name <span class="text-danger">*</span></h5></label>
                                    <input class="form-control" readonly type="text" name="name" />
                                </div>
                                <div class="col-md-6 my-2">
                                    <label class="col-form-label"><h5>Payable Renewal Fee<span class="text-danger">*</span></h5></label>
                                    <input class="form-control" readonly type="number" name="name" />
                                </div>
                                <div class="col-md-6 my-2">
                                    <label class="col-form-label"><h5>Received Renewal Fee<span class="text-danger">*</span></h5></label>
                                    <input class="form-control" type="number" name="name" />
                                </div>
                                <div class="col-md-6 my-2">
                                    <label class="col-form-label"><h5>Payment Type<span class="text-danger">*</span></h5></label>
                                    <select name="" id="" class="form-control">
                                        <option value="">Cash</option>
                                        <option value="">Bkash</option>
                                        <option value="">Bank</option>
                                    </select>
                                </div>
                                <div class="col-md-6 my-2">
                                    <label class="col-form-label">Renewal Date<span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <label class="col-form-label">Status</label>
                                    <select class="form-control">
                                        <option>Active</option>
                                        <option>Deactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center py-3 mt-4">
                                <button type="submit" class="px-5 border-0 btn btn-primary btn-gradient-primary btn-rounded">Renew</button>&nbsp;&nbsp;
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

