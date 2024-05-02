
@php
    if(auth()->user()->role_as == 'admin'){
        $myRoute = 'Admin';
    } elseif (auth()->user()->role_as == 'office_staff') {
        $myRoute = 'Office';
    } elseif (auth()->user()->role_as == 'marketing_staff') {
        $myRoute = 'Marketing';
    } else{
        $myRoute = 'User';
    }
@endphp

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            <ul class="sidebar-vertical">

                <li>
                    <a href="{{route('Marketing.dashboard')}}"  class="{{ Request::is('marketing-staff/dashboard') ? 'active' : ''}}"><i class="la la-chart-area"></i> <span> Dashboard </span></a>
                </li>
                {{-- <li>
                    <a href="{{route('Lead.index')}}"  class="{{ Request::is('lead/index') ? 'text-primary' : ''}}"><i class="la la-chart-area"></i> <span> Leads </span></a>
                </li> --}}


            </ul>
        </div>
    </div>
</div>


