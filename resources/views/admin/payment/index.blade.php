@extends('admin.layout.app')

@section('title', 'Payment')

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
                <div class="col">
                    <h3 class="page-title">Payment</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Payment </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="page-menu">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#all">ALl</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#paid">Paid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#pending">Partial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#unpaid">Unpaid</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>


        <div class="tab-content">

            <div class="tab-pane show active" id="all">
                <div class="payroll-table card">
                    <div class="table-responsive">
                        <table class="table table-hover table-radius">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Invoice ID</th>
                                    <th>Payment Date</th>
                                    <th class="">Paid Amount</th>
                                    <th class="">Created date</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                @if ($item->invoice && $item->invoice->client)
                                <tr>
                                    <th>{{$item->invoice->client->name}}</th>
                                    <td>
                                        <a href="{{ route('Payment.view', ['inv' => Crypt::encrypt($item->inv_id), 'id' => Crypt::encrypt($item->id)]) }}"
                                            class="text-success">{{ $item->inv_id }}
                                        </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->isoFormat('DD MMM YYYY') }}</td>
                                    <td>{{$item->paid_amount}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM YYYY') }}</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('Payment.edit')}}"><i class="fa-solid fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_addition"><i
                                                        class="fa-regular fa-trash-can m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Recoed Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="tab-pane" id="paid">
                <div class="payroll-table card">
                    <div class="table-responsive">
                        <table class="table table-hover table-radius">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Invoice ID</th>
                                    <th>Payment Date</th>
                                    <th class="">Paid Amount</th>
                                    <th class="">Created date</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data->where('payment_status', 'paid') as $item)
                                @if ($item->invoice && $item->invoice->client)
                                <tr>
                                    <th>{{$item->invoice->client->name}}</th>
                                    <td>{{$item->inv_id}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->isoFormat('DD MMM YYYY') }}</td>
                                    <td>{{$item->paid_amount}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM YYYY') }}</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('Payment.edit')}}"><i class="fa-solid fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_addition"><i
                                                        class="fa-regular fa-trash-can m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Recoed Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="tab-pane" id="pending">
                <div class="payroll-table card">
                    <div class="table-responsive">
                        <table class="table table-hover table-radius">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Invoice ID</th>
                                    <th>Payment Date</th>
                                    <th class="">Paid Amount</th>
                                    <th class="">Created date</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data->where('payment_status', 'partial') as $item)
                                @if ($item->invoice && $item->invoice->client)
                                <tr>
                                    <th>{{$item->invoice->client->name}}</th>
                                    <td>{{$item->inv_id}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->isoFormat('DD MMM YYYY') }}</td>
                                    <td>{{$item->paid_amount}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM YYYY') }}</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('Payment.edit')}}"><i class="fa-solid fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_addition"><i
                                                        class="fa-regular fa-trash-can m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Recoed Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="unpaid">
                <div class="payroll-table card">
                    <div class="table-responsive">
                        <table class="table table-hover table-radius">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Invoice ID</th>
                                    <th>Payment Date</th>
                                    <th class="">Paid Amount</th>
                                    <th class="">Created date</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data->where('payment_status', 'unpaid') as $item)
                                @if ($item->invoice && $item->invoice->client)
                                <tr>
                                    <th>{{$item->invoice->client->name}}</th>
                                    <td>{{$item->inv_id}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->isoFormat('DD MMM YYYY') }}</td>
                                    <td>{{$item->paid_amount}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM YYYY') }}</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('Payment.edit')}}"><i class="fa-solid fa-pencil m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_addition"><i
                                                        class="fa-regular fa-trash-can m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Recoed Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


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
