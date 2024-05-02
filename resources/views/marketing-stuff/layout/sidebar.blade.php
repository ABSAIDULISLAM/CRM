

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            <ul class="sidebar-vertical">

                <li>
                    <a href="{{route('Marketing.dashboard')}}" class="{{ Request::is('marketing-staff/dashboard') ? 'active' : ''}}"><i class="la la-chart-area"></i> <span> Dashboard </span></a>
                </li>
                <li>
                    <a href="{{ route('Marketing.lead.index') }}" class="{{ Request::is('Marketing/stuff/lead/list') ? 'text-primary' : '' }}">
                        <i class="la la-chart-area"></i> <span> Leads </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>


