@extends('backend.layouts.master')

@section('active')
    active
@endsection

@section('title')
    Profile
@endsection

@section('toproute')
    <div class="row mb-4" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 8px; background-color:#fff">
        <div class="col-md-12 d-flex justify-content-between">
            <h4 class="m-0">Profile</h4>
            {{-- <a class="btn btn-primary"> Create</a> --}}
        </div>
    </div>
@endsection

@section('homesection')
    <div class="row">

        @if (auth()->user()->role_as == 'admin')

            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if (empty($userdata->image))
                                <img src="{{ asset('backend/assets/dist/img/avatar3.png') }}" alt="profile-image"
                                    height="120px" width="130px" class="rounded-circle m-auto">
                            @else
                                <img src="{{ asset($userdata->image) }}" alt="profile-image"
                                height="120px" width="130px" class="rounded-circle m-auto">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ $userdata->name }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">

                            <li class="list-group-item">
                                <b class="text-success">Ballance</b> <a class="float-right">{{ $userdata->ballance }}</a>
                            </li>
                        </ul>

                        <div class="d-flex">
                            <a href="#" class="btn btn-primary btn-sm mr-2"><b>Share Points</b></a>
                            <a href="#" class="btn btn-success btn-sm"><b> Withdrow</b></a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#overView" data-toggle="tab">OverView</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="overView">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $userdata->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>number</th>
                                            <td>{{ $userdata->number }}</td>
                                        </tr>
                                        <tr>
                                            <th>role_as</th>
                                            <td>{{ $userdata->role_as }}</td>
                                        </tr>
                                        <tr>
                                            <th>status</th>
                                            <td>{{ $userdata->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>last_seen</th>
                                            <td>{{ $userdata->last_seen }}</td>
                                        </tr>

                                        <tr>
                                            <th>created_at</th>
                                            <td>{{ $userdata->created_at }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">

                                <form action="{{ route('admin.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" value="{{ $userdata->name }}"
                                                class="form-control @error('name') is-invalid border border-danger @enderror"
                                                id="inputName" placeholder="Name">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger ">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">What's App</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="whats_app" value="{{ $userdata->whats_app }}"
                                                class="form-control @error('whats_app') is-invalid border border-danger @enderror"
                                                id="inputName" placeholder="What's App number">
                                        </div>
                                        @if ($errors->has('whats_app'))
                                            <span class="error text-danger ">{{ $errors->first('whats_app') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="old_password"
                                                class="form-control @error('old_password') is-invalid border border-danger @enderror"
                                                id="inputEmail" placeholder="old Password">
                                        </div>
                                        @if ($errors->has('old_password'))
                                            <span class="error text-danger ">{{ $errors->first('old_password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid border border-danger @enderror"
                                                id="inputEmail" placeholder="New Password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="error text-danger ">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid border border-danger @enderror"
                                                id="inputEmail">
                                            <img src="{{ asset($userdata->image) }}" alt="profile-image" height="80px"
                                                width="80px">
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="error text-danger ">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row my-3 ml-auto">
                                        <div class="offset-sm-2 col-sm-10 ">
                                            <button type="submit" class="btn btn-success ">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else

            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">

                        <div class="text-center">
                            @if (empty($userdata->image))
                                <img src="{{ asset('backend/assets/dist/img/avatar3.png') }}" alt="profile-image"
                                    height="120px" width="130px" class="rounded-circle m-auto">
                            @else
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset($userdata->image) }}"
                                    alt="User profile picture">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ $userdata->name }}</h3>

                        <p class="text-muted text-center">{{ $userdata->role_as == 'member' ? 'Student' : '' }}</p>

                        <ul class="list-group list-group-unbordered mb-3">

                            <li class="list-group-item">
                                <b>Activation Points:</b> <a class="float-right">{{ $userdata->activation_points }}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="text-success">Wallet Points:</b> <a
                                    class="float-right">{{ $userdata->ballance }}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="text-primary">Freeze Wallet points:</b> <a
                                    class="float-right">{{ $userdata->freeze_points }}</a>
                            </li>
                        </ul>

                        <div class="d-flex">

                            @if ($userdata->ballance >= 5000)
                                <a href="{{ route('withdraw-request') }}" class="btn btn-success btn-sm"><b>
                                        Withdrow</b></a>
                            @else
                                <button class="btn btn-danger btn-sm ml-2" disabled><b>Withdraw</b></button>
                            @endif

                            {{-- @if ($userdata->activation_points >= 500)
                            <a href="#" class="btn btn-primary btn-sm ml-2" ><b>Active Now</b></a>
                        @else
                            <button class="btn btn-danger btn-sm ml-2" disabled><b>Active</b></button>
                        @endif --}}

                        </div>

                        @if (auth()->user()->status == 'active')
                            <ul class="list-group list-group-unbordered mb-3">
                                <hr>
                                <li class="list-group-item">
                                    <input type="text" class="form-control" id="referenceLink" readonly
                                        value="{{ $referRoute }}">
                                </li>
                            </ul>
                        @else
                            <p class="text-danger h6 my-3">your member ID is not active !</p>
                        @endif

                        <div class="d-flex">
                            <button class="btn btn-primary btn-sm mr-2" onclick="copyToClipboard()"><b>Copy
                                    Link</b></button>
                            <button class="btn btn-success btn-sm" onclick="shareLink()"><b> Share Link</b></button>
                        </div>

                    </div>
                </div>
            </div>
            <script>
                function copyToClipboard() {
                    // Get the input element
                    var inputElement = document.getElementById('referenceLink');

                    // Select the text in the input element
                    inputElement.select();
                    inputElement.setSelectionRange(0, 99999); // For mobile devices

                    // Copy the selected text to the clipboard
                    document.execCommand('copy');

                    // Deselect the text
                    inputElement.setSelectionRange(0, 0);
                    alert('Link copied to clipboard!');
                }
            </script>
            <script>
                function shareLink() {
                    // Check if the Web Share API is supported
                    if (navigator.share) {
                        // Use the Web Share API to share the link
                        navigator.share({
                                title: 'Share Link',
                                text: 'Check out this link:',
                                url: '{{ $referRoute }}'
                            })
                            .then(() => console.log('Link shared successfully!'))
                            .catch((error) => console.error('Error sharing link:', error));
                    } else {
                        // Fallback for browsers that do not support the Web Share API
                        alert('Web Share API is not supported on this browser.');
                    }
                }
            </script>
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#overView"
                                    data-toggle="tab">OverView</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="overView">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $userdata->student_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $userdata->name }}</td>
                                        </tr>
                                        {{-- <tr>
                                        <th>Account Type</th>
                                        <td>{{ $userdata->role_as }}</td>
                                    </tr> --}}
                                        <tr>
                                            <th>Phone Number:</th>
                                            <td><a class="btn btn-primary" href="tel:{{ $userdata->number }}">{{ $userdata->number }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Whstsapp Number:</th>
                                            <td><a class="btn btn-primary" href="https://wa.me/{{ $userdata->whats_app }}" target="_blank">{{ $userdata->whats_app }}</a></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Gmail:</th>
                                            <td>{{ $userdata->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Country:</th>
                                            <td>{{ $userdata->country }}</td>
                                        </tr>
                                        <tr>
                                            <th>Language:</th>
                                            <td>{{ $userdata->language }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender:</th>
                                            <td>{{ $userdata->gender }}</td>
                                        </tr>
                                        @if (auth()->user()->role_as == 'member')
                                        <tr>
                                            <th>My Team Leader (ID)</th>
                                            @if (empty($userdata->teamleader))
                                            <td>Null</td>
                                            @else
                                            <td>{{ $userdata->teamleader->name }}-({{ $userdata->teamleader->student_id }})</td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <th>Counselor (ID)</th>
                                            @if (empty($userdata->counselor))
                                            <td>Null</td>
                                            @else
                                            <td>{{ $userdata->counselor->name }}-({{ $userdata->counselor->student_id }})</td>
                                            @endif

                                        </tr>
                                        @endif
                                        <tr>
                                            <th>created_at</th>
                                            <td>{{ $userdata->created_at->isoFormat('Do MMM YYYY') }}</td>
                                            {{-- <td>{{ $userdata->created_at }}</td> --}}
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">

                                @if ($errors->any())
                                    <div class="">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                @php
                                                    toastr()->error($error);
                                                @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" value="{{ $userdata->name }}"
                                                class="form-control @error('name') is-invalid border border-danger @enderror"
                                                id="inputName" placeholder="Name">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger ">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">What's App</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="whats_app" value="{{ $userdata->whats_app }}"
                                                class="form-control @error('whats_app') is-invalid border border-danger @enderror"
                                                id="inputName" placeholder="What's App number">
                                        </div>
                                        @if ($errors->has('whats_app'))
                                            <span class="error text-danger ">{{ $errors->first('whats_app') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="old_password"
                                                class="form-control @error('old_password') is-invalid border border-danger @enderror"
                                                id="inputEmail" placeholder="old Password">
                                        </div>
                                        @if ($errors->has('old_password'))
                                            <span class="error text-danger ">{{ $errors->first('old_password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid border border-danger @enderror"
                                                id="inputEmail" placeholder="New Password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="error text-danger ">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid border border-danger @enderror"
                                                id="inputEmail">
                                            <img src="{{ asset($userdata->image) }}" alt="profile-image" height="80px"
                                                width="80px">
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="error text-danger ">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row my-3 ml-auto">
                                        <div class="offset-sm-2 col-sm-10 ">
                                            <button type="submit" class="btn btn-success ">Update</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
