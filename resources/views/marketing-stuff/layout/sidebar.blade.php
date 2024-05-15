

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            <ul class="sidebar-vertical">

                <li>
                    <a href="{{route('Marketing.dashboard')}}" class="{{ Request::is('marketing-staff/dashboard') ? 'text-primary' : ''}}"><i class="la la-chart-area"></i> <span> Dashboard </span></a>
                </li>
                <li>
                    <a href="{{ route('Marketing.lead.index') }}" class="{{ Request::is('marketing-staff/lead/index') ? 'text-primary' : '' }}">
                        <i class="la la-chart-area"></i> <span>My Leads </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('profile')}}"  class="{{ Request::is('profile') ? 'text-primary' : ''}}"><i class="la la-chart-area"></i> <span> Profile </span></a>
                </li>

            </ul>
        </div>
    </div>
</div>


