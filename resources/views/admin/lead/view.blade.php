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
                        <li>
                            <span class="other-title">Date
                                Created</span><span>{{ $data->created_at->format('Y-m-d') }}
                            </span>
                        </li>
                        <li>
                            <span class="other-title">
                                Lead Region :
                            </span>
                        </li>
                        <li>
                            <span class="other-title">
                                {{ $data->union->union_name }}, {{ $data->upazila->thana_name }}, {{ $data->district->district_name }}
                            </span>
                        </li>


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
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h5>Contact Number</h5>
                    </div>
                    <ul class="deals-info">
                        <li>

                            <div>
                                <a href="">{{ $data->mobile }}</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="other-info">
                        <li><span class="other-title">Last
                            Modified</span><span>{{ $data->updated_at->format('Y-m-d') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-9">
                <div class="contact-tab-wrap d-flex justify-content-between">
                    <ul class="contact-nav nav">
                        <li>
                            <a href="#" onclick="contactModal({{$data->id}})" class="active"><i
                                    class="fa-regular fa-add m-r-5"></i>Contact Record</a>
                        </li>
                        <li>
                            <a href="{{route('Lead.edit',['id' => Crypt::encrypt($data->id)]) }}" class="active"><i
                                    class="las la-user-clock"></i>Edit Lead</a>
                        </li>
                        <li>
                            <a href="{{route('Lead.convert.client',['id' => Crypt::encrypt($data->id)]) }}" onclick="return confirm('Are you sure to convert this Lead into Client ??')" class="active"><i
                                    class="las la-user-clock"></i>Convert To Client</a>
                        </li>
                    </ul>

                </div>

                <div class="contact-tab-view">
                    <div class="tab-content pt-0">

                        <div class="tab-pane active show" id="activities">

                            <div class="table-responsive">
                                <table class="table table-border table-hover table-stripted">
                                    <thead>
                                        <th scope="col" class="col-md-1">#</th>
                                        <th scope="col" class="col-md-2">Next Contact Date</th>
                                        <th scope="col" class="col-md-1">Priority</th>
                                        <th scope="col" class="col-md-6">Note</th>
                                        <th scope="col" class="col-md-2">Contact Date</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($lastInfo as $item)
                                        <tr>
                                            <td>{{ $loop->index+1}}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->next_contact_date)->isoFormat('DD MMM YYYY') }}
                                            <td>{{ $item->priority ?? 'null'}}</td>
                                            <td>{{ $item->note ?? 'null'}}</td>
                                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
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

    @includeIf('admin.lead.partial.next-contact-date')
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function contactModal(id){
            $('#NextContactDate').modal('show');
            $('#NextContactDate').find('input[name="id"]').val(id);
        }
    </script>
@endsection
