
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
                    <a href="{{route('User.dashboard')}}"  class="{{ Request::is('user/dashboard') ? 'active' : ''}}"><i class="la la-chart-area"></i> <span> Dashboard </span></a>
                </li>
                <li>
                    <a href="{{route('User.payment.history')}}"  class="{{ Request::is('user/payment/history') ? 'active' : ''}}"><i class="la la-money-bill-wave"></i> <span>Payment History</span></a>
                </li>

            </ul>
        </div>
    </div>
</div>


