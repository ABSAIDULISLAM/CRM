@extends('admin.layout.app')
@php
    $clientName = '';
@endphp
@section('title','view')
@section('content')

    <div class="content container-fluid pb-0">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"> Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Client.index')}}" class="text-success"><i class="fas fa-arrow-left"></i> Back</a>
                        </li>
                        <li class="breadcrumb-item active">Client Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 my-4">
                        {{-- <div class="card-header"><h5>Leads by</h5></div> --}}
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped custom-table datatable contact-table">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th class="no-sort text-end">Action</th>
                                        <th>Invoice No.</th>
                                        {{-- <th>Client Name</th> --}}
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
                                        <td>{{$loop->index+1}}</td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('Invoice.edit',Crypt::encrypt($item->id)) }}"><i
                                                            class="fa-solid fa-pencil m-r-5"></i>
                                                        Edit</a>
                                                    @if ($item->payment_status != 'paid' )
                                                    <a class="dropdown-item" href="{{ route('Invoice.pay-now',['id'=>Crypt::encrypt($item->id), 'inv'=>$item->inv_id, 'payable'=> $dueamount]) }}"><i
                                                        class="fab fa-dollar m-r-5"></i>
                                                    Pay Now</a>
                                                    @endif
                                                    <a class="dropdown-item" href="{{ route('Invoice.view', Crypt::encrypt($item->id)) }}"><i
                                                            class="fa-regular fa-eye"></i>
                                                        Preview</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete_estimate"><i class="fa-regular fa-trash-can m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><a href="{{ route('Invoice.view', Crypt::encrypt($item->id)) }}" class="text-success">{{$item->inv_id}}</a></td>
                                        {{-- <td>{{$item->client->name}}</td> --}}
                                        <td>{{$item->grand_total}}</td>
                                        <td>{{$paidAmount}}</td>
                                        <td> {{$dueamount}}</td>
                                        <td><span class="badge badge-{{ $item->payment_status === 'paid' ? 'success' : ($item->payment_status === 'partial' ? 'warning' : 'danger') }}" style="font-size: 15px;">
                                            {{ $item->payment_status }}
                                            </span>
                                        </td>
                                        <td>{{$item->created_at}}</td>

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
                                    <tr>
                                        <td colspan="9" class="text-center">No Record Found</td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
