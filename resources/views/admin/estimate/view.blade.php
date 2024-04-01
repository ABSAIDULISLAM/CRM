@extends('admin.layout.app')

@section('title', 'View-invoice')
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
                    <h3 class="page-title">Estimate</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Estimate</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-white">CSV</button>
                        <button class="btn btn-white">PDF</button>
                        <button  onclick="window.print();" class="btn btn-white"><i class="fa-solid fa-print fa-lg"></i>
                            Print</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="contentToPrint">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 m-b-20">
                                <img src="{{ asset('backend/assets/img/logo2.png') }}" class="inv-logo" alt="Logo">
                                <ul class="list-unstyled">
                                    <li>Coder King IT Solution</li>
                                    <li>Barishal, Bangladesh</li>
                                    <li>GST No: #0512</li>
                                </ul>
                            </div>
                            <div class="col-sm-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-uppercase">Invoice #INV-{{$data->inv_id}}</h3>
                                    <ul class="list-unstyled">
                                        <li>Print Date: <span>{{ \Carbon\Carbon::now()->format('d-m-y') }}</span></li>
                                        <li>Due date: <span>{{ \Carbon\Carbon::parse($data->expiry_date)->format('d-m-y') }}</span></li>

                                        <hr style="color: #bdbdbd;padding:2px; margin:2px">
                                        <h5>Invoice to:</h5>
                                        <li>
                                            <h5><strong>{{$data->lead->name}}</strong></h5>
                                        </li>
                                        <li><span>{{$data->lead->company_address}}</span></li>
                                        <li>{{$data->lead->address}}</li>
                                        <li>{{$data->lead->mobile}}</li>
                                        <li>{{$data->lead->email}}</li>
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
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$item->product->name}}</td>
                                        <td class="d-none d-sm-table-cell">{{$item->description}}</td>
                                        <td>{{$item->price}}/-</td>
                                        <td>{{$item->qty}}</td>
                                        <td class="text-end">{{$item->total}}/-</td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="row invoice-payment">
                                <div class="col-sm-7">
                                </div>
                                <div class="col-sm-5">
                                    <div class="m-b-20">
                                        <div class="table- no-border">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th>Subtotal:</th>
                                                        <td class="text-end">{{$data->subTotal}}/-</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Renew / Service Charge: <span class="text-regular"></span>
                                                        </th>
                                                        <td class="text-end">{{$data->service_fee}}/- {{$data->renewType}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount: <span class="text-regular"></span>
                                                        </th>
                                                        <td class="text-end">{{$data->discount ?? '0'}}/-</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td class="text-end text-primary">
                                                            <h5>{{ $data->grand_total + $data->service_fee}}/-</h5>
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
                                <p style="border: 1px solid #d1d0d0; padding: 5px;" class="text-muted">{{$data->other_info}} </p>
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
