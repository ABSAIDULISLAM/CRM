<div class="table-responsive">
    <table id="example1" class="table table-striped custom-table datatable contact-table">
        <thead>
            <tr>
                <th>Sl.</th>
                <th class="no-sort text-end">Action</th>
                <th>Estimate Number</th>
                <th>Lead Name</th>
                <th>Estimate Date</th>
                <th>Expiry Date </th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                @if ($item->lead && $item->creator)
                    <tr>
                        <td>{{ $loop->index+1}}</td>
                        <td class="text-end">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item"
                                        href="{{ route('Estimate.edit', Crypt::encrypt($item->id)) }}"><i
                                            class="fa-solid fa-pencil m-r-5"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#delete_estimate"><i
                                            class="fa-regular fa-trash-can m-r-5"></i>
                                        Delete</a>

                                    <a class="dropdown-item"
                                        href="{{ route('Estimate.view', Crypt::encrypt($item->id)) }}"><i
                                            class="fa-regular fa-eye"></i>
                                        Preview</a>
                                    <a class="dropdown-item"
                                        href="{{ route('Estimate.convert.invoice', Crypt::encrypt($item->id)) }}"
                                        onclick="return confirm('Are you sure to This Item Convert To Invoice ?? ')"><i
                                            class="fas fa-exchange-alt"></i>
                                        Convert to Invoice</a>
                                </div>
                            </div>
                        </td>
                        <td><a href="{{ route('Estimate.view', Crypt::encrypt($item->id)) }}"
                                class="text-success">{{ $item->inv_id }}</a></td>
                        <td>{{ $item->lead->company_name }}</td>
                        <td>{{ $item->estimate_date }}</td>
                        <td><span class="">{{ $item->expiry_date }}</span></td>
                        <td>{{ $item->grand_total }}</td>

                    </tr>
                    <div class="modal custom-modal fade" id="delete_estimate" role="dialog">
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
                                            <a href="{{ route('Estimate.delete', Crypt::encrypt($item->id)) }}"
                                                class="btn btn-primary">Okay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            @empty
            @endforelse

        </tbody>
    </table>
</div>
