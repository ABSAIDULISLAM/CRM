@extends('admin.layout.app')

@section('title', 'Clients')

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
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h3 class="page-title">Clients</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ul>
                </div>
                <div class="col-md-8 float-end ms-auto">
                    <div class="d-flex title-head">
                        <div class="view-icons">
                            <a href="javascript:void(0);" class="list-view btn btn-link" id="collapse-header"><i
                                    class="las la-expand-arrows-alt"></i></a>
                            <a href="javascript:void(0);" class="list-view btn btn-link" id="filter_search"><i
                                    class="las la-filter"></i></a>
                        </div>
                        <div class="form-sort">
                        <a href="{{ route('Client.create') }}" class="btn add-btn"><i class="la la-plus-circle"></i> Add
                            Client</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-filelds" id="filter_inputs">
            <div class="row filter-row">
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Lead Name</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus">
                        <input type="email" class="form-control floating">
                        <label class="focus-label">Email</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus focused">
                        <input type="text" class="form-control  date-range bookingrange">
                        <label class="focus-label">From - To Date</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>--Select--</option>
                            <option>Closed</option>
                            <option>Not Contacted</option>
                            <option>Contacted</option>
                            <option>Lost</option>
                        </select>
                        <label class="focus-label">Lead Status</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>--Select--</option>
                            <option>NovaWaveLLC</option>
                            <option>SilverHawk</option>
                            <option>SummitPeak</option>
                            <option>HarborView</option>
                            <option>Redwood Inc</option>
                        </select>
                        <label class="focus-label">Lead Name</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <a href="#" class="btn btn-success w-100"> Search </a>
                </div>
            </div>
        </div>
        <hr>

        <form id="searchForm" method="get">
            @csrf
            <div class="form-grou row">
                <div class="col-md-10 my-3 col-10">
                    <input id="searchInput" type="text" class="form-control" required placeholder="Search By Client Name, Mobile, Email, Date, Status">
                </div>
                <div class="col-md-2 my-3 col-2">
                    <button type="submit" class="btn btn-secondary"><i class="las la-search"></i> Search</button> <!-- Change type to submit -->
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-12">
                <div id="loadingSpinner" style="display: none; text-align: center;">
                    {{-- <img src="loading.gif" alt="Loading..."> --}}
                    <i class="fas fa-spinner fa-spin"></i><p>Loading...</p> <!-- Optional loading message -->
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-striped custom-table datatable contact-table">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Client Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                {{-- <th>Product</th> --}}
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <h2 class="table-avatar d-flex align-items-center">
                                            <a href="{{ route('Client.view', ['id' => Crypt::encrypt($item->id)]) }}"
                                                class="company-img">
                                                <img src="{{ asset($item->image ?: 'backend/assets/img/icons/company-icon-10.svg') }}"
                                                    alt="Company Image">
                                            </a>
                                            <a href="{{ route('Client.view', ['id' => Crypt::encrypt($item->id)]) }}"
                                                class="profile-split text-success">{{ $item->name }}</a>
                                        </h2>
                                    </td>
                                    <td> {{ $item->mobile }}</td>
                                    <td> {{ $item->email ?? 'null' }}</td>
                                    <td> {{ $item->address }}</td>
                                    {{-- <td> {{ $item->product->name }}</td> --}}
                                    <td> {{ $item->user->name }}</td>
                                    <td> {{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('Client.status.update', ['id' => Crypt::encrypt($item->id)]) }}"
                                            onclick="return confirm('Aye you sure to change status ??')"
                                            class="text-white btn btn-sm badge-{{ $item->status == 'active' ? 'success' : 'danger' }}">
                                            {{ $item->status }}
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item"
                                                    href="{{ route('Client.edit', ['id' => Crypt::encrypt($item->id)]) }}"><i
                                                        class="fa-solid fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_company"><i
                                                        class="fa-regular fa-trash-can m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal custom-modal fade" id="delete_company" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="success-message text-center">
                                                    <div class="success-popup-icon bg-danger">
                                                        <i class="la la-trash-restore"></i>
                                                    </div>
                                                    <h3>Are you sure, You want to delete</h3>
                                                    <p>Company ”NovaWaveLLC” from your Account</p>
                                                    <div class="col-lg-12 text-center form-wizard-button">
                                                        <a href="#" class="button btn-lights"
                                                            data-bs-dismiss="modal">Not Now</a>
                                                        <a href="{{ route('Client.delete', [Crypt::encrypt($item->id)]) }}"
                                                            class="btn btn-primary">Okay</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Data Found</td>
                                    </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    @includeIf('admin.lead.partial.add-lead')
    @includeIf('admin.lead.partial.contact-record-result')
    @includeIf('admin.lead.partial.next-contact-date')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#searchForm').on('submit', function(e){
                e.preventDefault();
                let query = $('#searchInput').val();
                fetchFilteredData(query);
            });

            function fetchFilteredData(query) {
                $('#loadingSpinner').show();
                $.ajax({
                    url: "{{ route('Client.search') }}",
                    method: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                        query: query
                    },
                    success: function(response){
                        $('#loadingSpinner').hide();
                        $('#example1').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

        });
    </script>
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
