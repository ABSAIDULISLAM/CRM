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
                    <h3 class="page-title">Payment History</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('User.dashboard')}}">Dashboard</a>
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
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                @if ($item->invoice && $item->invoice->client)
                                <tr>
                                    <th>{{$item->invoice->client->name}}</th>
                                    <td>
                                        <a href="{{ route('User.payment.view', ['inv' => Crypt::encrypt($item->inv_id), 'id' => Crypt::encrypt($item->id)]) }}"
                                            class="text-success">{{ $item->inv_id }}
                                        </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->isoFormat('DD MMM YYYY') }}</td>
                                    <td>{{$item->paid_amount}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM YYYY') }}</td>

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
