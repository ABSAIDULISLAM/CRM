@extends('admin.layout.app')

@section('title', 'view-lead')

@section('content')
    @push('css')
        <link rel="stylesheet" href="{{asset('backend/assets/plugins/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/css/feather.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/assets/css/select2.min.css')}}">
    @endpush

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h3 class="page-title">View Lead </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">View Lead </li>
                    </ul>
                </div>
                <div class="col-md-8 float-end ms-auto">

                    <div class="d-flex title-head">
                        <a href="{{ route('Lead.index') }}" class="btn btn-primary px-5">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-head">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <ul class="contact-breadcrumb">
                                <li><a href="{{ route('Lead.index') }}"><i class="las la-arrow-left"></i>
                                        Leads</a></li>
                                <li>{{ $data->company_name }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <div class="contact-pagination">
                                <p>1 of 40</p>
                                <ul>
                                    <li>
                                        <a href="leads-details.html"><i class="las la-arrow-left"></i></a>
                                    </li>
                                    <li>
                                        <a href="leads-details.html"><i class="las la-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-wrap">
                    <div class="contact-profile">
                        <div class="avatar company-avatar">
                            <span class="text-icon">HT</span>
                        </div>
                        <div class="name-user">
                            <h4>{{ $data->company_name }} <span class="star-icon"><i class="fa-solid fa-star"></i></span>
                            </h4>

                            <p class="mb-0"><i class="las la-map-marker"></i> {{ $data->address }}</p>
                        </div>
                    </div>
                    <div class="contacts-action">
                        <span class="badge badge-light"><i class="las la-lock"></i>Private</span>
                        <div class="dropdown action-drops">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>{{ $data->status }}<i class=" ms-2"></i></span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card contact-sidebar">
                    <h5>Lead Information</h5>
                    <ul class="other-info">
                        <li><span class="other-title">Date
                                Created</span><span>{{ $data->created_at->format('Y-m-d') }}</span></li>

                    </ul>
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h5>Priority</h5>
                    </div>
                    <ul class="priority-info">
                        <li>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false"><span><i
                                            class="fa-solid fa-circle me-1 text-danger circle"></i>{{ $data->priority }}</span><i
                                        class="las la-angle-down ms-1"></i></a>

                            </div>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h5>Contact Person</h5>
                    </div>
                    <ul class="deals-info">
                        <li>
                            <span>
                                <img src="{{ asset($data->image ?: 'backend/assets/img/icons/company-icon-10.svg') }}"
                                    alt="Image">
                            </span>
                            <div>
                                <p>{{ $data->name }}</p>
                            </div>
                        </li>
                    </ul>
                    <ul class="other-info">
                        <li><span class="other-title">Last
                                Modified</span><span>{{ $data->updated_at->format('Y-m-d') }}</span></li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-9">
                <div class="contact-tab-wrap">
                    <ul class="contact-nav nav">
                        <li>
                            <a href="#" data-bs-toggle="tab" data-bs-target="#activities" class="active"><i
                                    class="las la-user-clock"></i>Contact Record</a>
                        </li>
                    </ul>
                </div>

                <div class="contact-tab-view">
                    <div class="tab-content pt-0">

                        <div class="tab-pane active show" id="activities">

                            <div class="table-responsive">
                                <table class="table table-border table-hover table-stripted">
                                    <thead>
                                        <th>#</th>
                                        <th>Next Contact Date</th>
                                        <th>Note</th>
                                        <th>Contact Date</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($lastInfo as $item)
                                        <tr>
                                            <td>{{ $loop->index+1}}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->next_contact_date)->formatLocalized('%d %B %Y') }}
                                            <td>{{ $item->note ?? 'null'}}</td>
                                            <td>{{ $item->created_at->formatLocalized('%d %B %Y') }}</td>
                                        </tr>
                                        @empty
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="modal custom-modal fade modal-padding" id="add_notes" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header header-border align-items-center justify-content-between p-0">
                    <h5 class="modal-title">Add Note</h5>
                    <button type="button" class="btn-close position-static" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <form action="https://smarthr.dreamstechnologies.com/html/template/leads-details.html">
                        <div class="input-block mb-3">
                            <label class="col-form-label">Title <span class="text-danger">
                                    *</span></label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Note <span class="text-danger">
                                    *</span></label>
                            <textarea class="form-control" rows="4" placeholder="Add text"></textarea>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Attachment <span class="text-danger">
                                    *</span></label>
                            <div class="drag-upload">
                                <input type="file">
                                <div class="img-upload">
                                    <i class="las la-file-import"></i>
                                    <p>Drag & Drop your files</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Uploaded Files</label>
                            <div class="upload-file">
                                <h6>Projectneonals teyys.xls</h6>
                                <p>4.25 MB</p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>45%</p>
                            </div>
                            <div class="upload-file upload-list">
                                <div>
                                    <h6>Projectneonals teyys.xls</h6>
                                    <p>4.25 MB</p>
                                </div>
                                <a href="javascript:void(0);" class="text-danger"><i class="las la-trash"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-12 text-end form-wizard-button">
                            <button class="button btn-lights reset-btn" type="reset">Reset</button>
                            <button class="btn btn-primary" type="submit">Save Notes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal custom-modal fade modal-padding" id="create_call" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header header-border align-items-center justify-content-between p-0">
                    <h5 class="modal-title">Create Call Log</h5>
                    <button type="button" class="btn-close position-static" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <form action="https://smarthr.dreamstechnologies.com/html/template/leads-details.html">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Status <span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Busy</option>
                                        <option>Unavailable</option>
                                        <option>No Answer</option>
                                        <option>Wrong Number</option>
                                        <option>Left Voice Message</option>
                                        <option>Moving Forward</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Followup Date <span class="text-danger">
                                            *</span></label>
                                    <input class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Note <span class="text-danger">
                                    *</span></label>
                            <textarea class="form-control" rows="4" placeholder="Add text"></textarea>
                        </div>
                        <div class="input-block mb-3">
                            <label class="custom_check check-box mb-0">
                                <input type="checkbox">
                                <span class="checkmark"></span> Create a Follow up task
                            </label>
                        </div>
                        <div class="col-lg-12 text-end form-wizard-button">
                            <button class="button btn-lights reset-btn" type="reset">Reset</button>
                            <button class="btn btn-primary" type="submit">Save Call</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script src="{{asset('backend/assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"
            type="text/javascript"></script>

        <script src="{{asset('backend/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('backend/assets/plugins/daterangepicker/daterangepicker.js')}}"
            type="text/javascript"></script>

        <script src="{{asset('backend/assets/js/select2.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.js')}}"
            type="text/javascript"></script>

    @endpush

@endsection
