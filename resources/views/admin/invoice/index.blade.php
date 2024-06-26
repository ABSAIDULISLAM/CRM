@extends('admin.layout.app')
@section('title', 'invoice')

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
                    <h3 class="page-title">Invoice</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ul>
                </div>
                <div class="col-md-8 float-end ms-auto">
                    <div class="d-flex title-head">
                        <div class="view-icons">
                            <a href="javascript:void(0);" class="list-view btn btn-link" id="collapse-header"><i
                                    class="las la-expand-arrows-alt"></i></a>
                        </div>
                        <div class="form-sort">
                            <a href="javascript:void(0);" class="list-view btn btn-link" data-bs-toggle="modal"
                                data-bs-target="#invoiceFilter"><i class="las la-file-export"></i>Filter</a>
                        </div>
                        <a href="{{ route('Invoice.create') }}" class="btn add-btn"><i class="la la-plus-circle"></i> Add
                            Invoice</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="filter-section">
            <ul>
                <li>
                    <div class="search-set">
                        <div class="search-input">
                            <a href="#" class="btn btn-searchset"><i class="las la-search"></i></a>
                            <div class="dataTables_filter">
                                <label> <input type="search" id="searchInput" class="form-control form-control-sm"
                                        placeholder="Search by INV, Name"></label>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped custom-table datatable contact-table">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th class="no-sort text-end">Action</th>
                                <th>Invoice No.</th>
                                <th>Client Name</th>
                                <th>Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Payment Status</th>
                                <th>Created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                @if ($item->client)
                                    @php
                                        $paidAmount = App\Models\Ledger::where('inv_id', $item->inv_id)->sum('income');
                                        $dueamount = $item->grand_total - $paidAmount;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    @if ($item->payment_status != 'paid')
                                                        <a class="dropdown-item"
                                                            href="{{ route('Invoice.pay-now', ['id' => Crypt::encrypt($item->id), 'inv' => $item->inv_id, 'payable' => $dueamount]) }}"><i
                                                                class="fab fa-dollar m-r-5"></i>
                                                            Pay Now</a>
                                                    @endif
                                                    <a class="dropdown-item"
                                                        href="{{ route('Invoice.view', Crypt::encrypt($item->id)) }}"><i
                                                            class="fa-regular fa-eye"></i>
                                                        Preview</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('Invoice.edit', Crypt::encrypt($item->id)) }}"><i
                                                            class="fa-solid fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete_estimate"><i
                                                            class="fa-regular fa-trash-can m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><a href="{{ route('Invoice.view', Crypt::encrypt($item->id)) }}"
                                                class="text-success">{{ $item->inv_id }}</a></td>
                                        <td>{{ $item->client->name }}</td>
                                        <td>{{ $item->grand_total }}</td>
                                        <td>{{ $paidAmount }}</td>
                                        <td> {{ $dueamount }}</td>
                                        <td><span
                                                class="badge badge-{{ $item->payment_status === 'paid' ? 'success' : ($item->payment_status === 'partial' ? 'warning' : 'danger') }}"
                                                style="font-size: 15px;">
                                                {{ $item->payment_status }}
                                            </span>
                                        </td>
                                        <td>{{ $item->created_at }}</td>

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
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #contentToPrint,
            #contentToPrint * {
                visibility: visible;
            }

            #contentToPrint {
                /* position: absolute; */
                top: 0;
                left: 0;
                right: 0;
            }
        }
    </style>


    @if (session('dataforPayment'))
        <div class="modal custom-modal fade custom-modal-two modal-padding" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-border justify-content-between p-0">
                        <h5 class="modal-title">Payment Slip</h5>
                        <button type="button" class="btn-close position-static" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="card-header text-end">
                        <button onclick="window.print();">print</button>
                    </div>
                    <div class="modal-body p-0">
                        @php
                            $id = session('dataforPayment') ? session('dataforPayment')['id'] : null;
                            $data = App\Models\InvoiceSummary::where('id', $id)
                                ->with(['invdetails.product', 'client', 'creator'])
                                ->first();

                        @endphp

                        <div class="row " id="contentToPrint">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 m-b-20">
                                                <img src="{{ asset('backend/assets/img/logo2.png') }}" class="inv-logo"
                                                    alt="Logo">
                                                <ul class="list-unstyled">
                                                    <li>Coder King IT Solution</li>
                                                    <li>Barishal, Bangladesh</li>
                                                    <li>GST No: #0512</li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 m-b-20">
                                                <div class="invoice-details">
                                                    <h3 class="text-uppercase">Invoice #INV-{{ $data->inv_id }} </h3>
                                                    <ul class="list-unstyled">
                                                        <li>Print Date:
                                                            <span>{{ \Carbon\Carbon::now()->format('d-m-y') }}</span>
                                                        </li>
                                                        <li>Paid date:
                                                            <span>{{ \Carbon\Carbon::parse($data->date)->format('d-m-y') }}</span>
                                                        </li>

                                                        <hr style="color: #cfcfcf;padding:2px; margin:2px">
                                                        <h6> Status : <span
                                                                class="text-{{ $data->payment_status === 'paid' ? 'success' : ($data->payment_status === 'partial' ? 'warning' : 'danger') }}"
                                                                style="font-size: 15px;">
                                                                {{ $data->payment_status }}
                                                            </span></h6>
                                                        <hr style="color: #cfcfcf;padding:2px; margin:2px">
                                                        {{-- <h5>Invoice to:</h5> --}}
                                                        <li>
                                                            <h5>Invoice to: <strong>{{ $data->client->name }}</strong></h5>
                                                        </li>
                                                        <li>{{ $data->client->address }}</li>
                                                        <li>{{ $data->client->mobile }}</li>
                                                        <li>{{ $data->client->email }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ITEM</th>
                                                        <th class="d-none d-sm-table-cell">DESCRIPTION
                                                        </th>
                                                        <th>UNIT COST</th>
                                                        <th>QUANTITY</th>
                                                        <th class="text-end">TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($data->invdetails as $item)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $item->product->name }}</td>
                                                            <td class="d-none d-sm-table-cell">{{ $item->description }}
                                                            </td>
                                                            <td>{{ $item->price }}/-</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td class="text-end">{{ $item->total }}/-</td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <div class="row invoice-payment">
                                                <div class="col-sm-6">
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="m-b-20">
                                                        <div class="table- no-border">
                                                            <table class="table mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Subtotal:</th>
                                                                        <td class="text-end">{{ $data->subTotal }}/-</td>
                                                                    </tr>
                                                                    {{-- <tr>
                                                                <th>Renew / Service Charge: <span class="text-regular"></span>
                                                                </th>
                                                                <td class="text-end">{{$data->service_fee}}/- {{$data->renewType}} </td>
                                                            </tr> --}}
                                                                    <tr>
                                                                        <th>Discount: <span class="text-regular"></span>
                                                                        </th>
                                                                        <td class="text-end">
                                                                            {{$data->discount ?? '0' }}/-</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Total:</th>
                                                                        <td class="text-end text-primary">
                                                                            <h5>{{ $data->grand_total}}/-
                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="p-2" style="background-color: rgba(252, 162, 167, 0.2)">
                                                Renewal Payent details
                                            </div>
                                            <div class="row invoice-payment">
                                                <div class="col-sm-6">
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="m-b-20">
                                                        <div class="table- no-border">
                                                            @php
                                                                $payment = App\Models\Payment::where('inv_id', $data->inv_id)
                                                                                                ->latest()
                                                                                                ->first();
                                                            @endphp
                                                            <table class="table mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Payment Status: <span
                                                                                class="text-regular"></span>
                                                                        </th>
                                                                        <td class="text-end">{{ $payment->payment_status }}/-
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Paid Amount:</th>
                                                                        <td class="text-end text-primary">
                                                                            <h5>{{ $payment->paid_amount }}/-
                                                                            </h5>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4 mt-4">
                        =====================
                        (Accountant Signature)
                    </div>
                    <div class="col-md-4 mt-4">
                        =====================
                        (Accountant Signature)
                    </div>
                    <div class="col-md-4 mt-4">
                        =====================
                        (Accountant Signature)
                    </div>
                </div>
            </div> --}}
                </div>
            </div>
        </div>
    @endif


    @if (session('data'))
        <div class="modal custom-modal fade custom-modal-two modal-padding" id="myModal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header header-border justify-content-between p-0">
                        <h5 class="modal-title">Invoice</h5>
                        <button type="button" class="btn-close position-static" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="card-header text-end">
                        <button onclick="window.print();">print</button>
                    </div>
                    <div class="modal-body p-0">
                        @php
                            $id = session('data') ? session('data')['id'] : null;
                            $data = App\Models\InvoiceSummary::where('id', $id)
                                ->with(['invdetails.product', 'client', 'creator'])
                                ->first();

                        @endphp

                        <div class="row " id="contentToPrint">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 m-b-20">
                                                <img src="{{ asset('backend/assets/img/logo2.png') }}" class="inv-logo"
                                                    alt="Logo">
                                                <ul class="list-unstyled">
                                                    <li>Coder King IT Solution</li>
                                                    <li>Barishal, Bangladesh</li>
                                                    <li>GST No: #0512</li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 m-b-20">
                                                <div class="invoice-details">
                                                    <h3 class="text-uppercase">Invoice #INV-{{ $data->inv_id }} <span
                                                            class="text-danger"
                                                            style="font-size: 15px;">{{ $data->payment_status }}</span>
                                                    </h3>
                                                    <ul class="list-unstyled">
                                                        <li>Print Date:
                                                            <span>{{ \Carbon\Carbon::now()->format('d-m-y') }}</span></li>
                                                        <li>Due date:
                                                            <span>{{ \Carbon\Carbon::parse($data->expiry_date)->format('d-m-y') }}</span>
                                                        </li>

                                                        <hr style="color: #bdbdbd;padding:2px; margin:2px">
                                                        <h5>Invoice to:</h5>
                                                        <li>
                                                            <h5><strong>{{ $data->client->name }}</strong></h5>
                                                        </li>
                                                        <li>{{ $data->client->address }}</li>
                                                        <li>{{ $data->client->mobile }}</li>
                                                        <li>{{ $data->client->email }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsiv">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ITEM</th>
                                                        <th class="d-none d-sm-table-cell">DESCRIPTION
                                                        </th>
                                                        <th>UNIT COST</th>
                                                        <th>QUANTITY</th>
                                                        <th class="text-end">TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($data->invdetails as $item)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $item->product->name }}</td>
                                                            <td class="d-none d-sm-table-cell">{{ $item->description }}
                                                            </td>
                                                            <td>{{ $item->price }}/-</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td class="text-end">{{ $item->total }}/-</td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <div class="row invoice-payment">
                                                <div class="col-sm-6">
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="m-b-20">
                                                        <div class="table- no-border">
                                                            <table class="table mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Subtotal:</th>
                                                                        <td class="text-end">{{ $data->subTotal }}/-</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Renew / Service Charge: <span
                                                                                class="text-regular"></span>
                                                                        </th>
                                                                        <td class="text-end">{{ $data->service_fee }}/-
                                                                            {{ $data->renewType }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Discount: <span class="text-regular"></span>
                                                                        </th>
                                                                        <td class="text-end">
                                                                            {{ $data->discount ?? '0' }}/-</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Total:</th>
                                                                        <td class="text-end text-primary">
                                                                            <h5>{{ $data->grand_total + $data->service_fee }}/-
                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="invoice-info">
                                                <h5>Other information</h5>
                                                <p style="border: 1px solid #d1d0d0; padding: 5px;" class="text-muted">
                                                    {{ $data->other_info }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        $(document).ready(function() {
            $('#myModal').modal('show');
        });
    </script>

    @includeIf('admin.invoice.partial.filter')


@endsection

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

    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var query = $(this).val();
                fetchFilteredData(query);
            });

            function fetchFilteredData(query) {
                $.ajax({
                    url: "{{ route('Invoice.search') }}",
                    method: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        query: query
                    },
                    success: function(response) {
                        $('#example1').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
