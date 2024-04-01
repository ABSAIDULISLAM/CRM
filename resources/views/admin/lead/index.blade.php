@extends('admin.layout.app')
@section('title', 'Leads')

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
                    <h3 class="page-title">Leads</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Leads</li>
                    </ul>
                </div>
                <div class="col-md-8 float-end ms-auto">
                    <div class="d-flex title-head">
                        <div class="view-icons">
                            <a href="javascript:void(0);" class="list-view btn btn-link" id="collapse-header"><i
                                    class="las la-expand-arrows-alt"></i></a>
                            <a href="javascript:void(0);" class="list-view btn btn-link" id="filter_search"><i
                                    class="las la-filter"></i></a>
                        </div>
                        <div class="form-sort">
                            {{-- <a href="javascript:void(0);" class="list-view btn btn-link" data-bs-toggle="modal"
                                data-bs-target="#export"><i class="las la-file-export"></i>Export</a> --}}
                        </div>
                        <a href="{{route('Lead.create')}}" class="btn add-btn" ><i
                                class="la la-plus-circle"></i> Add
                            Leads</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-filelds" id="filter_inputs">
            <div class="row filter-row">
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Lead Name</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus">
                        <input type="email" class="form-control floating">
                        <label class="focus-label">Email</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus focused">
                        <input type="text" class="form-control  date-range bookingrange">
                        <label class="focus-label">From - To Date</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>--Select--</option>
                            <option>Closed</option>
                            <option>Not Contacted</option>
                            <option>Contacted</option>
                            <option>Lost</option>
                        </select>
                        <label class="focus-label">Lead Status</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating">
                            <option>--Select--</option>
                            <option>NovaWaveLLC</option>
                            <option>SilverHawk</option>
                            <option>SummitPeak</option>
                            <option>HarborView</option>
                            <option>Redwood Inc</option>
                        </select>
                        <label class="focus-label">Lead Name</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <a href="#" class="btn btn-success w-100"> Search </a>
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
                    @php
                        use App\Models\ContactLead;
                    @endphp
                    <table class="table table-striped custom-table datatable contact-table">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th class="no-sort text-end">Action</th>
                                <th>Company Name</th>
                                <th>Lead Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Last Contact</th>
                                <th>Next contact date</th>
                                <th>contact record</th>
                                <th>Lead Status</th>
                                <th>Created Date</th>
                                <th>Lead Owner</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leads as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if ($item->status == 'active')
                                            <a class="dropdown-item" href="{{route('Lead.convert.client',['id' => Crypt::encrypt($item->id)]) }}"  onclick="return confirm('Aye you sure to Convert This Lead Into CLient ??')"><i class="fa-solid fa-pencil m-r-5"></i>
                                                Convret To Client</a>
                                            @endif
                                            <a class="dropdown-item" href="#" onclick="contactModal({{$item->id}})"><i
                                                    class="fa-regular fa-add m-r-5"></i>
                                                Contact Record</a>
                                            <a class="dropdown-item" href="{{route('Lead.edit',['id' => Crypt::encrypt($item->id)]) }}"><i class="fa-solid fa-pencil m-r-5"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="{{route('Lead.view',['id' => Crypt::encrypt($item->id)]) }}"><i class="fa-regular fa-eye m-r-5"></i>
                                                Preview</a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#delete_company"><i
                                                    class="fa-regular fa-trash-can m-r-5"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$item->company_name}}</td>
                                <td>
                                    <h2 class="table-avatar d-flex align-items-center">
                                        <a href="{{route('Lead.view',['id' => Crypt::encrypt($item->id)]) }}" class="company-img">
                                            <img src="{{ asset($item->image ?: 'backend/assets/img/icons/company-icon-10.svg') }}" alt="Company Image">
                                        </a>
                                        <a class="text-success text-bold" href="{{route('Lead.view',['id' => Crypt::encrypt($item->id)]) }}" class="profile-split">{{$item->name}}</a>
                                    </h2>
                                </td>
                                <td> {{$item->mobile}}</td>
                                <td> {{$item->email}}</td>
                                <td>
                                    @php
                                        $lastInfo = ContactLead::where('lead_id', $item->id)->latest()->first();
                                        $lastcontact = $lastInfo->created_at;
                                    @endphp
                                    {{ $lastcontact->format('Y-m-d') }}
                                </td>
                                <td>
                                    @php
                                        $lastInfo = ContactLead::where('lead_id', $item->id)->latest()->first();
                                        $lastcontact = $lastInfo->next_contact_date;
                                        $lastcontact = $lastcontact ? \Carbon\Carbon::parse($lastcontact) : null;

                                        if ($lastcontact) {
                                            $isWithin5Days = $lastcontact->diffInDays(\Carbon\Carbon::now()) <= 5;
                                            $color = $isWithin5Days ? 'color:red;' : '';
                                            $formattedDate = $lastcontact->format('Y-m-d');
                                        } else {
                                            $color = '';
                                            $formattedDate = 'null';
                                        }
                                    @endphp
                                    <span style="{{ $color }}">{{ $formattedDate }}</span>
                                </td>
                                <td>
                                  {{-- @php
                                        $notes = ContactLead::where('lead_id', $item->id)->whereNotNull('note')->latest()->limit(1)->get();
                                        $note = $notes->isNotEmpty() ? $notes->first()->note : null;
                                    @endphp --}}

                                    {{ $lastInfo->note ?? 'null'}}
                                </td>
                                <td>
                                    <a href="{{route('Lead.status.update',['id' => Crypt::encrypt($item->id)])}}" onclick="return confirm('Aye you sure to change status ??')" class="text-white btn btn-sm badge-{{ $item->status == 'active' ? 'success' : 'danger' }}">
                                        {{ $item->status }}
                                    </a>
                                </td>
                                <td> {{$item->created_at}}</td>
                                <td> {{$item->user->name}}</td>

                            </tr>
                            @includeIf('admin.lead.partial.delete')
                            @includeIf('admin.lead.partial.contact-record-result')
                            @empty
                            <tr><td colspan="9" class="text-center">No Data Found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @includeIf('admin.lead.partial.add-lead')
    @includeIf('admin.lead.partial.contact-record-result')
    @includeIf('admin.lead.partial.next-contact-date')


<script>
    function contactModal(id){
        $('#NextContactDate').modal('show');
        $('#NextContactDate').find('input[name="id"]').val(id);
    }
</script>

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
