<div class="table-responsive">
    <table id="example1" class="table table-striped custom-table datatable contact-table">
        <thead>
            <tr>
                <th>Sl.</th>
                <th>Client Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
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
                                class="profile-split">{{ $item->name }}</a>
                        </h2>
                    </td>
                    <td> {{ $item->mobile }}</td>
                    <td> {{ $item->email ?? 'null' }}</td>
                    <td> {{ $item->address }}</td>
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
