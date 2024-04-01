<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            <ul class="sidebar-vertical">
                <li class="submenu">
                    <a href="#"><i class="la la-dashcube"></i> <span> Dashboard</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{route('Admin.dashboard')}}" class="{{ Request::is('admin/dashboard') ? 'active' : ''}}">Admin Dashboard</a>
                        </li>
                        {{-- <li><a href="employee-dashboard.html">Employee Dashboard</a></li>
                                  <li><a href="deals-dashboard.html">Deals Dashboard</a></li>
                                  <li><a href="leads-dashboard.html">Leads Dashboard</a></li> --}}
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span>Product</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{route('Product.create')}}" class="{{ Request::is('product/create') ? 'active' : ''}}">Create Product </a></li>
                                <li><a href="{{route('Product.index')}}" class="{{ Request::is('product/index') ? 'active' : ''}}">Manage Product </a></li>
                        <li><a href="{{route('Category.index')}}" class="{{ Request::is('category/index') ? 'active' : ''}}">Category</a></li>
                        <li><a href="{{route('Sub-category.index')}}"  class="{{ Request::is('sub-category/index') ? 'active' : ''}}" >Sub-category</a></li>
                    </ul>
                </li>
                <li class="submenu" {{ Request::is('product*') ? 'active' : ''}}>
                    <a href="#"><i class="la la-money-bill-wave"></i> <span> Sales </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{route('Estimate.index')}}" class="{{ Request::is('estimate/index') ? 'active' : ''}}"> Estimate</a></li>
                        <li><a href="{{route('Invoice.index')}}" class="{{ Request::is('invoice/index') ? 'active' : ''}}">Invoices</a></li>
                        <li><a href="{{route('Invoice.renewal.list')}}" class="{{ Request::is('invoice/renewal-list') ? 'active' : ''}}">Renewal List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('Payment.index')}}" class="{{ Request::is('payment*') ? 'text-primary' : ''}}"><i class="la la-user-shield"></i> <span> Payments
                        </span></a>
                </li>
                <li class=" submenu">
                    <a href="#"><i class="la la-money-bill-wave"></i> <span> Services </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{route('Service.index')}}" class="{{ Request::is('service*') ? 'active' : ''}}"> Reneue Service</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('Lead.index')}}"  class="{{ Request::is('lead/index') ? 'text-primary' : ''}}"><i class="la la-chart-area"></i> <span> Leads </span></a>
                </li>
                <li>
                    <a href="{{route('Client.index')}}" class="{{ Request::is('client*') ? 'text-primary' : ''}}"><i class="la la-exchange-alt"></i> <span> Client
                        </span></a>
                </li>
                <li>
                    <a href="{{route('Lead-owner.index')}}" class="{{ Request::is('leads/owner/*') ? 'text-primary' : ''}}"><i class="la la-dice"></i> <span> Lead Owner
                        </span></a>
                </li>

            </ul>
        </div>
    </div>
</div>
