@extends('admin.layout.app')

@section('title', 'View-Payment')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}">
@endpush
@section('content')

    <div class="content container-fluid pb-0">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Payment View</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('User.payment.history')}}" class="text-success"><i class="fas fa-arrow-left"></i> Back</a>
                        </li>
                        <li class="breadcrumb-item active">Payment View</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <div class="btn-group btn-group-sm">

                        <button  onclick="window.print();" class="btn btn-white"><i class="fa-solid fa-print fa-lg"></i>
                            Print</button>
                    </div>
                </div>
            </div>
        </div>
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
                                            @php
                                                $payment = App\Models\Payment::where('id', $id)
                                                                                ->latest()
                                                                                ->first();
                                            @endphp
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th>Payment Date: <span
                                                                class="text-regular"></span>
                                                        </th>
                                                        <td class="text-end">{{ Carbon\Carbon::parse($payment->date)->isoFormat("DD MMM YYYY") }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Amount:</th>
                                                        <td class="text-end text-primary">
                                                            <h5>{{ $payment->paid_amount }}/-
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <th>Due Amount:</th>
                                                        <td class="text-end text-primary">
                                                            <h5>{{ $payment->paid_amount }}/-
                                                            </h5>
                                                        </td>
                                                    </tr> --}}
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
@endpush
@push('css')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #contentToPrint, #contentToPrint * {
            visibility: visible;
        }
        #contentToPrint {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }
    }
</style>
@endpush
