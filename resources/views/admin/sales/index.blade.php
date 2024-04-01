@extends('admin.layout.app')

@section('title', 'Sales')

@section('content')

    @push('css')
        <link rel="stylesheet" href="{{asset('backend/assets/css/select2.min.css')}}" />
        <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datetimepicker.min.css')}}" />
        <link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap4.min.css')}}" />
    @endpush


    <div class="content container-fluid">
        <div class="crms-title row bg-white">
            <div class="col p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="feather-grid"></i>
                    </span>
                    Sales
                </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="{{route('Admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sales</li>
                </ul>
            </div>
        </div>

        <div class="page-header pt-3 mb-0">
            <div class="row">
                <div class="col">
                    <div class="dropdown">
                        <a class="dropdown-toggle recently-viewed" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> All Sales</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Recently Viewed</a>
                            <a class="dropdown-item" href="#">Items I'm following</a>
                            <a class="dropdown-item" href="#">All Projects</a>
                            <a class="dropdown-item" href="#">All Closed Deals</a>
                            <a class="dropdown-item" href="#">All Open Deals</a>
                        </div>
                    </div>
                </div>
                <div class="col text-end">
                    <ul class="list-inline-item ps-0">
                        <li class="nav-item dropdown list-inline-item add-lists">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-text">
                                    <i class="fa fa-th" aria-hidden="true"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="projects.html">List View</a>
                                <a class="dropdown-item" href="projects-kanban-view.html">Kanban View</a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add-new-list">Add New List View</a>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-bs-toggle="modal" data-bs-target="#add_project">New Sales</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th class="checkBox">
                                            <label class="container-checkbox">
                                                <input type="checkbox" />
                                                <span class="checkmark"></span>
                                            </label>
                                        </th>
                                        <th>Project Name</th>
                                        <th>Project Status</th>
                                        <th>User Responsible</th>
                                        <th>Project category</th>
                                        <th>Pipeline</th>
                                        <th>Project Created</th>
                                        <th></th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="checkBox">
                                            <label class="container-checkbox">
                                                <input type="checkbox" />
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="#"><span class="person-circle-a person-circle">A</span></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#project-details">Astronaut </a>
                                        </td>
                                        <td>In Progress</td>
                                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#system-user">John Doe</a></td>
                                        <td>Phone call</td>
                                        <td>
                                            <div class="pipeline-small flat pipeline-project">
                                                <a class="won noselect tipped-top planing" data-bs-toggle="tooltip" data-bsplacement="top" title data-bsoriginal-title="Pipeline: Deal Pipeline, stage: plan">
                                                    &nbsp;
                                                    <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#project-details"></span>
                                                </a>
                                                <a class="won noselect tipped-top planing" data-bs-toggle="tooltip" data-bsplacement="top" title data-bsoriginal-title="Pipeline: Deal Pipeline, stage: plan">
                                                    <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#project-details"></span>
                                                </a>
                                                <a class="won noselect tipped-top" data-bs-toggle="tooltip" data-bsplacement="top" title data-bsoriginal-title="Pipeline: Deal Pipeline">
                                                    <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#project-details"></span>
                                                </a>
                                                <a class="won noselect tipped-top" data-bs-toggle="tooltip" data-bsplacement="top" title data-bsoriginal-title="Pipeline: Deal Pipeline">
                                                    <span class="stretched-link" data-bs-toggle="modal" data-bs-target="#project-details"></span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>03-Jun-20 1:14 AM</td>
                                        <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Edit This Project</a>
                                                    <a class="dropdown-item" href="#">Change Project Image</a>
                                                    <a class="dropdown-item" href="#">Clone This Project</a>
                                                    <a class="dropdown-item" href="#">Delete This Project</a>
                                                    <a class="dropdown-item" href="#">Change Record Owner</a>
                                                    <a class="dropdown-item" href="#">Generate Merge Document</a>
                                                    <a class="dropdown-item" href="#">Print This Project</a>
                                                    <a class="dropdown-item" href="#">Add New Task For Project</a>
                                                    <a class="dropdown-item" href="#">Add New Event For Project</a>
                                                    <a class="dropdown-item" href="#">Add Activity Set To Project</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  @includeIf('admin.product.partial.pipeline_stage')
  @includeIf('admin.product.partial.add-new-list')
  @includeIf('admin.product.partial.add_project')
  @includeIf('admin.product.partial.project-details')
  @includeIf('admin.product.partial.settings')
  @includeIf('admin.product.partial.system-user')

    @push('js')
        <script src="{{asset('backend/assets/js/select2.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    @endpush

@endsection
