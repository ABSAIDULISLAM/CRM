@extends('admin.layout.app')
@section('title', 'renewal-list')

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
                    <h3 class="page-title">Renewal List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Renewal List</li>
                    </ul>
                </div>
                {{-- <div class="col-md-8 float-end ms-auto">
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
                </div> --}}
            </div>
        </div>
        <hr>
        @includeIf('errors.error')
        <form action="{{ route('Service.send.message') }}" method="post">
            @csrf
            <div class="filter-section">
                <button type="submit" name="type" value="sendsms" class="btn btn-primary" onclick="return confirm('Are Your Sure Want To Send SMS')">Send SMS</button>
                <button type="submit" name="type" value="sendmail" class="btn btn-primary" onclick="return confirm('Are Your Sure Want To Send Mail')">Send Mail</button>
                <button type="submit" name="type" value="both" class="btn btn-primary" onclick="return confirm('Are Your Sure Want To Send SMS & Mail')">SMS & Mail</button>
                <ul>
                    <li>
                        <div class="search-set">
                            <div class="search-input">
                                <a href="#" class="btn btn-searchset"><i class="las la-search"></i></a>
                                <div class="dataTables_filter">
                                    <label> <input type="search" class="form-control form-control-sm"
                                            placeholder="Search"></label>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable contact-table">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th scope="col" class="col-md-1">
                                        <div class="form-check">
                                            <label class="form-check-label" for="selectAll">All</label>
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th>Invoice No.</th>
                                    <th>Client Name</th>
                                    <th>Renewal Type</th>
                                    <th>Renewal Fee</th>
                                    <th>Renew Now</th>
                                    <th>Next Renewal Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    @if ($item->client)
                                        @php
                                            $paidAmount = App\Models\Ledger::where('inv_id', $item->inv_id)->sum(
                                                'income',
                                            );
                                            $dueamount = $item->grand_total - $paidAmount;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox" type="checkbox" name="id[]"
                                                        value="{{ $item->id }}">
                                                    <label class="form-check-label"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('Invoice.view', Crypt::encrypt($item->id)) }}"
                                                    class="text-success">{{ $item->inv_id }}
                                                </a>
                                            </td>
                                            <td>{{ $item->client->name }}</td>
                                            <td>{{ $item->service_fee }}</td>

                                            <td>{{ $item->renewType }}</td>
                                            <td>
                                                <a href="#" class="btn btn-success"
                                                    onclick="contactModal({{ $item->id }},'{{ $item->inv_id }}','{{ $item->service_fee }}','{{ $item->renewType }}','{{ $item->client->user_id }}')">
                                                    Renew Now
                                                </a>
                                            </td>
                                            <td class="text-danger">
                                                {{ \Carbon\Carbon::parse($item->expiry_date)->isoFormat('DD MMM YYYY') }}
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
        </form>
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
    @if (session('data'))
        <div class="modal custom-modal fade custom-modal-two modal-padding" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-border justify-content-between p-0">
                        <h5 class="modal-title">Payment Slip</h5>
                        <button type="button" class="btn-close position-static" data-bs-dismiss="modal" aria-label="Close">
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
                                                    <h3 class="text-uppercase">Invoice #INV-{{ $data->inv_id }} </h3>
                                                    <ul class="list-unstyled">
                                                        <li>Print Date:
                                                            <span>{{ \Carbon\Carbon::now()->format('d-m-y') }}</span></li>
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
                                                                            {{ $data->discount ?? '0' }}/-</td>
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
                                                            <table class="table mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Renewal Type:</th>
                                                                        <td class="text-end">{{ $data->renewType }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Renew / Service Charge: <span class="text-regular"></span>
                                                                        </th>
                                                                        <td class="text-end">{{$data->service_fee}}/-</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Paid Amount:</th>
                                                                        <td class="text-end text-primary">
                                                                            <h5>{{ $data->service_fee }}/-
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

    <script>
        $(document).ready(function() {
            $('#myModal').modal('show');
        });
    </script>


    @includeIf('admin.invoice.partial.renew')
    <script>
        function contactModal(id, invId, fee, type,userId) {
            $('#renew').modal('show');
            $('#renewId').val(id);
            $('#invId').val(invId);
            $('#userId').val(userId);
            $('#service_fee').val(fee);
            if (type === 'monthly') {
                $('#monthlyRadio').prop('checked', true);
            } else {
                $('#yearlyRadio').prop('checked', true);
            }
        }
    </script>
    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.getElementsByClassName('checkbox');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
            }
        });
    </script>


    @includeIf('admin.invoice.partial.filter')


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
