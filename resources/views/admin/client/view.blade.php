@extends('admin.layout.app')
@section('title', $data->name .'- view')
@section('content')

    <div class="content container-fluid pb-0">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">{{$data->name}}'s - Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Client.index')}}">Back</a>
                        </li>
                        <li class="breadcrumb-item active">Client Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#">
                                        <img src="{{ asset($data->user->image ?: 'backend/assets/img/icons/company-icon-10.svg') }}" alt="User Image">
                                    </a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0">{{$data->name}}</h3>
                                            <h5 class="company-role m-t-0 mb-0">CRM</h5>
                                            <small class="text-muted">{{$data->user->role_as}}</small>
                                            <div class="staff-id">Employee ID :
                                                {{$data->lead_owner_id}}</div>
                                            <div class="staff-msg"><a href="chat.html" class="btn btn-custom">Send
                                                    Message</a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <span class="title">Phone:</span>
                                                <span class="text"><a href="#">{{$data->user->mobile}}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Email:</span>
                                                <span class="text">{{$data->user->email}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Address:</span>
                                                <span class="text">{{$data->address}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 my-4">
                        <div class="card-header"><h5>Leads by {{$data->user->name}}</h5></div>
                        <div class="table-responsive">
                            <table class="table table-hover table-border table-stripted">
                                <thead>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Email</th>
                                    <th>Joining Date</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Saidul</td>
                                        <td>0145</td>
                                        <td>aslfkd@gmail.com</td>
                                        <td>10-10-2020</td>
                                        <td>active</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>

@endsection
