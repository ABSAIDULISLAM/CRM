@extends('admin.layout.app')

@section('title', 'edit-product')

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
                    Products Edit
                </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="{{route('Admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ul>
            </div>
        </div>

        <div class="page-header pt-3 mb-0">
            <div class="row">
                <div class="col">
                    <div class="dropdown">
                        <a class="dropdown-toggle recently-viewed" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> All Product</a>
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
                            <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-bs-toggle="modal" data-bs-target="#add_project">New Product</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <form>
                            <h4>Product Edit</h4>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Product Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" />
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Status</label>
                                    <select class="form-control">
                                        <option>In progress</option>
                                        <option>Deferred</option>
                                        <option>Cancelled</option>
                                        <option>Abandoned</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Category</label>
                                    <select class="form-control" id="assigned-to" name="category">
                                        <option>Email</option>
                                        <option>Follow up</option>
                                        <option>Get Started</option>
                                        <option>Meeting</option>
                                        <option>Phone call</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">User Responsible</label>
                                    <select class="form-control">
                                        <option>Nothing selected</option>
                                        <option>ohn Doe</option>
                                    </select>
                                </div>
                            </div>
                            <h4>Pipeline and Stage</h4>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="col-form-label">Pipeline</label>
                                    <select class="form-control">
                                        <option>Nothing selected </option>
                                        <option>Project Pipeline </option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label">Stage</label>
                                    <select class="form-control">
                                        <option>Nothing selected </option>
                                    </select>
                                </div>
                            </div>
                            <h4>Description Information</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Description </label>
                                    <textarea class="form-control" rows="3" id="description" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <h4>Tag Information</h4>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Tag List</label>
                                    <input type="text" class="form-control" name="tag-name" placeholder="Tag List" />
                                </div>
                            </div>
                            <h4>Permissions</h4>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="col-form-label">Visibility</label>
                                    <select class="form-control">
                                        <option>Everyone</option>
                                        <option>Select a team</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center py-3">
                                <button type="button" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update</button>&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


  {{-- @includeIf('admin.product.partial.pipeline_stage')
  @includeIf('admin.product.partial.add-new-list')
  @includeIf('admin.product.partial.add_project')
  @includeIf('admin.product.partial.project-details')
  @includeIf('admin.product.partial.settings')
  @includeIf('admin.product.partial.system-user') --}}

    @push('js')
        <script src="{{asset('backend/assets/js/select2.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('backend/assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('backend/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    @endpush

@endsection

