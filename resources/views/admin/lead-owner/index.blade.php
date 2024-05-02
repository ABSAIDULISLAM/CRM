@extends('admin.layout.app')

@section('title', 'Lead owner')

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
                <div class="col">
                    <h3 class="page-title">Lead owner</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Lead owner</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="{{route('Lead-owner.create')}}" class="btn add-btn" ><i
                            class="fa-solid fa-plus"></i> Create
                        Lead owner</a>
                </div>
            </div>
        </div>


        <form id="searchForm" method="get">
            @csrf
            <div class="form-grou row">
                <div class="col-md-10 my-3 col-10">
                    <input id="searchInput" type="text" class="form-control" required placeholder="Search By Company Name, Contact Person, Phone, Email, Product, Date">
                </div>
                <div class="col-md-2 my-3 col-2">
                    <button type="submit" class="btn btn-secondary"><i class="las la-search"></i> Search</button> <!-- Change type to submit -->
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Lead Owner ID</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leadowners as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    <h2 class="table-avatar d-flex align-items-center">
                                        <a href="{{route('Lead-owner.view',['id' => Crypt::encrypt($item->id)])}}" class="company-img">
                                            <img src="{{ asset($item->user->image ?: 'backend/assets/img/icons/company-icon-10.svg') }}" alt="Company Image">
                                        </a>
                                        <a href="{{route('Lead-owner.view',['id' => Crypt::encrypt($item->id)])}}" class="profile-split">{{$item->user->name}}</a>
                                    </h2>
                                </td>
                                <td> {{$item->lead_owner_id}}</td>
                                <td> {{$item->user->email}}</td>
                                <td> {{$item->user->mobile}}</td>
                                <td>
                                    <a href="#" class="text-white btn btn-sm badge-{{ $item->user->status == 'active' ? 'success' : 'danger' }}">
                                        {{ $item->user->status }}
                                    </a>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('Lead-owner.edit',['id' => Crypt::encrypt($item->id)]) }}"><i class="fa-solid fa-pencil m-r-5"></i>
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
                                                              <a href="#" class="button btn-lights" data-bs-dismiss="modal">Not Now</a>
                                                              <a href="{{route('Lead-owner.delete', Crypt::encrypt($item->id))}}" class="btn btn-primary">Okay</a>
                                                        </div>
                                                  </div>
                                            </div>
                                      </div>
                                </div>
                            @empty
                            <tr><td colspan="5" class="text-center">No Data Found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


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
                url: "{{ route('Lead.search') }}",
                method: 'get',
                data: {
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
