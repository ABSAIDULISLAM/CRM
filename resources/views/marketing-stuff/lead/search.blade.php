<div class="table-responsive">
    @php
        use App\Models\ContactLead;
    @endphp
    <table id="example1" class="table table-striped custom-table datatable contact-table">
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
                <th>Product</th>
                <th>Lead Status</th>
                <th>Lead Region</th>
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
                            <a class="dropdown-item" href="{{route('Marketing.lead.convert.client',['id' => Crypt::encrypt($item->id)]) }}"  onclick="return confirm('Aye you sure to Convert This Lead Into CLient ??')"><i class="fas fa-exchange-alt m-r-5"></i>
                                Convret To Client</a>
                            @endif
                            <a class="dropdown-item" href="#" onclick="contactModal({{$item->id}})"><i
                                    class="fa-regular fa-add m-r-5"></i>
                                Contact Record</a>
                            <a class="dropdown-item" href="{{route('Marketing.lead.edit',['id' => Crypt::encrypt($item->id)]) }}"><i class="fa-solid fa-pencil m-r-5"></i>
                                Edit</a>
                            <a class="dropdown-item" href="{{route('Marketing.lead.view',['id' => Crypt::encrypt($item->id)]) }}"><i class="fa-regular fa-eye m-r-5"></i>
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
                        <a href="{{route('Marketing.lead.view',['id' => Crypt::encrypt($item->id)]) }}" class="company-img">
                            <img src="{{ asset($item->image ?: 'backend/assets/img/icons/company-icon-10.svg') }}" alt="Company Image">
                        </a>
                        <a class="text-success text-bold" href="{{route('Office.lead.view',['id' => Crypt::encrypt($item->id)]) }}" class="profile-split">{{$item->name}}</a>
                    </h2>
                </td>
                <td> {{$item->mobile}}</td>
                <td> {{$item->email ?? 'null'}}</td>
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
                <td> {{$item->product->name ?? 'Null'}}</td>
                <td>
                    <a href="{{route('Marketing.lead.status.update',['id' => Crypt::encrypt($item->id)])}}" onclick="return confirm('Aye you sure to change status ??')" class="text-white btn btn-sm badge-{{ $item->status == 'active' ? 'success' : 'danger' }}">
                        {{ $item->status }}
                    </a>
                </td>
                <td> {{$item->upazila->thana_name}}</td>
                <td> {{$item->created_at->format('Y-m-d')}}</td>
                <td> {{$item->user->name}}</td>

            </tr>
            @includeIf('marketing-stuff.lead.partial.delete')
            @includeIf('marketing-stuff.lead.partial.contact-record-result')
            @empty
            <tr><td colspan="14" class="text-center">No Data Found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
